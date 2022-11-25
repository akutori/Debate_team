<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserFfromHtoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        // F01 ~ F40
        for ($a = 1; $a < 10; $a++) {
            DB::table('users')->insert(['name' => 'F0' . $a, 'password' => Hash::make('E0' . $a . 'password')]);
        }
        for ($i = 10; $i < 41; $i++) {
            DB::table('users')->insert(['name' => 'F' . $i, 'password' => Hash::make('F' . $i, 'password')]);
        }

        // G01 ~ G40
        for ($b = 1; $b < 10; $b++) {
            DB::table('users')->insert(['name' => 'G0' . $b, 'password' => Hash::make('G0' . $b . 'password')]);
        }
        for ($j = 10; $j < 41; $j++) {
            DB::table('users')->insert(['name' => 'G' . $j, 'password' => Hash::make('G' . $j, 'password')]);
        }

        // H01 ~ H40
        for ($c = 1; $c < 10; $c++) {
            DB::table('users')->insert(['name' => 'H0' . $c, 'password' => Hash::make('H0' . $c . 'password')]);
        }
        for ($k = 10; $k < 41; $k++) {
            DB::table('users')->insert(['name' => 'H' . $k, 'password' => Hash::make('H' . $k, 'password')]);
        }
    }
}
