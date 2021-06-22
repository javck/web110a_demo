<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //刪除已有資料
        Category::truncate();
        //建立新資料
        Category::factory()->times(50)->create();

    }
}
