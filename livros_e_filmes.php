<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}

$itens = $_SESSION['itens'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Livros e Filmes</title>
</head>
<body>
    <h2>Bem-vindo à sua lista de Livros e Filmes!</h2>

    <a href="protegida.php">Cadastrar Novo</a> |
    <a href="logout.php">Sair</a>

    <ul>
        <?php foreach ($itens as $item): ?>
            <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>