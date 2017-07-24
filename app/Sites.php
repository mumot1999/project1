<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    public $timestamps = false;

    public function getId($name)
    {
      $site = $this -> where('name', $name) -> get() -> first();
      if( $site == null ) return null;
      return $site -> id;
    }
}
