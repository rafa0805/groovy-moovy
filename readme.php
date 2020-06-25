<?php
  require_once(__DIR__ . '/config/config.php');

  $app = new MyApp\Controller\Signup;
  $app->run();
?>

 <!DOCTYPE html>
 <html lang='ja'>
  <head>
    <title>Sign up to GroovyMoovy</title>
    <meta carset='utf-8'>
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>
    <link rel='stylesheet' href='css/readme.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  </head>
  <body>
    <header>Readme</header>
    <section class='container'>
      <p class='readme'><a href='/login.php'>アプリに戻る</a></p>
        <div class='wrapper'>
          <h2>アプリ概要</h2>
          <p>開発者 : </p>
          <p>Kosaka Rafael Yoshinori</p>
          <p>説明 : </p>
          <p>気になった映画をTo do listにメモして管理できるアプリです。ポートフォリオ版では、デフォルトで表示される映画情報のみアクセス可能ですが、最終的には、フォームの入力情報から関連するアイテムを表示する仕組みにする予定です。</p>
        </div>
        <div class='wrapper'>
          <h2 class=''>使用技術</h2>
          <table>
            <tr>
              <td class='cl'>サーバーサイド</td>
              <td class='cr'> :  PHP</td>
            </tr>
            <tr>
              <td class='cl'>フロントサイド</td>
              <td class='cr'> :  HTML, CSS, Javascript</td>
            </tr>
            <tr>
              <td class='cl'>ライブラリ</td>
              <td class='cr'> :  jQuery, Bootstrap</td>
            </tr>
            <tr>
              <td class='cl'>データベース</td>
              <td class='cr'> :  MySQL</td>
            </tr>
            <tr>
              <td class='cl'>デプロイ</td>
              <td class='cr'> :  Heroku (Githubとリンク)</td>
            </tr>
            <tr>
              <td class='cl'>API</td>
              <td class='cr'> :  <a href='https://developers.themoviedb.org/3/getting-started/introduction'>The Movie Database API</a></td>
            </tr>
          </table>
        </div>

    </section>

  </body>
</html>