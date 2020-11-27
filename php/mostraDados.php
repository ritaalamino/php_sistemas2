<?php

$xml = simplexml_load_file('./xml/user.xml');

echo '<h2>Employees Listing</h2>';

$list = $xml->record;

for ($i = 0; $i < count($list); $i++) {

    echo '<b>Man no:</b> ' . $list[$i]->id . '<br>';

    echo 'Email: ' . $list[$i]->login . '<br>';

    echo 'Senha: ' . $list[$i]->senha . '<br><br>';

}
?>