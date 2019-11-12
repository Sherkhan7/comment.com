<?php
    session_start();
    // echo "<pre>";
    // var_dump($_COOKIE);
    // echo "</pre>";

    // echo "<pre><br>";
    // var_dump($_SESSION);
    // echo "</pre>";
    include "users.php";
    if(($_SESSION['comment']) === ""){
        $commentErr = "Please, fill the Comment area !";
    }

    if (isset($_SESSION['email']) && isset($_SESSION['username'])) {
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
</head>

<body>

    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark elegant-color">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
            aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i><?= $_SESSION['username']; ?></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-info"
                        aria-labelledby="navbarDropdownMenuLink-4">
                        <a class="dropdown-item" href="#">My account</a>
                        <a class="dropdown-item" href="/user_logout.php">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--/.Navbar -->

    <div class="container">

        <?php if(isset($_SESSION['comment_error'])){
            echo $_SESSION['comment_error'];
        }?>
        <?php if(isset($_SESSION['comment_success'])){
            echo $_SESSION['comment_success'];
        }?>
        <div class="card mb-3 mt-3">
            <div class="card-header bg-dark text-light">
                Leave Comment
            </div>
            <div class="card-body">
                <form action="/user_comment.php" method="POST">
                    <div class="form-group">
                        <div class="form-group mt-3">
                            <label for="comment">Comment</label>
                            <textarea id="comment" class="form-control" name="comment" rows="3"
                                area-describedby="commentHelp"
                                placeholder="Write something..."><?= $_SESSION['comment'];?></textarea>
                            <small id="commentHelp" class="form-text text-danger"><?= $commentErr;?></small>
                            <button type="submit" class="btn btn-elegant mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-3 mt-3">
            <div class="card-header  bg-dark text-light">
                Comments
            </div>
            <div class="card-body">
                <?php foreach ($users as $user):?>
                <div class="media mb-3">
                    <img class="align-self-start mr-3" src="images/userIcon.jpg" alt=""
                        style="width:64px; height:64px; border-radius:50px;">
                    <div class="media-body">
                        <h5 class="mb-0"><?= $user['name'];?></h5>
                        <p class="form-text mb-2"><?= $user['message'];?></p>
                        <small class="text-muted"><?php
                         $d=strtotime($user['date']);
                         echo date("d/m/Y h:i:sa", $d);
                        //echo $user['date'];
                         ?></small>
                    </div>
                </div>
                <?php endforeach;?>
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
    else {
        header("Refresh: 0; url=/index.php");
    }
    unset($_SESSION['comment_success']);
    unset($_SESSION['comment_error']);
    unset($_SESSION['comment']);
?>