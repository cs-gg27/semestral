<?php
// Mostrar errores en pantalla (para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db.php';  // Incluir el archivo de conexión a la base de datos

$conexion = new Conecta();
$cnn = $conexion->conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);  // Asegúrate de usar 'correo' en lugar de 'email'
    $password = $_POST['password'];

    // Preparar la consulta
    $stmt = $cnn->prepare("SELECT id, password_hash FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header('Location: users.php');  // Redirigir al perfil del usuario
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Contraseña incorrecta.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>No se encontró un usuario con ese correo.</div>";
    }

    $stmt->close();
    $conexion->cerrar();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Torre de Libros</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        background-color: #f5f5f5;
      }
      .form-login {
        max-width: 400px;
        padding: 15px;
        margin: auto;
      }
      .btn-login {
        background-color: #b35759;
        border-color: #b35759;
      }
      .btn-login:hover {
        background-color: #933f47;
        border-color: #933f47;
      }
      .footer {
        text-align: center;
        margin-top: 40px;
        padding: 10px;
        background-color: #fff;
        border-top: 1px solid #ddd;
      }
    </style>
  </head>
  <body>
    <!-- Encabezado -->
    <header>
      <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container-fluid">
          <!-- Logo añadido -->
          <a class="navbar-brand" href="#">
            <img src="img\logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top" style="color:dark-gray">
            TORRE DE LIBROS |
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php" style="color:dark-gray">Inicio</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Formulario de inicio de sesión -->
    <main class="form-login">
      <form method="POST">
        <br><br><br>
        <img class="mb-4 mx-auto d-block" src="img/logo.png" alt="Logo Torre de Libros" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal text-center">Iniciar Sesión</h1>

        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="correo" name="correo" placeholder="name@example.com" required>
          <label for="correo">Correo Electrónico</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <label for="password">Contraseña</label>
        </div>

        <button class="btn btn-login w-100 py-2" type="submit">Iniciar Sesión</button>
        <p class="mt-3 text-center">
          <a href="resetpasswd.php">¿Olvidaste tu contraseña?</a> | 
          <a href="register.php">Crear cuenta</a>
        </p>
      </form>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2024 Torre de Libros</p>
    </main>

    <!-- Pie de página -->
    <footer class="footer">
      <p>&copy; 2024 Torre de Libros. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
