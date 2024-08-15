<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SQLFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $createTablePath = public_path('../database/seeders/Sql/CreateTables_vn_units.sql');
        $sqlCreateTable  = file_get_contents($createTablePath);
        $setupDataPath   = public_path('../database/seeders/Sql/ImportData_vn_units.sql');
        $sqlSetupData    = file_get_contents($setupDataPath);
        DB::unprepared($sqlCreateTable);
        DB::unprepared($sqlSetupData);
    }
}
