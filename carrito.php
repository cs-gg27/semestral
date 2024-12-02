<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

$conexion = new Conecta();
$cnn = $conexion->conectarDB();

$user_id = $_SESSION['user_id'];
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar_compra'])) {
    // Obtener carrito de localStorage
    $carrito = json_decode($_POST['carrito'], true);

    if (!empty($carrito)) {
        foreach ($carrito as $libro) {
            $libro_id = $libro['id'];
            $titulo = $libro['titulo'];
            $precio = $libro['precio'];

            // Obtener el nombre del usuario desde la base de datos
            $query_usuario = $cnn->prepare("SELECT nombre FROM usuarios WHERE id = ?");
            $query_usuario->bind_param("i", $user_id);
            $query_usuario->execute();
            $query_usuario->bind_result($nombre_usuario);
            $query_usuario->fetch();
            $query_usuario->close();

            // Insertar la compra en la tabla
            // Llamar al Stored Procedure para registrar la compra
            $stmt = $cnn->prepare("CALL InsertarCompra(?, ?, ?, ?, ?)");
            $stmt->bind_param("isisi", $user_id, $nombre_usuario, $libro_id, $titulo, $precio);

            $stmt->execute();
            $stmt->close();
        }

        $mensaje = "Compra realizada con éxito.";
    } else {
        $mensaje = "El carrito está vacío.";
    }

    $conexion->cerrar();

    // Redirige a users.php después de mostrar el mensaje
    echo "<script>alert('$mensaje'); window.location.href='users.php';</script>";
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito de Compras</title>
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
            <a class="nav-link" href="users.php">Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="libros.php">Libros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="carrito.php">Carrito</a>
          </li>
        </ul>
        <button onclick="location.href='logout.php'" class="btn btn-outline-dark">Logout</button>
      </div>
    </div>
  </nav>
</header>

<main>
  <section class="container py-5">
    <br>
    <h2 class="text-center mb-4">Carrito de Compras</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="carrito-body">
        <!-- Contenido generado dinámicamente -->
      </tbody>
    </table>
    <p class="text-end" id="subtotal">Subtotal: $0</p>
    <form id="form-carrito" method="POST" action="carrito.php">
      <input type="hidden" name="carrito" id="carrito-json">
      <input type="hidden" name="finalizar_compra" value="1">
      <div class="text-end">
        <button type="button" class="btn btn-danger" id="limpiar-carrito">Limpiar Carrito</button>
        <button type="submit" class="btn btn-success">Finalizar Compra</button>
      </div>
    </form>
  </section>
</main>

<script>
  function cargarCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const carritoBody = document.getElementById('carrito-body');
    const subtotalEl = document.getElementById('subtotal');

    carritoBody.innerHTML = ''; // Limpiar tabla
    let subtotal = 0;

    carrito.forEach(item => {
      subtotal += item.total;
      carritoBody.innerHTML += `
        <tr>
          <td>${item.titulo}</td>
          <td>$${item.precio.toFixed(2)}</td>
          <td>${item.cantidad}</td>
          <td>$${item.total.toFixed(2)}</td>
          <td>
            <button class="btn btn-sm btn-danger borrar-item" data-titulo="${item.titulo}">Eliminar</button>
          </td>
        </tr>
      `;
    });

    subtotalEl.textContent = `Subtotal: $${subtotal.toFixed(2)}`;
    agregarEventosEliminar();
  }

  function agregarEventosEliminar() {
    const botonesEliminar = document.querySelectorAll('.borrar-item');
    botonesEliminar.forEach(boton => {
      boton.addEventListener('click', function () {
        const titulo = this.dataset.titulo;
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        carrito = carrito.filter(item => item.titulo !== titulo);
        localStorage.setItem('carrito', JSON.stringify(carrito));
        cargarCarrito(); // Recargar carrito
      });
    });
  }

  document.getElementById('limpiar-carrito').addEventListener('click', () => {
    localStorage.removeItem('carrito');
    cargarCarrito();
  });

  document.getElementById('form-carrito').addEventListener('submit', function (event) {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    document.getElementById('carrito-json').value = JSON.stringify(carrito);
  });

  cargarCarrito();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<footer class="container" style="padding:25px">
  <p class="float-end"><a href="#">Back to top</a></p>
  <p>&copy; 2024 Torre de Libros. Todos los derechos reservados.</p>
</footer>
</html>

