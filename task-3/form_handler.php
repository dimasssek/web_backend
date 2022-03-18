<?php
	
//$name = '';
$ready_to_send = true;
 foreach( $_POST as $key => $value){
    if(empty($value)){
		echo "Input " . $key . "!</br>";
		$ready_to_send = false;
	}
	else if($key=='super') $super = serialize($_POST['super']);
}


/*
if (empty($_POST['super'])){
    print ('Выберите хотя бы одну сверхспособность.<br>');
    $errors = true;

}
else {
  $super = serialize($_POST['super']);
}

*/
if(!$ready_to_send){
	exit();
}

$user = 'u47569'; // Логин от БД
$pass = '3312824'; // Пароль от БД



$conn = new PDO('mysql:host=localhost;dbname=u47569', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
if ($conn === false) {
  die("Ошибка: " . mysqli_connect_error());
} 
echo "Подключение успешно установлено";
mysqli_close($conn);

// Создаем класс подключения к БД
/*try {
  $db = new PDO("mysql:host=localhost;dbname=u47569", $user, $pass);
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage();
  die();
}*/
$sql = "INSERT INTO Superpowers (name)
VALUES ('Бессмертие'), ('Способность проходить через стены'), ('Левитация')";

if ($bd->query($sql) === TRUE) {
   echo "Успешно создана новая запись";
} else {
   echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Подготовленный запрос. Не именованные метки.
try{
    $stmt = $db->prepare("INSERT INTO application SET name = ?, email = ?, year = ?, gender = ?, con = ?, super = ?, bio = ?, contr_check = ?");
    $stmt->execute(array(
        $_POST['name'],
        $_POST['email'],
        $_POST['year'],
        $_POST['gender'],
        $_POST['con'],
        $super,
        $_POST['bio'],
		$_POST['contr_check'],
    ));
}
catch(PDOException $e){
    // При возникновении ошибки отправления в БД, выводим информацию
    print ('Ошибка: ' . $e->getMessage());
    exit();
}
/*if(empty($_POST["name"])){
	print "Введите имя!</br>";
	$ready_to_send = false;
}
if(empty($_POST["email"])){
	print "Введите e-mail!</br>";
	$ready_to_send = false;
}*/

?>