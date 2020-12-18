<?php

//Incluindo bibliotecas
include("../../php/funcoes.php");

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
    session_start();
}
if((!isset ($_SESSION['username']) == true) or ($_SESSION['tipo'] != 'lab')){
  if($_SESSION['tipo'] != 'admin'){
    unset($_SESSION['username']);
    $_SESSION['valid'] = false;
    unset($_SESSION['tipo']);
    header('location:../../index.php');
    }
  }

$logado = $_SESSION['username'];

$medicos = simplexml_load_file("../../xml/medicos.xml") or die("ERRO: Não foi possível abrir o XML");
$labs = simplexml_load_file("../../xml/labs.xml") or die("ERRO: Não foi possível abrir o XML");
$pacientes = simplexml_load_file("../../xml/pacientes.xml") or die("ERRO: Não foi possível abrir o XML");


///////////////////////////////////////////////

$data = $medico = $paciente = $diagnostico = $receita = "";
$exames = $infos = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //Pegando os dados fornecidos pelo formulario

  
  $data = verifica($_POST["data"]);
  $medico = verifica($_POST["medico"]);
  $paciente = verifica($_POST["paciente"]);
  $email = verifica($_POST["email"]);
  $diagnostico = verifica($_POST["diagnostico"]);
  $receita = verifica($_POST["receita"]);
  $exames = verifica($_POST["exames"]);
  $infos = verifica($_POST["message"]);

  //Carregando xml
  $xml = simplexml_load_file("../../xml/exames.xml") or die("ERRO: Não foi possível abrir o XML");

  //Carregando exame
  //$node = $xml->addChild('exame');

  alterarCadastro($_COOKIE['id'],'data', $data);
  alterarCadastro($_COOKIE['id'],'medico',$medico);
  alterarCadastro($_COOKIE['id'],'paciente',$paciente);
  alterarCadastro($_COOKIE['id'],'email',$email);
  alterarCadastro($_COOKIE['id'],'diagnostico',$diagnostico);
  alterarCadastro($_COOKIE['id'],'receita',$receita);
  alterarCadastro($_COOKIE['id'],'exames',$exames);
  alterarCadastro($_COOKIE['id'],'infos',$infos);


  alerta("Cadastro alterado.");
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="contact_form">
          <div class="data">
            <label for="data"></label>
            <input type="text" placeholder="Data" name="data" id="data"  value="<?php echo $_COOKIE['data'] ?>" required>
          </div>
          <div class="subject">
            <label for="medico"></label>
            <select placeholder="Médico" name="medico" id="medico" required>
              <option disabled hidden>Médico</option>
              <?php foreach($medicos as $medico){
                  if($medico->nome == $_COOKIE['medico']){
                    echo "<option selected>".$medico->nome."</option>";
                  }
                  else {
                    echo "<option>".$medico->nome."</option>";
                  }
                } ?>
            </select>
          </div>
          <div class="paciente">
            <label for="paciente"></label>
            <input type="text" placeholder="Paciente" name="paciente" id="paciente" value="<?php echo $_COOKIE['paciente'] ?>" required>
          </div>
          <div class="name">
            <label for="email"></label>
            <input type="text" placeholder="E-mail" name="email" id="email" value="<?php echo $_COOKIE['email'] ?>" required>
          </div>
          <div class="diagnostico">
            <label for="diagnostico"></label>
            <input type="text" placeholder="Diagnóstico" name="diagnostico" id="diagnostico" value="<?php echo $_COOKIE['diagnostico'] ?>" required>
          </div>
          <div class="receita">
            <label for="receita"></label>
            <input type="text" placeholder="Receita" name="receita" id="receita" value="<?php echo $_COOKIE['receita'] ?>" required>
          </div>
          <div class="exames">
            <label for="exames"></label>
            <input type="text" placeholder="exames" name="exames" id="exames" value="<?php echo $_COOKIE['exames'] ?>" required>
          </div>
          <div class="message">
            <label for="message"></label>
            <textarea name="message" placeholder="Informações adicionais" id="message" cols="30" rows="3" required><?php echo $_COOKIE['infos'] ?></textarea>
          </div>
          <div class="submit">
            <input type="submit" value="Enviar" id="form_button" />
          </div>
        </form><!-- // End form -->
      </div><!-- // End #container -->
</body>
</html>

