<?php

namespace App\Filament\Resources\LeagueResource\Pages;

use App\Filament\Resources\LeagueResource;
use App\Models\Category;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeague extends EditRecord
{
    protected static string $resource = LeagueResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('Generar jornadas')->action('matchDays'),
            Actions\DeleteAction::make(),
        ];
    }

    public function matchDays(): void
    {
        $emparejamientos = array();

        $teams = array();
        foreach($this->record->categories as $category){
            array_push($teams, $category->id);
        }

        $teamNum = count($this->record->categories);

        if($teamNum % 2 == 0){
            //Equipos Pares
            $numRound = $teamNum - 1 ;
            $numMatchesPerRound = $teamNum / 2;

            for($i=0, $k=0;$i < $numRound; $i++){
                for($j = 0; $j<$numMatchesPerRound; $j++){
                    $emparejamientos[$i][$j]['local'] = $teams[$k];

                    $k++;
                    if($k == $numRound){
                        $k=0;
                    }
                }
            }

            for($i=0 ;$i < $numRound; $i++){
                if($i % 2 == 0){
                    $emparejamientos[$i][0]['visitante'] = $teams[count($teams)-1];
                } else{
                    $emparejamientos[$i][0]['visitante'] = $emparejamientos[$i][0]['local'];
                    $emparejamientos[$i][0]['local'] = $teams[count($teams)-1];
                }
            }

            $maxTeam = $teamNum -1 ;
            $oddMaxTeam = $maxTeam -1;
            for($i = 0, $k = $oddMaxTeam; $i < $numRound; $i++){
                for($j = 1; $j<$numMatchesPerRound; $j++){
                    $emparejamientos[$i][$j]['visitante'] = $teams[$k];

                    $k--;

                    if($k == -1){
                        $k = $oddMaxTeam;
                    }
                }
            }
            dd($emparejamientos);

        } else{
            //Equipos Impares
            $numRound = $teamNum;
            $numMatchesPerRound = ($teamNum / 2)-1;

            for($i=0, $k=0;$i < $numRound; $i++){
                for($j = -1; $j<$numMatchesPerRound; $j++){
                    if($j >= 0){
                        $emparejamientos[$i][$j]['local'] = $teams[$k];
                    }

                    $k++;

                    if($k == $numRound){
                        $k = 0;
                    }
                }
            }

            $maxTeam = $teamNum -1;

            for($i = 0, $k = $maxTeam; $i < $numRound; $i++){
                for($j = 0; $j<$numMatchesPerRound; $j++){
                    $emparejamientos[$i][$j]['visitante'] = $teams[$k];

                    $k--;

                    if($k == -1){
                        $k = $maxTeam;
                    }
                }
            }

            dd($emparejamientos);
        }

        dd($emparejamientos);
    }
}
