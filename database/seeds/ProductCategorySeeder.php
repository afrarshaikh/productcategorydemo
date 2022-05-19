<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('product_category')->truncate();

        $product_category = array(
            [
                'category_id'=>2,
                'product_id'=>1
            ],
            [
                'category_id'=>2,
                'product_id'=>2
            ],
            [
                'category_id'=>2,
                'product_id'=>3
            ],
            [
                'category_id'=>3,
                'product_id'=>4
            ]
        );
        DB::table('product_category')->insert($product_category);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
