<?php
session_start();
// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

if($_SESSION['email_error'] === true){
    $emailErr = "Eamil not found !";
}
if ($_SESSION['password_error'] === true){
    $passwordErr = "Password is not correct !";
}
if ($_SESSION['email'] === "") {
    $emailErr = "Please, fill the email area !";
}
if ($_SESSION['password'] === "") {
    $passwordErr = "Please, fill the password area !";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body>

    <!-- Start your project here-->
    <div class="container">
        <!-- Material form login -->
        <div class="card w-60 mx-auto my-3">

            <h5 class="card-header elegant-color white-text text-center py-4">
                <strong>Sign in</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-5 pt-0">

                <!-- Form -->
                <form class="text-center" style="color: #757575;" action="/user_login.php" method="POST">

                    <!-- Email -->
                    <div class="md-form">
                        <input type="email" id="materialLoginFormEmail" class="form-control" name="email" area-describedby="emailHelp" value="<?= $_SESSION['email'];?>">
                        <label for="materialLoginFormEmail">E-mail</label>
                        <small id="emailHelp" class="form-text text-danger" style="text-align: left;"><?= $emailErr;?></small>
                    </div>

                    <!-- Password -->
                    <div class="md-form">
                        <input type="password" id="materialLoginFormPassword" class="form-control" name="password" area-describedby="passwordHelp" value="<?= $_SESSION['password'];?>">
                        <label for="materialLoginFormPassword">Password</label>
                        <small id="passwordHelp" class="form-text text-danger" style="text-align: left;"><?= $passwordErr;?></small>
                    </div>

                    <div class="d-flex justify-content-around">
                        <div>
                            <!-- Remember me -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="materialLoginFormRemember" name="checkbox">
                                <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                            </div>
                        </div>
                        <div>
                            <!-- Forgot password -->
                            <a href="">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Sign in button -->
                    <button class="btn btn-block btn-elegant my-4 waves-effect" type="submit" style="border-radius: 30px;">Sign in</button>

                    <!-- Register -->
                    <p>Not a member?
                        <a href="/register.php">Register</a>
                    </p>

                    <!-- Social login -->
                    <p>or sign in with:</p>
                    <a type="button" class="btn-floating btn-fb btn-sm">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a type="button" class="btn-floating btn-tw btn-sm">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a type="button" class="btn-floating btn-li btn-sm">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a type="button" class="btn-floating btn-git btn-sm">
                        <i class="fab fa-github"></i>
                    </a>

                </form>
                <!-- Form -->

            </div>

        </div>
        <!-- Material form login -->
    </div>
    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
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
    session_unset();
?>