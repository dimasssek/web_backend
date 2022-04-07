<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style_3.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<title>Task-4</title>
</head>
<body>
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm ">
		<h1>Заполните форму</h1>
	</div>
	<?php 
		if (!empty($messages)) {
			if(isset($messages['save'])) print('<div id="messages" class="ok">'); else print('<div id="messages">');
			foreach ($messages as $message) {
				print($message);
			}
		  print('</div>');
		}
	?>
	<div class="container">
		<form action="form_handler.php" method="POST">
			<p><label for="name">Имя</label>
			<input type="text" id="name" name="name" <?php if(!empty($errors['name']))  print 'class="error"';?> <?php if(isset($values['name'])) print 'class="ok"';?> value="<?php isset($values['name']) ? print $values['name'] : print ''?>"> </p>
			
			<p><label for="email">E-mail</label>
			<input type="text" id="email" name="email" <?php if(!empty($errors['email']))  print 'class="error"';?> <?php if(isset($values['email'])) print 'class="ok"';?> value="<?php isset($values['email']) ? print $values['email'] : print ''?>"> </p>
			
			<p><label for="year">Год рождения</label>
			<select id="year" name="year" <?php if(!empty($errors['year']))  print 'class="error"';?> <?php if(isset($values['year'])) print 'class="ok"';?>>
				<option selected ><?php !empty($values['year']) ? print ($values['year']) : print '' ?></option>
				<?php 
					for ($i = 1980; $i <= 2014; $i++)
						echo '<option>' . $i . '</option>';
				?>
			</select>
			
			<p><label <?php if(!empty($errors['gender'])) print 'class="error_check"'?>>Пол:</label>
			<input type="radio" id="male" value="male" name="gender" <?php if (isset($values['gender'])&&$values['gender'] == 'male') print("checked"); ?>>Мужской
			<input type="radio" id="female" value="female" name="gender" <?php if (isset($values['gender'])&&$values['gender'] == 'female') print("checked"); ?>>Женский</p>

			<p><label <?php if(isset($_COOKIE['kon_error'])) print 'class="error_check"'?>>Количество конечностей:</label>
			<input type="radio" id="1" name="kon" value='1'<?php if (isset($values['kon'])&&$values['kon'] == '1') print("checked"); ?>>1
			<input type="radio" id="2" name="kon" value='2'<?php if (isset($values['kon'])&&$values['kon'] == '2') print("checked"); ?>>2
			<input type="radio" id="3" name="kon" value='3'<?php if (isset($values['kon'])&&$values['kon'] == '3') print("checked"); ?>>3
			<input type="radio" id="4" name="kon" value='4'<?php if (isset($values['kon'])&&$values['kon'] == '4') print("checked"); ?>>4</p>
			
			<p><label <?php if(!empty($errors['super'])) print 'class="error_check"'?>>Сверхспособности:</label>
			<input type="checkbox" id="immortality" value="immortality" name="super[]"<?php if(isset($values['super']['immortality'])&&$values['super']['immortality']=='immortality')print("checked");?>>Бессмертие
			<input type="checkbox" id="stena" value="stena" name="super[]"<?php if(isset($values['super']['stena'])&&$values['super']['stena']=='stena')print("checked");?>>Прохождение сквозь стены
			<input type="checkbox" id="levitation" value="levitation" name="super[]"<?php if(isset($values['super']['levitation'])&&$values['super']['levitation']=='levitation')print("checked");?>>Левитация</p>
			
			<p><label for="bio">Биография</label>
			<textarea id="bio" name="bio" <?php if(!empty($errors['bio']))  print 'class="error"';?> <?php if(isset($values['bio'])) print 'class="ok"';?>><?php isset($values['bio']) ? print trim($values['bio']) : print '' ?></textarea>
			
			<p><label <?php if(!empty($errors['contr_check'])) print 'class="error_check"'?>>С контрактом ознакомлен:</label>
			<input type="checkbox" id="contr_check" name="contr_check" value="contr_check" <?php if (isset($values['contr_check'])&&$values['contr_check'] == 'contr_check') print("checked"); ?>></p>
			
			<p><button type="submit" value="send">Отправить</p>
		</form>
	</div>
</body>
</html>