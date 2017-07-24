<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Orders;
use App\AttemptedOrders;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function makeNewOrder(Request $request)
    {
      $price = 2;
      $balance = $request->user()->getCoinsBalance();

      $scoreTarget = $request['score_target'];
      $cost = $price * $scoreTarget;

      if($cost > $balance) return redirect()->back();

      $order = new Orders;
      $order->setSiteByName( $request['site'] );
      $order->setActionByName( $request['action'] );
      $order->score_target = $scoreTarget;
      $order->url = $request['url'];
      $order->price = $price;
      $order->expiry_date = null;

      $request->user()->orders()->save($order);

      return redirect()->route('home');
    }

    public function deleteOrder($order_id)
    {
      $order = Orders::find($order_id);

      if($order->user == Auth::user())
        $order->end();
      return redirect()->route('home');
    }

    public function postGetJob(Request $request)
    {
      
      $this->validate($request, [
            'site' => 'required',
            'action' => 'required'
        ]);

      $site = $request['site'];
      $action = $request['action'];

      $site = 'Instagram';
      $action = "Like";

      $orders = new Orders;
      $order = $orders->getJob($site, $action);

      if($order)
      {
        $attemptedOrders = new AttemptedOrders;
        $userId = $request->user()->id;

        $attemptedOrders->order_id = $order->id;
        $attemptedOrders->user_id = $userId;
        $attemptedOrders->start = Carbon::now();
        $attemptedOrders->valid = 2;

        $attemptedOrders->save();
        return response()->json(['url' => $order->url], 200);
      }

      return response()->json(['url' => null], 200);
    }
}
