<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    if (file_exists('usuarios.txt')) {
        $linhas = file('usuarios.txt', FILE_IGNORE_NEW_LINES);
        
        foreach ($linhas as $linha) {
            list($usuarioSalvo, $senhaCriptografada) = explode('|', $linha);

            if ($usuario === $usuarioSalvo && password_verify($senha, $senhaCriptografada)) {
                $_SESSION['logado'] = true;
                $_SESSION['usuario'] = $usuario;
                header('Location: index.php');
                exit;
            }
        }
    }

    $erro = 'Usuário ou senha inválidos.';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="style.css">-->
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4 mx-auto" style="max-width: 400px;">
            <h3 class="mb-4 text-center">Login</h3>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>

            <?php if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok'): ?>
                <div class="alert alert-success">Cadastro realizado com sucesso!</div>
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
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

            <p class="text-center mt-3">
                <a href="cadastrar.php" class="btn btn-link">Cadastrar novo usuário</a>
            </p>
        </div>
    </div>
</body>
</html>

<!--echo "<script>alert('Usuário ou senha inválidos'); window.location.href='login.php';</script>";