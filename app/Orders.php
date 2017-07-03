<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OrderParams;

class Orders extends Model
{
  protected $fillable = ['user_id'];

    public function owner()
    {
        return $this -> belongsTo('App\User', 'user_id');
    }

    public function attemptedOrders()
    {
      return $this -> hasMany('App\AttemptedOrders', 'order_id');
    }

    public function site()
    {
      return $this -> hasOne('App\Sites', 'id', 'site_id');
    }

    public function action()
    {
      return $this -> hasOne('App\ActionType', 'id', 'action_id');
    }

    public function getJob($userId, $site, $actionType)
    {
      $orderParams = array('userId' => $userId, 'site' => $site, 'action' => $actionType);
      $orders = $this -> getOrdersToDo($orderParams);

      $count = $orders -> count();
      if($count == 0)
        return 'error';
      // else if ($count == 1)
      //   return $orders -> first();

      else return $orders -> random();
    }

    public function getOrdersToDo($orderParams)
    {
      $orders = $this -> with(['attemptedOrders', 'site', 'action']) -> get();

      $filtered = $orders->filter(function ($value, $key) use ($orderParams) {
        if($value->checkIfOk($orderParams))
          return $value;
      });

      $highestPrice = $filtered -> max('price');

      return $filtered -> where('price', $highestPrice);
    }

    private function checkIfOk($orderParams)
    {
      $userId = $orderParams['userId'];
      $site = $orderParams['site'];
      $action = $orderParams['action'];

      if(!$this -> isFinished() && $this -> canUserDo($userId) && $this -> isSite($site) && $this -> isAction($action))
        return true;
      return 0;
    }

    private function isFinished()
    {
      $count = $this -> attemptedOrders -> count();
      $target = $this -> score_target;
      if($count < $target)
        return false;
      return true;
    }

    private function canUserDo($userId)
    {
      foreach ($this -> attemptedOrders as $attemtedOrder) {
        if($attemtedOrder -> user_id == $userId && $attemtedOrder -> isValid())
          return false;
      }
      return true;
    }

    private function isSite($site)
    {
      if($this -> site -> name == $site)
        return true;
      return false;
    }

    private function isAction($action)
    {
      if($this -> action -> name == $action)
        return true;
      return false;
    }
}
