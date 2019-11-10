<?php
    session_start();
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $checkbox = $_POST['checkbox'];

    $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
    if(!$pdo){
        die("Connection field");
    }

    $sql = "SELECT password, email, name FROM users WHERE email=:email";
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(":email", $email);
    $statement -> execute();
    $result = $statement -> fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($result['password']);
    // echo "</pre>";

    if($result['password'] === null){
        $_SESSION['email_error'] = true;
        header("Location: /login.php");
    }
    else{
        if(!password_verify($password, $result['password'])){
            $_SESSION['password_error'] = true;
            header("Location: /login.php");
        }
        else{
            if($checkbox === "on"){
                setcookie("password", $result['password'], time() + 86400 * 3);
                setcookie("email", $result['email'], time() + 86400 * 3);



            }
            else{
                setcookie("password", $result['password'], time() + 30);
                setcookie("email", $result['email'], time() + 30);
            }
            header("Refresh: 3; url=user_index.php");

        }
    }

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

?>
Loading...