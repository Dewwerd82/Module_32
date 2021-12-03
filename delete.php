<?php

if (isset($_POST['delete'])){
    
    $id = $_POST['idCounter'];
    //echo $id;
    //echo 'dfgdfsgsd';
    $mysqli = new mysqli("localhost", "root", "", "db");// Подключается к базе данных
    $delete = $mysqli->query("DELETE FROM `comments` WHERE `id`='$id'"); 
    header("Location: / ");// Делаем редирект обратно
}
?>