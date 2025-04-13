<?php
$busca = isset($_GET['busca']) ? strtolower(trim($_GET['busca'])) : '';

$itensFiltrados = array_filter($itens, function ($item) use ($busca) {
    return empty($busca) || 
        strpos(strtolower($item['titulo']), $busca) !== false || 
        strpos(strtolower($item['categoria']), $busca) !== false;
});

$itensPorPagina = 12;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaAtual - 1) * $itensPorPagina;
$totalItens = count($itensFiltrados);
$totalPaginas = ceil($totalItens / $itensPorPagina);

$itensPagina = array_slice($itensFiltrados, $inicio, $itensPorPagina);
?>