<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ScoutSeeder::class,
            TeamSeeder::class,
            CategoryTypeSeeder::class,
            SeasonSeeder::class,
            LeagueSeeder::class,
            CategorySeeder::class,
            PlayerSeeder::class,
            PlayerScoutSeeder::class,
            PrompterSeeder::class,
            MatchDaySeeder::class,
            ReportSeeder::class,
            ClassificationSeeder::class,
            PlayerHistorySeeder::class,
            FollowPlayerSeeder::class,
        ]);
    }
}
