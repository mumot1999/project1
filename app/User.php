<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function attemptedOrders()
    {
      return $this -> hasMany('App\AttemptedOrders', 'user_id');
    }

    public function getEranedCoins()
    {
      $attemptedOrders = $this -> attemptedOrders;
      $coins = 0;

      foreach ($attemptedOrders as $attemptedOrder) {
        if($attemptedOrder-> valid)
        {
          $coins += $attemptedOrder->order->cost;
        }
      }

      return $coins;
    }

    public function findOrder($siteName)
    {
      $sites = new App\Sites;
      $siteId = $sites -> getSiteId($siteName);


      $orders = $this -> orders -> where(site_id, $siteId) -> where($id, '!=', $id);

    }
}
