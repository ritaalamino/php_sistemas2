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
function teste($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Função verifica se já existe usuário
function jaExiste($id, $caminho){
    //Carregando xml para verificação
    $xml = simplexml_load_file($caminho) or die("ERRO: Não foi possível abrir o XML");

    foreach($xml->children() as $nodo){
        if($nodo->email == $id){
            return true;
        }
    }

    return false;
}

//Cadastra médico
function cadastraMedico($nome, $email, $senha, $idade, $telefone, $crm, $endereco, $especialidade, $genero, $infos){
    //Carregando xml
    $xml = simplexml_load_file("../../xml/medicos.xml") or die("ERRO: Não foi possível abrir o XML");

    $id = count($xml)+1;

    //Adicionando medico
    $node = $xml->addChild('medico');
    $node->addChild('id',$id);
    $node->addChild('nome',$nome);
    $node->addChild('email',$email);
    $node->addChild('idade',$idade);
    $node->addChild('telefone',$telefone);
    $node->addChild('crm',$crm);
    $node->addChild('endereco',$endereco);
    $node->addChild('especialidade',$especialidade);
    $node->addChild('genero',$genero);
    $node->addChild('infos',$infos);

    //Salvando no xml
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/medicos.xml");

    //Salvando dados no user.xml para login
    $xml = simplexml_load_file("../../xml/user.xml") or die("ERRO: Não foi possível abrir o XML");

    //Adicionando novo usuario medico
    $node = $xml->addChild('user');

    $node->addChild('tipo','medico');
    $node->addChild('login', $email);
    $node->addChild('senha', $senha);

    //Salvando no xml
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/user.xml");

}

//Função cadastro novo paciente
function cadastraPaciente($nome, $email, $senha, $idade, $telefone, $cpf, $endereco, $genero, $infos){
    //Carregando xml
    $xml = simplexml_load_file("../../xml/pacientes.xml") or die("ERRO: Não foi possível abrir o XML");

    //Adicionando paciente
    $node = $xml->addChild('paciente');

    $node->addChild('nome',$nome);
    $node->addChild('email',$email);
    $node->addChild('idade',$idade);
    $node->addChild('telefone',$telefone);
    $node->addChild('cpf',$cpf);
    $node->addChild('endereco',$endereco);
    $node->addChild('genero',$genero);
    $node->addChild('infos',$infos);

    //Salvando no xml
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/pacientes.xml");

    //Salvando dados no user.xml para login
    $xml = simplexml_load_file("../../xml/user.xml") or die("ERRO: Não foi possível abrir o XML");

    //Adicionando novo usuario paciente
    $node = $xml->addChild('user');

    $node->addChild('tipo','paciente');
    $node->addChild('login', $email);
    $node->addChild('senha', $senha);

    //Salvando no xml
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/user.xml");
}

//Cadastra novo laboratório
function cadastraLab($nome, $email, $senha, $telefone, $cnpj, $endereco, $tipoExame, $infos){
    //Carregando xml
    $xml = simplexml_load_file("../../xml/labs.xml") or die("ERRO: Não foi possível abrir o XML");

    //Carregando laboratório
    $node = $xml->addChild('lab');

    $node->addChild('nome', $nome);
    $node->addChild('email',$email);
    $node->addChild('telefone',$telefone);
    $node->addChild('cnpj',$cnpj);
    $node->addChild('endereco',$endereco);
    $node->addChild('tipoExame',$tipoExame);
    $node->addChild('infos',$infos);

    //Salvando no xml
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/labs.xml");

    //Salvando dados no user.xml para login
    $xml = simplexml_load_file("../../xml/user.xml") or die("ERRO: Não foi possível abrir o XML");

    //Adicionando novo usuario medico
    $node = $xml->addChild('user');

    $node->addChild('tipo','lab');
    $node->addChild('login', $email);
    $node->addChild('senha', $senha);

    //Salvando no xml
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;
    $dom->loadXML($dom->saveXML());
    $dom->save("../../xml/user.xml");
}

?>