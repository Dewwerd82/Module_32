<?php
// Страница регистрации нового пользователя 
// Соединяемся с БД
//$link=mysqli_connect("localhost", "testtable", "root", ""); 
$link=mysqli_connect("localhost", "root", "", "db"); 
//$link=mysqli_connect("localhost", "mysql_user", "mysql_password", "testtable"); 
if(isset($_POST['submit']))
{
    $err = [];

    // проверяем логин

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['username']))
        {
            $err[] = "Логин может состоять только из букв английского алфавита и цифр";
        } 
    if(strlen($_POST['username']) < 3 or strlen($_POST['username']) > 30)
        {
            $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
        } 
    // проверяем, не существует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT id FROM users WHERE login='".mysqli_real_escape_string($link, $_POST['username'])."'");

    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    } 
    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        $login = $_POST['username'];
        $email = $_POST['email'];
        $mes = "-";
        // Убираем лишние пробелы и делаем двойное хэширование (используем старый метод md5)
        $password = md5(md5(trim($_POST['pass']))); 
        //$password = $_POST['pass'];
        mysqli_query($link,"INSERT INTO users SET login='".$login."', password='".$password."', mail='".$email."', message='".$mes."'");
        header("Location: signIn.php"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}

?>