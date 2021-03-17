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

  $xml = simplexml_load_file("../../xml/consultas.xml") or die("ERRO: Não foi possível abrir o XML");

  foreach($xml as $consulta){
    if (strval($consulta->id) == strval($_COOKIE['id'])){
      $consulta->data = $data;
      $consulta->medico = $medico;
      $consulta->paciente = $paciente;
      $consulta->diagnostico = $diagnostico;
      $consulta->receita = $receita;
    }
  }

  //Salvando no xml
  $dom = dom_import_simplexml($xml)->ownerDocument;
  $dom->formatOutput = true;
  $dom->preserveWhiteSpace = false;
  $dom->loadXML($dom->saveXML());
  $dom->save("../../xml/consultas.xml");

  alerta("Consulta alterada");
  redireciona("userMed.php");
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
            <label for="paciente"></label>
            <select placeholder="Paciente" name="paciente" id="paciente" value="<?php echo $_COOKIE['paciente'] ?>" required>
              <option disabled hidden selected>Paciente</option>
              <option selected><?php echo strval($_COOKIE['paciente']) ?></option>
              <?php foreach($Pacientes as $Paciente){
                if(strval($_COOKIE['paciente']) != strval($Paciente->nome))
                echo "<option>".$Paciente->nome."</option>";} ?>
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


