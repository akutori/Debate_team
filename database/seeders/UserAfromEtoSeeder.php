<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                            User::create(['name'=>'A0'.$cnt,'password'=>Hash::make('A0'.$cnt.'password')]);
                            break;
                        }
                        User::create(['name'=>'A'.$cnt,'password'=>Hash::make('A'.$cnt.'password')]);
                        break;
                    case 2:
                        if($cnt<10){
                            User::create(['name'=>'B0'.$cnt,'password'=>Hash::make('B0'.$cnt.'password')]);
                            break;
                        }
                        User::create(['name'=>'B'.$cnt,'password'=>Hash::make('B'.$cnt.'password')]);
                        break;
                    case 3:
                        if($cnt<10){
                            User::create(['name'=>'B0'.$cnt,'password'=>Hash::make('C0'.$cnt.'password')]);
                            break;
                        }
                        User::create(['name'=>'B'.$cnt,'password'=>Hash::make('C'.$cnt.'password')]);
                        break;
                    case 4:
                        if($cnt<10){
                            User::create(['name'=>'B0'.$cnt,'password'=>Hash::make('D0'.$cnt.'password')]);
                            break;
                        }
                        User::create(['name'=>'B'.$cnt,'password'=>Hash::make('D'.$cnt.'password')]);
                        break;
                    case 5:
                        if($cnt<10){
                            User::create(['name'=>'B0'.$cnt,'password'=>Hash::make('E0'.$cnt.'password')]);
                            break;
                        }
                        User::create(['name'=>'B'.$cnt,'password'=>Hash::make('E'.$cnt.'password')]);
                        break;
                }
            }
        }
        User::create(['name'=>'A01','password'=>Hash::make('A01password')]);

    }
}
