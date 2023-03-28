<?php

namespace Tests\Unit;

use App\Models\CategoryType;
use App\Models\League;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LeagueTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function league_has_expected_table()
    {
        $this->assertTrue(
            Schema::hasTable('leagues')
        );
    }

    /** @test */
    public function league_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('leagues', ['id', 'name', 'category_type_id', 'season_id'])
        );
    }

    /** @test */
    public function league_can_be_created()
    {
        $season = Season::create([
            'name' => 'Temporada de prueba',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(5),
        ]);

        $categoryType = CategoryType::create([
            'name' => 'Infantil',
        ]);

        $league = League::create([
            'name' => 'Liga de prueba',
            'category_type_id' => $categoryType->id,
            'season_id' => $season->id,
        ]);

        $this->assertModelExists($league);
    }

    /** @test */
    public function league_can_be_deleted()
    {
        $season = Season::create([
            'name' => 'Temporada de prueba',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(5),
        ]);

        $categoryType = CategoryType::create([
            'name' => 'Infantil',
        ]);

        $league = League::create([
            'name' => 'Liga de prueba',
            'category_type_id' => $categoryType->id,
            'season_id' => $season->id,
        ]);

        $league->delete();
        $this->assertModelMissing($league);
    }
}
