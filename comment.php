<?php
  if(isset($_POST['send'])){


    //$name = $_SESSION['fotoname'];

    $userName = $_SESSION['login'];

    $text_comment = $_POST["text_comment"];

    $name = $_POST["foto_id"];

    
    
    $text_comment = htmlspecialchars($text_comment);// Преобразуем спецсимволы в HTML-сущности
  
    $mysqli = new mysqli("localhost", "root", "", "db");// Подключается к базе данных
  
    $mysqli->query("INSERT INTO `comments` (`name`, `username`, `text_comment`, `date`) VALUES ('$name', '$userName', '$text_comment', NOW())");// Добавляем комментарий в таблицу
  
    header("Location: / ");// Делаем редирект обратно
  }

  


?>