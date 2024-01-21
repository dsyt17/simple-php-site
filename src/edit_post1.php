<?php
include_once "./templates/mysqlConnect.php";
$title = $_POST ["name"];
$id = $_POST ["id"];
$text = $_POST['text'];
$categories = $_POST['categories'];
$image = $_POST['image'];
$sql = "UPDATE `articles` SET `title` = '$title', `text` =  '$text', `id_topic` = '$categories', `image` = '$image' WHERE `articles`.`id` = '$id' ";
$mysqli -> query($sql);
// echo $sql;
header("Location: index.php");
?>