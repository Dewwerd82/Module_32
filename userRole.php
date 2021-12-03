<?php

$link=mysqli_connect("localhost", "root", "", "db");

$query = mysqli_query($link, "SELECT * FROM users WHERE login = '".$_SESSION['login']."' LIMIT 1");
        $userdata = mysqli_fetch_assoc($query);
        //print "Привет, ".$userdata['login'].". Всё работает!";
        if (!empty($_SESSION['login'])){
        		if ($userdata['status'] == 'user')
    						{
    							echo "<strong><h1>'".$userdata['status']."'</h1></strong> <br>";
    							echo "Вам как '".$userdata['status']."' доступны эти данные!!! <br>";
    						}
    			if($userdata['status'] == 'manager')
    						{
    							echo "<strong><h1>'".$userdata['status']."'</h1></strong> <br>";
    							echo "Вам как '".$userdata['status']."' доступны эти данные!!! <br>";
    						}
        		if($userdata['status'] == 'admin')
    			            {
    							echo "<strong><h1>'".$userdata['status']."'</h1></strong> <br>";
    							echo "Вам как '".$userdata['status']."' вам можно ВСЁ!!! <br>";
    						}
						}

?>