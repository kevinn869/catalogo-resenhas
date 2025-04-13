<?php
/*session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}


$itens = $_SESSION['itens'] ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Protegida</title>
</head>
<body>
    <h2>Bem-vindo à área protegida!</h2>

    <a href="logout.php">Sair</a>
    <h3>Itens Cadastrados:</h3>
    <ul>
        <?php foreach ($itens as $item): ?>
            <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Cadastrar Novo Item</h3>
    <form action="protegida.php" method="post">
        <input type="text" name="nome" required>
        <button type="submit">Salvar</button>
    </form>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    if ($nome !== '') {
        $_SESSION['itens'][] = $nome;
        header('Location: livros_filmes.php'); 
        exit;
    }
}
?>
</body>
</html>