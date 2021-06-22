<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //刪除已有資料
        Order::truncate();
        //建立新資料
        $orders = Order::factory()->times(1000)->make();
        //dd($orders);

        $products = Product::get();
        foreach ($orders as $order) {
            $order->save();
            $qty = rand(1,5);
            for ($i=0; $i < $qty; $i++) {
                 //隨機取出一個商品
                $product = $products[rand(0,count($products)-1)];
                $newOrderProduct = new OrderProduct();
                $newOrderProduct->order_id = $order->id;
                $newOrderProduct->product_id = $product->id;
                $newOrderProduct->qty = rand(1,10);
                $newOrderProduct->save();
            }
        }
        $orders = Order::get();
        foreach ($orders as $order) {
            $order->rowid = $order->id;
            $order->save();
        }

    }
}
