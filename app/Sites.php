<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    public function getSiteId($name)
    {
      return $this -> where('name', $name) -> id;
    }
}
