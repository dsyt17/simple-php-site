<?php
session_start(); // открываем сессию
?>

<html lang = "ru">
<link rel="stylesheet" href="styles.css">

<div class="login-page-wrapper">
    <div class="login-page-content">
        <form method = "post" class="login-form">
                    <div><span>Логин:</span> <input type="text" name="login" id ="test1"></div>
                    <div><span>Пароль:</span> <input type="password" name="pass" id ="test2"></div>
                    <div><input type="submit" value="Войти" name="doGo"></div>
        </form>
    </div>    
</div>

<?php
include_once "templates/mysqlConnect.php";


if (isset($_REQUEST['doGo'])) { 

$error = null;

if (!$_REQUEST['login']) {
    $error = 'Введите логин';
}
if (!$_REQUEST['pass']) {
    $error = 'Введите пароль';
}

if (!$error) {
    $login = $_REQUEST['login'];
    $pass = $_REQUEST['pass'];

    // берёт из БД пароль, id пользователя и его права
    if ($result = mysqli_query($mysqli, "SELECT `password`, `id`, `access_rights` FROM `user` WHERE `login`='" . $login . "'")) {
        while( $row = mysqli_fetch_assoc($result) ){ 
            $role = $row['access_rights'];
            if ($row['id']) {
                if (password_verify($pass, $row['password'])) {
                    // Если функция возвращает true, то вы входите
                    echo "Вход выполнен";
                    $login1 = $_POST["login"];
                    $pass1 = $_POST["pass"];

                    $_SESSION ['name']= $login1;
                    $_SESSION ['role']= $role;

                    header("location: /");
                    exit;
                } else {
                     // Если функция возвращает false, то выводит ошибку
                     echo "Пароль не совпадает";
                }
            } else {
                echo "Ввели не верный логин";
            }
        } 
    }
} else {
     // Выводит ошибки, если есть пустые поля формы
     echo $error;
}
}
?>