<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['ID_usuario'])) {
    header("Location: ../eventos/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Agenda de Eventos</title>
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
      font-size: 2rem;
      color: #0d6efd;
      font-weight: 700;
      user-select: none;
      transition: opacity 0.5s ease;
    }

    h2 {
      transition: text-shadow 0.2s ease;
      
       }

      h2:hover {
      text-shadow: 0 0 10px #af87f8), 0 0 10px #af87f8);
      }
     
    .login-box {
      background-color:  #ffffff;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      animation: fadeIn 0.6s ease;
    }

    .link-cadastrar {
       color: #0d6efd;
  font-weight: 500;
  transition: all 0.3s ease;
  text-decoration: none;
      text-decoration: none;
    }

    .login-title {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-weight: bold;
      background: linear-gradient(to right, #0d6efd, #af87f8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
      text-align: center;
      font-size: 2.5rem;
      margin-top: 60px;
      margin-bottom: -150px;
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

    .link-cadastrar:hover {
       color: #063eaa;
  text-decoration: underline;
  text-shadow: 0 0 4px #0d6efd55;
    }

    @media (max-width: 575.98px) {
      .login-box {
        padding: 1.5rem;
      }
    }
   
    input:focus {
     border-color: #0d6efd;
     box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
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

  
  <div id="loading-screen">
  <div class="spinner"></div>
</div>
  
  
<h2 class="login-title">Bem vindo de volta!</h2>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    
    <div class="login-box">
      <h4 class="text-center mb-4">Login</h4>
      <form action="login_processa.php" method="POST" novalidate>
        <div class="mb-3">
          <label class="form-label">E-mail</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="button btn btn-primary w-100">Entrar</button>
      </form>
      <div class="text-center mt-3">
        <p>Não tem uma conta ainda? <a href="cadastro.php" class="link-cadastrar">Cadastre-se</a></p>
      </div>
    </div>
  </div>
  <footer>
  <div class="container">
    <small>&copy; <?= date("Y") ?> rp. Todos os direitos reservados.</small>
  </div>
  </footer>

  <script>
  window.addEventListener('load', () => {
    const loadingScreen = document.getElementById('loading-screen');
    loadingScreen.style.opacity = '0';
    setTimeout(() => loadingScreen.style.display = 'none', 1000);
  });
</script>
</body>
</html>
