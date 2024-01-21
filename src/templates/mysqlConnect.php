<?php
$servername = "mysql";
$username = "root";
$password = "root";
$BDname = "bnk_clone";
 
$mysqli = new mysqli($servername, $username, $password, $BDname);
 
if ($mysqli -> connect_error) {
    printf("Соединение не удалось: %s\n", $mysqli -> connect_error);
    exit();
};