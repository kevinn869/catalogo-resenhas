<?php
session_start();

include 'usuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $novoUsuario = $_POST['usuario'];
  $novaSenha = $_POST['senha'];


  if (!isset($_SESSION['usuariosExtras'])) {
    $_SESSION['usuariosExtras'] = [];
  }


  foreach ($usuarios as $u) {
    if ($u['usuario'] === $novoUsuario) {
      echo "<script>alert('Usuário já existe!'); window.location.href='cadastrar.php';</script>";
      exit;
    }
  }

  $_SESSION['usuariosExtras'][] = [
    'usuario' => $novoUsuario,
    'senha' => password_hash($novaSenha, PASSWORD_DEFAULT)
  ];

  echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='login.html';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="login-container">
    <h2>Criar Conta</h2>
    <form method="POST" class="login-form">
      <input type="text" name="usuario" placeholder="Usuário" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Cadastrar</button>
    </form>
  </div>
</body>

</html>