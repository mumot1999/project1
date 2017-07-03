<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttemptedOrders extends Model
{
    public function order()
    {
      return $this -> belongsTo('App\Orders', 'id');
    }

    public function valid()
    {
      return $this -> hasOne('App\ValidOrderAttemps', 'attempt_id');
    }

    public function isValid()
    {
      if($this -> valid == 1)
        return true;
      return false;
    }

}
