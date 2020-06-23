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
  <meta carset='utf-8'>
  <title>GroovyMoovy by Rafa</title>
  <link rel='stylesheet' href='css/styles.css'>
</head>

<body>
  <div id='mask' class=''></div>
  <header><div id='user' data-id='<?= $_SESSION['me']['id']; ?>'><img src='./img/user.png'> <?= $_SESSION['me']['email']; ?></div>Groovy-Moovy by Rafa  <img src='./img/film.png'></header>
  <div id='container'>
    
    <div id='side_bar'>
      <div class='dummybtn btn' id='new_pad' ><input type='text' placeholder="type new pad's title"><img src='./img/plus.png'></div>
      <form action='/logout.php' method='POST'>
      <button type='submit'><div class='dummybtn btn'><img src='./img/logout.png'></div></button>
    </form>
  </div>
  
  <div id='list_container'>
    <?php foreach($datas as $pad): ?>
      <ul class='todo_list' data-id='<?= $pad->id; ?>'>
        <div class='pad_del btn'><img src='./img/trash.png'></div>
          <p><?= $pad->title; ?></p>
          <?php foreach($pad->todos as $todo): ?>
            <li data-id='<?= $todo->id; ?>'><input type='checkbox' class='btn' <?= $todo->done === '1' ? 'checked' : ''; ?>><span class='<?= $todo->done === '1' ? 'checked' : ''; ?> '><?= $todo->content; ?></span><div class='del btn'>x</div></li>
          <?php endforeach; ?>
          <li><input type='text' name='new_todo' placeholder='create new item!'></li>
          <button class='post_new_todo btn'>Create</button>
        </ul>
      <?php endforeach; ?>

      <!-- 要素のテンプレート -->
      <li class='template' data-id=''><input type='checkbox' class='btn'><span></span><div class='del btn'>x</li>
      <ul class='template' data-id=''>
        <div class='pad_del btn'><img src='./img/trash.png'></div>
        <p></p>
        <li><input type='text' name='new_todo' placeholder='create new item!'></li>
        <button class='post_new_todo btn'>Create</button>
      </ul>
      <!------------------------>
    </div>

    <div id='timeline_container'>
      <div id='highlights'>
        <p>Some Hints for You!! (by The Movie Database API)</p>
        <ul>
          <?php foreach($weekly as $movie): ?>
            <li><img src="<?= $movie['url']; ?>" class='poster btn' data-title="<?= $movie['title']; ?>" data-overview="<?= $movie['overview']; ?>" data-release="<?= $movie['release']; ?>" data-vote_count="<?= $movie['vote_count']; ?>"></li>
          <?php endforeach; ?>
        </ul>
          
          <!-- モーダルウィドウのテンプレート -->
          <div id='abstract' class=''>
            <div class='img_container'>
              <div class='close btn'><img src='./img/close.png'></div>
              <img class='thumbnail' src="">
              <div class='add_to_list btn'><img src='./img/add.png'></div>
              <p>Select a list</p>
              <select>
                <?php foreach($datas as $pad): ?>
                  <option value='<?= $pad->id;?>'><?= $pad->title;?></option>
                <?php endforeach; ?>
              </select>
            </div>  
            <div class='info_container'>
              <p class='title'></p>
              <p class='release'></p>
              <p class='overview'></p>
            </div>
          </div>
          <!------------------------------------>
      </div>
    </div>
    
  <input type='hidden' id='token' value='<?= $_SESSION['token']; ?>'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src='./app/main.js'></script>
</body>
</html>