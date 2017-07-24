<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AttemptedOrders;
use App\Orders;
use App\User;


use Carbon\Carbon;


class AttemptedOrdersController extends Controller
{
    public function getEndJob(Request $request)
    {
      $jobs = $request->user()->attemptedOrders()->with('order')->where('valid', 2)->get();


      if($jobs->count() > 1)
      {
        foreach ($jobs as $job) {
          $job->valid = 0;
          $job->update();
        }
      }
      else if( $jobs->count() == 1 )
      {
        $job = $jobs->first();
        $job->validate();
      }
      return redirect()->route('home');
    }
}
