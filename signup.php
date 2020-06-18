<?php
  require_once(__DIR__ . '/config/config.php');

  $app = new MyApp\Controller\Signup;
  $app->run();
?>

 <!DOCTYPE html>
 <html lang='ja'>
  <head>
    <meta carset='utf-8'>
    <title>Sign up to GroovyMoovy</title>
    <link rel='stylesheet' href='css/styles.css'>
  </head>
  <body>
    <header>Sign up to GroovyMoovy</header>
    <div id='form_container'>
      <form action='' method='POST'>
        <p>UserID</p>
        <p class='error'><?= $app->getErrors('user_id'); ?></p>
        <input type='text' name='user_id' placeholder='enter UserID' value='<?= $app->getValues('user_id'); ?>'>
        <p>E-MAIL</p>
        <p class='error'><?= $app->getErrors('email'); ?></p>
        <input type='text' name='email' placeholder='enter E-MAIL' value='<?= $app->getValues('email'); ?>'>
        <p>PASSWORD</p>
        <p class='error'><?= $app->getErrors('password'); ?></p>
        <input type='password' name='password' placeholder='enter PASSWORD'>
        <input type='hidden' name='token' value='<?= $_SESSION['token']; ?>'>
        <button class='btn' type='submit'>Sign up</button>
        <a href='/login.php'>Log in</a>
      </form>
    </div>

  </body>
</html>