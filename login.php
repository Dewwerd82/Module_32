<?php
 
$token = hash('gost-crypto', random_int(0,999999));
$_SESSION["CSRF"] = $token;
// Страница авторизации 

// Соединяемся с БД

if (isset($_POST["token"])){

    if($_SESSION["CSRF"])
        {
            //Начинаем проверку логина и пароля в БД
            if((isset($_POST["username"]))&& (isset($_POST["pass"])))
                {
                    $pass = md5(md5($_POST['pass']));
                    // Вытаскиваем из БД запись, у которой логин равняется введенному
                    $link=mysqli_connect("localhost", "root", "", "db");
                    //$query = mysqli_query($link,"SELECT * FROM users WHERE login='".mysqli_real_escape_string($link,$_POST['username'])."'AND password='".mysqli_real_escape_string($link,$_POST['pass'])."'  LIMIT 1");
                    $query = mysqli_query($link,"SELECT * FROM users WHERE login='".$_POST['username']."'AND password='".$pass."'  LIMIT 1");
                    $data = mysqli_fetch_assoc($query); 
                        // Сравниваем пароли
                        if($data['password'] === md5(md5($_POST['pass']))) 
                         
                            {
        
                                setcookie("id", $data['id'], time()+60*60*24*30, "/");
                                setcookie("login", $data['login'], time()+60*60*24*30, "/");
        
                                $_SESSION['login']=$_POST['username'];
                                $_SESSION['id']=$data['id'];
        
                                header("Location: / "); exit();
                            }
                        else
                            {
                                print "Вы ввели неправильный логин/пароль";
                            }
                }
        }
}


?>