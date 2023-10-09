<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table("mods")->insert([
                    "fullname"=> "mod1",
                    "nat_id" => "12345678912345",
                    "password"=>"mod1"
            ]);

            DB::table("mods")->insert([
                    "fullname"=> "mod2",
                    "nat_id" => "12345678912346",
                    "password"=>"mod2"
            ]);

            DB::table("mods")->insert([
                    "fullname"=> "mod3",
                    "nat_id" => "12345678912347",
                    "password"=>"mod3"
            ]);

            DB::table("mods")->insert([
                    "fullname"=> "mod4",
                    "nat_id" => "12345678912348",
                    "password"=>"mod4"
            ]);

            DB::table("mods")->insert([
                    "fullname"=> "mod5",
                    "nat_id" => "12345678912349",
                    "password"=>"mod5"
            ]);
            
            DB::table("mods")->insert([
                    "fullname"=> "mod6",
                    "nat_id" => "12345678912350",
                    "password"=>"wali6"
            ]);

            DB::table("mods")->insert([
                    "fullname"=> "mod7",
                    "nat_id" => "12345678912351",
                    "password"=>"mod7"
            ]);

    }
}
