<?php 

    function criandoDB(){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "CREATE DATABASE $db;";
    
            $conn->exec($sql);
            echo "Banco de Dados $db foi criado!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function criandoUserAdmin(){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "CREATE TABLE usuarios (
                id int PRIMARY KEY,
                tipo varchar(15),
                nome varchar(50),
                email varchar(50),
                senha varchar(50)
            );
            INSERT INTO usuarios (id, tipo, nome, email, senha) VALUES
            (1, 'admin', 'Wanderson Paes','wanderson@furg.br','wan123@'),
            (2, 'admin', 'Rita Alamino','rita@furg.br','rita123@');";
    
            $conn->exec($sql);
            echo "Tabela de usuários foi criado!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function criandoTabelaMedico(){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "CREATE TABLE medicos (
                id int PRIMARY KEY,
                nome varchar(50),
                email varchar(50),
                senha varchar(50),
                idade int,
                telefone varchar(15),
                crm varchar(10),
                endereco varchar(100),
                especialidade varchar(50),
                genero varchar(30),
                infos varchar(240)
            );
            ";
    
            $conn->exec($sql);
            echo "Tabela de médicos foi criado!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function criandoTabelaPaciente(){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "CREATE TABLE pacientes (
                id int PRIMARY KEY,
                nome varchar(50),
                email varchar(50),
                senha varchar(50),
                idade int,
                telefone varchar(15),
                cpf varchar(15),
                endereco varchar(100),
                genero varchar(30),
                infos varchar(240)
            );
            ";
    
            $conn->exec($sql);
            echo "Tabela de pacientes foi criado!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function criandoTabelaLaboratorio(){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "CREATE TABLE laboratorios (
                id int PRIMARY KEY,
                nome varchar(50),
                email varchar(50),
                senha varchar(50),
                telefone varchar(15),
                cnpj varchar(18),
                endereco varchar(100),
                tipoExame varchar(50),
                infos varchar(240)
            );
            ";
    
            $conn->exec($sql);
            echo "Tabela de laboratorios foi criado!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function criandoTabelaExame(){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "CREATE TABLE exames (
                id int PRIMARY KEY,
                data varchar(12),
                id_paciente int,
                id_medico int,
                id_laboratorio int,
                CONSTRAINT fk_paciente FOREIGN KEY (id_paciente) REFERENCES pacientes (id),
                CONSTRAINT fk_medico FOREIGN KEY (id_medico) REFERENCES medicos (id),
                CONSTRAINT fk_laboratorio FOREIGN KEY (id_laboratorio) REFERENCES laboratorios (id),
                exame varchar(50),
                infos varchar(240)
            );
            ";
    
            $conn->exec($sql);
            echo "Tabela de exames foi criado!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    function criandoTabelaConsulta(){
        $server = "clinicapw.cr3c0eja1r0m.sa-east-1.rds.amazonaws.com";
        $user = "root";
        $pass = "Oitona66.";
        $db = "CLINICA_PW";

        try {
            $conn = new PDO ("mysql:dbname=$db;host=$server", $user, $pass);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "CREATE TABLE consultas (
                id int PRIMARY KEY,
                data varchar(12),
                id_paciente int,
                id_medico int,
                CONSTRAINT fk_pacienteC FOREIGN KEY (id_paciente) REFERENCES pacientes (id),
                CONSTRAINT fk_medicoC FOREIGN KEY (id_medico) REFERENCES medicos (id),
                diagnostico varchar(100),
                receita varchar(100)
            );
            ";
    
            $conn->exec($sql);
            echo "Tabela de consultas foi criado!";
    
        }catch (PDOEXception $e){
            echo "Erro: " . "<br>" . $e->getMessage();
        }
    
        $conn = null;
    }

    //criandoDB();
    //criandoUserAdmin();
    //criandoTabelaMedico();
    //criandoTabelaPaciente();
    //criandoTabelaLaboratorio();
    //criandoTabelaExame();
    //criandoTabelaConsulta();

?>