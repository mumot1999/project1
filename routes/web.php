<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('orders', function () {
  $orders = App\Orders::find(1);
  echo ($orders -> getJob(2,1,2));

});

Route::get('validAttemps', function () {
  $validAttemps = new App\ValidOrderAttemps;
  echo $validAttemps -> getOrders(1);

});

Route::get('valid', function () {
  echo '1';
  $orders = new App\AttemptedOrders;
  echo $orders -> order() -> where('valid', '!=', 1) -> get();

});

Route::get('jobs', function () {
  $orders = new App\Orders;
  // return $orders -> getAllWithStats();
   echo $orders -> getJob(1,'facebook','like');
   return;
  // echo $orders -> getJob(1,1,1);
  // echo $orders -> attemptedOrders;
  $orders = $orders ->  with(['attemptedOrders' => function($query) {
    $query ->  where('user_id', '=', 1);
  }]) -> get();
  echo $orders->tojson();
});
