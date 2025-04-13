<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: login.php');
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
        <div class="detalhes-container">
            <div class="detalhes-card">
                <img src="<?php echo $itemSelecionado['imagem']; ?>" alt="" class="detalhes-imagem">
                <div class="detalhes-info">
                    <h1><?php echo $itemSelecionado['titulo']; ?></h1>
                    <p><strong>Categoria:</strong> <?php echo $itemSelecionado['categoria']; ?></p>
                    <p><strong>Tipo:</strong> <?php echo $itemSelecionado['tipo']; ?></p>
                    <div class="detalhes-resenha">
                        <h3>Resenha</h3>
                        <p><?php echo $itemSelecionado['resenha']; ?></p>
                    </div>
                    <a href="index.php" class="botao-voltar">← Voltar ao catálogo</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Item não encontrado.</p>
    <?php endif; ?>
</body>
</html>