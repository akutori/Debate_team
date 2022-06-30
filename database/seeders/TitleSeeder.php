<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Title::create(['t_name'=>'日本にもロックダウン制度を導入すべき','category_id'=> 1]);
        Title::create(['t_name'=>'国会議員になるための資格を作成すべき','category_id'=> 1]);
        Title::create(['t_name'=>'国民の意見を通しやすくするために意見箱を設置すべき','category_id'=>1]);
        Title::create(['t_name'=>'定期的に議員の審査をすべき（最高裁判所長の審査のように）', 'category_id'=>1]);
        Title::create(['t_name'=>'アイドルなどの恋愛禁止を廃止すべき', 'category_id'=>2]);
        Title::create(['t_name'=>'恋愛ドラマはなくすべき', 'category_id'=>2]);
        Title::create(['t_name'=>'俳優、女優をなくし、職種を俳優に統一すべき', 'category_id'=>2]);
        Title::create(['t_name'=>'お笑い関係の番組を減らし、ドラマを増やすべき', 'category_id'=>2]);
        Title::create(['t_name'=>'種目の幅を狭めるべき', 'category_id'=>3]);
        Title::create(['t_name'=>'試合数を減らすべき', 'category_id'=>3]);
        Title::create(['t_name'=>'球団(チーム）を減らすべき', 'category_id'=>3]);
        Title::create(['t_name'=>'国の税金で、スポーツ保険を充実すべき', 'category_id'=>3]);
        Title::create(['t_name'=>'デートでは、支払いは男性がすべき', 'category_id'=>4]);
        Title::create(['t_name'=>'告白するときは男性からのみにする？', 'category_id'=>4]);
        Title::create(['t_name'=>'異性と付き合うときは、外見重視？', 'category_id'=>4]);
        Title::create(['t_name'=>'告白するときは、事前に異性の両親に許可を取るべき', 'category_id'=>4]);
        Title::create(['t_name'=>'お菓子はたけのこの里派である', 'category_id'=>5]);
        Title::create(['t_name'=>'カレー味のうんこよりうんこ味のカレーがいい', 'category_id'=>5]);
        Title::create(['t_name'=>'学校の授業で、海外の料理の講習もすべき', 'category_id'=>5]);
        Title::create(['t_name'=>'レストランなどで出す料理は、すべてアレルギー対応にすべき', 'category_id'=>5]);
        Title::create(['t_name'=>'車など、クラクションを鳴らすのは禁止にする', 'category_id'=>6]);
        Title::create(['t_name'=>'年齢による割引をもっと増やすべき', 'category_id'=>6]);
        Title::create(['t_name'=>'一夫多妻制を導入すべき', 'category_id'=>6]);
        Title::create(['t_name'=>'日本でもギャンブル（カジノ）などを合法すべき', 'category_id'=>6]);
    }
}
