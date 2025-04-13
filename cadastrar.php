<?php
// cadastrar.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);

    if ($usuario && $senha) {
        $linha = $usuario . '|' . $senha . PHP_EOL;
        file_put_contents('usuarios.txt', $linha, FILE_APPEND);
        header('Location: login.html?cadastro=ok');
        exit;
    } else {
        $erro = "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4 mx-auto" style="max-width: 400px;">
            <h3 class="mb-4 text-center">Cadastrar Novo Usuário</h3>
            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                <a href="login.html" class="btn btn-link mt-3 w-100 text-center">Voltar para Login</a>
            </form>
        </div>
    </div>
</body>
</html>