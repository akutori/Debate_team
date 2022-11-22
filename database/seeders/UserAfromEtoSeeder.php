<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAfromEtoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sample
        for($txt=1;$txt<=5;$txt++){
            for($cnt=1;$cnt<=40;$cnt++){
                switch ($txt){
                    case 1:
                        if($cnt<10){
                            DB::table('users')->insert(['name'=>'A0'.$cnt,'password'=>Hash::make('A0'.$cnt.'password')]);
                            break;
                        }
                        DB::table('users')->insert(['name'=>'A'.$cnt,'password'=>Hash::make('A'.$cnt.'password')]);
                        break;
                    case 2:
                        if($cnt<10){
                            DB::table('users')->insert(['name'=>'B0'.$cnt,'password'=>Hash::make('B0'.$cnt.'password')]);
                            break;
                        }
                        DB::table('users')->insert(['name'=>'B'.$cnt,'password'=>Hash::make('B'.$cnt.'password')]);
                        break;
                    case 3:
                        if($cnt<10){
                            DB::table('users')->insert(['name'=>'B0'.$cnt,'password'=>Hash::make('C0'.$cnt.'password')]);
                            break;
                        }
                        DB::table('users')->insert(['name'=>'B'.$cnt,'password'=>Hash::make('C'.$cnt.'password')]);
                        break;
                    case 4:
                        if($cnt<10){
                            DB::table('users')->insert(['name'=>'B0'.$cnt,'password'=>Hash::make('D0'.$cnt.'password')]);
                            break;
                        }
                        DB::table('users')->insert(['name'=>'B'.$cnt,'password'=>Hash::make('D'.$cnt.'password')]);
                        break;
                    case 5:
                        if($cnt<10){
                            DB::table('users')->insert(['name'=>'B0'.$cnt,'password'=>Hash::make('E0'.$cnt.'password')]);
                            break;
                        }
                        DB::table('users')->insert(['name'=>'B'.$cnt,'password'=>Hash::make('E'.$cnt.'password')]);
                        break;
                }
            }
        }
        DB::table('users')->insert(['name'=>'A01','password'=>Hash::make('A01password')]);

    }
}
