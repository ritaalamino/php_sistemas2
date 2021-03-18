<?php
  //Incluindo bibliotecas
  include("../../php/funcoes.php");

  ini_set( 'error_reporting', E_ALL );
  ini_set( 'display_errors', true );
  if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
      session_start();
  }
  if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'medico')){
    if($_SESSION['tipo'] != 'admin'){
        unset($_SESSION['username']);
        $_SESSION['valid'] = false;
        unset($_SESSION['tipo']);
        header('location:../../index.php');
        }
      }
  $logado = $_SESSION['username'];

$data = $medico = $paciente = $diagnostico = $receita = "";
$Pacientes = simplexml_load_file("../../xml/pacientes.xml") or die("ERRO: Não foi possível abrir o XML");

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario
  $data = verifica($_POST["data"]);
  $paciente = verifica($_POST["paciente"]);
  $medico = pegaNome($logado);
  $diagnostico = verifica($_POST["diagnostico"]);
  $receita = verifica($_POST["receita"]);

  $indice = strval($_COOKIE['id']);

  $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
  $user = "root";
  $pass = "Oitona66.";
  $db = "CLINICA_PW";

  try {
    $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
    $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE consultas SET data = :dt WHERE id = :id;
            UPDATE consultas SET id_paciente = :idp WHERE id = :id;
            UPDATE consultas SET id_medico = :idm WHERE id = :id;
            UPDATE consultas SET diagnostico = :ex WHERE id = :id;
            UPDATE consultas SET infos = :ifu WHERE id = :id;
    ";
    $resposta = $conn->prepare($sql);
    $resposta->bindParam(':id',$indice);
    $resposta->bindParam(':dt',$data);
    $resposta->bindParam(':idp',$idPaciente);
    $resposta->bindParam(':idm',$idMedico);
    $resposta->bindParam(':ex',$diagnostico);
    $resposta->bindParam(':ifu',$infos);
    $resposta->execute();

    alerta("Consulta alterada");
    redireciona("userMed.php");
    
    
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

    <title>Altera Consulta</title>
</head>
<body>
<div id="container">
        <h1>&bull; Altera Consulta &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
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
            <label for="diagnostico"></label>
            <input type="text" placeholder="Diagnóstico" name="diagnostico" id="diagnostico" value="<?php echo $_COOKIE['diagnostico'] ?>" required>
          </div>
          <div>
            <label for="receita"></label>
            <input type="text" placeholder="Receita" name="receita" id="receita" value="<?php echo $_COOKIE['receita'] ?>" required>
          </div>
          <div class="submit">
            <input type="submit" value="Alterar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>


