<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($count=0;$count<10;$count++){
            DB::table('accounts')->insert([
                'name' => $faker->text($maxNbChars = 50),
                'account_type_id' => 1
            ]);
        }
        
    }
}