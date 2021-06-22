<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //刪除既有資料
        Product::truncate();
        //建立商品資料
        Product::factory()->times(100)->create();
    }
}
