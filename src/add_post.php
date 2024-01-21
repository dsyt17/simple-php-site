<?php
include_once "./templates/mysqlConnect.php";
$name = $_GET ["name"];
$text = $_GET ["text"];
$categories = $_GET ["categories"];
$image = $_GET ["image"];
$sql = "INSERT INTO `articles` (`title`, `text`, `id_topic`, `image`, `date`) VALUES ('$name', '$text', '$categories', '$image', CURRENT_TIMESTAMP)";
$mysqli -> query($sql);
header("Location: index.php");
?>