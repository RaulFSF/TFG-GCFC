<?php

namespace Database\Seeders;

use App\Models\CategoryMatch;
use App\Models\Player;
use App\Models\PlayerHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matches = CategoryMatch::whereNotNull('report')->get();

        foreach($matches as $match){
            $report = json_decode($match->report);

            $all_players = array_merge($report->local_players, $report->visitor_players);
            $players = [];
            foreach($all_players as $player_id){
                $player = Player::where('id', $player_id)->first();

                $player_history = PlayerHistory::firstOrCreate(['player_id' => $player->id, 'category_id'=> $player->category_id, 'league_id' => $match->matchDay->league->id]);
                $players[] = [
                    'id' => $player_history->id,
                    'player_id' => $player_history->player_id,
                    'category_id'=> $player_history->category_id,
                    'league_id' => $match->matchDay->league->id,
                    'played' => ++$player_history->played,
                ];
            }
            PlayerHistory::upsert($players, ['id'], ['played']);

            $players_goal = [];
            foreach($report->goals as $goal){
                $player = Player::where('id', $goal->goal_player)->first();
                $player_history = PlayerHistory::where('player_id', $player->id)->where('category_id', $player->category_id)->where('league_id', $match->matchDay->league->id)->first();

                $players_goal[] = [
                    'id' => $player_history->id,
                    'player_id' => $player_history->player_id,
                    'category_id'=> $player_history->category_id,
                    'league_id' => $match->matchDay->league->id,
                    'goals' => ++$player_history->goals,
                    'assits' => $player_history->assits,
                    'yellow_cards' => $player_history->yellow_cards,
                    'red_cards' => $player_history->red_cards,
                ];
                $player = Player::where('id', $goal->goal_assist)->first();
                $player_history = PlayerHistory::where('player_id', $player->id)->where('category_id', $player->category_id)->where('league_id', $match->matchDay->league->id)->first();

                $players_goal[] = [
                    'id' => $player_history->id,
                    'player_id' => $player_history->player_id,
                    'category_id'=> $player_history->category_id,
                    'league_id' => $match->matchDay->league->id,
                    'goals' => $player_history->goals,
                    'assits' => ++$player_history->assits,
                    'yellow_cards' => $player_history->yellow_cards,
                    'red_cards' => $player_history->red_cards,
                ];
            }

            $players_yellow = [];
            foreach($report->yellow_cards as $player_id){
                $player = Player::where('id', $player_id)->first();
                $player_history = PlayerHistory::where('player_id', $player->id)->where('category_id', $player->category_id)->where('league_id', $match->matchDay->league->id)->first();
                $players_yellow[] = [
                    'id' => $player_history->id,
                    'player_id' => $player_history->player_id,
                    'category_id'=> $player_history->category_id,
                    'league_id' => $match->matchDay->league->id,
                    'goals' => $player_history->goals,
                    'assits' => $player_history->assits,
                    'yellow_cards' => ++$player_history->yellow_cards,
                    'red_cards' => $player_history->red_cards,
                ];
            }

            $players_red = [];
            foreach($report->red_cards as $player_id){
                $player = Player::where('id', $player_id)->first();
                $player_history = PlayerHistory::where('player_id', $player->id)->where('category_id', $player->category_id)->where('league_id', $match->matchDay->league->id)->first();
                $players_red[] = [
                    'id' => $player_history->id,
                    'player_id' => $player_history->player_id,
                    'category_id'=> $player_history->category_id,
                    'league_id' => $match->matchDay->league->id,
                    'goals' => $player_history->goals,
                    'assits' => $player_history->assits,
                    'yellow_cards' => $player_history->yellow_cards,
                    'red_cards' => ++$player_history->red_cards,
                ];
            }

            $players = array_merge($players_goal, $players_yellow, $players_red);

            PlayerHistory::upsert($players, ['id'], ['goals', 'assits', 'yellow_cards', 'red_cards']);
        }
    }
}
