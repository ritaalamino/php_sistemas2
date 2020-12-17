<?php
$texto="mudaaaa";
?>

<!DOCTYPE html>

<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}

if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'lab')){
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
            <li><a data-item='UserLab'>UserLab</a></li>
            <li><a href='../../index.php' data-item='Log Out'>Log Out</a></li>
            <li><a href='#' data-item='<?php echo $logado;?>'><?php echo $logado;?></a></li>
        </ul>
    </nav>
    <br><br>

    <div>Sua saúde em primeiro lugar.</div>
    <p data-item='Clínica RW'>Clínica RW</p>

    <section>
    <div>Escolha sua opção:</div>
    <nav>
        <ul class="menuItems">
        <li><a href='laboratorio.php' data-item='Atualizar Cadastro'>Atualizar Cadastro</a></li>
        <li><a href='exames.php' data-item='Cadastra Exames'>Cadastra Exames</a></li>
        <li><a href='consultaExame.php' data-item='Histórico Exames'>Histórico Exames</a></li>
        </ul>
    </nav>

    </section>

    <script>
        var variavel = "<?php echo $texto; ?>";
        function testando(){
            document.getElementById("demo").innerHTML = "<?php echo $texto; ?>";
        }
    </script>
</body>
</html>