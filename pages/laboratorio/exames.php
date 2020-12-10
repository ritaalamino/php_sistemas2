<?php
//Funções
function alerta($texto){
  echo "<script>alert('${texto}');</script>";
}

function redireciona($url){
  echo "<script> window.location.href = '{$url}'; </script>";
}

function teste($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

session_start();

///////////////////////////////////////////////

$data = $medico = $paciente = $diagnostico = $receita = "";
$exames = $infos = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario

  
  $data = teste($_POST["data_input"]);
  $medico = teste($_POST["medico_input"]);
  $paciente = teste($_POST["paciente_input"]);
  $email = teste($_POST["email_input"]);
  $diagnostico = teste($_POST["diagnostico_input"]);
  $receita = teste($_POST["receita_input"]);
  $exames = teste($_POST["exames_input"]);
  $infos = teste($_POST["message_input"]);

  //Carregando xml
  $xml = simplexml_load_file("../../xml/exames.xml") or die("ERRO: Não foi possível abrir o XML");

  //Carregando exame
  $node = $xml->addChild('exame');

  $node->addChild('data', $data);
  $node->addChild('medico',$medico);
  $node->addChild('paciente',$paciente);
  $node->addChild('email',$email);
  $node->addChild('diagnostico',$diagnostico);
  $node->addChild('receita',$receita);
  $node->addChild('exames',$exames);
  $node->addChild('infos',$infos);

  //Salvando no xml
  $dom = dom_import_simplexml($xml)->ownerDocument;
  $dom->formatOutput = true;
  $dom->preserveWhiteSpace = false;
  $dom->loadXML($dom->saveXML());
  $dom->save("../../xml/exames.xml");

  //Salvando dados no user.xml para login
  $xml = simplexml_load_file("../../xml/exames.xml") or die("ERRO: Não foi possível abrir o XML");

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
        <form action="#" method="post" id="contact_form">
          <div class="data">
            <label for="data"></label>
            <input type="text" placeholder="Data" name="data" id="data_input" required>
          </div>
          <div class="subject">
            <label for="medico"></label>
            <select placeholder="Médico" name="medico" id="medico_input" required>
              <option disabled hidden selected>Médico</option>
              <option>Médico 1</option>
              <option>Médico 2</option>
            </select>
          </div>
          <div class="paciente">
            <label for="paciente"></label>
            <input type="text" placeholder="Paciente" name="paciente" id="paciente_input" required>
          </div>
          <div class="name">
            <label for="email"></label>
            <input type="text" placeholder="E-mail" name="email" id="email_input" required>
          </div>
          <div class="diagnostico">
            <label for="diagnostico"></label>
            <input type="text" placeholder="Diagnóstico" name="diagnostico" id="diagnostico_input" required>
          </div>
          <div class="receita">
            <label for="receita"></label>
            <input type="text" placeholder="Receita" name="receita" id="receita_input" required>
          </div>
          <div class="exames">
            <label for="exames"></label>
            <input type="text" placeholder="exames" name="exames" id="exames_input" required>
          </div>
          <div class="message">
            <label for="message"></label>
            <textarea name="message" placeholder="Informações adicionais" id="message_input" cols="30" rows="3" required></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Enviar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>


