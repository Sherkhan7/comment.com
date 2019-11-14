<?php
    session_start();

    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";

    if(($_SESSION['username']) === ""){
        $usernameErr = "Please, fill the Name area !";
    }
    if(($_SESSION['email']) === ""){
        $emailErr = "Please, fill the Email area !";
    }
    else{
        if(($_SESSION['email_type_validate']) === false) {
            $emailErr = "Wrong email type !";
        }
        if($_SESSION['email_existence_validate'] === true) {
            $emailErr = "This eamil has already been taken !";
        }
    }

    if(($_SESSION['password']) === ""){
        $passwordErr = "Please, fill the Password area !";
    }
    else {
        if($_SESSION['password_character_validate'] === false){
            $passwordErr = "Password must contain at least 6 characters !";
        }
        if($_SESSION['password_validate'] === false){
            $confirmErr = "The password confirmation does not match !";
        }
    }
    if(($_SESSION['confirmed_password']) === ""){
        $confirmErr = "Please, Confirm the password !";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <!-- Card -->
        <div class="card w-60 mx-auto my-3">

            <h5 class="card-header elegant-color white-text text-center py-4">
                <strong>Sign up</strong>
            </h5>
            <!-- Card body -->
            <div class="card-body px-5 pt-0">

                <!-- Material form register -->
                <form action="/user_register.php" method = "post">

                    <!-- Material input text -->
                    <div class="md-form">
                        <i class="fa fa-user prefix grey-text"></i>
                        <input type="text" id="materialFormCardNameEx" class="form-control" name="username" area-describedby="userHelp" value="<?= $_SESSION['username'];?>">
                        <label for="materialFormCardNameEx" class="font-weight-light">Your name</label>
                        <small id="userHelp" class="form-text text-danger"><?= $usernameErr;?></small>
                    </div>

                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="email" id="materialFormCardEmailEx" class="form-control" name="email" area-describedby="emailHelp" value="<?= $_SESSION['email'];?>">
                        <label for="materialFormCardEmailEx" class="font-weight-light">Your E-mail address</label>
                        <small id="emailHelp" class="form-text text-danger"><?= $emailErr;?></small>
                    </div>

                    <!-- Material input email -->
                    <div class="md-form">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="materialFormCardConfirmEx" class="form-control" name="password" are-describedby="passwordHelp" value="<?= $_SESSION['password'];?>">
                        <label for="materialFormCardConfirmEx" class="font-weight-light">Your password</label>
                        <small id="passwordHelp" class="form-text text-danger"><?= $passwordErr;?></small>
                    </div>

                    <!-- Material input password -->
                    <div class="md-form">
                        <i class="fa fa-exclamation-triangle prefix grey-text"></i>
                        <input type="password" id="materialFormCardPasswordEx" class="form-control" name="confirmed_password" area-describedby="confirmHelp" value="<?= $_SESSION['confirmed_password'];?>">
                        <label for="materialFormCardPasswordEx" class="font-weight-light">Confirm password</label>
                        <small id="confirmHelp" class="form-text text-danger"><?= $confirmErr;?></small>
                    </div>

                    <div class="text-center py-4 mt-3">
                        <button class="btn btn-block btn-elegant" type="submit" style="border-radius: 30px;">Sign Up</button>
                    </div>
                </form>
                <!-- Material form register -->

            </div>
            <!-- Card body -->

        </div>
        <!-- Card -->
    </div>

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>
    
</html>
<?php

    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['email_type_validate']);
    unset($_SESSION['email_existence_validate']);

    unset($_SESSION['password']);
    unset($_SESSION['password_validate']);
    unset($_SESSION['password_character_validate']);
    unset($_SESSION['confirmed_password']);

    //session_unset();
?>