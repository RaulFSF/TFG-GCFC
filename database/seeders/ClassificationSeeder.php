<?php

namespace Database\Seeders;

use App\Models\CategoryMatch;
use App\Models\Classification;
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

        $results = [];
        foreach ($matches as $match) {

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

            $classification_local->save();
            $classification_visitor->save();
        }
    }
}
