<?php

// PHP
    $instagram = null; // JSONデータ配列をここに格納
     
    $instagram_business_id = '17841401206994866'; // InstagramビジネスアカウントのID
    $access_token = 'EAAQXEiYKKbcBAJq18nm32PykEvQDZBJKs1NIaFQWzjNmOK31SWvotTZA2qKtESeZBCQZBZBnrsYRZC7XonoCZAk0HiPDVT8o3eXFS5ccbogC5h7cHXpte7DsHlrm2GiiZA8PZAN0wuERPjc9ZCSWkUbbZAyDSRAGVDm1bizbZBZAXjbJtaMuwLwN9m6xI'; // 有効期限無期限のアクセストークン
    $post_count = 4; // 表示件数
    $hashtag = 'filmarks';

    // ハッシュタグのIDを取得する
    $get_hash = 'https://graph.facebook.com/v5.0/ig_hashtag_search?user_id=' . $instagram_business_id . '&q=' . $hashtag . '&access_token=' . $access_token;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $get_hash);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
    $hashtag_id = json_decode(curl_exec($curl));
    curl_close($curl);
    
    // $query = 'name,media.limit(' . $post_count. '){caption,like_count,media_url,permalink,timestamp,username,comments_count}';
    $query = 'media_url';
    $get_url = 'https://graph.facebook.com/v5.0/' . $hashtag_id->data[0]->id . '/top_media?user_id=' .$instagram_business_id . '&fields=' . $query . '&access_token=' . $access_token;
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $get_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
    $response = curl_exec($curl);
    curl_close($curl);
     
    if($response){
      $instagram = json_decode($response);
      if(isset($instagram->error)){
          $instagram = null;
      }
    }
    // $query = 'name,media.limit(' . $post_count. '){caption,like_count,media_url,permalink,timestamp,username,comments_count}';
    // $get_url = 'https://graph.facebook.com/v5.0/' . $instagram_business_id . '?fields=' . $query . '&access_token=' . $access_token;

    
    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_URL, $get_url);
    // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // curl_execの結果を文字列で返す
    // $response = curl_exec($curl);
    // curl_close($curl);
     
    // if($response){
    //   $instagram = json_decode($response);
    //   if(isset($instagram->error)){
    //       $instagram = null;
    //   }
    // }