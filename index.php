<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
    exit;
}

include 'dados.php';
//include 'filtrar.php';
$itensPorPagina = 12;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaAtual - 1) * $itensPorPagina;
$totalItens = count($itens);
$totalPaginas = ceil($totalItens / $itensPorPagina);

$itensPagina = array_slice($itens, $inicio, $itensPorPagina);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Catálogo de Livros e Filmes</title>
    <link rel="stylesheet" href="styles.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
</head>
<div id="carrosselTexto" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #007bff; color: white;">
                <h3>Descubra os melhores livros e filmes para a sua próxima aventura!</h3>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #28a745; color: white;">
                <h3>Explore categorias como Fantasia, Ação, Ficção Científica e muito mais!</h3>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #f39c12; color: white;">
                <h3>Encontre suas próximas leituras ou filmes preferidos aqui!</h3>
            </div>
        </div>
    </div>
    <!-- Adiciona controles de navegação (opcional) -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carrosselTexto" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carrosselTexto" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<body>
    <div class="d-flex justify-content-end p-3 bg-light">
    <a href="logout.php" class="btn btn-outline-danger">Sair</a>
    </div>
    <h1>Catálogo</h1>
    <form method="get" class="search-form" style="text-align: center; margin-bottom: 30px;">
    <input 
        type="text" 
        name="busca" 
        placeholder="🔎 Buscar por título ou categoria..." 
        value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>"
    >
    <button type="submit">Buscar</button>
</form>
    <div class="catalogo">
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

    <?php foreach ($itensPagina as $item): ?>
            <div class="item">
                <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['titulo']; ?>" width="150">
                <h3><?php echo $item['titulo']; ?></h3>
                <p><strong>Categoria:</strong> <?php echo $item['categoria']; ?></p>
                <p><strong>Tipo:</strong> <?php echo $item['tipo']; ?></p>
                <a href="detalhes.php?id=<?php echo $item['id']; ?>">Ver mais</a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination text-center my-4">
    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
        <a href="?pagina=<?php echo $i; ?>" class="btn <?php echo ($i == $paginaAtual) ? 'btn-primary' : 'btn-outline-primary'; ?> mx-1">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>