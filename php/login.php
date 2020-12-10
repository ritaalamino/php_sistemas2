
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
      
      function verifica($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      
      

?>