<?php
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'UserController@index')->name('home');

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

Route::get('job/{site}/{action}', function ($site, $action) {
  $orders = new App\Orders;
  return $orders -> getJob($site,$action);
});

Route::get('likes/', function () {
  $attempts = new App\AttemptedOrders;
  return $attempts -> instagramLikes('as');
});

Route::get('makeOrder', function () {
  $user = new App\User;

  return $user -> getCoinsBalance();
  $orders = new App\Orders;
  return $orders -> makeNewOrder(0);
});
