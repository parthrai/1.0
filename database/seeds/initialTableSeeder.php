<?php

use Illuminate\Database\Seeder;

class initialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('initials')->insert([

            'isSetup'=>false
        ]);
    }
}
