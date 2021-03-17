<?php

    $hostname = "localhost";
    $username = "root";
    $password = "Moimeme2020";
    $dbname = "projetweb2021";

    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    
    if (!$conn)
    {
        die("Impossible de se connecter: " . $e->getMessage());
    }else {
        return $conn;
    }
?>
