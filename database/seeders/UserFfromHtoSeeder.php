<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            User::create(['name' => 'F0' . $a, 'password' => Hash::make('F0' . $a . 'password')]);
        }
        for ($i = 10; $i < 41; $i++) {
            User::create(['name' => 'F' . $i, 'password' => Hash::make('F' . $i. 'password')]);
        }

        // G01 ~ G40
        for ($b = 1; $b < 10; $b++) {
            User::create(['name' => 'G0' . $b, 'password' => Hash::make('G0' . $b . 'password')]);
        }
        for ($j = 10; $j < 41; $j++) {
            User::create(['name' => 'G' . $j, 'password' => Hash::make('G' . $j. 'password')]);
        }

        // H01 ~ H40
        for ($c = 1; $c < 10; $c++) {
            User::create(['name' => 'H0' . $c, 'password' => Hash::make('H0' . $c . 'password')]);
        }
        for ($k = 10; $k < 41; $k++) {
            User::create(['name' => 'H' . $k, 'password' => Hash::make('H' . $k. 'password')]);
        }
    }
}
