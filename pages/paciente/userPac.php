<!DOCTYPE html>

<?php
    session_start();
?>

<html lang="pt-br">
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
            <li><a data-item='UserPac'>UserPac</a></li>
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
        <li><a href='paciente.php' data-item='Paciente'>Paciente</a></li>
        <li><a href='consultas.php' data-item='Consultas'>Consultas</a></li>
        <li><a href='exames.php' data-item='Exames'>Exames</a></li>
        </ul>
    </nav>

    </section>
</body>
</html>