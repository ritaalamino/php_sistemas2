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
        <h1>&bull; Histórico Consulta &bull;</h1>
        <div class="underline">
        </div>  
        <?php
            //Funções
            include("../../php/funcoes.php");

           
            $paciente = $data = $diagnostico = $receita = "";
            $medico = pegaNome($logado);

            $fileConsulta = simplexml_load_file("../../xml/consultas.xml");
            //$Nomepaciente = pegaNome($logado);

            foreach ($fileConsulta->children() as $Consulta){
            if(strval($Consulta->medico) == strval($medico)){
                $data= $Consulta->data;
                $paciente= $Consulta->paciente;
                $diagnostico = $Consulta->diagnostico;
                $receita = $Consulta->receita;
                echo '<div id="container">';
                echo 'Data: ' .$data .'<br>';
                echo 'Paciente: ' .$paciente .'<br>';
                echo 'Diagnostico: ' .$diagnostico .'<br>';
                echo 'Receita: ' .$receita .'<br>';
                echo '</div>';
            }
            }
        ?>
        
        <div class="submit">
            <button type="button" id="form_button"><a href="userMed.php">Voltar</a></button>
        </div>
    
    </div> 

</body>
</html>