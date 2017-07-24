<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Debugbar;
use App\Orders;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
      return $this -> hasMany('App\Orders', 'user_id');
    }

    public function getOrders($limit = -1)
    {
      $orders = $this->orders()->with(['attemptedOrders', 'site', 'action'])->orderBy('created_at', 'desc')
      ->where(function ($query) {
        $query->where( 'expiry_date', '>', Carbon::now() )->orWhere( 'expiry_date', null );
      })-> limit($limit)->get();

       $orders = $orders->filter(function ($value, $key){
         if(!$value->isFinished())
          return $value;
      });

      return $orders;
    }

    public function attemptedOrders()
    {
      return $this -> hasMany('App\AttemptedOrders', 'user_id');
    }





    public function getCoinsBalance()
    {
      return $this -> getEarnedCoins() - $this -> getIssuedCoins() + $this -> getStartupBonus();
    }

    private function getEarnedCoins()
    {
      $attemptedOrders = $this -> attemptedOrders() -> with('order') -> where('valid',1) -> get();
      Debugbar::info($attemptedOrders->toJson());
      return $attemptedOrders -> sum('order.price');
    }

    private function getIssuedCoins()
    {
      $issued = 0;
      $orders = $this -> orders() -> with('attemptedOrders') -> get();
      foreach ($orders as $order) {
        if($order->isActual())
          $issued += $order -> price * $order -> score_target;
        else
          $issued += $order -> price * $order -> getActualScore();
      }
      return $issued;
    }

    private function getStartupBonus()
    {
      $start = new \App\StartupCoins;
      return $start -> getCoins($this -> id, $this -> created_at);
    }
}
