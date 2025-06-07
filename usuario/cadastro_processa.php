<?php
require '../conexao/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if (empty($nome) || empty($email) || empty($senha)) {
        echo "<script>alert('Todos os campos são obrigatórios.'); window.location='cadastro.php';</script>";
        exit;
    }

    // Verifica se e-mail já está cadastrado
    $verifica = $conn->prepare("SELECT ID_usuario FROM usuarios WHERE email = ?");
    $verifica->bind_param("s", $email);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        echo "<script>alert('E-mail já cadastrado.'); window.location='cadastro.php';</script>";
        exit;
    }
    $verifica->close();

    // Cadastro da lenda
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senhaHash);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar. Tente novamente.'); window.location='cadastro.php';</script>";
    }

    $stmt->close();
}
?>
