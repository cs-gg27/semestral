<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Libros</title>
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
            <a class="nav-link active" href="libros.php">Libros</a>
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

<main>
  <div>
    <img src="img/shop_banner.png" class="d-block w-100">
  </div>

  <!-- Libros Section -->
  <section class="container py-5">
    <h2 class="text-center mb-4">Elige tu próxima aventura</h2>
    <div class="row">
      <?php
        include 'db.php';  // Incluir archivo de conexión

        $conexion = new Conecta();
        $cnn = $conexion->conectarDB();

        $query = "SELECT * FROM libros";  // Consulta de todos los libros
        $result = $cnn->query($query);

        while ($libro = $result->fetch_assoc()):  // Recorrer los libros disponibles
      ?>
        <div class="col-md-4">
          <div class="card">
            <!-- Mostrar la imagen del libro desde la base de datos -->
            <img src="<?php echo htmlspecialchars($libro['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($libro['titulo']); ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($libro['titulo']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($libro['autor']); ?></p>
              <p class="text-primary">$<?php echo htmlspecialchars($libro['precio']); ?></p>
              <a href="#" class="btn btn-primary comprar-btn" data-id="<?php echo $libro['id']; ?>" data-titulo="<?php echo htmlspecialchars($libro['titulo']); ?>" data-precio="<?php echo $libro['precio']; ?>">Comprar</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<!-- Bootstrap JS desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Funcionalidad de agregar al carrito
  const botonesComprar = document.querySelectorAll('.comprar-btn');

  botonesComprar.forEach(boton => {
    boton.addEventListener('click', function (event) {
      event.preventDefault(); // Prevenir la redirección por defecto

      // Extraer información del libro
      const libro_id = this.dataset.id;
      const titulo = this.dataset.titulo;
      const precio = parseFloat(this.dataset.precio);

      // Crear un objeto para el libro
      const libro = {
        id: libro_id,
        titulo: titulo,
        precio: precio,
        cantidad: 1,
        total: precio
      };

      // Verificar si hay un carrito existente en localStorage
      let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

      // Revisar si el libro ya está en el carrito
      const libroExistente = carrito.find(item => item.id === libro_id);
      if (libroExistente) {
        libroExistente.cantidad += 1;
        libroExistente.total = libroExistente.cantidad * libroExistente.precio;
      } else {
        carrito.push(libro); // Añadir nuevo libro
      }

      // Guardar el carrito actualizado en localStorage
      localStorage.setItem('carrito', JSON.stringify(carrito));

      // Redirigir al carrito
      window.location.href = 'carrito.php';
    });
  });
</script>
</body>

<!-- FOOTER -->
<footer class="container" style="padding:25px">
  <p class="float-end"><a href="#">Back to top</a></p>
  <p>&copy; 2024 Torre de Libros. Todos los derechos reservados.</p>
</footer>
</html>
