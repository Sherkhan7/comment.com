<?php
    session_start();
    include "user.php";
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    // var_dump($_SESSION['username']);
    
    if(!isset($_SESSION['username']) && !isset($_SESSION['email'])){
        $_SESSION['username'] = $_SESSION['USERNAME'];
        $_SESSION['email'] =  $_SESSION['EMAIL'];
    }

    if(($_SESSION['username']) === ""){
        $usernameErr = "Please, fill the Name area !";
    }
    if(($_SESSION['email']) === ""){
        $emailErr = "Please, fill the Email area !";
    }
    else {
        if(($_SESSION['email_type_validate']) === false) {
            $emailErr = "Wrong email type !";
        }
        if($_SESSION['email_existence_validate'] === true) {
            $emailErr = "This eamil has already been taken !";
        }
    }


    if(($_SESSION['current_password']) === ""){
        $current_password_Err = "Please, enter the current password !";
    }
    else {
        if($_SESSION['current_password_error'] === true){
            $current_password_Err = "Wrong password entered !";
        }
    }
    if($_SESSION['new_password'] === ""){
        $new_password_Err = "Please, enter the new password !";
    }
    else {
        if($_SESSION['password_character_validate'] === false){
            $new_password_Err = "Password must contain at least 6 characters !";
        }
        if($_SESSION['password_validate'] === false){
            $confirmed_password_Err = "The password confirmation does not match !";
        }
    }
    if(($_SESSION['confirmed_new_password']) === ""){
        $confirmed_password_Err = "Please, Confirm the new password !";
    }

    if(isset($_SESSION['USERNAME']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Account</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>

    </style>

</head>

<body>

    <div class="container">
        <a href="/user_index.php">Go to user index</a>
        <?php if($_SESSION['account_success'] === true){
            echo '<div class="alert alert-dark" role="alert">
                    Username, email or avatar have changed successfully.
                 </div>';
        }
        ?>
    
        <div class="card mb-3 mt-3">

            <div class="card-header bg-dark text-light">
                User Account
            </div>

            <div class="card-body">
                <form action="/user_account_edit.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group mt-3">
                        <label for="name">Name</label>
                        <input class="form-control form-control-sm" type="text" name="username" id="name"
                            value="<?= $_SESSION['username'];?>">
                        <small id="userHelp" class="form-text text-danger"><?= $usernameErr;?></small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input class="form-control form-control-sm" type="text" name="email" id="email"
                            value="<?= $_SESSION['email'];?>">
                        <small id="emailHelp" class="form-text text-danger"><?= $emailErr;?></small>
                    </div>

                    <div class="form-group mt-3">
                        <div class="custom-file" style="overflow: hidden;">
                            <input type="file" class="custom-file-input" id="user_avatar" name="user_avatar">
                            <label class="custom-file-label" for="user_avatar">Choose file</label>
                        </div>
                    </div>
                    <div class="avatar" >
                        <img src="images/<?= $user['image'];?>" alt="user_avatar"
                            style=" border-radius: 100%; max-width: 100%; object-fit:cover;" width="200" height="200">
                    </div>

                    <button type="submit" class="btn btn-elegant btn-sm mt-3">Save</button>
                </form>
            </div>

        </div>

        <?php if($_SESSION['password_success'] === true){
            echo '<div class="alert alert-dark" role="alert">
                    Your password has changed successfully.
                 </div>';
        }
        ?>

        <div class="card mb-3 mt-3">

            <div class="card-header bg-dark text-light">
                Security
            </div>

            <div class="card-body">
                <form action="/user_password_edit.php" method="POST">

                    <div class="form-group mt-3">
                        <label for="current_psw">Current Password</label>
                        <input class="form-control form-control-sm" type="password" name="current_password"
                            id="current_psw" value="<?= $_SESSION['current_password'];?>">
                        <small class="form-text text-danger"><?= $current_password_Err;?></small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="new_psw">New password</label>
                        <input class="form-control form-control-sm" type="password" name="new_password" id="new_psw" value="<?= $_SESSION['new_password'];?>">
                        <small class="form-text text-danger"><?= $new_password_Err;?></small>
                    </div>

                    <div class="form-group mt-3">
                        <label for="confirmed_new_psw">Confirm the new password</label>
                        <input type="password" class="form-control form-control-sm" name="confirmed_new_password"
                            id="confirmed_new_psw" value="<?= $_SESSION['confirmed_new_password'];?>">
                        <small class="form-text text-danger"><?= $confirmed_password_Err;?></small>
                    </div>

                    <button type="submit" class="btn btn-elegant btn-sm mt-3">Save</button>
                </form>
            </div>

        </div>

    </div>

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
    }
    else{
        header("Refresh: 0; url=/index.php");
    }

    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['email_type_validate']);
    unset($_SESSION['email_existence_validate']);
    unset($_SESSION['account_success']);

    unset($_SESSION['current_password']);
    unset($_SESSION['current_password_error']);
    unset($_SESSION['new_password']);
    unset($_SESSION['password_character_validate']);
    unset($_SESSION['password_validate']);
    unset($_SESSION['confirmed_new_password']);
    unset($_SESSION['password_success']);

?>