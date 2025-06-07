<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Agenda de Eventos - Início</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    
    
    .welcome-box {
      background-color: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin-top: 100px;
    }

    footer {
      color: black;
      text-align: center;
      margin-top: 50px;
    }
  </style>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3277/3277345.png" type="image/png">
</head>
<body>
<main>
  <div class="container d-flex justify-content-center">
    <div class="col-md-6 welcome-box">
      <h2 class="text-primary">Bem-vindo à Agenda de Eventos</h2>
      <p class="mt-3">Aqui você pode gerenciar e visualizar todos os seus eventos com facilidade.</p>
      <a href="usuario\login.php" class="btn btn-primary mt-3">Fazer Login</a>
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
