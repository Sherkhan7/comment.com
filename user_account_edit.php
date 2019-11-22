<?php
    session_start();
    include "user.php";
    // var_dump($_POST);
    // var_dump($_FILES['user_avatar']);
    $username = $_POST['username'];
    $email = strtolower($_POST['email']);
    $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);
    $user_avatar = $_FILES['user_avatar'];
    $user_avatar_size = $_FILES['user_avatar']['size'];
    $user_id = $_SESSION['USER_ID'];

    function uploadImage($image){
 
        $extesion = pathinfo($image["name"], PATHINFO_EXTENSION);
        $filename = uniqid() . "." . $extesion;
        
        move_uploaded_file($image["tmp_name"] , "images/" . $filename);
        return $filename;
    }
   if(($username != $user['name']) || ($email != $user['email']) || ($user_avatar_size != 0)){
        if($user_avatar_size == 0){
            $user_avatar = false;
        }
        else{
            $user_avatar = uploadImage($user_avatar);
        }

        if($email_validate === false){
            $_SESSION['email_type_validate'] = $email_validate;
        }
        else {

            $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
            
            if(!$pdo){
                die("Connection failed!");
            }

            $sql = "SELECT email FROM users WHERE email=:email";

            $statement = $pdo -> prepare($sql);
            $statement -> bindParam(':email', $email);        
            $statement -> execute();

            $result = $statement -> fetch(PDO::FETCH_ASSOC);

            if($result['email'] != null && $result['email'] != $user['email'])
            {
                $_SESSION['email_existence_validate'] = true;
                $email_validate = false;
            }
            else {
                $email_validate = true;
            }
        }

        if($username && $email_validate ){
            if($user_avatar === false){
                $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
                if(!$pdo){
                    die("Error!");
                }

                $sql = "UPDATE users SET name=:name, email=:email WHERE id=:id";
                $statement = $pdo -> prepare($sql);
                $statement -> bindParam(":name", $username);
                $statement -> bindParam(":email", $email);
                $statement -> bindParam(":id", $user_id);
                $result = $statement -> execute();
            }
            else {
                $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
                if(!$pdo){
                    die("Error!");
                }
        
                $sql = "UPDATE users SET name=:name, email=:email, image=:image WHERE id=:id";
                $statement = $pdo -> prepare($sql);
                $statement -> bindParam(":name", $username);
                $statement -> bindParam(":email", $email);
                $statement -> bindParam(":image", $user_avatar);
                $statement -> bindParam(":id", $user_id);
                $result = $statement -> execute();
                
            }
            $_SESSION['USERNAME'] = $username;
            $_SESSION['EMAIL'] = $email;
            $_SESSION['account_success'] = true;
        }
        else {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
        }
   }


    header("Location: /user_account.php");

?>