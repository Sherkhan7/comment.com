<?php
    session_start();
    setcookie("USERNAME", "", time() - 3600);
    setcookie("EMAIL", "", time() - 3600);
    session_destroy();

    header("Refresh: 2; url=/index.php");
?>
Loading...