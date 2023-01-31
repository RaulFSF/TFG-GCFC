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
            $matchDayDate = $firstMatchDay;
            $iterator = 1;
            //Partidos de ida
            foreach ($emparejamientos as $round) {
                $matchDay = MatchDay::create([
                    'league_id' => $league->id,
                    'number' => $iterator,
                ]);

                foreach ($round as $match) {
                    $actual_match = CategoryMatch::create([
                        'match_day_id' => $matchDay->id,
                        'local_id' => $match['local'],
                        'visitor_id' => $match['visitante'],
                        'prompter_id' => Prompter::where('id', random_int(1, Prompter::all()->count()))->first()->id,
                        'date' => $matchDayDate . ' 21:00',
                    ]);

                    if ($matchDayDate < Carbon::now()) {
                        self::generateReport($actual_match);
                    }
                }
                $matchDayDate = Carbon::parse($matchDayDate . ' next friday')->toDateString();
                $iterator++;
            }
            //Partidos de vuelta
            foreach ($emparejamientos as $round) {
                $matchDay = MatchDay::create([
                    'league_id' => $league->id,
                    'number' => $iterator,
                ]);

                foreach ($round as $match) {
                    $actual_match = CategoryMatch::create([
                        'match_day_id' => $matchDay->id,
                        'local_id' => $match['visitante'],
                        'visitor_id' => $match['local'],
                        'prompter_id' => Prompter::where('id', random_int(1, Prompter::all()->count()))->first()->id,
                        'date' => $matchDayDate . ' 21:00',
                    ]);

                    if ($matchDayDate < Carbon::now()) {
                        self::generateReport($actual_match);
                    }
                }
                $matchDayDate = Carbon::parse($matchDayDate . ' next friday')->toDateString();
                $iterator++;
            }
        }
    }

    public function generateReport($match)
    {
        //Jugadores de ambos equipos
        $local_players = Player::where('category_id', $match->local_id)->inRandomOrder()->limit(16)->get()->toArray();
        $visitor_players = Player::where('category_id', $match->visitor_id)->inRandomOrder()->limit(16)->get()->toArray();
        $match_players = array_merge($local_players, $visitor_players);

        //Random resultado
        $local_score = random_int(0, 5);
        $visitor_score = random_int(0, 5);

        //Random tarjetas
        $yellow_cards = random_int(0, 6);
        $red_cards = random_int(0, 3);

        //Añadir resultado
        $match->local_score = $local_score;
        $match->visitor_score = $visitor_score;

        //Añadir partido jugado a todos los jugadores
        foreach ($match_players as $player) {
            //comprobar historial si tiene el de la categoria y añadirle datos a ese historial
            $player = Player::where('id', $player['id'])->first();

            $player_history = PlayerHistory::where('player_id',  $player['id'])->where('category_id', $player['category_id'])->where('league_id', $match->matchDay->league->id)->first();

            //historial con equipo activo
            if ($player_history) {
                $player_history->played++;
                $player_history->save();

                //si no tiene historial con el equipo se lo creo
            } else {
                PlayerHistory::create([
                    'player_id' =>  $player['id'],
                    'category_id' => $player['category_id'],
                    'league_id' => $match->matchDay->league->id,
                    'played' => 1,
                ]);
            }
        }

        //Añadir goles y asistencias a equipo local
        for ($i = 0; $i <= $local_score; $i++) {
            $player = $local_players[random_int(0, count($local_players) - 1)];
            $player_history = PlayerHistory::where('player_id', $player['id'])->where('category_id', $player['category_id'])->where('league_id', $match->matchDay->league->id)->first();

            $player_history->goals++;
            $player_history->save();

            $player_assits = $local_players[random_int(0, count($local_players) - 1)];
            $player_assits_history = PlayerHistory::where('player_id', $player_assits['id'])->where('category_id', $player_assits['category_id'])->where('league_id', $match->matchDay->league->id)->first();

            $player_assits_history->assits++;
            $player_assits_history->save();
        }

        $array_goals = array();
        //Añadir goles y asistencias a equipo visitante
        for ($i = 0; $i <= $visitor_score; $i++) {
            $player = $visitor_players[random_int(0, count($visitor_players) - 1)];
            $player_history = PlayerHistory::where('player_id', $player['id'])->where('category_id', $player['category_id'])->where('league_id', $match->matchDay->league->id)->first();

            $player_history->goals++;
            $player_history->save();

            $player_assits = $visitor_players[random_int(0, count($visitor_players) - 1)];
            $player_assits_history = PlayerHistory::where('player_id', $player_assits['id'])->where('category_id', $player_assits['category_id'])->where('league_id', $match->matchDay->league->id)->first();

            $player_assits_history->assits++;
            $player_assits_history->save();

            $goal = [
                'goal_player' => $player['id'],
                'goal_assist' => $player_assits['id'],
            ];
            array_push($array_goals, $goal);
        }

        $array_yellow_cards = array();
        //Añadir tarjetas amarillas
        for ($i = 0; $i <= $yellow_cards; $i++) {
            $player = $match_players[random_int(0, count($match_players) - 1)];
            $player_history = PlayerHistory::where('player_id', $player['id'])->where('category_id', $player['category_id'])->where('league_id', $match->matchDay->league->id)->first();

            $player_history->yellow_cards++;
            $player_history->save();

            array_push($array_yellow_cards, $player['id']);
        }

        $array_red_cards = array();
        //Añadir tarjetas rojas
        for ($i = 0; $i <= $red_cards; $i++) {
            $player = $match_players[random_int(0, count($match_players) - 1)];
            $player_history = PlayerHistory::where('player_id', $player['id'])->where('category_id', $player['category_id'])->where('league_id', $match->matchDay->league->id)->first();

            $player_history->red_cards++;
            $player_history->save();

            array_push($array_red_cards, $player['id']);
        }

        $array_local_players = array();
        foreach ($local_players as $local) {
            array_push($array_local_players, $local['id']);
        }

        $array_visitor_players = array();
        foreach ($visitor_players as $visitor) {
            array_push($array_visitor_players, $visitor['id']);
        }

        $match->report = json_encode([
            'local_players' =>  $array_local_players,
            'visitor_players' => $array_visitor_players,
            'goals' => $array_goals,
            'yellow_cards' => $array_yellow_cards,
            'red_cards' => $array_red_cards,
        ]);

        //añadir a clasificación los datos del partido
        $classification_local = Classification::where('category_id', $match->local_id)->where('league_id', $match->matchDay->league->id)->first();
        $classification_local->played++;
        $classification_local->goals_scored += $local_score;
        $classification_local->goals_against += $visitor_score;

        $classification_visitor = Classification::where('category_id', $match->visitor_id)->where('league_id', $match->matchDay->league->id)->first();
        $classification_visitor->played++;
        $classification_visitor->goals_scored += $visitor_score;
        $classification_visitor->goals_against += $local_score;

        if ($local_score > $visitor_score) {
            $classification_local->points += 3;
            $classification_local->wins += 1;

            $classification_visitor->losts += 1;
        } elseif ($visitor_score > $local_score) {
            $classification_visitor->points += 3;
            $classification_visitor->wins += 1;

            $classification_local->losts += 1;
        } else {
            $classification_local->points += 1;
            $classification_visitor->points += 1;

            $classification_local->draws += 1;
            $classification_visitor->draws += 1;
        }


        $classification_local->save();
        $classification_visitor->save();
        $match->save();
    }
}
