<?php

//funções
function alerta($texto){
  echo "<script>alert('${texto}');</script>";
}

function redireciona($url){
  echo "<script> window.location.href = '{$url}'; </script>";
}

function verificaAcesso($user,$password){
  $file = "xml/user.xml";
  $xml = simplexml_load_file($file);

  for($i = 0; $i < $xml->count(); $i++){
      $xmlcadastro = $xml->user[$i]->login;

      if($user == $xmlcadastro){
          if($password == $xml->user[$i]->senha) {
              alerta("Acesso realizado com sucesso");              
              return $xml->user[$i]->tipo;
          } else {
              alerta("Senha inválida");
              return "";
          }
      }
  }
  alerta("Usuário inválido.");
  return "";
}

function teste($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

///////////////////// 

$username = $senha = "";
$user = $sen = $verifica;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $user = $sen = true;

  if(empty($_POST["username"])){
      $userErr = "Nome é Obrigatório!";
      alerta($userErr);
      $user=false;
  }else{
      $username = teste($_POST["username"]);
      if(!filter_var($username,FILTER_VALIDATE_EMAIL)){
          $username = "Formato de e-mail inválido!";
          alerta($username);
          $user=false;
      }
  }

  if(empty($_POST["senha"])){
      $senhaErr = "Senha é Obrigatória!";
      alerta($senhaErr);
      $sen=false;
  }
  
}

if($user===true && $sen===true){
  $verifica = verificaAcesso($_POST["username"],$_POST["senha"]);

  if ($verifica == "admin"){
    redireciona("/php_sistemas2/pages/admin/userAdmin.php");   
  }
}
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica RW</title>

    <link href="css/index.css" rel="stylesheet" media="all">
</head>
<body>

    <form autocomplete='off' class='form' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <div class='control'>
          <h1>
            Acesso
          </h1>
        </div>
        <div class='control block-cube block-input'>
          <input name='username' placeholder='username' type='text' id="username">
          <?php echo $userErr; ?>
          <div class='bg-top'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg-right'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg'>
            <div class='bg-inner'></div>
          </div>
        </div>
        <div class='control block-cube block-input'>
          <input name='senha' placeholder='senha' type='senha' id="senha">
          <?php echo $senhaErr;?>
          <div class='bg-top'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg-right'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg'>
            <div class='bg-inner'></div>
          </div>
        </div>
        <input class='btn block-cube block-cube-hover' type='submit' name='acessar'>
          <div class='bg-top'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg-right'>
            <div class='bg-inner'></div>
          </div>
          <div class='bg'>
            <div class='bg-inner'></div>
          </div>
          <div class='text'>
            Acessar
          </div>
        </button>
      </form>
      
    
</body>
</html>