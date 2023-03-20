<?php

namespace Tests\Unit;

use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SeasonTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function season_has_expected_table()
    {
        $this->assertTrue(
            Schema::hasTable('seasons')
        );
    }

    /** @test */
    public function season_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('seasons', ['id', 'name', 'start_date', 'end_date'])
        );
    }

    /** @test */
    public function season_can_be_created()
    {
        $season = Season::create([
            'name' => 'Temporada de prueba',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(5),
        ]);

        $this->assertModelExists($season);
    }

    /** @test */
    public function season_can_be_deleted()
    {
        $season = Season::create([
            'name' => 'Temporada de prueba',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(5),
        ]);

        $season->delete();
        $this->assertModelMissing($season);
    }
}
