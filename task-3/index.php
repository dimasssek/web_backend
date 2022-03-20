<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style_3.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<title>Task-3</title>
</head>
<body>
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
		<h1>Заполните форму</h1>
	</div>
	<div class="container">
		<form action="form_handler.php" method="POST">
			<p><label for="name">Имя</label>
			<input type="text" id="name" name="name"></p>
			
			<p><label for="email">E-mail</label>
			<input type="text" id="email" name="email"></p>
			
			<p><label for="year">Год рождения</label>
			<select id="year" name="year">
				<option selected>Год</option>
    <?php
        for ($i = 1980; $i <= 2014; $i++)
            echo '<option>' . $i . '</option>';
    ?>
			</select>
			
			<p><label>Пол:</label>
			<input type="radio" id="male" value="male" name="gender">Мужской
			<input type="radio" id="female" value="female" name="gender">Женский</p>
			
			<p><label>Количество конечностей:</label>
			<input type="radio" id="0" value="0" name="kon">0
			<input type="radio" id="1" value="1" name="kon">1
			<input type="radio" id="2" value="2" name="kon">2
			<input type="radio" id="3" value="3" name="kon">3
			<input type="radio" id="4" value="4" name="kon">4</p>
			
			<p><label>Сверхспособности:</label>
			<input type="checkbox" id="immortality" value="immortality" name="super[]">Бессмертие
			<input type="checkbox" id="stena" value="stena" name="super[]">Прохождение сквозь стены
			<input type="checkbox" id="levitation" value="levitation" name="super[]">Левитация</p>
			
			<p><label for="bio">Биография</label>
			<textarea id="bio" name="bio"></textarea></p>
			
			<p><label>С контрактом ознакомлен:</label>
			<input type="checkbox" id="contr_check" value="contr_check" name="contr_check"></p>
			
			<p><button type="submit" value="send">Отправить</p>
		</form>
	</div>
</body>
</html>
