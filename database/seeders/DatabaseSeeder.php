<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //關閉外鍵偵測
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);
        //重開外鍵偵測
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
