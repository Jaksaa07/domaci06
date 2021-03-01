<?php
    $dbconn = mysqli_connect("localhost", "root", "", "domaci06");

    $dsn = "mysql:host=localhost;dbname=domaci06";
    $user = "root";
    $pass = "";

    $pdo = new PDO($dsn, $user, $pass);
?>