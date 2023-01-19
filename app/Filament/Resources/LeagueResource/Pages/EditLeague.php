<?php

namespace App\Filament\Resources\LeagueResource\Pages;

use App\Filament\Resources\LeagueResource;
use App\Models\Category;
use App\Models\CategoryMatch;
use App\Models\League;
use App\Models\MatchDay;
use App\Models\Prompter;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeague extends EditRecord
{
    protected static string $resource = LeagueResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('Generar jornadas')->action('matchDays')->hidden($this->record->start_date === null)
                ->requiresConfirmation()
                ->modalHeading('Generar jornadas')
                ->modalSubheading('¿Está seguro que quiere generar las jornadas de esta liga? Perderá todos los datos actuales de la liga incluyendo los partidos y jornadas'),
            Actions\DeleteAction::make()->before(function (League $record) {
                foreach ($record->categories as $category_id) {
                    $category = Category::where('id', $category_id->id)->first();
                    $category->league_id = null;
                    $category->save();
                }
            }),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $year = Carbon::createFromFormat('Y-m-d', $data['start_date'])->format('Y');
        $season = $year . '/' . $year + 1;
        $data['season'] = $season;

        return $data;
    }

    public function matchDays(): void
    {
        //Comprobar si hay equipos asignados a la liga
        $this->record->categories;
        if (count($this->record->categories) == 0) {
            Notification::make()
                ->warning()
                ->title('Debe añadir equipos a la liga')
                ->body('Asocie los equipos en el recurso inferior')
                ->send();

            $this->halt();
        }

        //Borrar jornadas y partidos si ya existen
        $matchDays = MatchDay::where('league_id', $this->record->id)->get();
        foreach ($matchDays as $matchDay) {
            foreach ($matchDay->categoryMatches as $categoryMatch) {
                $categoryMatch->delete();
            }
            $matchDay->delete();
        }
        //Crear jornadas
        $firstMatchDay = Carbon::parse($this->record->start_date . ' next friday')->toDateString();
        $emparejamientos = array();

        $teams = array();
        foreach ($this->record->categories as $category) {
            array_push($teams, $category->id);
        }

        $teamNum = count($this->record->categories);

        if ($teamNum % 2 == 0) {
            //Equipos Pares
            $numRound = $teamNum - 1;
            $numMatchesPerRound = $teamNum / 2;

            for ($i = 0, $k = 0; $i < $numRound; $i++) {
                for ($j = 0; $j < $numMatchesPerRound; $j++) {
                    $emparejamientos[$i][$j]['local'] = $teams[$k];

                    $k++;
                    if ($k == $numRound) {
                        $k = 0;
                    }
                }
            }

            for ($i = 0; $i < $numRound; $i++) {
                if ($i % 2 == 0) {
                    $emparejamientos[$i][0]['visitante'] = $teams[count($teams) - 1];
                } else {
                    $emparejamientos[$i][0]['visitante'] = $emparejamientos[$i][0]['local'];
                    $emparejamientos[$i][0]['local'] = $teams[count($teams) - 1];
                }
            }

            $maxTeam = $teamNum - 1;
            $oddMaxTeam = $maxTeam - 1;
            for ($i = 0, $k = $oddMaxTeam; $i < $numRound; $i++) {
                for ($j = 1; $j < $numMatchesPerRound; $j++) {
                    $emparejamientos[$i][$j]['visitante'] = $teams[$k];

                    $k--;

                    if ($k == -1) {
                        $k = $oddMaxTeam;
                    }
                }
            }
        } else {
            //Equipos Impares
            $numRound = $teamNum;
            $numMatchesPerRound = ($teamNum / 2) - 1;

            for ($i = 0, $k = 0; $i < $numRound; $i++) {
                for ($j = -1; $j < $numMatchesPerRound; $j++) {
                    if ($j >= 0) {
                        $emparejamientos[$i][$j]['local'] = $teams[$k];
                    }

                    $k++;

                    if ($k == $numRound) {
                        $k = 0;
                    }
                }
            }
            $maxTeam = $teamNum - 1;
            for ($i = 0, $k = $maxTeam; $i < $numRound; $i++) {
                for ($j = 0; $j < $numMatchesPerRound; $j++) {
                    $emparejamientos[$i][$j]['visitante'] = $teams[$k];

                    $k--;

                    if ($k == -1) {
                        $k = $maxTeam;
                    }
                }
            }
        }
        $matchDayDate = $firstMatchDay;
        $iterator = 1;
        foreach ($emparejamientos as $round) {
            $matchDay = MatchDay::create([
                'league_id' => $this->record->id,
                'number' => $iterator,
            ]);

            foreach ($round as $match) {
                CategoryMatch::create([
                    'match_day_id' => $matchDay->id,
                    'local_id' => $match['local'],
                    'visitor_id' => $match['visitante'],
                    'prompter_id' => Prompter::where('id', random_int(1, Prompter::all()->count()))->first()->id,
                    'date' => $matchDayDate . ' 21:00',
                ]);
            }
            $matchDayDate = Carbon::parse($matchDayDate . ' next friday')->toDateString();
            $iterator++;
        }

        Notification::make()
            ->title('Jornadas generadas con éxito')
            ->success()
            ->send();
    }
}
