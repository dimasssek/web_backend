<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

header('Content-Type: text/html; charset=UTF-8');
function change_pass($db){session_start(); 
  $login_ch = $_POST['user_login'];
  $old_pass = $_POST['old_pass'];
  $new_pass  =$_POST['new_pass'];

  $stmt = $db->prepare("SELECT * FROM users6 WHERE login = ?");
    $stmt->execute(array(
      $login_ch
    ));
  $user = $stmt->fetch();
  if (password_verify($old_pass, $user['pass'])) {
    $stmt = $db->prepare("UPDATE users6 SET pass = ? WHERE login = ?");
      $stmt -> execute(array(
          password_hash($new_pass, PASSWORD_BCRYPT),
          $login_ch
      ));
      $_SESSION['login'] = $login_ch;
  }
  else{
    $stmt = $db->prepare("SELECT * FROM admin WHERE login = ?");
    $stmt->execute(array(
      $login_ch
    ));
    $admin = $stmt->fetch();
    if ($old_pass==$admin['pass']||password_verify($old_pass, $admin['pass'])) {
      $stmt = $db->prepare("UPDATE admin SET pass = ? WHERE login = ?");
      $stmt -> execute(array(
          password_hash($new_pass, PASSWORD_BCRYPT),
          $login_ch
      ));
    }
    else {
      echo "Неправильный логин или пароль";
    }
  }
  header('Location: login.php');
  exit();
}

session_start();

$db_user = 'u47569';   // Логин БД
$db_pass = '3312824';  // Пароль БД

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  //реализация выхода из аккаунта и завершения сессии  
  if(isset($_GET['do'])&&$_GET['do'] == 'logout'){
    /*if(!empty($_SERVER['PHP_AUTH_USER'])&&!empty($_SERVER['PHP_AUTH_PW'])){
      unset($_SERVER['PHP_AUTH_USER']);
      unset($_SERVER['PHP_AUTH_PW']);}*/
    session_start();    
    session_unset();
    session_destroy();
    setcookie ("PHPSESSID", "", time() - 3600, '/');
    header("Location: index.php");
    exit;
  }
  else if(isset($_GET['act'])&&$_GET['act'] == 'change_pass'){
    ?>
     <form action="" method="post">
       <p><label for="user_login">Логин </label><input name="user_login" /></p>
       <p><label for="old_pass">Старый пароль </label><input name="old_pass" /></p>
       <p><label for="new_pass">Новый пароль </label><input name="new_pass" /></p>
       <input type="submit" value="Изменить" />
     </form>
    <?php 
  }
  else{
    ?>
    <form action="" method="post">
      <p><label for="login">Логин </label><input name="login" /></p>
      <p><label for="pass">Пароль </label><input name="pass" /></p>
      <input type="submit" value="Войти" />
    </form>
    <br><a href='login.php?act=change_pass'> Сменить пароль</a><br>
    <?php
  }
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {
  $db = new PDO('mysql:host=localhost;dbname=u47569', $db_user, $db_pass, array(
    PDO::ATTR_PERSISTENT => true
  ));

  try {
    if(isset($_GET['act'])&&$_GET['act'] == 'change_pass'){
      change_pass($db);
    }
    $login = $_POST['login'];
    $pass =  $_POST['pass'];
    
    $stmt = $db->prepare("SELECT * FROM users6 WHERE login = ?");
    $stmt->execute(array(
      $login
    ));
    $user = $stmt->fetch();
    if (password_verify($pass, $user['pass'])) {
      $_SESSION['login'] = $login;
    }
    else{
      $stmt = $db->prepare("SELECT * FROM admin WHERE login = ?");
      $stmt->execute(array(
        $login
      ));
      // Получаем данные в виде массива из БД.
      $admin = $stmt->fetch();
      // Сравнием текущий хэш пароля с тем, что достали из базы.
      if ($pass==$admin['pass']||password_verify($pass, $admin['pass'])) {
        header('Location: admin.php');
        exit();
      }
      else {
        echo "Неправильный логин или пароль";
        exit();
      }
    }
  }
  catch(PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
    exit();
  }
  header('Location: ./');
}
