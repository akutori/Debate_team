<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'c_name'=>"政治"
        ]);

        Category::create([
            'c_name'=>"プログラミング"
        ]);
        Category::create([
            'c_name'=>"食品"
        ]);
        Category::create([
            'c_name'=>"機械"
        ]);
        Category::create([
            'c_name'=>"その他"
        ]);
    }
}
