<?php
/**

 * @return PDO

 */

 //include './functions.php';

function get_connection()
{
    return new PDO('mysql:host=localhost;dbname=db', 'root', '');
}

function insert(array $data)
{
    $query = 'INSERT INTO users (login, mail, password) VALUES(?, ?, ?)';
    $db = get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
}

function getUserByEmail(string $email)
{
    $query = 'SELECT * FROM users WHERE email = ?';
    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}

function getUsersList()
{
    $db = get_connection();
    $query = 'SELECT * FROM users ORDER BY id DESC';
    
    return $db->query($query,PDO::FETCH_ASSOC);

}