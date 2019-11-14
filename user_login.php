<?php
    session_start();
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $checkbox = $_POST['checkbox'];

    $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
    if(!$pdo){
        die("Connection field");
    }

    $sql = "SELECT id, name, email, password FROM users WHERE email=:email";

    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(":email", $email);
    $statement -> execute();
    $result = $statement -> fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($result['password']);
    // echo "</pre>";

    if($result['password'] === null){
        $_SESSION['email_error'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

       header("Location: /login.php");
    }
    else{
        if(!password_verify($password, $result['password'])){
            $_SESSION['password_error'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("Location: /login.php");
        }
        else{
            if($checkbox === "on"){
                setcookie("EMAIL", $result['email'], time() + 3600);
                setcookie("USERNAME", $result['name'], time() + 3600);
                setcookie("USER_ID", $result['id'], time() + 3600);

                $_SESSION['USERNAME'] = $result['name'];
                $_SESSION['EMAIL'] = $result['email'];
                $_SESSION['USER_ID'] = $result['id'];
            }
            else{
                setcookie("EMAIL", $result['email'], time() - 3600);
                setcookie("USERNAME", $result['name'], time() - 3600);
                setcookie("USER_ID", $result['id'], time() - 3600);

                $_SESSION['USERNAME'] = $result['name'];
                $_SESSION['EMAIL'] = $result['email'];
                $_SESSION['USER_ID'] = $result['id'];
            }

            header("Refresh: 2; url=user_index.php");
        }
    }

?>
Loading...