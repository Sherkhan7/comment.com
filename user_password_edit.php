<?php
    session_start();
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirmed_new_password = $_POST['confirmed_new_password'];
    $id = $_SESSION['USER_ID'];

    // var_dump($current_password);
    // var_dump($new_password);
    // var_dump($confirmed_new_password);

    if($current_password === ""){
        $_SESSION['current_password'] = $current_password;
        $current_password_validate = false;
    }
    else {

        $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
        if(!$pdo){
            die("Error !");
        }

        $sql = "SELECT password FROM users WHERE id=:id";
        $statement = $pdo -> prepare($sql);
        $statement -> bindParam(":id", $id);
        $statement -> execute();
        $result = $statement -> fetch(PDO::FETCH_ASSOC);
        
        if(!password_verify($current_password, $result['password'])){
            $current_password_validate = false;
            $_SESSION['current_password_error'] = true;
        }
        else {
            $current_password_validate = true;

            if ($new_password === $confirmed_new_password) {
                if(strlen($new_password) < 6){
                    $_SESSION['password_character_validate'] = false;
                    $new_password_validate = false;
                    $confirmed_new_password = "";
                }
                else {
                    $new_password_validate = true;
                }
            }
            else {
                if($confirmed_new_password != ""){
                    $_SESSION['password_validate'] = false;
                    $_SESSION['new_password'] = $new_password;
                    $new_password_validate = false;
                }
            }            
        }
    }

    if($new_password_validate && $current_password_validate){
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
        if(!$pdo){
            die("Error !");
        }

        $sql = "UPDATE users SET password=:new_password WHERE id=:id";
        $statement = $pdo -> prepare($sql);
        $statement -> bindParam(":new_password", $new_password);
        $statement -> bindParam(":id", $id);
        $statement -> execute();
        $_SESSION['password_success'] = true;
        header("Location:/user_account.php");

    }
    else {
        $_SESSION['current_password'] = $current_password;
        $_SESSION['new_password'] = $new_password;
        $_SESSION['confirmed_new_password'] = $confirmed_new_password;
    }
    
    header("Location:/user_account.php");


?>