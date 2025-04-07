<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: login.html');
    exit;
}

include 'dados.php';

$id = $_GET['id'] ?? null;
$itemSelecionado = null;

foreach ($itens as $item) {
    if ($item['id'] == $id) {
        $itemSelecionado = $item;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if ($itemSelecionado): ?>
        <h1><?php echo $itemSelecionado['titulo']; ?></h1>
        <img src="<?php echo $itemSelecionado['imagem']; ?>" alt="" width="200">
        <p><strong>Categoria:</strong> <?php echo $itemSelecionado['categoria']; ?></p>
        <p><strong>Tipo:</strong> <?php echo $itemSelecionado['tipo']; ?></p>
        <p><strong>Resenha:</strong> <?php echo $itemSelecionado['resenha']; ?></p>
        <a href="index.php">← Voltar ao catálogo</a>
    <?php else: ?>
        <p>Item não encontrado.</p>
    <?php endif; ?>
</body>
</html>