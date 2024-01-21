<?php
session_start();

if ( !isset($_SESSION[ 'role' ])) die('Вы не авторизованы!');
if ( $_SESSION[ 'role' ] !== "admin") die('403');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Admin panel</title>
</head>
<?php 
    include_once "./templates/mysqlConnect.php";

    // $username = $_POST['login'];
    // $password = $_POST['pass'];

    $sql = "SELECT * FROM `user`";
    $res = $mysqli -> query($sql);
    if ($res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        // if ($username == $row["login"] && password_verify($password, $row['password'])){
            ?>
        <div class="wrapper redactor">    
            <div class="my-card">
                        <div class="title">Создание нового поста</div><br>
                        <form class="my-form" method = "get" action = "add_post.php" id = "add">
                            Название <input class="form-field" type="text" name ="name"/><br/>
                            Текст <textarea class="form-field" name="text" style="width:200px; height:50px;"></textarea><br/>
                            Ссылка на картинку <input class="form-field" type="text" name ="image"/><br/>
                            Категория
                            <select class="form-field" id="items" name="categories" form = "add">
                                <?php
                                    $sql = "SELECT * FROM `topic`";
                                    $res = $mysqli -> query($sql);
                                    if ($res->num_rows > 0) { 
                                        while($row = $res->fetch_assoc()) {
                                            echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                                        }
                                    }
                                ?>
                            </select><br/>
                            <input class="my-btn form-btn" type = "submit" value = "Добавить"/>
                        </form>
            </div>

                    <?php
                    $sql = "SELECT title FROM `articles`";
                    $res = $mysqli -> query($sql);
                    ?>

            <div class="my-card">
                        <div class="title">Редактирование постов</div><br>
                        <form class="my-form" method = "post" action="edit_post.php" id = "edit">
                            <select class="form-field" id="items" name="items" form = "edit">
                                <?php
                                    if ($res->num_rows > 0) { 
                                        while($row = $res->fetch_assoc()) {
                                            echo "<option value='" . $row["title"] . "'>" . $row["title"] . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <br><input class="my-btn form-btn" type="submit" value="Редактировать"/>
                            </form>
            </div>

            <div class="my-card">
                        <div class="title">Удаление постов</div><br>
                        <form class="my-form" method = "get" action="delete_post.php" id = "delete">
                            <select class="form-field" id="items" name="items" form = "delete">
                                <?php
                                    $sql = "SELECT title FROM `articles`";
                                    $res = $mysqli -> query($sql);
                                    if ($res->num_rows > 0) { 
                                        while($row = $res->fetch_assoc()) {
                                            echo "<option value='" . $row["title"] . "'>" . $row["title"] . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <br>
                            <input class="my-btn form-btn" type="submit" value="Удалить"/>
                        </form>
            </div>

                    <a class="my-btn" href="/">Домой</a>

            </div> 
            <?php
        }
        
    }
    // }
?>