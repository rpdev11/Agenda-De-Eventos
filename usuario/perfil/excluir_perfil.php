<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['ID_usuario'])) {
    header("Location: ../login.php");
    exit;
}

require '../../conexao/config.php';

// puxa o ID do usuário alvo (passado via GET ou usuário logado)
$idUsuarioAlvo = isset($_GET['id']) ? (int)$_GET['id'] : $_SESSION['ID_usuario'];

// puxa os dados do usuário alvo (para mostrar nome/email na tela)
$stmt = $conn->prepare("SELECT nome, email FROM usuarios WHERE ID_usuario = ?");
$stmt->bind_param("i", $idUsuarioAlvo);
$stmt->execute();
$result = $stmt->get_result();
$usuarioAlvo = $result->fetch_assoc();

if (!$usuarioAlvo) {
    echo "<script>alert('Usuário não encontrado.'); window.location='../perfil.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Excluir Perfil - Agenda de Eventos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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
      background-color: #dc3545;
      border-color: #dc3545;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #bb2d3b;
      border-color: #b02a37;
      box-shadow: 0 0 10px rgba(220, 53, 69, 0.4);
    }
    .btn-primary:active {
      background-color: #b02a37;
      box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);
    }
    footer {
      color: black;
      text-align: center;
      margin-top: 50px;
    }
  </style>
  <script>
    function confirmarExclusao() {
      return confirm("Tem certeza que deseja excluir este perfil? Essa ação não pode ser desfeita.");
    }
  </script>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="cadastro-box">
      <h4 class="text-center mb-4">Excluir Perfil</h4>
      <p class="text-center mb-3">
        Você está prestes a excluir o perfil de:<br />
        <strong><?= htmlspecialchars($usuarioAlvo['nome']) ?> (<?= htmlspecialchars($usuarioAlvo['email']) ?>)</strong>
      </p>
      <form action="processa_excluir.php" method="POST" onsubmit="return confirmarExclusao();" novalidate>
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($idUsuarioAlvo) ?>" />
        <div class="mb-3">
          <label for="senha" class="form-label">Senha atual</label>
          <input type="password" class="form-control" id="senha" name="senha" required />
          <p><small>(Do usuario logado)</small></p>
        </div>
        <button type="submit" class="btn btn-primary w-100">Excluir Perfil</button>
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
