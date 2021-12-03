<?php

    

    // function showUsers(){
    //     $link=mysqli_connect("localhost", "root", "", "db");
    //     $query = mysqli_query($link,"SELECT login, status FROM users WHERE id > 0");
    //     //$data = mysqli_fetch_assoc($query); 

    //     for ($i=0, $data = []; $row = mysqli_fetch_assoc($query); $data[] = $row, $i++);
    //         //var_dump($data[0]['login']); //Массив результата лежит в $data
    //         //echo $row;
    //         //var_dump($row);
    //         //echo $data[0]['login'];
    //         //echo $data[0]['status'];
    //         //var_dump($data);
    //         echo    '
    //                     <table>
    //                         <tr>
    //                             <td>'.$data[1]['login'].'</td>
    //                             <td>'.$data[$i]['status'].'</td>
    //                             <td><form action="stChange.php" method="POST" >
    //                             <input type="hidden" name="tdName" value="'.$data[$i]['login'].'" />
    //                                 <select class="form-select" aria-label="Default select example" name="selectName">
    //                                     <option value="user">user</option>
    //                                     <option value="manager">manager</option>
    //                                 </select>
    //                                 <button type="submit" class="btn btn-primary" name="statusChange">Change</button>    
    //                                 </form>
    //                                 </td>
    //                         </tr>
                            
    //                     </table>';
    // }


    // function get_connection()
    // {
    //     return new PDO('mysql:host=localhost;dbname=db', 'root', '');
    // }

    function getUsersLists()
{
    //$db = get_connection();
    $db = new PDO('mysql:host=localhost;dbname=db', 'root', '');
    $query = 'SELECT * FROM users ORDER BY id DESC';
    
    return $db->query($query,PDO::FETCH_ASSOC);

}


?>