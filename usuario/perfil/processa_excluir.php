<?php
session_start();
require '../../conexao/config.php';

if (!isset($_SESSION['ID_usuario'])) {
    echo "<script>alert('Você precisa estar logado.'); window.location='../login.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';
    $idExcluir = isset($_POST['id_usuario']) ? (int)$_POST['id_usuario'] : 0;
    $idLogado = $_SESSION['ID_usuario'];

    if (empty($senha)) {
        echo "<script>alert('É obrigatório informar sua senha.'); window.location='excluir_perfil.php?id=$idExcluir';</script>";
        exit;
    }

    // Verifica permissão: só pode excluir seu próprio perfil ou se for admin (exemplo: ID 1)
    if ($idExcluir !== $idLogado && $idLogado !== 14) {
    echo "<script>alert('Você não tem permissão para excluir este usuário.'); window.location='../perfil.php';</script>";
    exit;
    }

    // Verifica a senha do usuário logado
    $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE ID_usuario = ?");
    $stmt->bind_param("i", $idLogado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        $senhaHash = $usuario['senha'];

        if (!password_verify($senha, $senhaHash)) {
            echo "<script>alert('Senha incorreta.'); window.location='excluir_perfil.php?id=$idExcluir';</script>";
            exit;
        }

        // Exclui o usuário alvo
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE ID_usuario = ?");
        $stmt->bind_param("i", $idExcluir);

        if ($stmt->execute()) {
            // Se excluiu o próprio usuário, derruba a sessão
            if ($idExcluir === $idLogado) {
                session_unset();
                session_destroy();
                echo "<script>alert('Perfil excluído com sucesso.'); window.location='../../index.php';</script>";
                exit;
            } else {
                echo "<script>alert('Usuário excluído com sucesso.'); window.location='../perfil.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Erro ao excluir perfil.'); window.location='../perfil.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Usuário não encontrado.'); window.location='../perfil.php';</script>";
        exit;
    }
}
?>
