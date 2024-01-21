<?php
session_start();
include_once "./templates/generation.php";
$id_article = $_REQUEST["id_article"];

function send_comment ($mysqli, $comment, $id_article) {
    $sql = "INSERT INTO `comments` (`comment`, `id_article`, `date`) VALUES ('$comment', '$id_article', CURRENT_TIMESTAMP)";
    $mysqli -> query($sql);
    echo '<script>location.replace("http://localhost/post.php?id_article=' . $id_article . '");</script>'; exit;
}
 
if (isset($_REQUEST['doGo']) === true) {
    send_comment($mysqli, $_REQUEST['comment'], $id_article);
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Статья</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
</head>
<body>

    <div class="wrapper">
        <?php 
            generation_header($mysqli);
        ?>
        <div class="content-container">
            <div class="navbar">
                <?php 
                    generation_head_menu($mysqli);
                ?>
            </div>
            <div class="posts">
                <div class = "my-card">
                    <?php
                        generation_post($mysqli, $id_article);
                    ?>
                </div>
                <div class="my-card">
                <div>Оставить комментарий:</div>
                        <form action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                            <textarea class="area-comment" name="comment" id="" style="width:800px; height:50px;"></textarea>
                            <input type="hidden" name="id_article" value="<?php echo $id_article ?>">
                            <input class="my-btn" name="doGo" type="submit" value="Отправить">
                        </form>
            
                </div>
                <div class="my-card">
                <div>Комментарии:</div>

                    <?php 
                        generation_comment($mysqli, $id_article);
                    ?>
                </div>
            </div>
            <div class="navbar">
            <?php 
                generation_temp($mysqli);
            ?>
            </div>
        </div>
    </div>
</body>
</html>