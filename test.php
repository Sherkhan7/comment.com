<?php
    // session_start();
    // echo "<pre><br>";
    // var_dump($_COOKIE);
    // echo "</pre>";

    // echo "<pre><br>";
    // var_dump($_SESSION);
    // echo "</pre>";

    // var_dump(session_id());
    
    
    // var_dump(session_save_path());
    
    function connection(){
        $pdo = new PDO("mysql:host=localhost; dbname=comment", "root", "");
        return $pdo;
    }

        // if(!connection()){
        //     die("Connection failed!");
        // }
    
        
        // $name = "Sherzod";
        // $email = "966@gmail.com";
        
        // $sql = "INSERT INTO mydata (name, email) VALUES (:name, :email)";
        
        //         $statement = $pdo -> prepare($sql);
        //         $statement -> bindParam(':name', $name);
        //         $statement -> bindParam(':email', $email);
        
        //         $result = $statement -> execute();
        //         // $result = $statement -> execute();
        //         $last_user_id = $pdo -> lastInsertId();
        
    //     $username = "Sherzod";
    //     $email = "123@example.com";
    //     $password = "111111111111111111111";
        
    //     $sql = "INSERT INTO mydata (name, email) VALUES (:name, :email)";
        
    //     $statement = connection() -> prepare($sql);
    //     $statement -> bindParam(':name', $username);
    //     $statement -> bindParam(':email', $email);
        
    //     $statement -> execute();
    //     $last_user_id =  connection() -> lastInsertId();

    
    // var_dump($last_user_id);
            
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