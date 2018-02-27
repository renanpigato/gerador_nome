<?php
require_once 'conf.php';

use Classes\Gerador;

echo "Gerando nomes...";

$gerador = new Gerador;
$qtde = $gerador->gerarNomes();

echo "{$qtde} nomes gerados.";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gerador de Nomes</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Palavras</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="gerar.php">Gerar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="ver.php">Ver Nomes</a>
        </li>
    </ul>
</body>
</html> 