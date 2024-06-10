<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cafeDatabse";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    // $db_name = 'mysql:host=localhost;dbname=cafeDatabse';
    // $user_name = 'root';
    // $user_password = '';
    // $conn = new PDO($db_name, $user_name, $user_password) or die("Connection failed");

    // if($conn){
    //     echo "Succesful";
    // }else{
    //     die("Connection failed");
    // }
?>