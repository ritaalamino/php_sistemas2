<!DOCTYPE html>
<?php
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
  $conteudo = "";

  $server = "localhost";
  $user = "root";
  $pass = "";
  $db = "CLINICA_PW";

  try {
      $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
      $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $idLab = pegaID('laboratorios', pegaNome($logado));

      $sql = "SELECT id_paciente FROM exames WHERE id_laboratorio=:i";
      $resposta = $conn->prepare($sql);
      $resposta->bindParam(':i',$idLab);
      $resposta->execute();
      $conteudo = $resposta->fetchAll(PDO::FETCH_ASSOC);
      //print_r($conteudo);
      
  }catch (PDOEXception $e){
      echo "Erro: " . "<br>" . $e->getMessage();
  }

  $conn = null;

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $nomePaciente = $_POST["paciente"];

    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "CLINICA_PW";

    try {
      $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
      $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $idPac = pegaID('pacientes', $nomePaciente);

      $sql = "SELECT * FROM exames WHERE id_paciente=:i";
      $resposta = $conn->prepare($sql);
      $resposta->bindParam(':i',$idPac);
      $resposta->execute();
      $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
      //print_r($conteudo);

      setcookie("id",strval($conteudo['id']),time()+60,"/");
      setcookie("data",strval($conteudo['data']),time()+60,"/");
      setcookie("medico",strval(pegaNomeID($conteudo['id_medico'])),time()+60,"/");
      setcookie("paciente",strval(pegaNomeID($conteudo['id_paciente'])),time()+60,"/");
      setcookie("lab",strval(pegaNomeID($conteudo['id_laboratorio'])),time()+60,"/");
      //setcookie("email",strval($conteudo->email),time()+60,"/");
      setcookie("exame",strval($conteudo['exame']),time()+60,"/");
      setcookie("infos",strval($conteudo['infos']),time()+60,"/");

      redireciona("alteraExames.php");
      
    }catch (PDOEXception $e){
        echo "Erro: " . "<br>" . $e->getMessage();
    }

  }

?>

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
        
        <div id="container">

          <form class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" onsubmit="return true;">

          <div>
            <label for="paciente"></label>
            <select placeholder="Paciente" name="paciente" id="paciente" required>
              <option disabled hidden selected>Paciente</option>
              <?php foreach($conteudo as $nomeP){
                echo "<option>".pegaNomeID($nomeP['id_paciente'])."</option>";
              } ?>
            </select>
          </div>
          <div class="submit">
            <input type="submit" value="Alterar Exame" id="form_button" />
          </div>

          </form>

        </div>
        
    </div>
</body>
</html>


