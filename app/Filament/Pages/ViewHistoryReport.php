<?php

namespace App\Filament\Pages;

use App\Models\CategoryMatch;
use App\Models\Prompter;
use Filament\Pages\Page;
use Filament\Tables;

class ViewHistoryReport extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.view-history-report';

    protected static ?string $title = 'Informes de partidos';

    public function mount(): void
    {
        abort_unless(auth()->user()->role === 'prompter', 403);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role === 'prompter';
    }

    protected function getTableQuery()
    {
        return CategoryMatch::whereNotNull('report');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('local.name')
                ->label('Local'),
            Tables\Columns\TextColumn::make('match_result')
                ->label('Resultado'),
            Tables\Columns\TextColumn::make('visitor.name')
                ->label('Visitante'),
            Tables\Columns\TextColumn::make('formated_date')
                ->label('Fecha'),
            Tables\Columns\TextColumn::make('prompter.user.name')
                ->label('Apuntador'),
        ];
    }
}
