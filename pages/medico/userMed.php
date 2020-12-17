<!DOCTYPE html>
<html lang="pt-br">

<?php

session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Rita & Wanderson">

    <link href="../../css/sub_index.css" rel="stylesheet" media="all">

    <title>Clínica PW</title>
</head>
<body>
    <nav style="margin: 15px;">
        <ul class="menuItems">
            <li><a data-item='UserMed'>UserMed</a></li>
            <li><a href='../../php/logout.php' data-item='Log Out'>Log Out</a></li>
        </ul>
    </nav>
    <br><br><br><br><br><br><br><br>

    <div>Sua saúde em primeiro lugar.</div>
    <p data-item='Clínica RW'>Clínica RW</p>

    <section>
    <div>Escolha sua opção:</div>
    <nav>
        <ul class="menuItems">
        <li><a href='medico.php' data-item='Médico'>Médico</a></li>
        <li><a href='Consultas.php' data-item='Consultas'>Consultas</a></li>
        </ul>
    </nav>

    </section>
</body>
</html>