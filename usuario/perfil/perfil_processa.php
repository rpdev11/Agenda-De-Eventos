<?php
session_start();
require '../../conexao/config.php';

if (!isset($_SESSION['ID_usuario'])) {
    echo "<script>alert('Você precisa estar logado.'); window.location='../login.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $novaSenha = $_POST['senha'];
    $senhaAntiga = $_POST['confirma-senha'];
    $idUsuario = isset($_POST['id_usuario']) ? (int) $_POST['id_usuario'] : $_SESSION['ID_usuario'];

    // Segurança: apenas o dono da conta ou o admin (ID 14) podem alterar
if ($_SESSION['ID_usuario'] != $idUsuario && $_SESSION['ID_usuario'] != 14) {
echo "<script>alert('Você não tem permissão para editar este perfil.'); window.location='../perfil.php';</script>";
exit;
}

//    if (empty($nome) || empty($email) || empty($novaSenha) || empty($senhaAntiga)) {
//        echo "<script>alert('Todos os campos são obrigatórios.'); window.location='editar_perfil.php?id=$idUsuario';</script>";
 //       exit;
//    }

    // Busca a senha atual do usuário no banco
    $buscaSenha = $conn->prepare("SELECT senha FROM usuarios WHERE ID_usuario = ?");
    $buscaSenha->bind_param("i", $idUsuario);
    $buscaSenha->execute();
    $buscaSenha->bind_result($senhaAtualHash);
    $buscaSenha->fetch();
    $buscaSenha->close();

    // Verifica senha antiga
    if (!password_verify($senhaAntiga, $senhaAtualHash)) {
        echo "<script>alert('Senha antiga incorreta.'); window.location='editar_perfil.php?id=$idUsuario';</script>";
        exit;
    }

    // Verifica se o novo email já está sendo usado
    $verifica = $conn->prepare("SELECT ID_usuario FROM usuarios WHERE email = ? AND ID_usuario != ?");
    $verifica->bind_param("si", $email, $idUsuario);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        echo "<script>alert('Este e-mail já está em uso por outro usuário.'); window.location='editar_perfil.php?id=$idUsuario';</script>";
        $verifica->close();
        exit;
    }
    $verifica->close();

    // Atualiza os dados
    $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE ID_usuario = ?");
    $stmt->bind_param("sssi", $nome, $email, $senhaHash, $idUsuario);

    if ($stmt->execute()) {
        echo "<script>alert('Perfil atualizado com sucesso!'); window.location='../perfil.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar perfil.'); window.location='editar_perfil.php?id=$idUsuario';</script>";
    }

    $stmt->close();
}
?>
