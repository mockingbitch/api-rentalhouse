<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('types_mst')->truncate();

        $types = [
            [
                'rent_type',
                '1',
                'Hợp đồng',
                'Contract'
            ],
            [
                'rent_type',
                '2',
                'Dài hạn',
                'Long term'
            ],
            [
                'rent_type',
                '3',
                'Ngắn hạn',
                'Short term'
            ],
            [
                'apartment_type',
                '1',
                'Chung cư',
                'Department'
            ],
            [
                'apartment_type',
                '2',
                'Văn phòng',
                'Office'
            ],
            [
                'rent_type',
                '3',
                'Homestay',
                'Homestay'
            ],
        ];

        foreach ($types as $type) {
            DB::table('types_mst')->insert([
                'key'        => $type[0],
                'key_id'     => $type[1],
                'value_vi'   => $type[2],
                'value_en'   => $type[3],
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
