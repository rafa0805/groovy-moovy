<?php

require_once(__DIR__ . '/config/config.php');

$app = new MyApp\Controller\Index;
$app->run();

// 表示データの取得
$datas = $app->getData();
$weekly = $app->getMovies();

?>

<!DOCTYPE html>
<html lang='ja'>
<head>
  <title>GroovyMoovy by Rafa</title>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel='stylesheet' href='css/styles.css'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
  <!--------------------- 共通部品 start --------------------->
  <div id='mask' class=''></div>
  <!--------------------- 共通部品 end ----------------------->
  
  <header>
    <div id='user' class='d-none d-md-block' data-id='<?= h($_SESSION['me']['id']); ?>'>
      <img src='./img/user.png'> <?= h($_SESSION['me']['email']); ?>
    </div>
    Groovy-Moovy by Rafa  <img src='./img/film.png'>
  </header>
  
  <div class='container-fluid'>
    <div class='row'>
        <div id='side_bar'>
          <p>Create list</p>
          <div class='dummybtn btn' id='new_pad' ><input type='text' placeholder="type new pad's title"><img src='./img/plus.png'></div>
          <p class='d-md-none'>Find movie</p>
          <div class='dummybtn btn d-md-none' id='find-movie' ><img src='./img/search.png'></div>
          <p>Log out</p>
          <form action='/logout.php' method='POST'>
            <button type='submit'>
              <div class='dummybtn btn'><img src='./img/logout.png'></div>
            </button>
          </form>
        </div>

      
      <div id='list_container' class='col-md-5'>
        <p>Find some awesome Movies and add to your To Watch List!!</p>
        <?php foreach($datas as $pad): ?>
          <ul class='todo_list' data-id='<?= h($pad->id); ?>'>
            <div class='pad_del btn'><img src='./img/trash.png'></div>
            <p><?= h($pad->title); ?></p>
            <?php foreach($pad->todos as $todo): ?>
              <li data-id='<?= h($todo->id); ?>'>
                <input type='checkbox' class='btn' <?= $todo->done === '1' ? 'checked' : ''; ?>>
                <span class='<?= $todo->done === '1' ? 'checked' : ''; ?> '><?= h($todo->content); ?></span>
                <div class='del btn'><img src='./img/close.png'></div>
              </li>
            <?php endforeach; ?>
            <li>
              <input type='text' name='new_todo' placeholder='Add an awesome movie!!'>
              <button class='post_new_todo btn bg-secondary text-light'>Add</button>
            </li>
          </ul>
        <?php endforeach; ?>
              
        <!--------------------- 要素のテンプレート start --------------------->
        <li class='template' data-id=''><input type='checkbox' class='btn'><span></span><div class='del btn'><img src='./img/close.png'></div></li>
        
        <ul class='template' data-id=''>
          <div class='pad_del btn'><img src='./img/trash.png'></div>
          <p></p>
          <li>
            <input type='text' name='new_todo' placeholder='create new item!'>
            <button class='post_new_todo btn bg-secondary text-light'>Add</button>
          </li>
        </ul>
        <!--------------------- 要素のテンプレート end ----------------------->
        
      </div>
    
      <div id='movie_container' class='py-3 d-md-block'>
        <div id='highlights'>
          <p>Some Hints for You!! (by The Movie Database API)</p>
          <ul>
            <?php foreach($weekly as $movie): ?>
              <li><img src="<?= $movie['url']; ?>" class='poster btn' data-title="<?= $movie['title']; ?>" data-overview="<?= $movie['overview']; ?>" data-release="<?= $movie['release']; ?>" data-vote_count="<?= $movie['vote_count']; ?>"></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

    </div>
    
    <!--------------------- モーダルウィドウ start --------------------->
    <div id='abstract' class=''>
      <div class='img_container'>
        <div class='exit btn'><img src='./img/exit.png'></div>
        <img class='thumbnail' src="">
        <div class='add_to_list_container'>
          <div class='add_to_list btn'><img src='./img/add.png'><p class='d-none'>Added!!</p></div>
          <div>
            <p>Select a To Watch List</p>
            <select>
              <?php foreach($datas as $pad): ?>
                <option value='<?= $pad->id;?>'><?= $pad->title;?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>  
      <div class='info_container'>
        <p class='title'></p>
        <p class='release'></p>
        <p class='overview'></p>
      </div>
    </div>
    <!--------------------- モーダルウィドウ end ----------------------->

  </div>  
  <input type='hidden' id='token' value='<?= $_SESSION['token']; ?>'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src='./app/main.js'></script>
</body>
</html>