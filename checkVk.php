<?php
// Скрипт проверки 
// Соединяемся с БД
function checkVk (){
    if (!empty($_SESSION['login'])){
    $link=mysqli_connect("localhost", "root", "", "db");
 
        $query = mysqli_query($link, "SELECT * FROM users WHERE login = '".$_SESSION['login']."' LIMIT 1");
        $userdata = mysqli_fetch_assoc($query);
        //print "Привет, ".$userdata['login'].". Всё работает!";
        // if (empty($_SESSION['login']))
        if ($userdata['id_vk'] == '')
    						{
    							// Если пусты, то мы не выводим ссылку
    							echo "Вы вошли на сайт, не через VK <br>";
    						}
    					else
    						{
    							// Если не пусты, то мы выводим ссылку
    							echo "Вы вошли на сайт через VK, как ".$_SESSION['login']."<br>";
    						}
                        }
                        
}

function autorizVk (){
    if (empty($_SESSION['vk']))
    						{
    							echo 'Могут видеть информацию пользователи вошедшие через VK';
    						}
    					else
    						{
    							echo 'К сожалению пока никакой информации нет!!!';
    						}
                            
}

?>