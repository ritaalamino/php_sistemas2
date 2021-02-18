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


  include("../../php/funcoes.php");


  //session_start();

  /////////////////////////////////////////////

  $nome = $laboratorio = $paciente = $medico = $diagnostico = $exames = $resultados = "";

  ///////////////////////////////////////////
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $data = verifica($_POST["data"]);
    $laboratorio = verifica($_POST["laboratorio"]);
    $medico = verifica($_POST["medico"]);
    $paciente = verifica($_POST["paciente"]);
    $diagnostico = verifica($_POST["diagnostico"]);
    $exames = verifica($_POST["exames"]);
    $resultados = verifica($_POST["resultados"]);

    $xml = simplexml_load_file("../../xml/consultas.xml") or die("ERRO: Não foi possível abrir o XML");
    $id = count($xml) +1;

    $node = $xml->addChild('consulta');
    $node->addChild('id',$id);
    $node->addChild('paciente',$paciente);
    $node->addChild('medico',$medico);
    $node->addChild('data',$data);
    $node->addChild('lab',$laboratorio);
    $node->addChild('diagnostico',$diagnostico);
    $node->addChild('exames',$exames);
    $node->addChild('resultados',$resultados);

    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/consultas.xml");

    alerta("Consulta cadastrada.");
    redireciona("Consultas.php");
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

    <title>Saúde</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Exames &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
          <div class="data">
            <label for="data"></label>
            <input type="text" placeholder="Data" name="data" id="data" required>
          </div>
          <div class="subject">
            <label for="laboratorio"></label>
            <select placeholder="Laboratório" name="laboratorio" id="laboratorio" required>
              <option disabled hidden selected>Laboratório</option>
              <option>Laboratório 1</option>
              <option>Laboratório 2</option>
            </select>
          </div>
          <div class="paciente">
            <label for="paciente"></label>
            <input type="text" placeholder="Paciente" name="paciente" id="paciente" required>
          </div>
          <div class="medico">
            <label for="medico"></label>
            <input type="text" placeholder="Médico" name="medico" id="medico" required>
          </div>
          <div class="diagnostico">
            <label for="diagnostico"></label>
            <input type="text" placeholder="Diagnóstico" name="diagnostico" id="diagnostico" required>
          </div>
          <div class="exames">
            <label for="exames"></label>
            <input type="text" placeholder="Exames" name="exames" id="exames" required>
          </div>
          <div class="resultados">
            <label for="resultados"></label>
            <input type="text" placeholder="Resultados" name="resultados" id="resultados" required>
          </div>
          <div class="submit">
            <input type="submit" value="Enviar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>


