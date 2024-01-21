<?php
session_start();
?>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
<body>
    
    <div class="wrapper">
        <?php 
            include_once "./templates/generation.php";
        ?>
        <div>
        <?php 
            generation_header($mysqli);
        ?>
        </div>
        <div class="content-container">
            <div class="navbar">
                <?php 
                    generation_head_menu($mysqli);
                ?>
            </div>
            <div class="posts">
            <?php 
                generation_posts_index($mysqli);
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