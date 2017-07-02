<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttemptedOrders extends Model
{
    public function order()
    {
      return $this -> belongsTo('App\Orders', 'id');
    }

    // public function valid()
    // {
    //   return $this -> hasOne('App\ValidOrderAttemps', 'attempt_id');
    // }

    public function isValid($id)
    {
      if($this -> find($id) -> validAttemps != NULL) return true;
      return false;
    }

}
