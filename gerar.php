<?php
require_once 'conf.php';

use Classes\Gerador;

echo "Gerando nomes...";

$gerador = new Gerador;
$qtde = $gerador->gerarNomes();

echo "{$qtde} nomes gerados.";