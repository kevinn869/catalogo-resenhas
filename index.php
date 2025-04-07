<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: login.html');
    exit;
}

include 'dados.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Livros e Filmes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Catálogo</h1>
    <div class="catalogo">
        <?php foreach ($itens as $item): ?>
            <div class="item">
                <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['titulo']; ?>" width="150">
                <h3><?php echo $item['titulo']; ?></h3>
                <p><strong>Categoria:</strong> <?php echo $item['categoria']; ?></p>
                <p><strong>Tipo:</strong> <?php echo $item['tipo']; ?></p>
                <a href="detalhes.php?id=<?php echo $item['id']; ?>">Ver mais</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>