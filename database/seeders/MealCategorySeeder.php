<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            [
                'id' => 1,
                'name' => '野菜'
            ],
            [
                'id' => 2,
                'name' => 'タンパク質'
            ],
            [
                'id' => 3,
                'name' => '炭水化物'
            ],
        ];
        DB::table('meal_categories')->insert($param);
    }
}
