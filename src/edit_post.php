<link rel="stylesheet" href="styles.css">
<title>Редактор</title>
<?php
include_once "./templates/mysqlConnect.php";
$title = $_POST ["items"];
$sql = "SELECT * FROM `articles`";
$res = $mysqli -> query($sql);

if ($res->num_rows > 0) { 
    while($row = $res->fetch_assoc()) {
        if ($title == $row["title"]) {
        ?>

        <div class="wrapper redactor">    
            <div class="title">Редактирование поста: <?php echo $title ?></div>
            <form class="my-form" method = "post" action="edit_post1.php">
                Название <input class="form-field" id="name1" type="text" name ="name"/><br/>
                Текст <textarea class="form-field" id="text1" name="text" style="height:300px;"></textarea><br/>
                Ссылка на картинку <input class="form-field" id="image1" type="text" name ="image"/><br/>
                Номер категории <input class="form-field" id="categories1" type="text" name ="categories"/><br/>
                <input class="form-field" id="id1" type="text" name ="id" hidden/>
                <script>
                    document.getElementById("name1").value = "<?php echo $row["title"];?>";
                    document.getElementById("text1").value = "<?php echo $row["text"];?>";
                    document.getElementById("categories1").value = "<?php echo $row["id_topic"];?>"
                    document.getElementById("image1").value = "<?php echo $row["image"];?>";
                    document.getElementById("id1").value = "<?php echo $row["id"];?>";
                </script>
                <input class="my-btn form-btn" type = "submit" value = "Изменить статью"/>
                <!-- <a class="my-btn" href="/">Домой</a> -->
            </form>
        </div>    
            <?php
        }   
}
}
?>

