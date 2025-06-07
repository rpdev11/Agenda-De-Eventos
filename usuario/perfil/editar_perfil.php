<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['ID_usuario'])) {
    header("Location: ../login.php");
    exit;
}

require '../../conexao/config.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : $_SESSION['ID_usuario'];

// só permitir editar outro usuário se for admin (ex: ID 14)
if ($_SESSION['ID_usuario'] != $id && $_SESSION['ID_usuario'] != 14) {
  echo "<script>alert('Você não tem permissão para editar este perfil.'); window.location='../perfil.php';</script>";
    exit;
}

$stmt = $conn->prepare("SELECT nome, email FROM usuarios WHERE ID_usuario = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Perfil - Agenda de Eventos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      background-image: url('https://i.postimg.cc/ZKZ6BLsc/Chat-GPT-Image-22-de-mai-de-2025-08-40-27.png');
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      background-position: center center;
    }

    main {
      flex: 1;
    }

    .cadastro-box {
      background-color: white;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      margin-top: -120px;
    }

    @media (max-width: 575.98px) {
      .cadastro-box {
        padding: 1.5rem;
      }
    }

    .btn-primary {
      background-color: #0d6efd;
      border-color: #0d6efd;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0b5ed7;
      border-color: #0a58ca;
      box-shadow: 0 0 10px rgba(13, 110, 253, 0.4);
    }

    .btn-primary:active {
      background-color: #0a58ca;
      box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);
    }

    footer {
      color: black;
      text-align: center;
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="cadastro-box">
      <h4 class="text-center mb-4">Editar Perfil</h4>
      <form action="perfil_processa.php" method="POST" novalidate>
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($id) ?>">
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">E-mail</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Nova senha</label>
          
          <input type="password" name="senha" class="form-control" required>
          <p><small>(repita sua senha atual caso não queira redefini-la)</small></p>
        </div>
        <div class="mb-3">
          <label class="form-label">Senha atual</label>
          <input type="password" name="confirma-senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Salvar alterações</button>
      </form>
      <div class="text-center mt-3">
        <a href="../perfil.php" class="btn btn-outline-warning w-100">Voltar</a>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <small>&copy; <?= date("Y") ?> rp. Todos os direitos reservados.</small>
    </div>
  </footer>
</body>
</html>
