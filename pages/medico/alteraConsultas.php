<?php


  function alerta($texto){
    echo "<script>alert('${texto}');</script>";
  }

  function redireciona($url){
    echo "<script> window.location.href = '{$url}'; </script>";
  }

  function verifica($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function alterarCadastro($consultaID,$parametro,$valor){
    $file = "../../xml/consultas.xml";
    $xml = simplexml_load_file($file) or die("XML não acessado.");

    for($i = 0; $i < $xml->count(); $i++){
      if ($xml->consulta[$i]->id == $consultaID){
        $xml->consulta[$i]->$parametro = $valor;
      }
    }
  
    //Salvando no xml
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/consultas.xml");
  }

  session_start();

  /////////////////////////////////////////////

  $data = $id = $laboratorio = $paciente = $diagnostico = $exames = $resultados = "";

  ///////////////////////////////////////////
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = verifica($_POST["data"]);
    $laboratorio = verifica($_POST["laboratorio"]);
    $paciente = verifica($_POST["paciente"]);
    $diagnostico = verifica($_POST["diagnostico"]);
    $exames = verifica($_POST["exames"]);
    $resultados = verifica($_POST["resultados"]);

    $xml = simplexml_load_file("../../xml/consultas.xml") or die("ERRO: Não foi possível abrir o XML");

    alterarCadastro($_COOKIE['id'],'data',$data);
    alterarCadastro($_COOKIE['id'],'lab',$laboratorio);
    alterarCadastro($_COOKIE['id'],'paciente',$paciente);
    alterarCadastro($_COOKIE['id'],'diagnostico',$diagnostico);
    alterarCadastro($_COOKIE['id'],'exames',$exames);
    alterarCadastro($_COOKIE['id'],'resultados',$resultados);

    alerta("Consulta alterada.");
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

    <title>Seguros</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Exames &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
          <div class="id">
            <label for="id"></label>
            <input type="text" placeholder="ID" name="id" id="id" value="<?php echo $_COOKIE['id'] ?>" required>
          </div>
          <div class="data">
            <label for="data"></label>
            <input type="text" placeholder="Data" name="data" id="data" value="<?php echo $_COOKIE['data'] ?>" required>
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
            <input type="text" placeholder="Paciente" name="paciente" id="paciente"  value="<?php echo $_COOKIE['paciente'] ?>" required>
          </div>
          <div class="diagnostico">
            <label for="diagnostico"></label>
            <input type="text" placeholder="Diagnóstico" name="diagnostico" id="diagnostico" value="<?php echo $_COOKIE['diagnostico'] ?>"  required>
          </div>
          <div class="exames">
            <label for="exames"></label>
            <input type="text" placeholder="Exames" name="exames" id="exames" value="<?php echo $_COOKIE['exames'] ?>"  required>
          </div>
          <div class="resultados">
            <label for="resultados"></label>
            <input type="text" placeholder="Resultados" name="resultados" id="resultados" value="<?php echo $_COOKIE['resultados'] ?>" required>
          </div>
          <div class="submit">
            <input type="submit" value="Enviar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>

