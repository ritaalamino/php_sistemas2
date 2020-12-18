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


///////////////////////////////////////////////

$data = $medico = $paciente = $diagnostico = $receita = "";
$exames = $infos = $email = $lab ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario

  
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

  //Carregando exame
  $node = $xml->addChild('exame');

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

  alerta("Cadastro efetuado");
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
              <option>Médico 1</option>
              <option>Médico 2</option>
            </select>
          </div>
          <div>
            <label for="lab"></label>
            <select placeholder="Laboratório" name="Lab" id="lab" required>
              <option disabled hidden selected>Laboratório</option>
              <option>Lab 1</option>
              <option>Lab 2</option>
            </select>
          </div>
          <div>
            <label for="paciente"></label>
            <h6 id="demo3"></h6>
            <input type="text" placeholder="Paciente" name="paciente" id="paciente" required>
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
          var paciente = document.getElementById("paciente").value
          var email = document.getElementById("email").value
          var tudoOk = true;          

          document.getElementById("demo").innerHTML = "";
          document.getElementById("demo2").innerHTML = "";
          document.getElementById("demo3").innerHTML = "";
          

          if(email.indexOf('@')==-1 || email.indexOf('.')==-1){
            document.getElementById("demo").innerHTML = "Formato de e-mail inválido!";
            document.getElementById("demo2").innerHTML = ".";
            tudoOk=false;
            
          }
          if(paciente.indexOf('0')!=-1 || 
            paciente.indexOf('1')!=-1 || 
            paciente.indexOf('2')!=-1 || 
            paciente.indexOf('3')!=-1 || 
            paciente.indexOf('4')!=-1 || 
            paciente.indexOf('5')!=-1 || 
            paciente.indexOf('6')!=-1 || 
            paciente.indexOf('7')!=-1 || 
            paciente.indexOf('8')!=-1 || 
            paciente.indexOf('9')!=-1){
            
              document.getElementById("demo3").innerHTML = "Nome não pode conter números!";
              tudoOk=false;
          }

          if(tudoOk){
            return true;
            window.alert("aqui não");
          }else{
            window.alert("aqui");
            document.getElementById("demo7").innerHTML = "Campos preenchidos incorretamente!";
            return false;
          }
                
        } 
    </script>

</body>
</html>


