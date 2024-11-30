<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';  // Conexión a la base de datos

$conexion = new Conecta();
$cnn = $conexion->conectarDB();

$user_id = $_SESSION['user_id'];

// Consulta para obtener la información del usuario
$queryUser = "SELECT nombre, apellido, correo, direccion FROM usuarios WHERE id = ?";
$stmt = $cnn->prepare($queryUser);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nombre, $apellido, $correo, $direccion);
$stmt->fetch();
$stmt->close();

// Consulta para obtener las compras del usuario
$query = $cnn->prepare("SELECT titulo_libro, precio, fecha_compra FROM compras WHERE user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TORRE DE LIBROS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="libros.php">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resenas.php">Reseñas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php">Carrito</a>
                    </li>
                </ul>
                <button onclick="location.href='logout.php'" class="btn btn-outline-dark">Logout</button>
            </div>
        </div>
    </nav>
</header>

<main class="container py-5">
    <br><br>
    <h2>Perfil de Usuario</h2>
    <h4>Información Personal</h4>
    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></li>
        <li class="list-group-item"><strong>Apellido:</strong> <?php echo htmlspecialchars($apellido); ?></li>
        <li class="list-group-item"><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($correo); ?></li>
        <li class="list-group-item"><strong>Dirección:</strong> <?php echo htmlspecialchars($direccion); ?></li>
    </ul>
    <hr>
    <div class="container py-5">
    <h2 class="text-center mb-4">Historial de Compras</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Título</th>
          <th>Precio</th>
          <th>Fecha de Compra</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($compra = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($compra['titulo_libro']); ?></td>
            <td>$<?php echo number_format($compra['precio'], 2); ?></td>
            <td><?php echo htmlspecialchars($compra['fecha_compra']); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</main>
<br><br>
<footer class="footer">
    <center>
    <p>&copy; 2024 Torre de Libros. Todos los derechos reservados.</p>
    </center>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>