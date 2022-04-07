<?php
header('Content-Type: text/html; charset=UTF-8');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();

  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages['save'] = 'Спасибо, результаты сохранены.';
  }

  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['kon'] = !empty($_COOKIE['kon_error']);
  $errors['super'] = !empty($_COOKIE['super_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['contr_check'] = !empty($_COOKIE['contr_check_error']);

  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages['name_message'] = '<div class="error">Заполните имя.<br>Поле может быть заполнено символами только русского или только английского алфавитов</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages['email_message'] = '<div class="error">Заполните e-mail.<br>Поле может быть заполнено только символами английского алфавита, цифрами и знаком "@"</div>';
  }
  if ($errors['year']) {
    setcookie('year_error', '', 100000);
    $messages['year_message'] = '<div class="error">Выберите год рождения</div>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages['gender_message'] = '<div class="error">Укажите ваш пол</div>';
  }
  if ($errors['kon']) {
    setcookie('kon_error', '', 100000);
    $messages['kon_message'] = '<div class="error">Веберите количество конечностей</div>';
  }
  if ($errors['super']) {
    setcookie('super_error', '', 100000);
    $messages[] = '<div class="error">Веберите хотя бы одну сверхспособность</div>';
  }
  if ($errors['bio']) {
    setcookie('bio_error', '', 100000);
    $messages['bio_message'] = '<div class="error">Расскажите о себе</div>';
  }
  if ($errors['contr_check']) {
    setcookie('contr_check_error', '', 100000);
    $messages['contr_check_message'] = '<div class="error">Вы не можете отправить форму, не ознакомившись с контрактом</div>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['kon'] = empty($_COOKIE['kon_value']) ? '' : $_COOKIE['kon_value'];
  $values['super'] = [];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['contr_check'] = empty($_COOKIE['contr_check_value']) ? '' : $_COOKIE['contr_check_value'];

  $super = array(
    'immortality' => "Бессмертие",
    'stena' => "Прохождение сквозь стены",
    'levitation' => "Левитация",
  );
  
  if(!empty($_COOKIE['super_value'])) {
    $super_value = unserialize($_COOKIE['super_value']);
    foreach ($super_value as $s) {
      if (!empty($super[$s])) {
          $values['super'][$s] = $s;
      }
    }
  }
  include('form.php');
  
}

else {
  $errors = FALSE;
// ИМЯ
if (empty($_POST['name'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('name_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else if(!preg_match("/^[а-яё]|[a-z]$/iu", $_POST['name'])){
    setcookie('name_error', $_POST['name'], time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  }
  // EMAIL
  if (empty($_POST['email'])){
    setcookie('email_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+.[a-zA-Z.]{2,5}$/", $_POST['email'])){
    setcookie('email_error', $_POST['email'], time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }

  // ГОД
  if ($_POST['year']=='') {
    setcookie('year_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60);
  }

  // ПОЛ
  if (empty($_POST['gender'])) {
    setcookie('gender_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else{
  setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }

  // КОНЕЧНОСТИ
  if (empty($_POST['kon'])) {
    setcookie('kon_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('kon_value', $_POST['kon'], time() + 30 * 24 * 60 * 60);
  }

  // СВЕРХСПОСОБНОСТИ
  if(empty($_POST['super'])){
    setcookie('super_error', ' ', time() + 24 * 60 * 60);
    setcookie('super_value', '', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else{
    foreach ($_POST['super'] as $key => $value) {
      $super[$key] = $value;
    }
    setcookie('super_value', serialize($super), time() + 30 * 24 * 60 * 60);
  }

  // БИОГРАФИЯ
  if (empty($_POST['bio'])) {
    setcookie('bio_error', ' ', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60);
  }

  // ПОДТВЕРЖДЕНИЕ
  if (empty($_POST['contr_check'])) {
    setcookie('contr_check_error', ' ', time() + 24 * 60 * 60);
    setcookie('contr_check_value', '', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('contr_check_value', $_POST['contr_check'], time() + 30 * 24 * 60 * 60);
  }

  if ($errors) {
    header('Location: index.php');
    exit();
  }
  else {
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('kon_error', '', 100000);
    setcookie('super_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('contr_check_error', '', 100000);
  }

  // Сохранение в БД.
  $user = 'u47569';
$pass = '3312824';
$db = new PDO('mysql:host=localhost;dbname=u47569', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.

try {
  $stmt = $db->prepare("INSERT INTO application SET name = ?, email = ?, year = ?, gender = ?, kon = ?, bio = ?");
  $stmt -> execute(array(
		$_POST['name'],
        $_POST['email'],
        $_POST['year'],
        $_POST['gender'],
        $_POST['kon'],
        $_POST['bio'],
	));
	
  $stmt = $db->prepare("INSERT INTO Superpowers SET name = ?");
  $stmt -> execute(array(
		$_POST['super'] = implode(', ', $_POST['super']),
	));
}
catch(PDOException $e){
  print('Error: ' . $e->getMessage());
  exit();
}

  setcookie('save', '1');

  header('Location: index.php');
}
