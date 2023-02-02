<?php

namespace Database\Seeders;

use App\Models\CategoryMatch;
use App\Models\Classification;
use App\Models\MatchDay;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matches = CategoryMatch::whereNotNull('report')->get();

        foreach (MatchDay::all() as $matchDay) {
            $results = [];
            foreach ($matchDay->categoryMatches as $match) {
                if ($match->date < Carbon::now()) {

                    $classification_local = Classification::where('category_id', $match->local_id)->where('league_id', $match->matchDay->league->id)->first();
                    $classification_local->played++;
                    $classification_local->goals_scored += $match->local_score;
                    $classification_local->goals_against += $match->visitor_score;

                    $classification_visitor = Classification::where('category_id', $match->visitor_id)->where('league_id', $match->matchDay->league->id)->first();
                    $classification_visitor->played++;
                    $classification_visitor->goals_scored += $match->visitor_score;
                    $classification_visitor->goals_against += $match->local_score;


                    if ($match->local_score > $match->visitor_score) {
                        $classification_local->points += 3;
                        ++$classification_local->wins;

                        ++$classification_visitor->losts;
                    } elseif ($match->visitor_score > $match->local_score) {
                        $classification_visitor->points += 3;
                        ++$classification_visitor->wins;

                        ++$classification_local->losts;
                    } else {
                        ++$classification_local->points;
                        ++$classification_visitor->points;

                        ++$classification_local->draws;
                        ++$classification_visitor->draws;
                    }

                    $results[] = [
                        'id' => $classification_local->id,
                        'category_id' => $classification_local->category_id,
                        'league_id' => $classification_local->league_id,
                        'played' => $classification_local->played,
                        'points' => $classification_local->points,
                        'wins' => $classification_local->wins,
                        'draws' => $classification_local->draws,
                        'losts' => $classification_local->losts,
                        'goals_scored' => $classification_local->goals_scored,
                        'goals_against' => $classification_local->goals_against,
                    ];

                    $results[] = [
                        'id' => $classification_visitor->id,
                        'category_id' => $classification_visitor->category_id,
                        'league_id' => $classification_visitor->league_id,
                        'played' => $classification_visitor->played,
                        'points' => $classification_visitor->points,
                        'wins' => $classification_visitor->wins,
                        'draws' => $classification_visitor->draws,
                        'losts' => $classification_visitor->losts,
                        'goals_scored' => $classification_visitor->goals_scored,
                        'goals_against' => $classification_visitor->goals_against,
                    ];
                }
            }
            Classification::upsert($results, ['id'], ['points', 'played', 'wins', 'draws', 'losts', 'goals_scored', 'goals_against']);
        }
    }
}
