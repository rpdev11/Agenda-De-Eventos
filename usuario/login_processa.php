<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require '../conexao/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Buscar usuário pelo e-mail
    $stmt = $conn->prepare("SELECT ID_usuario, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar senha
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['ID_usuario'] = $usuario['ID_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: ../eventos/dashboard.php");
            exit;
        } else {
            echo "<script>alert('Senha incorreta.'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('E-mail não encontrado.'); window.location='login.php';</script>";
    }

    $stmt->close();
}
?>
