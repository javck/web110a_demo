<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/demo', 'index');
Route::view('/products/query','products');

// Route::get('/orders/{id}',function(){
//     $order = App\Models\Order::find(1);
//     //return 'Hello';
//     //return $order->taxs;
//     //return $order->schedule_at->diffForHumans();
//     $order->receive_name = '馬力';
//     $order->save();
//     dd($order);
// });

//取用所有狀態為 ALD 的訂單
Route::get('/orders/demo1', function () {
    $orders = App\Models\Order::where('status', 'ALD')->get();
    dd($orders[0]);
});
//取用所有狀態為 ALD 且 Total > 6000 的訂單
Route::get('/orders/demo2', function () {
    $orders = App\Models\Order::where('status', 'ALD')->where('total', '>', 6000)->get();
    dd($orders[0]);
});

//怎麼準備分類的下拉選單的陣列
Route::get('/orders/demo3', function () {
    $categories = App\Models\Category::pluck('name', 'id');
    dd($categories);
});
//取得該類別的所有商品
Route::get('/orders/demo4', function () {
    $category = App\Models\Category::find(1);
    $products = $category->products()->orderBy('price', 'asc')->get();
    dd($products);
});

//取得該商品所屬分類
Route::get('/orders/demo5', function () {
    $product = App\Models\Product::find(1);
    dd($product->category->name);
});

Route::get('orders/demo6/{id}', function ($id) {
    $order = App\Models\Order::findOrFail($id);
    dd($order->products);
});

Route::get('orders/demo7/{id}', function ($id) {
    $order = App\Models\Order::findOrFail($id);
    $product = App\Models\Product::findOrFail(1);
    //$order->products()->save($product);
    $order->products()->sync([1, 2, 3]);
    dd($order->products);
});


//這個訂單裏頭有哪些產品，及其數量
Route::get('orders/demo8', function () {
    //希望結果  dddx3,cccdcx4,eeeex5
    $order = App\Models\Order::findOrFail(1);
    dd($order->orderDetail);
});



//Route::resource('categories', 'App\Http\Controllers\CategoryController');
