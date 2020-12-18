<!DOCTYPE html>
<html lang="en">

<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'medico')){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
    }

$logado = $_SESSION['username'];

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../../css/formulario.css" rel="stylesheet" media="all">

    <title>Saúde</title>

</head>
<body>

    <div id="container">
        <h1>&bull; Consultas &bull;</h1>
        <div class="underline">
        </div>  
        <?php
            $id = $paciente = $data = $lab = $medico = $diagnostico = $exames = $dados = "";

            $flag = false;
            $file = "../../xml/consultas.xml";
            $file2 = "../../xml/medicos.xml";
            $xml = simplexml_load_file($file);
            $xml2 = simplexml_load_file($file2);

            foreach ($xml->children() as $consulta) {
                foreach ($xml2->children() as $medico) {
                if(strval($medico->email) == strval($_SESSION['username'])){
                    if (strval($consulta->medico) == strval($medico->nome)){
                        $id = $consulta->id;
                        $paciente= $consulta->paciente;
                        $medico= $consulta->medico;
                        $data= $consulta->data;
                        $lab= $consulta->lab;
                        $diagnostico = $consulta->diagnostico;
                        $exames = $consulta->exames;
                        $resultados = $consulta->resultados;
                        echo '<div id="container">';
                        echo '<p>Paciente: ' .$paciente .'<br>';
                        echo 'Médico: ' .$medico .'<br>';
                        echo 'Data: ' .$data .'<br>';
                        echo 'Laboratório: ' .$lab .'<br>';
                        echo 'Diagnóstico: ' .$diagnostico .'<br>';
                        echo 'Exames: ' .$exames .'<br>';
                        echo 'Resultados: ' .$resultados .'<br>';
                        setcookie("id", $id , time()+60000, '/');
                        setcookie("tipo", 'consulta' , time()+60000, '/');
                        echo '<a href ="../../php/altera.php">Alterar</a>';
                        echo '</div>';
                        $flag = false;
                        break 2;
                    }
                }
                else{
                    $flag = true;
                  }
                }
            }
                if ($flag == true){
                  echo '<br><p>';
                  echo 'Não existem consultas para esse cadastro. </p>';
                }
          ?>
    </div>
</body>
</html>