
<!DOCTYPE html>

<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != "admin")){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
    }

$logado = $_SESSION['username'];
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
            <li><a data-item='Admin'>Admin</a></li>
            <li><a href='../../php/logout.php' data-item='Log Out'>Log Out</a></li>
            <li><a href='#' data-item='<?php echo $logado;?>'><?php echo $logado;?></a></li>
        </ul>
    </nav>
    <br><br>

    <div>Sua saúde em primeiro lugar.</div>
    <p data-item='Clínica RW'>Clínica RW</p>

    <section>
    <div>Opções de cadastro de novo usuário:</div>
    <nav>
        <ul class="menuItems">
        <li><a href='medico.php' data-item='Médico'>Médico</a></li>
        <li><a href='laboratorio.php' data-item='Laboratório'>Laboratório</a></li>
        <li><a href='paciente.php' data-item='Paciente'>Paciente</a></li>
        <!-- <li><a href='consultas.php' data-item='Consultas'>Consultas</a></li>
        <li><a href='exames.php' data-item='Exames'>Exames</a></li> -->
        </ul>
    </nav>

    </section>
</body>
</html>