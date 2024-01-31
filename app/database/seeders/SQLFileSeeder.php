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
        $path1 = public_path('../database/seeders/Sql/CreateTables_vn_units.sql');
        $sql1 = file_get_contents($path1);
        $path2 = public_path('../database/seeders/Sql/ImportData_vn_units.sql');
        $sql2 = file_get_contents($path2);
        DB::unprepared($sql1);
        DB::unprepared($sql2);
    }
}
