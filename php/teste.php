<?php

$servername = "clinicarw-1.cdvmnfrkbalc.us-east-2.rds.amazonaws.com";
$port = 3306;
$username = "admin";
$password = "D15Vd6y5RyktJ2a5f6Ci";
$db = 'clinica';
//$dbname = "phpmyadmin";

try {
    $conn = new PDO("mysql:host=$servername:$port;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query_select = "SELECT login, password FROM users WHERE login = 'teste' AND password = '123456'";
    $result = $conn->query($query_select);
    $rows = $result->fetchAll();
    print $rows;
    //echo $result->num_rows;
    //$data = mysqli_select_db($conn,$db);
    //return $conn;
    echo "Connected successfully.";     
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
    return $e->getMessage();
}



//$data = mysqli_fetch_array($sql);

// $logarray = $data['login'];
// echo $logarray;
// $passarray = $data['password'];

?>

