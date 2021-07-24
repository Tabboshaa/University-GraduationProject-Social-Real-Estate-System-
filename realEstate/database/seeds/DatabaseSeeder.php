<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user__types')->insert([
            'User_Type_ID' => 1,
            'Type_Name' => 'Admin'
        ]);
        DB::table('user__types')->insert([
            'User_Type_ID' => 2,
            'Type_Name' => 'Customer'
        ]);
        DB::table('user__types')->insert([
            'User_Type_ID' => 3,
            'Type_Name' => 'Owner'
        ]);
        ///

        DB::table('datatypes')->insert([
            'datatype' => 'text'
        ]);
        DB::table('datatypes')->insert([
            'datatype' => 'number'
        ]);
        DB::table('datatypes')->insert([
            'datatype' => 'file'
        ]);
        DB::table('datatypes')->insert([
            'datatype' => 'checkbox'
        ]);
        //
        
    }
}
