<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryMatch;
use App\Models\Classification;
use App\Models\League;
use App\Models\MatchDay;
use App\Models\Player;
use App\Models\PlayerHistory;
use App\Models\Prompter;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (League::all() as $league) {
            $firstMatchDay = Carbon::parse($league->season->start_date . ' next friday')->toDateString();
            $emparejamientos = array();

            $teams = array();
            foreach (DB::table('category_league')->where('league_id', $league->id)->get() as $record) {
                array_push($teams, $record->category_id);
            }

            shuffle($teams);
            
            $teamNum = DB::table('category_league')->where('league_id', $league->id)->get()->count();

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

            $matches = [];

            $matchDayDate = $firstMatchDay;
            $iterator = 1;
            //Partidos de ida
            foreach ($emparejamientos as $round) {
                $matchDay = MatchDay::create([
                    'league_id' => $league->id,
                    'number' => $iterator,
                    'date' => $matchDayDate,
                ]);

                foreach ($round as $match) {
                    $matches[] = [
                        'match_day_id' => $matchDay->id,
                        'local_id' => $match['local'],
                        'visitor_id' => $match['visitante'],
                        'prompter_id' => Prompter::where('id', random_int(1, Prompter::all()->count()))->first()->id,
                        'date' => $matchDayDate . ' 21:00',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $matchDayDate = Carbon::parse($matchDayDate . ' next friday')->toDateString();
                $iterator++;
            }
            //Partidos de vuelta
            foreach ($emparejamientos as $round) {
                $matchDay = MatchDay::create([
                    'league_id' => $league->id,
                    'number' => $iterator,
                    'date' => $matchDayDate,
                ]);

                foreach ($round as $match) {
                    $matches[] = [
                        'match_day_id' => $matchDay->id,
                        'local_id' => $match['visitante'],
                        'visitor_id' => $match['local'],
                        'prompter_id' => Prompter::where('id', random_int(1, Prompter::all()->count()))->first()->id,
                        'date' => $matchDayDate . ' 21:00',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $matchDayDate = Carbon::parse($matchDayDate . ' next friday')->toDateString();
                $iterator++;
            }

            CategoryMatch::insert($matches);
        }
    }
}
