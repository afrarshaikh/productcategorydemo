<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('categories')->truncate();

        $categories = array(
            [
                'category_code'=> 'CAT-0001',
                'name'=>'Biscuit',
                'parent_category_id'=>NULL
            ],
            [
                'category_code'=> 'CAT-0002',
                'name'=>'Shampoo',
                'parent_category_id'=>NULL
            ],
            [
                'category_code'=> 'CAT-0003',
                'name'=>'Clothes',
                'parent_category_id'=>NULL
            ],
            [
                'category_code'=> 'CAT-0004',
                'name'=>'Clarifying Shampoo',
                'parent_category_id'=>2
            ],
            [
                'category_code'=> 'CAT-0005',
                'name'=>'Anti-dandruff Shampoo',
                'parent_category_id'=>2
            ],
        );
        DB::table('categories')->insert($categories);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
