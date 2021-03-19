<!DOCTYPE html>
<?php
  include("../../php/cadastraDB.php");

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

  $conteudo = "";

  $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
  $user = "root";
  $pass = "Oitona66.";
  $db = "CLINICA_PW";

  try {
    $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
    $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $idMed = pegaID('medicos', pegaNome($logado));

    $sql = "SELECT id_paciente FROM consultas WHERE id_medico=:i";
    $resposta = $conn->prepare($sql);
    $resposta->bindParam(':i',$idMed);
    $resposta->execute();
    $conteudo = $resposta->fetchAll(PDO::FETCH_ASSOC);
    //print_r($conteudo);
    
}catch (PDOEXception $e){
    echo "Erro: " . "<br>" . $e->getMessage();
}

$conn = null;

?>

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
            <input type="submit" value="Alterar Consulta" id="form_button" />
          </div>

          </form>

        </div>
        
    </div>
</body>
</html>


