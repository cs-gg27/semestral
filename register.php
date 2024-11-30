<?php
include 'db.php';  // Asegúrate de incluir tu archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Encriptar la contraseña
    $direccion = htmlspecialchars($_POST['direccion']);

    $conexion = new Conecta();
    $cnn = $conexion->conectarDB();

    // Verificar si el correo ya existe
    $stmt = $cnn->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Este correo ya está registrado.";
    } else {
        // Insertar nuevo usuario
        $stmt = $cnn->prepare("INSERT INTO usuarios (nombre, apellido, correo, password_hash, direccion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellido, $correo, $password, $direccion);

        if ($stmt->execute()) {
            echo "Usuario registrado correctamente.";
        } else {
            echo "Error al registrar el usuario.";
        }
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
    <meta name="description" content="Página de Registro">
    <meta name="author" content="Torre de Libros">
    <title>Registrarse | Torre de Libros</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
      body {
        background-color: #f5f5f5;
      }
      .form-register {
        max-width: 400px;
        padding: 15px;
        margin: auto;
      }
      .btn-register {
        background-color: #b35759;
        border-color: #b35759;
      }
      .btn-register:hover {
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
              <li class="nav-item">
                <a class="nav-link" href="libros.php" style="color:dark-gray">Libros</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="resenas.php" style="color:dark-gray">Reseñas</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main class="form-register">
      <br><br><br>
      <form method="POST">
        <img class="mb-4 mx-auto d-block" src="img/logo.png" alt="Logo Torre de Libros" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal text-center">Crear Cuenta</h1>

        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
          <label for="nombre">Nombre Completo</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
          <label for="apellido">Apellido</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="correo" name="correo" placeholder="name@example.com" required>
          <label for="correo">Correo Electrónico</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
          <label for="password">Contraseña</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
          <label for="direccion">Dirección</label>
        </div>

        <button class="btn btn-register w-100 py-2" type="submit">Registrarse</button>
        <p class="mt-3 text-center">
          <a href="login.php">Ya tengo una cuenta</a>
        </p>
      </form>
    </main>

    <footer class="footer">
      <p>&copy; 2024 Torre de Libros. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

