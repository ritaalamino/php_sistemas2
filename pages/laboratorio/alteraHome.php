<!DOCTYPE html>
<html lang="en">

<?php
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

  $fileExames = simplexml_load_file("../../xml/exames.xml");

  $data="";
  $laboratorio = pegaNome($logado);

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $nomePaciente = $_POST["paciente"];

    foreach($fileExames as $Exame){
      if(strval($Exame->paciente) == strval($nomePaciente)){
        setcookie("id",strval($Exame->id),time()+60,"/");
        setcookie("data",strval($Exame->data),time()+60,"/");
        setcookie("medico",strval($Exame->medico),time()+60,"/");
        setcookie("paciente",strval($Exame->paciente),time()+60,"/");
        setcookie("lab",strval($Exame->lab),time()+60,"/");
        setcookie("email",strval($Exame->email),time()+60,"/");
        setcookie("exame",strval($Exame->exame),time()+60,"/");
        setcookie("infos",strval($Exame->infos),time()+60,"/");
      }
    }
    
    redireciona("alteraExames.php");
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
              <?php foreach($fileExames as $Exame){
                if(strval($Exame->lab) == strval($laboratorio)){
                  echo "<option>".$Exame->paciente."</option>";
                }
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


