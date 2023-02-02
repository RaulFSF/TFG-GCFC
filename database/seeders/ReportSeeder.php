<?php

namespace Database\Seeders;

use App\Models\CategoryMatch;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matches = CategoryMatch::where('date', '<', Carbon::now())->get();

        foreach ($matches as $match) {
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

            $array_goals = array();
            //Añadir goles y asistencias a equipo local
            for ($i = 0; $i <= $local_score; $i++) {
                $player = $local_players[random_int(0, count($local_players) - 1)];
                $player_assits = $local_players[random_int(0, count($local_players) - 1)];
                $goal = [
                    'goal_player' => $player['id'],
                    'goal_assist' => $player_assits['id'],
                ];
                array_push($array_goals, $goal);
            }

            //Añadir goles y asistencias a equipo visitante
            for ($i = 0; $i <= $visitor_score; $i++) {
                $player = $visitor_players[random_int(0, count($visitor_players) - 1)];
                $player_assits = $visitor_players[random_int(0, count($visitor_players) - 1)];
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
                array_push($array_yellow_cards, $player['id']);
            }

            $array_red_cards = array();
            //Añadir tarjetas rojas
            for ($i = 0; $i <= $red_cards; $i++) {
                $player = $match_players[random_int(0, count($match_players) - 1)];
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

            $match->save();
        }
    }
}
