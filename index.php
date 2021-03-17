<?php
  //Incluindo bibliotecas
  //include("php/funcoes.php");
  include("php/cadastraDB.php");

function verificaS($data){
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
  }/*else{
      $username = verificaS($_POST["username"]);
      if(!filter_var($username,FILTER_VALIDATE_EMAIL)){
          $username = "Formato de e-mail inválido!";
          alerta($username);
          $user=false;
      }
  }*/

  if(empty($_POST["senha"])){
      $senhaErr = "Senha é Obrigatória!";
      alerta($senhaErr);
      $sen=false;
  }
  
}

if($user===true && $sen===true){
  $verifica = verificaAcessoDB($_POST["username"],$_POST["senha"]);
  setcookie("username", $_POST["username"], time() + 30 );
  if ($verifica == "admin"){
    session_start();
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $username; 
    $_SESSION['tipo'] = 'admin';
    header('location:pages/admin/userAdmin.php');   
  }elseif($verifica == "medico"){
    session_start();
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $username; 
    $_SESSION['tipo'] = 'medico'; 
    header('location:pages/medico/userMed.php');
  }elseif($verifica == "paciente"){
    session_start();
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $username; 
    $_SESSION['tipo'] = 'paciente'; 
    header("location:pages/paciente/userPac.php");
  }elseif($verifica == "lab"){
    session_start();
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time()+1000;
    $_SESSION['username'] = $username; 
    $_SESSION['tipo'] = 'lab'; 
    header("location:pages/laboratorio/userLab.php");
  }else{
    alerta("Acesso inválido.");
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
          <input name='senha' placeholder='senha' type='password' id="senha">
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
        <button class='btn block-cube block-cube-hover' type='submit' name='acessar'>
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