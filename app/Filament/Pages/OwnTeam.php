<?php

namespace App\Filament\Pages;

use App\Models\Team;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Table;

class OwnTeam extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    protected static string $view = 'filament.pages.own-team';

    protected static ?string $title = 'Información';

    protected static ?string $navigationLabel = 'Información del club';

    protected static string $pluralLabel = 'Información del club';


    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role === 'president';
    }

    public string $name = '';
    public string $description = '';
    public $shield = '';
    public Team $team;

    public function mount(): void
    {
        $this->team = Team::where('administrator_id', auth()->user()->id)->first();
        abort_unless(auth()->user()->role === 'president', 403);
        $this->form->fill([
            'name' => $this->team['name'],
            'description' => $this->team['description'],
            'shield' => $this->team['shield'],
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')->required()
                ->label('Nombre del club'),
            Textarea::make('description')->required()
                ->label('Descripción del club'),
            FileUpload::make('shield')->required()
                ->label('Escudo'),
        ];
    }

    public function save()
    {
        $this->validate();

        $this->team['name'] = $this->name;
        $this->team['description'] = $this->description;
        $this->team['shield'] = $this->shield;

        $this->team->save();
    }
}
