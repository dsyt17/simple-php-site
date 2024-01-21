<?php
include_once "./templates/mysqlConnect.php";
if (isset($_REQUEST['doGo'])) {
    
    if ($_REQUEST['pass'] !== $_REQUEST['pass_rep']) {
        $error = 'Пароль не совпадает';
    }
    
    if (!$_REQUEST['pass_rep']) {
        $error = 'Введите повторный пароль';
    }
    
    if (!$_REQUEST['pass']) {
        $error = 'Введите пароль';
    }
 
    if (!$_REQUEST['email']) {
        $error = 'Введите email';
    }
 
    if (!$_REQUEST['login']) {
        $error = 'Введите login';
    }
 
    // Если ошибок нет, то происходит регистрация 
    if (!$error) {
        $login = $_REQUEST['login'];
        $email = $_REQUEST['email'];
        // Пароль хешируется
        $pass = password_hash($_REQUEST['pass'], PASSWORD_DEFAULT);
        // хешируем хеш, который состоит из логина и времени
        $hash = md5($login . time());
        $token = md5(uniqid(rand(), true));
        
        // Переменная $headers нужна для Email заголовка
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: <$email>\r\n";
        $headers .= "From: <mail@test.com>\r\n";
        // Сообщение для Email
        $message = '
                <html>
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Что бы подтвердить Email, перейдите по <a href="http://localhost/site/reg_confirmed.php?hash=' . $hash . '">ссылке</a></p>
                </body>
                </html>
                ';
        
        $sql = "INSERT INTO `user` (`login`, `email`, `password`, `hash`, `email_confirmed`, `access_rights`) VALUES ('" . $login . "','" . $email . "','" . $pass . "', '" . $hash . "', 1, 'user')";
        $mysqli -> query($sql);
        echo $sql;
        // проверяет отправилась ли почта
        if (mail($email, "Подтвердите Email на сайте", $message, $headers)) {
            // Если да, то выводит сообщение
            echo 'Подтвердите на почте';
        }
    } else {
        // Если ошибка есть, то выводить её 
        echo $error; 
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<body>
    <div class = "container">
        <form role ="form" action ="<?=$_SERVER['SCRIPT_NAME'] ?>" method = "post" class = "row g-3 ">
            <div class="col-md-6">
                <label for = "login" class= "control-label col-md2">Логин</label>
                <input type ="login" name = "login"class = "form-control" id="login" placeholder ="Введите логин">
            </div>
            <div class="col-md-6">
                <label for = "email" class ="control-label col-md2">Email</label>
                <input type = "email" name = "email" class = "form-control" id="email" placeholder ="Введите Email">
            </div>
            <div class="col-md-6">
                <label for = "password" class ="control-label col-md2">Пароль</label>
                <input type = "password" name ="pass" class = "form-control" id="pass" placeholder ="Введите пароль">
            </div>
            <div class="col-md-6">
                <label for = "password_check" class = "control-label col-md2">Повторите пароль</label>
                <input type ="password" name = "pass_rep" class = "form-control" id="password_check" placeholder ="Повторите пароль">
            </div>
            <input type = "submit" class = "btn btn-success" value ="Зарегистроваться" name ="doGo">
        </form>
    </div>
</body>
</head>