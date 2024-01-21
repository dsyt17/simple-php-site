<?php
include_once "./templates/mysqlConnect.php";
// Проверка есть ли хеш
if ($_GET['hash']) {
    $hash = $_GET['hash'];
    $sql = "SELECT `id`, `email_confirmed` FROM `user` WHERE `hash`='" . $hash . "'";
    $result = $mysqli -> query($sql);
    
    // Получаем id и подтверждено ли Email
    if ($result = mysqli_query($mysqli, "SELECT `id`, `email_confirmed` FROM `user` WHERE `hash`='" . $hash . "'")) {
        while( $row = mysqli_fetch_assoc($result) ) { 
            echo $row['id'] . " " . $row['email_confirmed'];
            // Проверяет получаем ли id и Email подтверждён ли 
            if ($row['email_confirmed'] == 1) {
                // Если всё верно, то делаем подтверждение
                mysqli_query($mysqli, "UPDATE `user` SET `email_confirmed`=0 WHERE `id`=". $row['id'] );
                echo "Email подтверждён";
            } else {
                echo "Что то пошло не так";
            }
        } 
    } else {
        echo "Что то пошло не так";
    }
} else {
    echo "Что то пошло не так";
}