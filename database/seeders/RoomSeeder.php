<?php

namespace Database\Seeders;

use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //
        Room::create(['title_id'=>1,'category_id'=>1]);
        Room::create(['title_id'=>2,'category_id'=>1]);
        Room::create(['title_id'=>3,'category_id'=>1]);
        Room::create(['title_id'=>4,'category_id'=>1]);
        Room::create(['title_id'=>5,'category_id'=>2]);
        Room::create(['title_id'=>6,'category_id'=>2]);
        Room::create(['title_id'=>7,'category_id'=>2]);
        Room::create(['title_id'=>8,'category_id'=>2]);
        Room::create(['title_id'=>9,'category_id'=>3]);
        Room::create(['title_id'=>10,'category_id'=>3]);
        Room::create(['title_id'=>11,'category_id'=>3]);
        Room::create(['title_id'=>12,'category_id'=>3]);
        Room::create(['title_id'=>13,'category_id'=>4]);
        Room::create(['title_id'=>14,'category_id'=>4]);
        Room::create(['title_id'=>15,'category_id'=>4]);
        Room::create(['title_id'=>16,'category_id'=>4]);
        Room::create(['title_id'=>17,'category_id'=>5]);
        Room::create(['title_id'=>18,'category_id'=>5]);
        Room::create(['title_id'=>19,'category_id'=>5]);
        Room::create(['title_id'=>20,'category_id'=>5]);
        Room::create(['title_id'=>21,'category_id'=>6]);
        Room::create(['title_id'=>22,'category_id'=>6]);
        Room::create(['title_id'=>23,'category_id'=>6]);
        Room::create(['title_id'=>24,'category_id'=>6]);
    }
}
