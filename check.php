<?php
// Скрипт проверки 
// Соединяемся с БД
function check (){
    $link=mysqli_connect("localhost", "root", "", "db");
 
    if (isset($_COOKIE['id']))
    {
        $query = mysqli_query($link, "SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
        $userdata = mysqli_fetch_assoc($query);
        //print "Привет, ".$userdata['login'].". Всё работает!";
        if (empty($_SESSION['login']) or empty($_SESSION['id']))
    						{
    							// Если пусты, то мы не выводим ссылку
    							echo "Вы вошли на сайт, как гость<br>";
    						}
    					else
    						{
    							// Если не пусты, то мы выводим ссылку
    							echo "Вы вошли на сайт, как ".$_SESSION['login']."<br>";
    						}
    }
    else
    {
        print "Включите куки";
    }
}

function autoriz (){
    if (empty($_SESSION['login']))
    						{
    							// Если пусты, то мы не выводим ссылку
    							//  include './loadLogOut.php';
                                return false;
    						}
    					else
    						{
    							// Если не пусты, то мы выводим ссылку
    							// include './load.php';
                                return true;
    						}
}

?>