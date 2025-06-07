<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['ID_usuario'])) {
    header("Location: login\login.php");
    exit;
}
require '../conexao/config.php';

$id = $_SESSION['ID_usuario'];

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
  <title>Perfil do Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      margin: 0;
      padding: 0;
      background-image: url('https://i.postimg.cc/ZKZ6BLsc/Chat-GPT-Image-22-de-mai-de-2025-08-40-27.png');
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      background-position: center center;
    }
    
    main {
      flex: 1;
      }

    .profile-box {
      background-color: white;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
    }

    .profile-box p {
      font-size: 1.1rem;
    }

    .btn-back {
      width: 100%;
    }

    @media (max-width: 575.98px) {
      .profile-box {
        padding: 1.5rem;
      }
    }
    
    footer {
      color: black;
      text-align: center;
      margin-top: 50px;
    }
  </style>
</head>
<body>
  
 <main>

  <div class="container mt-5 d-flex justify-content-center">
    <div class="profile-box">
      <h4 class="mb-4 text-center">Perfil do Usuário</h4>
      <p><strong>Nome: <?= htmlspecialchars($usuario['nome']) ?></strong></p>

      <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>

      <div class="mb-3 text-center">
        <a href="perfil/editar_perfil.php" class="btn btn-outline-primary btn-back">Editar Perfil</a>
      </div>


      <div class="mb-3 text-center">
        <a href="../eventos/dashboard.php" class="btn btn-outline-warning btn-back">Voltar</a>
      </div>

      <div class="mb-3 text-center">
        <a href="perfil/excluir_perfil.php" class="btn btn-outline-danger btn-back">Excluir perfil</a>
      </div>

<?php
// LISTAR TODOS OS USUÁRIOS EM UMA TABELA COM BOTÕES DE AÇÃO
$sql_usuarios = "SELECT ID_usuario, nome, email FROM usuarios ORDER BY ID_usuario ASC";
$result_usuarios = $conn->query($sql_usuarios);

if ($result_usuarios && $result_usuarios->num_rows > 0) {
    echo '<div class="container mt-5">';
    echo '<h5 class="text-center mb-3">Lista de Usuários</h5>';
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered table-hover align-middle text-center">';
    echo '<thead class="table-light">';
    echo '<tr>';
    echo '<th>Nome</th>';
    echo '<th>Email</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($usuario = $result_usuarios->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($usuario['nome']) . '</td>';
        echo '<td>' . htmlspecialchars($usuario['email']) . '</td>';
        echo '<td>';
        echo '<a href="perfil/editar_perfil.php?id=' . urlencode($usuario['ID_usuario']) . '" class="btn btn-sm btn-outline-primary me-2">Editar</a>';
        echo '<a href="perfil/excluir_perfil.php?id=' . urlencode($usuario['ID_usuario']) . '" class="btn btn-sm btn-outline-danger">Excluir</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>'; // .table-responsive
    echo '</div>'; // .container
} else {
    echo '<div class="alert alert-warning mt-4 text-center">Nenhum usuário encontrado.</div>';
}
?>



    </div>    
  </div>
 </main>




  
  
  <footer>
  <div class="container">
    <small>&copy; <?= date("Y") ?> rp. Todos os direitos reservados.</small>
  </div>
</footer>
</body>
</html>
