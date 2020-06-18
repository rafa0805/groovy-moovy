<?php
  require_once(__DIR__ . '/config/config.php');

  $app = new MyApp\Controller\Login;
  $app->run();
 ?>

 <!DOCTYPE html>
 <html lang='ja'>
  <head>
    <meta carset='utf-8'>
    <title>Log in to GroovyMoovy</title>
    <link rel='stylesheet' href='css/styles.css'>
  </head>
  <body>
    <header>Log in to GroovyMoovy</header>
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