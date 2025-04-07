<?php
session_start();
include 'usuarios.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html');
    exit;
}

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

$todosUsuarios = array_merge($usuarios, $_SESSION['usuariosExtras'] ?? []);

foreach ($todosUsuarios as $u) {
    if ($u['usuario'] === $usuario && password_verify($senha, $u['senha'])) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
        exit;
    }
}

echo "<script>alert('Usuário ou senha inválidos'); window.location.href='login.html';</script>";