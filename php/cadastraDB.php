<?php

    //alerta
    function alerta($texto){
        echo "<script>alert('${texto}');</script>";
    }

    //Redicionamento
    function redireciona($url){
        echo "<script> window.location.href = '{$url}'; </script>";
    }

    //Função que retira possíveis injeção de código
    function verifica($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function verificaAcessoDB($email, $password){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM usuarios WHERE email = :email AND senha=:pass";
            $resposta = $conn->prepare($sql);

            $resposta->bindParam(':email',$email);
            $resposta->bindParam(':pass',$password);
            $resposta->execute();
            
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);

            if ($conteudo['email'] == $email AND $conteudo['senha'] == $password){
                alerta("Conectado!");
                return $conteudo['tipo'];
            } else {
                alerta('Usuário ou senha inválidos.');
                return ;
            }

        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;

    }
    
    function pegaNomeID($id){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT nome FROM usuarios WHERE id=:i";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':i',$id);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            return $conteudo['nome'];
            
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function pegaNome($email){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT nome FROM usuarios WHERE email=:e";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':e',$email);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            //print_r($conteudo['nome']);
            return $conteudo['nome'];
            
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function pegaID($tabela, $nome){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT id FROM $tabela WHERE nome=:n";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':n',$nome);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            return $conteudo['id'];
            //print_r($conteudo['id']);
            
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function pegandoNomes($tabela){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT nome FROM $tabela WHERE nome!=''";
            $resposta = $conn->query($sql);
            $conteudo = $resposta->fetchAll(PDO::FETCH_ASSOC);
            return $conteudo;
            //print_r($conteudo[1]['nome']);
            
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function jaExisteDB($tabela, $email, $cpf){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";
        $tudoOk=false;

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM $tabela WHERE email = :email";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':email',$email);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            if($conteudo['email'] == $email){
                return true;
            }else{
                $tudoOk = false;
            };
            
            $sql = "SELECT * FROM $tabela WHERE cpf=:cpf";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':cpf',$cpf);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            if($conteudo['cpf'] == $cpf){
                $tudoOk=true;
            }else{
                $tudoOk=false;
            }

            return $tudoOk;
    
            //$conn->exec($sql);
            //echo "Inserido na tabela paciente!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function jaExisteMedDB($tabela, $email, $crm){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";
        $tudoOk=false;

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM $tabela WHERE email = :email";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':email',$email);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            if($conteudo['email'] == $email){
                return true;
            }else{
                $tudoOk = false;
            };
            
            $sql = "SELECT * FROM $tabela WHERE crm=:crm";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':crm',$crm);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            if($conteudo['crm'] == $crm){
                $tudoOk=true;
            }else{
                $tudoOk=false;
            }

            return $tudoOk;
    
            //$conn->exec($sql);
            //echo "Inserido na tabela paciente!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function jaExisteLabDB($tabela, $email, $cnpj){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";
        $tudoOk=false;

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT * FROM $tabela WHERE email = :email";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':email',$email);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            if($conteudo['email'] == $email){
                return true;
            }else{
                $tudoOk = false;
            };
            
            $sql = "SELECT * FROM $tabela WHERE cnpj=:cnpj";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':cnpj',$cnpj);
            $resposta->execute();
            $conteudo = $resposta->fetch(PDO::FETCH_ASSOC);
            if($conteudo['cnpj'] == $cnpj){
                $tudoOk=true;
            }else{
                $tudoOk=false;
            }

            return $tudoOk;
    
            //$conn->exec($sql);
            //echo "Inserido na tabela paciente!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function cadastraLabDB($nome, $email, $senha, $telefone, $cnpj, $endereco, $tipoExame, $infos){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT COUNT(*) FROM laboratorios;
            ";
            $resposta = $conn->query($sql);
            $indice = $resposta->fetchAll(PDO::FETCH_ASSOC);
            $indice = $indice[0]['COUNT(*)']+3001;
            //print_r($indice);
            
            $sql = "INSERT INTO laboratorios(
                id, nome, email, senha, 
                telefone, cnpj, endereco, 
                tipoExame, infos
            ) VALUES (:i, :n, :e, :s, 
                :t, :c, :en, :te, :ifu);
            ";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':i',$indice);
            $resposta->bindParam(':n',$nome);
            $resposta->bindParam(':e',$email);
            $resposta->bindParam(':s',$senha);
            $resposta->bindParam(':t',$telefone);
            $resposta->bindParam(':c',$cnpj);
            $resposta->bindParam(':en',$endereco);
            $resposta->bindParam(':te',$tipoExame);
            $resposta->bindParam(':ifu',$infos);
            $resposta->execute();

            $lab='lab';
            $sql = "INSERT INTO usuarios(
                id, tipo, nome, email, senha
            ) VALUES (:i, :t, :n, :e, :s);
            ";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':i',$indice);
            $resposta->bindParam(':t',$lab);
            $resposta->bindParam(':n',$nome);
            $resposta->bindParam(':e',$email);
            $resposta->bindParam(':s',$senha);
            $resposta->execute();

            //echo "Inserido na tabela laboratorios!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function cadastraMedicoDB($nome, $email, $senha, $idade, $telefone, $crm, $endereco, $especialidade, $genero, $infos){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT COUNT(*) FROM medicos;
            ";
            $resposta = $conn->query($sql);
            $indice = $resposta->fetchAll(PDO::FETCH_ASSOC);
            $indice = $indice[0]['COUNT(*)']+2001;
            //print_r($indice);
            
            $sql = "INSERT INTO medicos(
                id, nome, email, senha, 
                idade, telefone, crm, endereco, 
                especialidade, genero, infos
            ) VALUES (:i, :n, :e, :s, :age, 
                :t, :c, :en, :esp, :g, :ifu);
            ";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':i',$indice);
            $resposta->bindParam(':n',$nome);
            $resposta->bindParam(':e',$email);
            $resposta->bindParam(':s',$senha);
            $resposta->bindParam(':age',$idade);
            $resposta->bindParam(':t',$telefone);
            $resposta->bindParam(':c',$crm);
            $resposta->bindParam(':en',$endereco);
            $resposta->bindParam(':esp',$especialidade);
            $resposta->bindParam(':g',$genero);
            $resposta->bindParam(':ifu',$infos);
            $resposta->execute();
    
            $tipo='medico';
            $sql = "INSERT INTO usuarios(
                id, tipo, nome, email, senha
            ) VALUES (:i, :t, :n, :e, :s);
            ";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':i',$indice);
            $resposta->bindParam(':t',$tipo);
            $resposta->bindParam(':n',$nome);
            $resposta->bindParam(':e',$email);
            $resposta->bindParam(':s',$senha);
            $resposta->execute();

            //echo "Inserido na tabela medico!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function cadastraPacienteDB($nome, $email, $senha, $idade, $telefone, $cpf, $endereco, $genero, $infos){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT COUNT(*) FROM pacientes;
            ";
            $resposta = $conn->query($sql);
            $indice = $resposta->fetchAll(PDO::FETCH_ASSOC);
            $indice = $indice[0]['COUNT(*)']+1001;
            //print_r($indice);
            
            $sql = "INSERT INTO pacientes(
                id, nome, email, senha, 
                idade, telefone, cpf, endereco, 
                genero, infos
            ) VALUES (:i, :n, :e, :s, :age, 
                :t, :c, :en, :g, :ifu);
            ";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':i',$indice);
            $resposta->bindParam(':n',$nome);
            $resposta->bindParam(':e',$email);
            $resposta->bindParam(':s',$senha);
            $resposta->bindParam(':age',$idade);
            $resposta->bindParam(':t',$telefone);
            $resposta->bindParam(':c',$cpf);
            $resposta->bindParam(':en',$endereco);
            $resposta->bindParam(':g',$genero);
            $resposta->bindParam(':ifu',$infos);
            $resposta->execute();
    
            $tipo='paciente';
            $sql = "INSERT INTO usuarios(
                id, tipo, nome, email, senha
            ) VALUES (:i, :t, :n, :e, :s);
            ";
            $resposta = $conn->prepare($sql);
            $resposta->bindParam(':i',$indice);
            $resposta->bindParam(':t',$tipo);
            $resposta->bindParam(':n',$nome);
            $resposta->bindParam(':e',$email);
            $resposta->bindParam(':s',$senha);
            $resposta->execute();

            //echo "Inserido na tabela paciente!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    //cadastraPacienteDB("teste", "teste", "teste", 22, "teste","teste","teste","teste","teste",);
    //jaExisteDB('pacientes', 'carlos@furg.br', '12376534595')
    //$res = verificaAcessoDB('wanderson@furg.br', 'wan123@');
    //alerta($res);
    //pegandoNomes('medicos');
    //pegaID('medicos', 'Adriana Maria');
    //pegaNome('ids@ids.com');

?>