<?php

namespace App;

use GuzzleHttp\Client;


class Instagram
{
  private $accessToken = "1821127736.1677ed0.129c7d3027ce40d18f40feaf9d0c3a55";

  public function instagramLikes($url)
  {
    $client = new Client();

    if(!$url) $url = "https://www.instagram.com/p/BUhYC0PjfsE/";
    $mediaId = $this -> getMediaId($url);

    $likes = $client -> get("https://api.instagram.com/v1/media/$mediaId/likes?access_token=$this->accessToken") -> getBody();
    return json_decode($likes,true)['data'];
  }

  public function getMediaId($url)
  {
    $client = new Client();
    $res = $client -> get("http://api.instagram.com/oembed?url=$url") -> getBody();
    return json_decode($res,true)['media_id'];
  }

  public function getUserId($nick)
  {
    $client = new Client();
    $user = $client -> get("https://www.instagram.com/$nick/?__a=1") -> getBody();
    return json_decode($user,true)['user']['id'];

    return $user;



  }
}
