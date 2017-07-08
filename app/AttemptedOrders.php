<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
// use GuzzleHttp\Exception\GuzzleException;
use Vinkla\Instagram\Instagram;


class AttemptedOrders extends Model
{
   private $accessToken = "1821127736.1677ed0.129c7d3027ce40d18f40feaf9d0c3a55";
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

    public function checkCorrect()
    {
      $this -> order -> site_id;
      $this -> order -> action_id;
    }

    public function instagramLikes($url)
    {
      $client = new Client();

      $url = "https://www.instagram.com/p/BUhYC0PjfsE/";
      $mediaId = $this -> getMediaId($url);

      $likes = $client -> get("https://api.instagram.com/v1/media/$mediaId/likes?access_token=$this->accessToken") -> getBody();
      return json_decode($likes,true)['data'];
    }

    private function getMediaId($url)
    {
      $client = new Client();
      $res = $client -> get("http://api.instagram.com/oembed?url=$url")-> getBody();
      return json_decode($res,true)['media_id'];
    }

    // private function getShortcode($url)
    // {
    //   for
    // }

}
