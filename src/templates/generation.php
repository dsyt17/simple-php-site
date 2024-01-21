<html lang = "en">
<link rel="stylesheet" href="styles.css">



<?php
include_once "mysqlConnect.php";
function generation_head_menu ($mysqli) { // функция создания списка категорий
    $sql = "SELECT * FROM `topic`";

    $topic = 0;
    if (isset($_GET['id_topic'])) {
        $topic = $_GET['id_topic'];
    }

    $resSQL = $mysqli -> query($sql);
    ?>
        <nav class="">
            <div class="navbar-title">Категории:</div>
            <ul class="">
                <?php
                    if (!$topic) {
                        echo '<li class="nav-item active-link"><a class="nav-link" href="http://localhost/'.'">'. "Все категории".'</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="http://localhost/'.'">'. "Все категории".'</a></li>';
                    }
                    while ($rowTopic = $resSQL -> fetch_assoc()) {
                        if ($topic == $rowTopic["id"]) {
                            echo '<li class="nav-item"><a class="nav-link active-link" href="./topic.php?id_topic='. $rowTopic["id"] .'">'. $rowTopic['name'].'</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="./topic.php?id_topic='. $rowTopic["id"] .'">'. $rowTopic['name'].'</a></li>';
                        }
                        
                    }                   
                ?>
            </ul>
        </nav>
    <?php
}

function generation_temp ($mysqli) {
    ?>
        <nav class="">
            <div class="navbar-title">Важное:</div>
            <ul class="">
                <li class="nav-item"><a class="nav-link">ПОЛИТИКА</a></li>
                <li class="nav-item"><a class="nav-link">ЭКОНОМИКА</a></li>
                <li class="nav-item"><a class="nav-link">ОБЩЕСТВО</a></li>
                <li class="nav-item"><a class="nav-link">ЭКОЛОГИЯ</a></li>
                <li class="nav-item"><a class="nav-link">ПРАВО</a></li>
                <li class="nav-item"><a class="nav-link">КУЛЬТУРА</a></li>
                <li class="nav-item"><a class="nav-link">СПОРТ</a></li>
                <li class="nav-item"><a class="nav-link">ПРОИСШЕСТВИЯ</a></li>
                <li class="nav-item"><a class="nav-link">ТЕХНОЛОГИИ</a></li>
                <li class="nav-item"><a class="nav-link">АВТО</a></li>
                <li class="nav-item"><a class="nav-link">ПРИВЕТ</a></li>
                <li class="nav-item"><a class="nav-link">ДОКУМЕНТЫ</a></li>
            </ul>
        </nav>
        
    <?php
}

function generation_header ($mysqli) {
    ?>
    <div class="my-header">
        <h1>БНК Клон</h1>
        <!-- <form method = "post" class="login-form">
            <div><span>Логин:</span> <input type="text" name="login" id ="test1"></div>
            <div><span>Пароль:</span> <input type="password" name="pass" id ="test2"></div>
            <div><input type="submit" value="Войти" name="doGo"></div>
        </form> -->
        <div>
            <?php
                if ( ! isset ($_SESSION[ 'name' ])) {
                    echo "Вы не авторизованы  ";
                    echo "<a class='my-btn' href='login.php'>Войти</a>";
                } else {
                    echo "Добро пожаловать, {$_SESSION[ 'name' ]}";
                    echo "<br><br><a class='my-btn' href='/logout.php'>Выйти</a>";
                    if ( $_SESSION[ 'role' ] == "admin") echo "<br><br><a class='my-btn' href='admin.php'>Администрирование</a>";
                } 
            ?>
            
        </div>
    </div>  
    <?php
}

function generation_posts_index ($mysqli) { // функция для вывода списка статей
    $sql = "SELECT * FROM `articles` ORDER BY `date` DESC";
    $res = $mysqli -> query($sql);
    if ($res -> num_rows > 0) {
        while ($resArticle = $res -> fetch_assoc()) {
            ?>
            <div class = "row">
                <div class = "my-card">
                            <div class="card-title" ><a href = "post.php?id_article=<?= $resArticle['id'] ?>"><?= $resArticle['title'] ?></a></div>
                            <div class="card-date"><?= $resArticle['date']?></div>
                            <img class="my-img" src="<?=$resArticle['image']?>"/>
                            <div class="card-text"><?= mb_substr($resArticle['text'], 0, 400, 'UTF-8'); echo "..." ?></div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "Нет статей";
    }
}

function generation_posts_topic ($mysqli, $id_topic) { // функция для вывода статей в категории
    $sql = "SELECT * FROM `articles` WHERE `id_topic` = $id_topic ORDER BY `date` DESC";
    $res = $mysqli -> query($sql);
    if ($res -> num_rows > 0) {
        while ($resArticle = $res -> fetch_assoc()) {
            ?>
            <div class = "row">
                <div class = "my-card">
                            <div class="card-title" ><a href = "post.php?id_article=<?= $resArticle['id'] ?>"><?= $resArticle['title'] ?></a></div>
                            <div class="card-date"><?= $resArticle['date']?></div>
                            <img class="my-img" src="<?=$resArticle['image']?>"/>
                            <div class="card-text"><?= mb_substr($resArticle['text'], 0, 400, 'UTF-8'); echo "..." ?></div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "В этом разделе нет статей";
    }
}

function generation_post ($mysqli, $id_article) { // Функция для генерации статьи
    $sql = "SELECT * FROM `articles` WHERE `id` = '$id_article'";
    $res = $mysqli -> query($sql);
    if ($res -> num_rows === 1) {
        $resPost = $res -> fetch_assoc()?>
        <div class="card-title"><?= $resPost['title'] ?></div>
        <div class="card-date"><?= $resPost['date']?></div>
        <img class="my-img" src="<?=$resPost['image']?>"/>
        <p><?= $resPost['text'] ?></p>
        <?php
    }
}
function generation_comment ($mysqli, $id_article) { // функция для генерации комментариев
    $sql = "SELECT * FROM `comments` WHERE `id_article` = $id_article ORDER BY `date` DESC";
    $resSQL = $mysqli -> query($sql);
    if ($resSQL -> num_rows > 0) {
        while ($resComment = $resSQL -> fetch_assoc()) {
            ?> 
            <div class="comment">
                <p><b><?= $resComment['comment']?></b></p>
                <p>Оставлен: <?= substr($resComment['date'], 0, 11)  ?></p>
            </div>
            <hr>
            <?php
        }
    } else {
        ?>
            <p>Комментариев нет</p>
        <?php
    }
}


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
                    $prava = $row['access_rights'];
                    if ($row['id']) {
                        if (password_verify($pass, $row['password'])) {
                            // Если функция возвращает true, то вы входите
                            echo "Вход выполнен";
                            $login1 = $_POST["login"];
                            $pass1 = $_POST["pass"];
                            if ($prava == "admin"){
                                ?>
                                <form method="post" action="admin.php">
                                    <input type="text" name="login" id = "login" hidden value=<?php echo $login1?>>
                                    <input type="password" name="pass" id = "pass" hidden value=<?php echo $pass1?>>
                                    <input type="submit" value="Админ панель">
                                </form>
                                <?php
                            }
                            include "index.php";
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
