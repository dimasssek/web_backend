<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

header('Content-Type: text/html; charset=UTF-8');

// Начинаем сессию.
session_start();

$db_user = 'u47569';   // Логин БД
$db_pass = '3312824';  // Пароль БД

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['do'])&&$_GET['do'] == 'logout'){
    session_start();    
    session_unset();
    session_destroy();
    //setcookie("PHPSESSID", "", 1);
    setcookie ("PHPSESSID", "", time() - 3600, '/');
    header("Location: index.php");
    exit;}
?>

<form action="" method="post">
  <p><label for="login">Логин </label><input name="login" /></p>
  <p><label for="pass">Пароль </label><input name="pass" /></p>
  <input type="submit" value="Войти" />
</form>

<?php
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {

  $login = $_POST['login'];
  $pass =  $_POST['pass'];

  $db = new PDO('mysql:host=localhost;dbname=u47569', $db_user, $db_pass, array(
    PDO::ATTR_PERSISTENT => true
  ));

  try {
    $stmt = $db->prepare("SELECT * FROM users5 WHERE login = ?");
    $stmt->execute(array(
      $login
    ));
    // Получаем данные в виде массива из БД.
    $user = $stmt->fetch();
    // Сравнием текущий хэш пароля с тем, что достали из базы.
    if (password_verify($pass, $user['pass'])) {
      // Если он верныйы, то записываем логин в сессию.
      $_SESSION['login'] = $login;
    }
    else {
      echo "Неправильный логин или пароль";
      exit();
    }

  }
  catch(PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
    exit();
  }
  header('Location: ./');
}

