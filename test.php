<?php
    session_start();


    echo "<pre><br>";
    var_dump($_SESSION);
    echo "</pre>";
    
    var_dump(session_save_path());

?>