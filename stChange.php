<?php

    
    if (isset($_POST['statusChange'])){
        $link=mysqli_connect("localhost", "root", "", "db");
        $userRole = $_POST['selectName'];
        $log = $_POST['tdName'];
        $query = mysqli_query($link,"UPDATE users SET status = '".$userRole."' WHERE login = '".$log."'");
        header("Location: / ");// Делаем редирект обратно
    }

?>