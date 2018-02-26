<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
date_default_timezone_set('America/Sao_Paulo');
set_time_limit(0);

if(file_exists('vendor/autoload.php')) {
    require_once ('vendor/autoload.php');
}

if(file_exists('conf/config.php')) {
    require_once 'conf/config.php';
}

use Classes\Gerador;

echo "Gerando nomes...";

$gerador = new Gerador;
$qtde = $gerador->gerarNomes();

echo "{$qtde} nomes gerados.";