<?php
    // echo "<pre>";
    // var_dump($_COOKIE);
    // echo "</pre>";

    setcookie("username", "", time() - 3600);
    setcookie("email", "", time() - 3600);

    session_unset();

    header("Refresh: 3; url=/index.php");
?>
Loading...