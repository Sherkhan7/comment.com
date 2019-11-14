<?php
    session_start();
    
    function add_user($username, $email, $password, $confirmed_password){
    
        $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
        
        if(!$pdo){
            die("Connection failed!");
        }
        
        //email to lower case
        $email = strtolower($email);
        
        //email validated
        $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);
    
        if($email_validate === false){
            $_SESSION['email_type_validate'] = $email_validate;
        }
        else {
            $sql = "SELECT email FROM users WHERE email=:email";

            $statement = $pdo -> prepare($sql);
            $statement -> bindParam(':email', $email);        
            $statement -> execute();

            $result = $statement -> fetch(PDO::FETCH_ASSOC);

            if($result['email'] != null)
            {
                $_SESSION['email_existence_validate'] = true;
                $email_validate = false;
            }
        }

        if ($password === $confirmed_password) {
            if(strlen($password) < 6){
                $_SESSION['password_character_validate'] = false; 
                $password_validate = false;
                $confirmed_password = "";
            }
            else {
                $password_validate = true;
            }
        }
        else {
            if($confirmed_password != ""){
                $_SESSION['password_validate'] = false;
                $password_validate = false;
            }
        }

        if($username && $email_validate && $password_validate && $confirmed_password){

            //hashing the password
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

            $statement = $pdo -> prepare($sql);
            $statement -> bindParam(':name', $username);
            $statement -> bindParam(':email', $email);
            $statement -> bindParam(':password', $password);
            
            $statement -> execute();
            $last_user_id = $pdo -> lastInsertId();
            
            setcookie("USERNAME", $username, time() + 3600);
            setcookie("EMAIL", $email, time() + 3600);
            setcookie("USER_ID", $last_user_id, time() + 3600);
            
            $_SESSION['USERNAME'] = $username;
            $_SESSION['EMAIL'] = $email;
            $_SESSION['USER_ID'] = $last_user_id;

            header("Refresh: 2; url=/user_index.php");

        }
        else {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['confirmed_password'] = $confirmed_password;
            header("Location: /register.php");
        }
    }

    add_user($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmed_password']);
?>
Loading...