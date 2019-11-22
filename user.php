<?php
    session_start();

    $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
    if(!$pdo){
        die("Error !");
    }

    $sql = "SELECT * FROM users WHERE email = :email";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(":email", $_SESSION['EMAIL']);
    $statement -> execute();
    $user = $statement -> fetch(PDO::FETCH_ASSOC);

    
?>