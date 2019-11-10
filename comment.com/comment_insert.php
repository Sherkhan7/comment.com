<?php

    session_start();
        
    function add_comment($username, $comment){

        $pdo = new PDO("mysql:host=localhost;dbname=comment", "root", "");
        
        if(!$pdo){
            die("Connection failed!");
        }

        if($username && $comment){
            $sql = "INSERT INTO comments (name, message) VALUES (:name, :message)";
        
            $statement = $pdo -> prepare($sql);
            $statement -> bindParam(":name", $username);
            $statement -> bindParam(":message", $comment);
            $result = $statement -> execute();

            $_SESSION['comment_success'] = 
            '<div class="alert alert-dark mt-2" role="alert">
                Your comment has added !     
            </div>';
        }
        else {
            $_SESSION['comment_error'] =
            '<div class="alert alert-dark mt-2" role="alert">
                Please, Fill THE EMPTY FIELDS of comment section!
            </div>';
            $_SESSION['username'] = $username;
            $_SESSION['comment'] = $comment;
        }
    }
    
    add_comment($_POST["username"], $_POST["comment"]);

    header("Location: /index.php");
?>