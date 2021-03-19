<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    try {
        $dbhost = 'clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com';
        $dbport = 3306;
        $charset = 'utf8' ;

        $dsn = "mysql:host={$dbhost};port={$dbport};charset={$charset}";
        $username = 'root';
        $password = 'Oitona66.';

        $pdo = new PDO($dsn, $username, $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully."; 
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    ?>
</body>
</html>