<?php
include_once "./templates/mysqlConnect.php";
$title = $_GET ["items"];
$sql = "DELETE FROM articles WHERE `articles`.`title` = '$title'";
$mysqli -> query($sql);
header("Location: index.php");
?>