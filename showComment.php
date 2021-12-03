<?php
function showComment ($nameComment, $idCounter){
    $mysqli = new mysqli("localhost", "root", "", "db");// Подключается к базе данных
    $result_set = $mysqli->query("SELECT * FROM `comments` WHERE `name`='$nameComment'"); //Вытаскиваем все комментарии для данной страницы

  while ($row = $result_set->fetch_assoc()) {
      
     
    echo '<div style="display: flex; width: 570px;">';  
    
        echo '<div style="width: 170px;">';
            print_r($row['username']); //Вывод имени
            echo "<br />";
            print_r($row['date']); //Вывод даты
            echo "<br />";
            $idNum = $row['id'];
            
        echo '</div>';   
     
        echo '<div class="form-floating" style="width: 400px;">
            <textarea class="form-control" id="floatingTextarea2" style="height: 50px" disabled>';

            print_r($row['text_comment']); //вывод комментария
            //print_r($row);

            echo '</textarea>
           
            </div>';
            
            if ($_SESSION['login'] == $row['username']){
                echo '<div>
                <form action="delete.php" method="POST">
                <input type="hidden" name="idCounter" value="'.$idNum.'" />
                <button type="submit" class="btn btn-outline-danger" name="delete">Delete</button>
                </form>
                </div>';
            }
            
    echo '</div>';
  
}
}

?>