<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
  protected $fillable = ['user_id'];

    public function owner()
    {
        return $this -> belongsTo('App\User', 'user_id');
    }

    public function attemptedOrders()
    {
      return $this -> hasOne('App\AttemptedOrders', 'order_id');
    }

    public function site()
    {
      return $this -> hasOne('App\Sites', 'id', 'site_id');
    }

    public function action()
    {
      return $this -> hasOne('App\ActionType', 'id', 'action_id');
    }

    // public function valid()
    // {
    //   return $this -> hasOne('App\ValidOrderAttemps', 'attempted_orders', 'attempt_id', 'order_id');
    // }



    public function getJob($userId, $siteId, $actionTypeId)
    {
      $orders = $this -> getOrdersToDo();
      echo $orders -> get(0) -> attempted_orders;
      // $orders -> each(function($item, $key){
      //   echo $item -> attempted_orders -> id;
      // });

      // foreach ($this -> all() as $order => $user_id) {
      //   echo $user_id -> attemptedOrders;
      //   // if($order -> attemptedOrders -> user_id != $userId) echo 'ok ';
      // }
      // $orders = $this -> attemptedOrders() -> where('user_id', '!=', $userId);
      // return $orders -> first() -> order -> action -> name;
      // foreach ($orders as $order) {
      //
      // }
      // return $this -> where()
    }

    public function getOrdersToDo()
    {
      $orders = $this -> all();
       $filtered = collect();
      foreach ($orders as $order) {
        $ratio = 0;
        $order -> ratio();
        if($ratio < 100)
        {
          $filtered ->push($order);
        }
      }

      return $filtered;
    }

    public function ratio()
    {
      $scoreTarget = $this -> score_target;
      $actualScore = 0;
      // var_dump( $this -> attemptedOrders['valid']);
      $attemptedOrders = $this -> attemptedOrders;
      $valid = $attemptedOrders['valid'];
        if($valid == 1)
          $actualScore++;


      $percentage = ($actualScore / $scoreTarget) * 100;

      // return array('score_target' => $scoreTarget, 'score_now' => $actualScore, 'percentage' => $percentage);
      return $percentage;
    }

    public function checkOrder()
    {
      if($this -> first() -> attemptedOrders -> valid) return false;

      return true;
    }

    public function getFreeOrders($userId)
    {
      echo 1;
      $userId =1;
      // $orders = array();
      // foreach ($this -> all() as $order) {
      //   if($order -> attemptedOrders -> valid) return false;
      //
      // }
      //
      // return true;
      $attemps = $this -> attemptedOrders() -> where('user_id', $userId) -> get();
      // echo $attemps;
      foreach ($attemps as $attemp) {
        echo $attemp;
      }
      // $orders = \App\Orders::all();
      // foreach ($orders as $order) {
      //   echo $order -> attemptedOrders;
      // }
      // return $this -> attemptedOrders ;
    }




}
//
//
// <?php
//
// namespace App;
//
// use Illuminate\Database\Eloquent\Model;
//
// class Orders extends Model
// {
//     public function owner()
//     {
//         return $this -> belongsTo('App\User', 'user_id');
//     }
//
//     public function attemptedOrders()
//     {
//       return $this -> hasMany('App\AttemptedOrders', 'order_id');
//     }
//
//     public function site()
//     {
//       return $this -> hasOne('App\Sites', 'id', 'site_id');
//     }
//
//     public function action()
//     {
//       return $this -> hasOne('App\ActionType', 'id', 'action_id');
//     }
//
//     public function getOrderDetails()
//     {
//       $scoreTarget = $this -> score_target;
//       $actualScore = 0;
//       $attemptedOrders = $this -> attemptedOrders;
//
//       foreach ($attemptedOrders as $attemptedOrder) {
//         if($attemptedOrder -> valid)
//           $actualScore++;
//       }
//
//       $percentage = ($actualScore / $scoreTarget) * 100;
//
//       return array('score_target' => $scoreTarget, 'score_now' => $actualScore, 'percentage' => $percentage);
//     }
//
//     public function getJob($userId, $siteId, $actionTypeId)
//     {
//       $orders = array();
//       $attemptedOrders = $this -> attemptedOrders() -> where('user_id', '!=', $userId);
//       foreach ($attemptedOrders as $attemptedOrder) {
//
//         $orders -> pull();
//       }
//
//       return $attemptedOrders -> first() -> order;
//       // foreach ($orders as $order) {
//       //
//       // }
//       // return $this -> where()
//     }
//
//     public function getFreeOrders($userId)
//     {
//       echo 1;
//       $userId =1;
//       // $orders = array();
//       // foreach ($this -> all() as $order) {
//       //   if($order -> attemptedOrders -> valid) return false;
//       //
//       // }
//       //
//       // return true;
//       $attemps = $this -> attemptedOrders() -> where('user_id', $userId) -> get();
//       // echo $attemps;
//       foreach ($attemps as $attemp) {
//         echo $attemp;
//       }
//       // $orders = \App\Orders::all();
//       // foreach ($orders as $order) {
//       //   echo $order -> attemptedOrders;
//       // }
//       // return $this -> attemptedOrders ;
//     }
//
//
//
//
// }
