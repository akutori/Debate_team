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
            'c_name'=>"芸能"
        ]);
        Category::create([
            'c_name'=>"スポーツ"
        ]);
        Category::create([
            'c_name'=>"恋愛"
        ]);
        Category::create([
            'c_name'=>"食べ物"
        ]);
        Category::create([
            'c_name'=>"その他"
        ]);
    }
}
