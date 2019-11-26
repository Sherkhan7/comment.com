<?php

    $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");

    if(!$pdo){
        die("Error !");
    }
    // $sql = "SELECT * FROM comments ORDER BY Date DESC";
    $sql = "SELECT users.id, users.name, users.image, comments.message, comments.date FROM comments INNER JOIN users ON comments.user_id = users.id WHERE active=1 ORDER BY date DESC ";

    $statement = $pdo -> prepare($sql);
    $statement -> execute();
    $users = $statement -> fetchAll( PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($users);
    // echo "</pre>";

?>