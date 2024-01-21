<?php
session_start();

include_once "./templates/generation.php";
 
$id_topic = $_REQUEST['id_topic'];
 
?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Категория</title>
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
 </head>
 <body>
    <div class="wrapper">
        <?php 
             include_once "./templates/generation.php";
        ?>
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
            <?php 
                generation_posts_topic($mysqli, $id_topic);
            ?>
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