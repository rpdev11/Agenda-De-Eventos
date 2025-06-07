<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['ID_usuario'])) {
    header("Location: ../usuario/login.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agenda de Eventos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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

    .navbar-brand, .nav-link {
      color: black !important;
    }
    .nav-link.active {
      font-weight: bold;
      text-decoration: underline;
    }
    .container {
      margin-top: 40px;
    }
    .content-box {
      background-color: white;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    footer {
      color: black;
      text-align: center;
      margin-top: 50px;
    }
    #loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #ffffffcc;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1050;
    transition: opacity 0.5s ease;
    user-select: none;
  }

  .spinner {
    width: 60px;
    height: 60px;
    border: 6px solid #0d6efd;
    border-top: 6px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
</head>
<body>
<main>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= (!isset($_REQUEST['page']) || $_REQUEST['page'] == '') ? 'active' : '' ?>" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (isset($_REQUEST['page']) && $_REQUEST['page'] == 'novo') ? 'active' : '' ?>" href="?page=novo">Novo Evento</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (isset($_REQUEST['page']) && $_REQUEST['page'] == 'listar') ? 'active' : '' ?>" href="?page=listar">Meus Eventos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <?= htmlspecialchars($_SESSION['nome']) ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="../usuario/perfil.php">Revisar Perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="../usuario/logout.php">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10 content-box">

      <?php
      include("../conexao/config.php");

      switch (@$_REQUEST["page"]) {
        case "novo":
          include("novo-evento.php");
          break;
        case "listar":
          include("agenda-de-eventos.php");
          break;
        case "salvar":
          include("salvar-evento.php");
          break;
        case "editar":
          include("editar-evento.php");
          break;
        default:
          echo "<h2 class='text-center text-primary'>Bem-vindo à nossa Agenda de Eventos</h2>
                <p class='text-center'>Use o menu acima para navegar entre as opções disponíveis.</p>";

          // MOSTRAR PRÓXIMO EVENTO DO USUÁRIO
          $ID_usuario = $_SESSION['ID_usuario'];
          $hoje = date('Y-m-d');

          $sql_proximo = "SELECT * FROM agendas WHERE data >= '$hoje' AND ID_usuario = $ID_usuario ORDER BY data ASC LIMIT 1";
          $res_proximo = $conn->query($sql_proximo);

          if ($res_proximo && $res_proximo->num_rows > 0) {
            $evento = $res_proximo->fetch_object();
            echo '<div class="alert alert-info mt-4">';
            echo '<h5>Seu próximo evento:</h5>';
            echo '<p><strong>Evento:</strong> ' . htmlspecialchars($evento->nome) . '</p>';
            echo '<p><strong>Data:</strong> ' . date('d/m/Y', strtotime($evento->data)) . '</p>';
            echo '<p><strong>Horário:</strong> ' . date('H:i', strtotime($evento->hora)) . '</p>';
            echo '<p><strong>Local:</strong> ' . htmlspecialchars($evento->local) . '</p>';
            echo '<p><strong>Tema:</strong> ' . htmlspecialchars($evento->tema) . '</p>';
            echo '</div>';
          } else {
            echo '<div class="alert alert-warning mt-4">Você não tem nenhum evento futuro cadastrado.</div>';
          }

          break;
      }
      ?>

    </div>
  </div>
</div>
</main>
<footer>
  <div class="container">
    <small>&copy; <?= date("Y") ?> rp. Todos os direitos reservados.</small>
  </div>
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener('load', () => {
      const loadingScreen = document.getElementById('loading-screen');
      loadingScreen.style.opacity = '0';
      setTimeout(() => loadingScreen.style.display = 'none', 1000);
    });
  </script>

</body>
</html>
