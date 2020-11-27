
<?php

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
            $xmlcadastro = $xml->user[$i]->admin->login;

            if($user == $xmlcadastro){
                if($password == $xml->user[$i]->admin->senha) {
                    alerta("Acesso realizado com sucesso");
                    return 1;
                } else {
                    alerta("Senha inválida");
                    return 0;
                }
            }
        }
        alerta("Usuário inválido.");
        return 0;
    }

?>