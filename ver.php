<?php 
require_once 'conf.php';

use GeradorNome\NomeSugeridoQuery;
use Propel\Runtime\ActiveQuery\Criteria;

$pagina      = !empty($_GET['pagina']) ? $_GET['pagina'] : 1;
$filtroNome  = !empty($_GET['filtroNome']) ? $_GET['filtroNome'] : null;
$filtroLetra = !empty($_GET['filtroLetra']) ? $_GET['filtroLetra'] : null;
$filtroSilaba = !empty($_GET['filtroSilaba']) ? $_GET['filtroSilaba'] : null;
$filtros     = "";

$nomesSugeridosPager = NomeSugeridoQuery::create()->orderByInicial()->orderByNome();

if(!empty($filtroLetra)) {
    $nomesSugeridosPager = $nomesSugeridosPager->filterByInicial($filtroLetra);
    $filtros            .= "filtroLetra={$filtroLetra}&";
}

if(!empty($filtroNome)) {
    $nomesSugeridosPager = $nomesSugeridosPager->filterByNome("%{$filtroNome}%", Criteria::LIKE);
    $filtros            .= "filtroNome={$filtroNome}&";
}

if(!empty($filtroSilaba)) {
    $nomesSugeridosPager = $nomesSugeridosPager->filterByQuantidadeSilabas($filtroSilaba);
    $filtros            .= "filtroSilaba={$filtroSilaba}&";
}

$nomesSugeridosPager = $nomesSugeridosPager->paginate($pagina, 10);
$qtdeNomesSugeridos  = $nomesSugeridosPager->getNbResults();

$primeiraPagina = 1;
$ultimaPagina   = (int) floor($qtdeNomesSugeridos / 10);
$paginas        = $nomesSugeridosPager->getLinks(5);  // array of page numbers around the current page; useful to display pagination controls
$paginaAnterior = null;
$proximaPagina  = null;

if((($qtdeNomesSugeridos / 10) % 2) > 0) {
    $ultimaPagina++;
}

if($pagina > $ultimaPagina) {
    $pagina = $ultimaPagina;
}

if($pagina > 1) {
    $paginaAnterior = $pagina - 1;
}

if($pagina != $ultimaPagina) {
    $proximaPagina  = $pagina + 1;
}


// dump(
//     $primeiraPagina,
//     $ultimaPagina,
//     $paginas,
//     $paginaAnterior,
//     $proximaPagina
// );
// exit;

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

    <div class="row">
      <div class="col-2 col-xs-12"></div>
      <div class="col-8 col-xs-12">
        <form method="GET" action="">
          <fieldset>
            <div class="form-group">
              <label for="filtroNome">Nome</label>
              <input type="text" name="filtroNome" id="filtroNome" class="form-control" placeholder="Nome" value="<?php echo !empty($filtroNome) ? $filtroNome : ''?>">
            </div>
            <div class="row">
                <div class="form-group col-6 col-xs-12">
                  <label for="filtroLetra">Letra Inicial</label>
                  <input type="text" name="filtroLetra" id="filtroLetra" class="form-control" placeholder="Letra Inicial" value="<?php echo !empty($filtroLetra) ? $filtroLetra : ''?>">
                </div>
                <div class="form-group col-6 col-xs-12">
                  <label for="filtroSilaba">Silabas</label>
                  <input type="text" name="filtroSilaba" id="filtroSilaba" class="form-control" placeholder="Silabas" value="<?php echo !empty($filtroSilaba) ? $filtroSilaba : ''?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
            <button type="button" class="btn btn-primary" onclick="location.href='ver.php'">Limpar</button>
          </fieldset>
        </form>
      </div>
      <div class="col-2 col-xs-12"></div>
    </div>

    <?php if (!empty($nomesSugeridosPager->haveToPaginate())): ?>

        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-end">
            
            <?php if (!empty($paginaAnterior) ): ?>
                <li class="page-item"><a class="page-link" href="ver.php?<?php echo $filtros ?>pagina=<?php echo $paginaAnterior?>">Anterior</a></li>
            <?php endif; ?>

            <?php if (!in_array(1, $paginas)): ?>
                <li class="page-item"><a class="page-link" href="ver.php?<?php echo $filtros ?>pagina=<?php echo $primeiraPagina ?>">1</a></li>
            <?php endif; ?>
            
            <?php if (!empty($paginas)): ?>
                <?php foreach ($paginas as $pagina): ?>
                    <li class="page-item"><a class="page-link" href="ver.php?<?php echo $filtros ?>pagina=<?php echo $pagina?>"><?php echo $pagina ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if (!in_array($ultimaPagina, $paginas)): ?>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="ver.php?<?php echo $filtros ?>pagina=<?php echo $ultimaPagina?>"><?php echo $ultimaPagina ?></a></li>
            <?php endif; ?>
            
            <?php if (!empty($proximaPagina)): ?>
                <li class="page-item"><a class="page-link" href="ver.php?<?php echo $filtros ?>pagina=<?php echo $proximaPagina?>">Próximo</a></li>
            <?php endif; ?>
          </ul>
        </nav>
    <?php endif; ?>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">Sílabas</th>
          <th scope="col">Inicial</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($nomesSugeridosPager as $nomeSugerido): ?>
        <tr>
          <th scope="row"><?php echo $nomeSugerido->getId() ?></th>
          <td><?php echo $nomeSugerido->getNome() ?></td>
          <td><?php echo $nomeSugerido->getQuantidadeSilabas() ?></td>
          <td><?php echo $nomeSugerido->getInicial() ?></td>
        </tr>
        <?php endforeach; ?>
        <?php ?>
      </tbody>
    </table>
</body>
</html> 