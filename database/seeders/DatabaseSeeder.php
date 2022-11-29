<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CategorySeeder::class);
        $this->call(TitleSeeder::class);
        $this->call(RoomSeeder::class);

        // testデータのseederを実行
        $this->call(UserAfromEtoSeeder::class);
        $this->call(UserFfromHtoSeeder::class);
        $this->call(NgSeeder::class);
    }
}
