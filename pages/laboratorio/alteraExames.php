<?php
//Funções
include("../../php/funcoes.php");

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

$medicos = simplexml_load_file("../../xml/medicos.xml") or die("ERRO: Não foi possível abrir o XML");
$labs = simplexml_load_file("../../xml/labs.xml") or die("ERRO: Não foi possível abrir o XML");
$pacientes = simplexml_load_file("../../xml/pacientes.xml") or die("ERRO: Não foi possível abrir o XML");

///////////////////////////////////////////////

$data = $medico = $paciente = $diagnostico = $receita = "";
$exames = $infos = $email = $lab ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario

  
  $data = verifica($_POST["data"]);
  $medico = verifica($_POST["medico"]);
  $paciente = verifica($_POST["paciente"]);
  $email = verifica($_POST["email"]);
  $exames = verifica($_POST["exame"]);
  $infos = verifica($_POST["message"]);

  //Carregando xml
  $xml = simplexml_load_file("../../xml/exames.xml") or die("ERRO: Não foi possível abrir o XML");

  foreach($xml as $consulta){
    if (strval($consulta->id) == strval($_COOKIE['id'])){
      $consulta->data = $data;
      $consulta->medico = $medico;
      $consulta->paciente = $paciente;
      $consulta->email = $email;
      $consulta->exame = $exames;
      $consulta->infos = $infos;
    }
  }

  //Salvando no xml
  $dom = dom_import_simplexml($xml)->ownerDocument;
  $dom->formatOutput = true;
  $dom->preserveWhiteSpace = false;
  $dom->loadXML($dom->saveXML());
  $dom->save("../../xml/exames.xml");

  alerta("Exame alterado");
  redireciona("userLab.php");

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
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return checkForm();">
          <div>
            <label for="data"></label>
            <input type="date" placeholder="Data" name="data" id="data" value="<?php echo $_COOKIE['data'] ?>" required>
          </div>
          <div>
            <label for="medico"></label>
            <select placeholder="Médico" name="medico" id="medico" value="<?php echo $_COOKIE['medico'] ?>" required>
              <option disabled hidden selected>Médico</option>
              <option selected><?php echo strval($_COOKIE['medico']) ?></option>
              <?php foreach($medicos as $medico){
                if(strval($_COOKIE['medico']) != strval($medico->nome))
                echo "<option>".$medico->nome."</option>";} ?>
            </select>
          </div>
          <div>
            <label for="lab"></label>
            <select placeholder="Paciente" name="paciente" id="paciente" required>
              <option disabled hidden selected>Pacientes</option>
              <option selected><?php echo strval($_COOKIE['paciente']) ?></option>
              <?php foreach($pacientes as $paciente){
                if(strval($_COOKIE['paciente']) != strval($paciente->nome))
                echo "<option>".$paciente->nome."</option>";} ?>
            </select>
          </div>
          <div>
            <label for="email"></label>
            <h6 id="demo"></h6>
            <input type="text" placeholder="E-mail" name="email" id="email" value="<?php echo $_COOKIE['email'] ?>" required>
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

      <script>
        function checkForm(){
          //e.preventDefault();
          var paciente = document.getElementById("paciente").value
          var email = document.getElementById("email").value
          var tudoOk = true;       

          document.getElementById("demo").innerHTML = "";
          

          if(email.indexOf('@')==-1 || email.indexOf('.')==-1){
            document.getElementById("demo").innerHTML = "Formato de e-mail inválido!";
            tudoOk=false;
            
          }

          if(tudoOk){
            return true;
          }else{
            document.getElementById("demo7").innerHTML = "Campos preenchidos incorretamente!";
            return false;
          }
                
        } 
    </script>

</body>
</html>


