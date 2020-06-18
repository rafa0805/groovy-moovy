<?php

namespace MyApp\Model;

// これはThe Movie DatabaseのAPIを使って外部から情報を取得するためのクラスです

class TMDb extends \MyApp\Model
{
  private $api_key;
  private $base_url;

  public function __construct() {
    $this->api_key = "62950777e0a26359abbe11497357d6ab";
    $url = "https://api.themoviedb.org/3/configuration?api_key=" . $this->api_key;
    
    $this->base_url = $this->api_session($url)->images->secure_base_url;
  }
  
  public function getWeekly() {
    $url = "https://api.themoviedb.org/3/trending/movie/week?api_key=" . $this->api_key;
    
    $res = $this->api_session($url);
    
    $movies = []; 
    foreach($res->results as $data) {
      $movies[] = [
        "title" => $data->original_title,
        "url" => $this->base_url . 'w154/' . $data->poster_path,
        "overview" => $data->overview,
        "vote_count" => $data->vote_count,
        "release" => $data->release_date
      ];
    }
    return $movies;  
  }
  
  private function api_session($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
    $res = json_decode(curl_exec($curl));
    curl_close($curl);
    return $res;
  }



}