<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidOrderAttemps extends Model
{
    public function attemptedOrders()
    {
      return $this -> belongsTo('\App\AttemptedOrders','attempt_id');
    }

    public function getJob($userId)
    {
      foreach ($this -> all() as $attemp) {
        echo $attemp-> attemptedOrders() -> where('user_id', $userId) -> first();
      }

    }

    public function getOrders($userId)
    {
      foreach ($this -> all() as $validate) {
        echo $validate -> attemptedOrders() -> where('user_id', $userId) -> first();
      }
      // foreach ($this -> all() as $attemp) {
      //   echo $attemp-> attemptedOrders() -> where('user_id', $userId) -> first();
      // }

    }


}
