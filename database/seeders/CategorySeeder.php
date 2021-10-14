<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
                'name' => '肉類'
            ],
            [
                'id' => 2,
                'name' => '麺類'
            ],
            [
                'id' => 3,
                'name' => '丼もの'
            ],
            [
                'id' => 4,
                'name' => '魚類'
            ],
            [
                'id' => 5,
                'name' => '揚げ物'
            ],
        ];
        DB::table('categories')->insert($param);
    }
}
