<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
// use GuzzleHttp\Exception\GuzzleException;
// use Vinkla\Instagram\Instagram;
use Carbon\Carbon;
use App\Instagram;
class AttemptedOrders extends Model
{
   private $accessToken = "1821127736.1677ed0.129c7d3027ce40d18f40feaf9d0c3a55";
    public function order()
    {
      return $this -> belongsTo('App\Orders', 'order_id', 'id');
    }

    public function valid()
    {
      return $this -> hasOne('App\ValidOrderAttemps', 'attempt_id');
    }

    public function user()
    {
      return $this -> belongsTo('App\User', 'user_id', 'id');
    }

    public function isValid()
    {
      if($this -> valid == 1)
        return true;
      return false;
    }

    public function validate()
    {
      $url = $this->order->url;
      $instagramUserId = $this->user->instagram_user_id;

      $insta = new Instagram;
      $likes = collect( $insta->instagramLikes($url) )->where('id', $instagramUserId);
      if($likes){
        $this->valid = 1;
      }
      else $this->valid = 0;

      $this->end = Carbon::now();
      $this->update();

    }



    // private function getShortcode($url)
    // {
    //   for
    // }

}
