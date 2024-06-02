<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AddBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("brands")->insert([
            ["name"=>"Samsung"],
            ["name"=>"Apple"],
            ["name"=>"Xiaomi"],
            ["name"=>"Microsoft"],
            ["name"=>"Sony"],
            ["name"=>"Asus"],
            ["name"=>"Bose"],
            ["name"=>"Canon"],
            ["name"=>"Dell"],
            ["name"=>"DJL"],
            ["name"=>"Fitbit"],
            ["name"=>"Google"],
            ["name"=>"HP"],
            ["name"=>"Lenovo"],
            ["name"=>"LG"],
            ["name"=>"Nikon"],
            ["name"=>"Oculus"],
            ["name"=>"Razer"],
        ]);
    }
}
