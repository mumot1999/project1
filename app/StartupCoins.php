<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartupCoins extends Model
{

    public function getCoins($userId, $userCreateDate)
    {
      $defaultCoins = 100;

      if($userId <= 101) return 1000;

      $coins = $this -> orderBy('from', 'desc') -> get() -> filter( function($value, $key) use ($userCreateDate){
        if($value -> from <= $userCreateDate && $value -> to >= $userCreateDate) return $value;
      });
      if($coins -> isNotEmpty()) return $coins-> first() -> coins;
      return $defaultCoins;
    }
}
