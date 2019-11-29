<?php

    $hide = $_POST['hide'];
    $show = $_POST['show'];
    $delete = $_POST['delete'];
    $comment_id = $_POST['comment_id'];
    
    if(isset($hide)){
        $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
        $sql = "UPDATE comments SET active = 0 WHERE comment_id=:comment_id";
        $statement = $pdo -> prepare($sql);
        $statement -> bindParam(":comment_id", $comment_id);
        $statement -> execute();
    }
    if(isset($show)){
        $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
        $sql = "UPDATE comments SET active = 1 WHERE comment_id=:comment_id";
        $statement = $pdo -> prepare($sql);
        $statement -> bindParam(":comment_id", $comment_id);
        $statement -> execute();
    }
    if(isset($delete)){
        $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
        $sql = "DELETE FROM comments WHERE comment_id=:comment_id";
        $statement = $pdo -> prepare($sql);
        $statement -> bindParam(":comment_id", $comment_id);
        $statement -> execute();
    }

    $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
    $sql = "SELECT comments.comment_id, users.name, users.image, comments.message, comments.date, comments.active  FROM comments INNER JOIN users ON comments.user_id = users.id ORDER BY date DESC";
    $statement = $pdo -> prepare($sql);
    $statement -> execute();
    $comments = $statement -> fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <script></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">
        <div class="card mb-3 mt-3">
            <div class="card-header bg-dark text-light">Admin Panel</div>
            <div class="card-body px-0" style="overflow-x: auto; width:100%;">
                <h5 class="card-title mx-2">All comments</h5>
                <table class="table table-hover table-striped table-sm">
                    <thead ">
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment):?>
                        <tr>
                            <td>
                                <?= $comment['comment_id'];?>
                            </td>
                            <td>
                                <img class="align-self-start mr-3" src="images/<?= $comment['image'];?>" alt=""
                                    style="width:64px; height:64px; border-radius:50px; object-fit:cover;">
                            </td>
                            <td>
                                <?= $comment['name'];?>
                            </td>
                            <td>
                                <?= $comment['message'];?>
                            </td>
                            <td>
                                <?php
                                    $d=strtotime($comment['date']);
                                    echo date("d/m/Y H:i:s", $d);
                                ?>
                            </td>
                            <td>
                                <form action="/admin.php" method="POST">
                                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id'];?>">
                                    <?php
                                        if($comment['active'] != 1){
                                            echo '<button type="submit" class="btn btn-success btn-sm" name="show" value="show">Show</button>';
                                        }
                                        else {
                                            echo '<button type="submit" class="btn btn-warning btn-sm" name="hide" value="hide">Hide</button>';
                                        }
                                    ?>
                                    <button type="submit" class="btn btn-danger btn-sm" name="delete" value="delete" onclick="return confirm('Are you sure ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
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