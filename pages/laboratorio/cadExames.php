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
$logado = $_SESSION['username'];


$medicos = simplexml_load_file("../../xml/medicos.xml") or die("ERRO: Não foi possível abrir o XML");
$labs = simplexml_load_file("../../xml/labs.xml") or die("ERRO: Não foi possível abrir o XML");
$pacientes = simplexml_load_file("../../xml/pacientes.xml") or die("ERRO: Não foi possível abrir o XML");

///////////////////////////////////////////////

$data = $medico = $paciente = $diagnostico = $receita = "";
$exames = $infos = $email = $lab = $id = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario
  $id = verifica($_POST["id"]);  
  $data = verifica($_POST["data"]);
  $medico = verifica($_POST["medico"]);
  $lab = verifica($_POST["lab"]);
  $paciente = verifica($_POST["paciente"]);
  $email = verifica($_POST["email"]);
  $diagnostico = verifica($_POST["diagnostico"]);
  $receita = verifica($_POST["receita"]);
  $exames = verifica($_POST["exames"]);
  $infos = verifica($_POST["message"]);

  //Carregando xml
  $xml = simplexml_load_file("../../xml/exames.xml") or die("ERRO: Não foi possível abrir o XML");
  $id = count($xml)+1;

  //Carregando exame
  $node = $xml->addChild('exame');
  $node->addChild('id', $id);
  $node->addChild('data', $data);
  $node->addChild('medico',$medico);
  $node->addChild('paciente',$paciente);
  $node->addChild('lab',$lab);
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

  alerta("Cadastro efetuado.");
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

    <title>Saúde</title>
</head>
<body>
    <div id="container">
        <h1>&bull; Exames &bull;</h1>
        <div class="underline">
        </div>
        <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return checkForm();">
          <div>
            <label for="data"></label>
            <input type="date" placeholder="Data" name="data" id="data" required>
          </div>
          <div>
            <label for="medico"></label>
            <select placeholder="Médico" name="medico" id="medico" required>
              <option disabled hidden selected>Médico</option>
              <?php foreach($medicos as $medico){echo "<option>".$medico->nome."</option>";} ?>
            </select>
          </div>
          <div>
            <label for="lab"></label>
            <select placeholder="Laboratório" name="lab" id="lab" required>
              <option disabled hidden >Laboratório</option>
              <?php foreach($labs as $lab){
                if($lab->email = $_SESSION['username']){
                    echo "<option selected>".$lab->nome."</option>";
                  }
                } ?>
                
            </select>
          </div>
          <div>
            <label for="lab"></label>
            <select placeholder="Paciente" name="paciente" id="paciente" required>
              <option disabled hidden selected>Pacientes</option>
              <?php foreach($pacientes as $paciente){echo "<option>".$paciente->nome."</option>";} ?>
            </select>
          </div>
          <div>
            <label for="email"></label>
            <h6 id="demo"></h6>
            <input type="text" placeholder="E-mail" name="email" id="email" required>
          </div>
          <div>
            <label for="diagnostico"></label>
            <input type="text" placeholder="Diagnóstico" name="diagnostico" id="diagnostico" required>
          </div>
          <div>
            <label for="receita"></label>
            <input type="text" placeholder="Receita" name="receita" id="receita" required>
          </div>
          <div>
            <label for="exames"></label>
            <input type="text" placeholder="Exames" name="exames" id="exames" required>
          </div>
          <div>
            <label for="message"></label>
            <textarea name="message" placeholder="Informações adicionais" id="message" cols="30" rows="3" required></textarea>
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


