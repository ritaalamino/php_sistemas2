<?php

$servername = "clinicarw-1.cdvmnfrkbalc.us-east-2.rds.amazonaws.com";
$port = 3306;
$username = "admin";
$password = "D15Vd6y5RyktJ2a5f6Ci";
$db = 'clinica';
//$dbname = "phpmyadmin";

try {
    $conn = new PDO("mysql:host=$servername:3306;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully."; 

    
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>