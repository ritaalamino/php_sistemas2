
<?php

    function verificaLogin($userName){
        if(isset($_COOKIE['username'])){
            echo('Acesso continua.');
            return 1;
        } else {
            alerta('Login espirado');
            redireciona('/');
        }
    }

    function alerta($texto){
        echo "<script>alert('${texto}');</script>";
      }
      
      function redireciona($url){
        echo "<script> window.location.href = '{$url}'; </script>";
      }
      
      function verificaAcesso($user,$password){
        
        $sql = mysql_query("SELECT username, pass FROM users WHERE username = '".$user."' AND pass = '".$password."'");

        if(mysqli_num_rows($sql) > 0)
        {
            alerta("Acesso realizado com sucesso");
            $_SESSION["username"] = $xml->user[$i]->login;
            //revisar
            $_SESSION["tipo"]= mysql_query("SELECT tipo FROM users WHERE login ;");             
            return $xml->user[$i]->tipo;
        } else {
            alerta("Usuário ou senha inválido.");
            break;
        }
      }
      
      function verifica($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      
      

?>