<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{
    public $timestamps = false;

    public function getId($name)
    {
      $action = $this -> where('name', $name) -> get() -> first();
      if( $action == null ) return null;
      return $action -> id;
    }
}
