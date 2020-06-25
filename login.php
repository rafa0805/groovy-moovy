<?php
  require_once(__DIR__ . '/config/config.php');

  $app = new MyApp\Controller\Login;
  $app->run();
 ?>

 <!DOCTYPE html>
 <html lang='ja'>
  <head>
    <title>Log in to GroovyMoovy</title>
    <meta carset='utf-8'>
    <meta name='viewport' content='width=device-width,initial-scale=1.0'>
    <link rel='stylesheet' href='css/styles.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  </head>
  <body>
    <header>Log in to GroovyMoovy</header>
    <p class='readme'><a href='/readme.php'>Readme(使用技術の説明)</a></p>
    <div id='form_container'>
      <form action='' method='POST'>
        <p>E-MAIL</p>
        <p class='error'><?= $app->getErrors('email'); ?></p>
        <input type='text' name='email' placeholder='enter E-MAIL' value='<?= $app->getValues('email'); ?>'>
        <p>PASSWORD</p>
        <p class='error'><?= $app->getErrors('password'); ?></p>
        <input type='password' name='password' placeholder='enter PASSWORD' value='<?= $app->getValues('password'); ?>'>
        <input type='hidden' name='token' value='<?= $_SESSION['token']; ?>'>
        <button class='btn' type='submit'>Log in</button>
        <a href='/signup.php'>Sign up</a>
      </form>
      <form action='' method='POST'>
        <input type='hidden' name='email' value='demo@demo.com'>
        <input type='hidden' name='password' value='demo'>
        <input type='hidden' name='token' value='<?= $_SESSION['token']; ?>'>
        <button class='btn demo' type='submit'>Demo Account</button>
      </form>
    </div>

  </body>
</html>