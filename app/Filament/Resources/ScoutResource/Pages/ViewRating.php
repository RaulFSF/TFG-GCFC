<?php

namespace App\Filament\Resources\ScoutResource\Pages;

use App\Filament\Resources\ScoutResource;
use App\Models\Rating;
use DateTime;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ViewRating extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string $resource = ScoutResource::class;

    protected static string $view = 'filament.resources.scout-resource.pages.view-rating';

    public $rating;

    public function mount($record): void
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        $this->rating = Rating::where('id', $record)->first();
        $this->form->fill([
            'date' => $this->rating->date,
            'comment' => $this->rating->comment,
            'stars' => $this->rating->stars . '/5',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Información de la valoración')
                ->schema([
                    TextInput::make('name')->formatStateUsing(function () {
                        return $this->rating->player->name;
                    })->label('Jugador')->disabled(),
                    TextInput::make('team')->formatStateUsing(function () {
                        return $this->rating->player->category->name;
                    })->label('Equipo')->disabled(),
                    DateTimePicker::make('date')->disabled(),
                    TextInput::make('stars')->disabled(),
                    Textarea::make('comment')->disabled()->columnSpanFull(),
                ]),
        ];
    }

}
