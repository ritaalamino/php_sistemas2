<?php




function conectaDB(){
    $servername = "clinicarw-1.cdvmnfrkbalc.us-east-2.rds.amazonaws.com";
    $port = 3306;
    $username = "admin";
    $password = "D15Vd6y5RyktJ2a5f6Ci";
    $db = 'clinica';
    //$dbname = "phpmyadmin";

    try {
        $conn = mysqli_connect("mysql:host=$servername:$port", $username, $password);
        $data = mysqli_select_db($conn,$db);
        return $conn;
        //echo "Connected successfully.";     
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
        return $e->getMessage();
    }
}



?>