<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AddTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("types")->insert([
            ["name"=>"phone"],
            ["name"=>"laptop"],
            ["name"=>"watches"],
            ["name"=>"tv"],
            ["name"=>"headset"],
            ["name"=>"camera"],
            ["name"=>"console"],
            ["name"=>"drone"],
        ]);
    }
}
