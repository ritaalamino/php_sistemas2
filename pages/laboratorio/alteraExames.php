<?php
//Funções
include("../../php/cadastraDB.php");

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

$medicos = pegandoNomes('medicos');
$pacientes = pegandoNomes('pacientes');

///////////////////////////////////////////////

$data = $medico = $paciente = $diagnostico = $receita = "";
$exames = $infos = $email = $lab ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario

  
  $data = verifica($_POST["data"]);
  $medico = verifica($_POST["medico"]);
  $paciente = verifica($_POST["paciente"]);
  //$email = verifica($_POST["email"]);
  $exames = verifica($_POST["exame"]);
  $infos = verifica($_POST["message"]);

  $indice = strval($_COOKIE['id']);
  $idLab = pegaID('laboratorios', strval($_COOKIE['lab']));
  $idMedico = pegaID('medicos', $medico);
  $idPaciente = pegaID('pacientes', $paciente);

  $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
  $user = "root";
  $pass = "Oitona66.";
  $db = "CLINICA_PW";

  try {
      $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
      $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE exames SET data = :dt WHERE id = :id;
              UPDATE exames SET id_paciente = :idp WHERE id = :id;
              UPDATE exames SET id_medico = :idm WHERE id = :id;
              UPDATE exames SET id_laboratorio = :idl WHERE id = :id;
              UPDATE exames SET exame = :ex WHERE id = :id;
              UPDATE exames SET infos = :ifu WHERE id = :id;
      ";
      $resposta = $conn->prepare($sql);
      $resposta->bindParam(':id',$indice);
      $resposta->bindParam(':dt',$data);
      $resposta->bindParam(':idp',$idPaciente);
      $resposta->bindParam(':idm',$idMedico);
      $resposta->bindParam(':idl',$idLab);
      $resposta->bindParam(':ex',$exames);
      $resposta->bindParam(':ifu',$infos);
      $resposta->execute();

      alerta("Exame alterado");
      redireciona("userLab.php");
      
      
  }catch (PDOEXception $e){
      echo "Erro: " . "<br>" . $e->getMessage();
  }

  $conn = null;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="../../css/formulario.css" rel="stylesheet" media="all">

    <title>Altera Exame</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Exames &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" >
          <div>
            <label for="data"></label>
            <input type="date" placeholder="Data" name="data" id="data" value="<?php echo $_COOKIE['data'] ?>" required>
          </div>
          <div>
            <label for="medico"></label>
            <select placeholder="Médico" name="medico" id="medico" value="<?php echo $_COOKIE['medico'] ?>" required>
              <option disabled hidden selected>Médico</option>
              <option selected><?php echo strval($_COOKIE['medico']) ?></option>
              <?php foreach($medicos as $medico){echo "<option>".$medico['nome']."</option>";} ?>
            </select>
          </div>
          <div>
            <label for="lab"></label>
            <select placeholder="Paciente" name="paciente" id="paciente" required>
              <option disabled hidden selected>Pacientes</option>
              <option selected><?php echo strval($_COOKIE['paciente']) ?></option>
              <?php foreach($pacientes as $paciente){echo "<option>".$paciente['nome']."</option>";} ?>
            </select>
          </div>
          
          <div>
            <label for="exame"></label>
            <input type="text" placeholder="Exame" name="exame" id="exame" value="<?php echo $_COOKIE['exame'] ?>" required>
          </div>
          <div>
            <label for="message"></label>
            <textarea name="message" placeholder="Informações adicionais" id="message" cols="30" rows="3" required><?php echo $_COOKIE['infos'] ?></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Enviar" id="form_button" />
            <h6 id="demo7"></h6>
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->

</body>
</html>


