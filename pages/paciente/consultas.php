<!DOCTYPE html>
<?php
    ini_set( 'error_reporting', E_ALL );
    ini_set( 'display_errors', true );
    if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
        session_start();
    }
    if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'paciente')){
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

    <title>Consultas</title>

</head>
<body>

    <div id="container">
        <h1>&bull; Consultas &bull;</h1>
        <div class="underline">
        </div>  
        <?php
            //Funções
            include("../../php/cadastraDB.php");

           
            $paciente = $data = $diagnostico = $receita = "";
            
            $medico = pegaNome($logado);
            $idMed = pegaID('medicos', $medico);

            $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
            $user = "root";
            $pass = "Oitona66.";
            $db = "CLINICA_PW";

            //$fileConsulta = simplexml_load_file("../../xml/consultas.xml");
            //$Nomepaciente = pegaNome($logado);

            try {
                $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
                $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = "SELECT * FROM consultas";
                $resposta = $conn->prepare($sql);
                //o que esse bind param faz?
                //$resposta->bindParam(':i',$idMed);
                $resposta->execute();
                $conteudo = $resposta->fetchAll(PDO::FETCH_ASSOC);
                //print_r($conteudo);
  
                foreach ($conteudo as $consulta){
                  $data= $consulta['data'];
                  $medico= pegaNomeID($consulta['id_medico']);
                  $paciente= pegaNomeID($consulta['id_paciente']);
                  $lab = pegaNomeID($consulta['id_laboratorio']);
                  //$email = $consulta['email'];
                  $consultas = $consulta['exame'];
                  $infos = $consulta['infos'];
                  echo '<div id="container">';
                  echo 'Data: ' .$data .'<br>';
                  echo 'Paciente: ' .$paciente .'<br>';
                  echo 'Médico: ' .$medico .'<br>';
                  echo 'Laboratório: ' .$lab .'<br>';
                  //echo 'Email: ' .$email .'<br>';
                  echo 'Exames: ' .$consultas .'<br>';
                  echo 'Infos: ' .$infos .'<br>';
                  echo '</div>';
                }
                
            }catch (PDOEXception $e){
                echo "Erro: " . "<br>" . $e->getMessage();
            }
        
            $conn = null;
        ?>
        
        <div class="submit">
            <button type="button" id="form_button"><a href="userPac.php">Voltar</a></button>
        </div>
    </div>
</body>
</html>