<?php
    ini_set('display_errors', 1);

    $host = "db";
    $user = "root";
    $password = "3151936f";
    $db = "test_tb";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "PDO Error : Code " . $e->getCode() . " ,Expectation Msg : " . $e->getMessage() . "<br>";
        exit();
    }
?>