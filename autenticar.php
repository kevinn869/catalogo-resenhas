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

    // Volta para login com erro
    header('Location: login.php?erro=1');
    exit;
}
?>