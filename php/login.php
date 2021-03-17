
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
        
        include("../../db/db.php");

        $conn = conectaDB();
        $query_select = "SELECT login, password FROM users WHERE login = '".$user."' AND password = '".$password."'";
        $sql = mysqli_query($query_select,$conn);
        echo $sql;
        $data = mysqli_fetch_array($sql);
        $logarray = $data['login'];
        $passarray = $data['password'];

        if(mysqli_num_rows($data) > 0)
        {
            alerta("Acesso realizado com sucesso");
            $_SESSION["username"] = mysqli_query("SELECT login FROM users WHERE login = '".$user."';",$conn);
            $_SESSION["tipo"] = mysqli_query("SELECT tipo FROM users WHERE login = '".$user."';",$conn);             
            return $_SESSION["tipo"];
        } else {  
            alerta("Usuário ou senha inválido.");
            return ;
        }
      }
      
      function verificaS($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      
      

?>