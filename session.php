<?php
    session_start();

    $_SESSION['name'] = 'Sherzod';
    $_SESSION['date'] = date("H:i:s");

    var_dump($_SESSION);
    
?>