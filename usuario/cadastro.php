<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro - Agenda de Eventos</title>
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

    footer {
      color: black;
      text-align: center;
      margin-top: 50px;
    }

    .cadastro-box {
      background-color: white;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      margin-top: -120px
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
    
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="cadastro-box">
      <h4 class="text-center mb-4">Criar Conta</h4>
      <form action="cadastro_processa.php" method="POST" novalidate>
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">E-mail</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
      </form>
      <div class="text-center mt-3">
        <a href="login.php">Voltar para o Login</a>
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
