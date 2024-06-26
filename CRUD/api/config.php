<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $DBName = "test";

    $conn = mysqli_connect($host, $username, $password, $DBName);

    if($conn){
    }else{
        die("Connection Failed! ".mysqli_connect_error());
    }

?>