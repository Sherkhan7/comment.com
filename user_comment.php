<?php

    session_start();

    function connection(){
        $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
            if(!$pdo){
                die("Connection failed!");
            }
        return $pdo;
    }
        
    function add_comment($username, $comment){

        if($username && $comment){
            $sql = "INSERT INTO comments (name, message) VALUES (:name, :message)";
        
            $statement = connection() -> prepare($sql);
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
            $_SESSION['comment'] = $comment;
        }
    }
    
    add_comment($_SESSION["USERNAME"], $_POST["comment"]);

    header("Location: /user_index.php");

?>