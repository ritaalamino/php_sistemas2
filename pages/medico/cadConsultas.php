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

  $Pacientes = simplexml_load_file("../../xml/pacientes.xml") or die("ERRO: Não foi possível abrir o XML");

  include("../../php/funcoes.php");
  $data = $medico = $paciente = $diagnostico = $receita = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $medico = pegaNome($logado);
    $data = verifica($_POST["data"]);
    $paciente = verifica($_POST["paciente"]);
    $diagnostico = verifica($_POST["diagnostico"]);
    $receita = verifica($_POST["receita"]);

    $xml = simplexml_load_file("../../xml/consultas.xml") or die("ERRO: Não foi possível abrir o XML");

    $id = count($xml) +5001;

    $node = $xml->addChild('consulta');
    $node->addChild('id',$id);
    $node->addChild('data',$data);
    $node->addChild('paciente',$paciente);
    $node->addChild('medico',$medico);
    $node->addChild('diagnostico',$diagnostico);
    $node->addChild('receita',$receita);

    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/consultas.xml");

    alerta("Consulta cadastrada");
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

    <title>Nova Consulta</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Nova Consulta &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
          <div>
            <label for="data"></label>
            <input type="date" placeholder="Data" name="data" id="data" required>
          </div>
          <div>
            <label></label>
            <select placeholder="Paciente" name="paciente" id="paciente" required>
              <option disabled hidden selected>Pacientes</option>
              <?php foreach($Pacientes as $Paciente){echo "<option>".$Paciente->nome."</option>";} ?>
            </select>
          </div>
          <div>
            <label for="diagnostico"></label>
            <input type="text" placeholder="Diagnóstico" name="diagnostico" id="diagnostico" required>
          </div>
          <div>
            <label for="receita"></label>
            <input type="text" placeholder="Receita" name="receita" id="receita" required>
          </div>
          <div class="submit">
            <input type="submit" value="Enviar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>


