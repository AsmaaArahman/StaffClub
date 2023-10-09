<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KinshipSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
                DB::table("kinships")->insert([
                        "type"=>"son",
                ]);

                DB::table("kinships")->insert([
                        "type"=>"daughter",
                ]);

                DB::table("kinships")->insert([
                        "type"=>"mother",
                ]);

                DB::table("kinships")->insert([
                        "type"=>"father",
                ]);

                DB::table("kinships")->insert([
                        "type"=>"husband",
                ]);
                        
                        
                DB::table("kinships")->insert([
                        "type"=>"wife",
                ]);

        }
}
