<?php
//Funções
//include("../../php/funcoes.php");
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
$medico = pegaNome($logado);
$medicos = pegandoNomes('medicos');
$pacientes = pegandoNomes('pacientes');

///////////////////////////////////////////////

$data = $medico = $paciente = $diagnostico = $receita = "";
$exames = $infos = $email = $lab ="";
$idPaciente = $idMedico = $idLab = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario
  $data = verifica($_POST["data"]);
  $medico = verifica($_POST["medico"]);
  $paciente = verifica($_POST["paciente"]);
  $lab = verifica($_POST["laboratorio"]);
  $exames = verifica($_POST["exame"]);
  $infos = verifica($_POST["message"]);

  //Fazendo conexão com o banco
  $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
  $user = "root";
  $pass = "Oitona66.";
  $db = "CLINICA_PW";

  try {
      $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
      $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT COUNT(*) FROM exames;
      ";
      $resposta = $conn->query($sql);
      $indice = $resposta->fetchAll(PDO::FETCH_ASSOC);
      $indice = $indice[0]['COUNT(*)']+4001;
      //print_r($indice);

      $idPaciente = pegaID('pacientes',$paciente);
      $idMedico = pegaID('medicos', $medico);
      $idLab = pegaID('laboratorios', pegaNome($logado));
      
      $sql = "INSERT INTO exames(
          id, data, id_paciente,
          id_medico, id_laboratorio, 
          exame, infos
      ) VALUES (:i, :d, :fkp, :fkm, :fkl, :ex, :ifu);
      ";
      $resposta = $conn->prepare($sql);
      $resposta->bindParam(':i',$indice);
      $resposta->bindParam(':d',$data);
      $resposta->bindParam(':fkp',$idPaciente);
      $resposta->bindParam(':fkm',$idMedico);
      $resposta->bindParam(':fkl',$idLab);
      $resposta->bindParam(':ex',$exames);
      $resposta->bindParam(':ifu',$infos);
      $resposta->execute();

      alerta("Cadastro efetuado");
      redireciona("userLab.php");

  }catch (PDOEXception $e){
      echo "Erro: " . "<br>" . $e->getMessage();
  }

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
              <?php foreach($medicos as $medico){echo "<option>".$medico['nome']."</option>";} ?>
            </select>
          </div>
          <div>
            <label for="lab"></label>
            <select placeholder="Paciente" name="paciente" id="paciente" required>
              <option disabled hidden selected>Pacientes</option>
              <?php foreach($pacientes as $paciente){echo "<option>".$paciente['nome']."</option>";} ?>
            </select>
          </div>
          <!--<div>
            <label for="email"></label>
            <h6 id="demo"></h6>
            <input type="text" placeholder="E-mail" name="email" id="email" required>
          </div>-->
          <div>
            <label for="exame"></label>
            <input type="text" placeholder="Exame" name="exame" id="exame" required>
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


