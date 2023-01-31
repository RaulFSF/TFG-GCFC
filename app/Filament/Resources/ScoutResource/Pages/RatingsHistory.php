<?php

namespace App\Filament\Resources\ScoutResource\Pages;

use App\Filament\Resources\ScoutResource;
use App\Models\Rating;
use App\Models\Scout;
use Carbon\Carbon;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\DB;

class RatingsHistory extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = ScoutResource::class;

    protected static string $view = 'filament.resources.scout-resource.pages.ratings-history';

    protected static ?string $title = 'Historial de valoraciones';

    public Scout $scout;

    public function mount($record): void
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        $this->scout = Scout::where('id', $record)->first();
    }

    protected function getTableQuery()
    {
        return Rating::where('scout_id', $this->scout->id);
    }

    protected function getTableColumns(): array
    {
        return [

            Split::make([
                Stack::make([
                    TextColumn::make('player.category.name')->searchable(),
                    TextColumn::make('player.name'),
                ]),
                Stack::make([
                    TextColumn::make('date')->formatStateUsing(function (Rating $record) {
                        return Carbon::parse($record->date)->format('h:i d-m-Y');
                    })->icon('heroicon-s-calendar')->color('secondary'),
                    TextColumn::make('stars')->formatStateUsing(function (Rating $record) {
                        return $record->stars . '/5';
                    })->icon('heroicon-s-star')->color('warning'),
                ]),
                TextColumn::make('comment'),
            ]),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('Ver')
                ->url(function (Rating $record) {
                    return ScoutResource::getUrl('view-rating', ['record' => $record]);
                })
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
