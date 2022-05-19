<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('products')->truncate();

        $products = array(
            [
                'product_code'=> 'PROD-0001',
                'name'=>'Britania'
            ],
            [
                'product_code'=> 'PROD-0002',
                'name'=>'Sunsilk'
            ],
            [
                'product_code'=> 'PROD-0003',
                'name'=>'Clinic Plus'
            ],
            [
                'product_code'=> 'PROD-0004',
                'name'=>'Reymond'
            ],
        );
        DB::table('products')->insert($products);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
