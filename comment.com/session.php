<?php
    session_set_cookie_params(3,"/");
    session_start();

    $_SESSION['name'] = 'Sherzod';
    $_SESSION['time'] = date("h:i:s");
?>