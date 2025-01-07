<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;


class DatabaseTest extends TestCase
{
    /**
     * Ott vagyok ahol kellene lennem :D ą 
     */
    public function test_database_creation_and_tables_exists(): void
    {
        $databaseNameConn = DB::connection()->getDatabaseName();
        $databaseNameEnv = env('DB_DATABASE');
        // dd($databaseNameConn);
        $this->assertEquals($databaseNameConn, $databaseNameEnv);


        //Megvannak e a táblák. 
        $this-> assertDatabaseHas('diaks');
        $this-> assertDatabaseHas('osztalies');
        $this-> assertDatabaseHas('sportolas');
        $this-> assertDatabaseHas('sports');
        $this-> assertDatabaseHas('users');

    }

    public function test_sports_taple_structure() {
        $this-> assertDatabaseHas('sports');
        $this->assertTrue(Schema::hasColumn('sports', 'id'));
        $this->assertTrue(Schema::hasColumn('sports', 'sportNev'));
 
        // Ellenőrizzük az oszlopok típusát
        $this->assertEquals('int', Schema::getColumnType('sports', 'id'));
        //dd(Schema::getColumnType('sports', 'sportNev'));
        $this->assertEquals('varchar', Schema::getColumnType('sports', 'sportNev'));
 
        $indexes = DB::select("SHOW index from sports");
        $primaryIndex = collect($indexes)->firstWhere('Key_name', 'PRIMARY');
        // van kulcs
        $this->assertNotFull($primaryIndex);
        $id = $primaryIndex->Column_name;
        // id kulcs név
        $this->assertEquals("id", $id);
        // dd($primaryIndex);
    }
}
