<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Orders;
use App\Instagram;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $orders = Auth::User()->getOrders();

      return view('user.home')->with(['orders' => $orders]);
    }

    public function setInstagramNick(Request $request)
    {
      $this->validate($request, [
            'username' => 'required',
        ]);

      $username = $request['username'];
      $insta = new Instagram;

      $userId = $insta -> getUserId($username);

      $user = $request -> user();
      $user -> instagram_user_id = $userId;
      $user -> save();

      return redirect() -> route('home');
    }
}
