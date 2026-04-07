<?php
    $username = "root";
    $password = "";
    $server = "127.0.0.1";
    $dbname = "quanlybanhang";

    $conn = mysqli_connect($server, $username, $password, $dbname);

    if(!$conn){
        die("Không kết nối: " . mysqli_connect_error());
    }
    echo"thanh cong!";
?>