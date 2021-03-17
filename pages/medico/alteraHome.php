<!DOCTYPE html>
<?php
  include("../../php/funcoes.php");

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

  $fileConsulta = simplexml_load_file("../../xml/consultas.xml");

  $data="";
  $medico = pegaNome($logado);

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $nomePaciente = $_POST["paciente"];

    foreach($fileConsulta as $Consulta){
      if(strval($Consulta->paciente) == strval($nomePaciente)){
        setcookie("id",strval($Consulta->id),time()+60,"/");
        setcookie("data",strval($Consulta->data),time()+60,"/");
        setcookie("medico",strval($Consulta->medico),time()+60,"/");
        setcookie("paciente",strval($Consulta->paciente),time()+60,"/");
        setcookie("diagnostico",strval($Consulta->diagnostico),time()+60,"/");
        setcookie("receita",strval($Consulta->receita),time()+60,"/");
      }
    }
    
    redireciona("alteraConsultas.php");
  }

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
              <?php foreach($fileConsulta as $Consulta){
                if(strval($medico) == strval($Consulta->medico)){
                  echo "<option>".$Consulta->paciente."</option>";
                }
              }?>
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


