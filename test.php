<?php
    session_start();
    echo "<pre><br>";
    var_dump($_COOKIE);
    echo "</pre>";

    echo "<pre><br>";
    var_dump($_SESSION);
    echo "</pre>";

    var_dump(session_id());
    
    
    var_dump(session_save_path());

?>
<?php

// session_start();
// $timeout = 5; // Number of seconds until it times out.
 
// // Check if the timeout field exists.
// if(isset($_SESSION['timeout'])) {
//     // See if the number of seconds since the last
//     // visit is larger than the timeout period.
//     $duration = time() - (int)$_SESSION['timeout'];
//     if($duration > $timeout) {
//         // Destroy the session and restart it.
//     session_unset();
//         echo "time is up";
//     }
//     else {
//         echo "it is too early";
//     }
// }
// else {
//     echo "timeout is set ";
//     $_SESSION['timeout'] = time();
// }
?>