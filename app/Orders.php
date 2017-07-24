<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OrderParams;
use Illuminate\Support\Facades\Auth;

use App\Sites;
use Carbon\Carbon;

class Orders extends Model
{
  protected $fillable = [
      'user_id', 'url', 'score_target', 'site_id', 'action_id', 'price', 'expiry_date'
  ];
    public function user()
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

    public function getJob($site, $actionType)
    {
      $orderParams = array('userId' => Auth::id(), 'site' => $site, 'action' => $actionType);
      $orders = $this -> getOrdersToDo($orderParams);

      $count = $orders -> count();
      if($count == 0)
        return null;
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

        public function isFinished()
        {
          $count = $this -> getActualScore();
          $target = $this -> score_target;
          if($count >= $target)
            return true;
          return false;
        }

        private function canUserDo($userId)
        {
          if($this -> user_id == $userId) return false;
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

        public function isActual()
        {
          if($this->expiry_date == NULL) return true;
          if($this->expiry_date > Carbon::now() ) return true;

          return false;
        }


    public function makeNewOrder()
    {
      $user = Auth::User();
      $balance = $user -> getCoinsBalance();

      if($this -> getCost() > $balance) return 1;
      else {
        $this -> save();
      }

    }

        private function getCost()
        {
          return $this -> score_target * $this -> price;
        }

    public function setSiteByName($name)
    {
      $site = new Sites;

      $this -> site_id = $site -> getId($name);
    }

    public function setActionByName($name)
    {
      $action = new ActionType;

      $this -> action_id = $action -> getId($name);
    }

    public function end()
    {
      $this -> expiry_date = Carbon::now();
      $this -> save();
    }

    public function getActualScore()
    {
      $score = 0;
      foreach ($this -> attemptedOrders as $attemptedOrder) {
        if($attemptedOrder->isValid()) $score++;
      }
      return $score;
    }
 }
