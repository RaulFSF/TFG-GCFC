<?php

namespace App\Filament\Resources\CategoryMatchResource\Pages;

use App\Filament\Resources\CategoryMatchResource;
use App\Models\Category;
use App\Models\CategoryMatch;
use App\Models\Player;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Routing\Route;

class MatchReport extends Page
{
    protected static string $resource = CategoryMatchResource::class;

    protected static string $view = 'filament.resources.category-match-resource.pages.match-report';

    public CategoryMatch $match;

    public function mount($record): void
    {
        $this->match = CategoryMatch::where('id', $record)->first();

        abort_unless(auth()->user()->role === 'prompter', 403);
        $this->form->fill([
            'league' => $this->match->matchDay->league->name,
            'date' => $this->match->date,
            'local_team' => $this->match->local->team->name,
            'visitor_team' => $this->match->visitor->team->name,
        ]);
    }

    protected function getFormSchema(): array
    {

        $local_players = Player::where('category_id', Category::where('id', CategoryMatch::where('id', $this->match->id)->first()->local_id)->first()->id)->get();
        $visitor_players = Player::where('category_id', Category::where('id', CategoryMatch::where('id', $this->match->id)->first()->visitor_id)->first()->id)->get();
        $players = array_flip(array_merge($local_players->pluck('id', 'name')->toArray(), $visitor_players->pluck('id', 'name')->toArray()));

        return [
            Tabs::make('Heading')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Información general')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('league')->disabled(),
                                    TextInput::make('date')->disabled(),

                                    TextInput::make('local_team')->label('Local')->disabled(),
                                    TextInput::make('visitor_team')->label('Local')->disabled(),
                                ]),
                        ]),
                    Tabs\Tab::make('Alineaciones')
                        ->icon('heroicon-o-user-circle')
                        ->schema([
                            Select::make('local_players')
                                ->label('Jugadores de equipo local')
                                ->multiple()
                                ->minItems(11)
                                ->maxItems(18)
                                ->options($local_players->pluck('name', 'id')),
                            Select::make('visitor_players')
                                ->label('Jugadores de equipo visitante')
                                ->multiple()
                                ->minItems(11)
                                ->maxItems(18)
                                ->options($visitor_players->pluck('name', 'id')),
                        ]),
                    Tabs\Tab::make('Eventos del partido')
                        ->icon('heroicon-o-clipboard-list')
                        ->schema([
                            Builder::make('content')
                                ->label('Evento')
                                ->blocks([
                                    Builder\Block::make('goals')
                                        ->label('Gol')
                                        ->schema([
                                            Select::make('goal_player')
                                                ->label('Gol')
                                                ->options($players),
                                            Select::make('goal_assist')
                                                ->label('Asistencia')
                                                ->options($players),
                                        ]),
                                    Builder\Block::make('cards')
                                        ->label('Tarjetas')
                                        ->schema([
                                            Select::make('yellow_cards')
                                                ->label('Tarjetas amarillas')
                                                ->options($players)
                                                ->multiple(),
                                            Select::make('red_cards')
                                                ->label('Tarjetas rojas')
                                                ->options($players)
                                                ->multiple(),
                                        ]),

                                ]),
                        ]),
                ])
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->match->report) {
            Notification::make()
                ->title('Ya existe un informe para este partido')
                ->danger()
                ->seconds(5)
                ->send();
        } else {

            $goals = array();
            $yellowCards = array();
            $redCards = array();
            foreach ($this->content as $content) {
                if ($content['type'] === 'goals') {
                    array_push($goals, $content['data']);
                } else {
                    array_push($yellowCards, $content['data']['yellow_cards']);
                    array_push($redCards, $content['data']['red_cards']);
                }
            }

            $this->match->report = json_encode([
                'local_players' => $this->local_players,
                'visitor_players' => $this->visitor_players,
                'goals' => $goals,
                'yellow_cards' => $yellowCards,
                'red_cards' => $redCards,
            ]);

            //falla al crear un informe para jugadores nuevos no se por que

            //actualizar el history de cada player añadiendole sus cosas
            if ($this->match->save()) {

                $players = array_merge($this->local_players, $this->visitor_players);

                //partido jugado
                foreach ($players as $player_id) {
                    //comprobar historial si tiene el de la categoria y añadirle datos a ese historial
                    $player = Player::where('id', $player_id)->first();

                    //historial con equipo activo
                    if ($player->history && $player->history[$player->category_id]) {
                        $history = json_decode($player->history, true);

                        $history[$player->category_id] = [
                            'played' => ++$history[$player->category_id]['played'],
                            'goals' => $history[$player->category_id]['goals'],
                            'assits' => $history[$player->category_id]['assits'],
                            'yellowCards' => $history[$player->category_id]['yellowCards'],
                            'redCards' => $history[$player->category_id]['redCards'],
                        ];

                        $player->history = json_encode($history);
                        $player->save();

                        //si no tiene historial con el equipo se lo creo
                    } else {
                        $history = json_encode([
                            $player->category_id => [
                                'played' => 1,
                                'goals' => 0,
                                'assits' => 0,
                                'yellowCards' => 0,
                                'redCards' => 0,
                            ]
                        ]);
                        $player->history = $history;
                        $player->save();
                    }
                }
                //goles
                foreach ($goals as $goal) {
                    //marca
                    $goal_player = Player::where('id', $goal['goal_player'])->first();
                    $history = json_decode($goal_player->history, true);

                    $history[$goal_player->category_id] = [
                        'played' => $history[$goal_player->category_id]['played'],
                        'goals' => ++$history[$goal_player->category_id]['goals'],
                        'assits' => $history[$goal_player->category_id]['assits'],
                        'yellowCards' => $history[$goal_player->category_id]['yellowCards'],
                        'redCards' => $history[$goal_player->category_id]['redCards'],
                    ];
                    $goal_player->history = json_encode($history);
                    $goal_player->save();

                    //asistencia
                    $assit_player = Player::where('id', $goal['goal_assist'])->first();
                    $history = json_decode($assit_player->history, true);

                    $history[$assit_player->category_id] = [
                        'played' => $history[$assit_player->category_id]['played'],
                        'goals' => $history[$assit_player->category_id]['goals'],
                        'assits' => ++$history[$assit_player->category_id]['assits'],
                        'yellowCards' => $history[$assit_player->category_id]['yellowCards'],
                        'redCards' => $history[$assit_player->category_id]['redCards'],
                    ];
                    $assit_player->history = json_encode($history);
                    $assit_player->save();
                }

                //amarillas
                foreach ($yellowCards as $card) {
                    $player = Player::where('id', $card)->first();
                    $history = json_decode($player->history, true);
                    $history[$player->category_id] = [
                        'played' => $history[$player->category_id]['played'],
                        'goals' => $history[$player->category_id]['goals'],
                        'assits' => $history[$player->category_id]['assits'],
                        'yellowCards' => ++$history[$player->category_id]['yellowCards'],
                        'redCards' => $history[$player->category_id]['redCards'],
                    ];
                    $player->history = json_encode($history);
                    $player->save();
                }
                //rojas
                foreach ($redCards as $card) {
                    $player = Player::where('id', $card)->first();
                    $history = json_decode($player->history, true);
                    $history[$player->category_id] = [
                        'played' => $history[$player->category_id]['played'],
                        'goals' => $history[$player->category_id]['goals'],
                        'assits' => $history[$player->category_id]['assits'],
                        'yellowCards' => $history[$player->category_id]['yellowCards'],
                        'redCards' => ++$history[$player->category_id]['redCards'],
                    ];
                    $player->history = json_encode($history);
                    $player->save();
                }
            }

            Notification::make()
                ->title('Informe guardado con éxito')
                ->success()
                ->seconds(5)
                ->send();

            }
            redirect()->to('/admin/category-matches');
    }
}
