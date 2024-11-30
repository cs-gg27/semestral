<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Torre de libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles (opcional, si tienes un archivo css) -->
    <link href="carousel.css" rel="stylesheet">
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
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
            <a class="nav-link active" href="index.php">Inicio</a>
          </li>
          <?php if (!isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
          <button onclick="location.href='login.php'" class="btn btn-outline-dark">Login</button>
          </li>
          <?php endif; ?>
        </ul>
        <?php if (isset($_SESSION['user_id'])): ?>
        <button onclick="location.href='logout.php'" class="btn btn-outline-dark">Logout</button>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>

<main>

<div>
    <img src="img\bannerprincipal.png" class="d-block w-100" >
</div>

<br>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <!-- Primera imagen -->
    <div class="carousel-item active">
      <img src="img\banner_l_disp.png" class="d-block w-100" alt="Slide 1">
      <div class="container">
        <div class="carousel-caption">
          <h1 style="text-shadow: black 0 -2px 3px">NUEVOS LIBROS</h1>
          <p style="color:black">.</p>
          <br>
          <p><a class="btn btn-lg btn-primary" onclick="location.href='libros.php'" style="background-color:#b35759 ; border-color:#b35759">Comprar Ahora</a></p>
        </div>
      </div>
    </div>
    <!-- Segunda imagen -->
    <div class="carousel-item">
      <img src="img\bannerclub.png" class="d-block w-100" alt="Slide 2">
      <div class="container">
        <div class="carousel-caption text-end">
          <h1 style="color:#401b01 ; text-shadow: white 0 -2px 3px">Inscríbete Ahora</h1>
          <p style="color:#000000">Ya tenemos nuevo tema de la semana el club!.</p>
          <p><a class="btn btn-lg btn-primary" href="#" style="background-color:#b35759 ; border-color:#b35759">Inscribirme</a></p>
        </div>
      </div>
    </div>
    <!-- Tercera imagen -->
    <div class="carousel-item">
      <img src="img\bannercybermon.png" class="d-block w-100" alt="Slide 2">
      <div class="container">
        <div class="carousel-caption text-end">
          <h1></h1>
          <p>.</p>
          <p><a class="btn btn-lg btn-primary" href="#">Ver mas</a></p>
        </div>
      </div>
    </div>
    <!-- Cuarta imagen -->
    <div class="carousel-item">
      <img src="img\bannerfil.png" class="d-block w-100" alt="Slide 3">
      <div class="container">
        <div class="carousel-caption text-end">
          <h1 style="text-shadow: black 0 -2px 3px">Buscanos!</h1>
          <p>Estaremos en la FILPA este año, buscanos en el stan 42!.</p>
          <p><a class="btn btn-lg btn-primary" href="#">Ver mas</a></p>
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
 
<br>
<br>

<div class="seccion_preventa">
    <center>
    <h1> Preventa: Born of Blood and Ashes </h1>
    <h3 class="text-center mb-4">Elige tu próxima aventura</h3>
    </center>
    <section class="container py-5">
        
        <div class="row">
            <!-- Libro preventa -->
            <center>
            <div class="col-md-4">
                <div class="card">
                    <img src="img\libropreventa.png" class="card-img-top" alt="Libro preventa">
                    <div class="card-body">
                        <h5 class="card-title">Born of Blood and Ashes</h5>
                        <p class="card-text">Una novela de misterio que te mantendrá intrigado.</p>
                        <p class="text-primary">$35</p>
                        <a href="carrito.php" class="btn btn-primary comprar-btn" data-titulo="Born of Blood and Ashes" data-precio="35"style="background-color:#b35759 ; border-color:#b35759">Comprar</a>
                    </div>
                </div>
            </div>
            </center>
    </section>
</div>

<section class="mas-comprados">
  <h2>Los más comprados</h2>
  <div class="libros-container">
    <div class="libro-box">
      <img src="img\libros\rosas.png" alt="Una Corte de Rosas y Espinas">
      <h3>Una Corte de Rosas y Espinas</h3>
      <p>Sarah J.Maas</p>
      <p><strong>$19.99</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\seleccion.png" alt="La Selección">
      <h3>La Selección</h3>
      <p>Kiera Cass</p>
      <p><strong>$15</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\juegohambre.png" alt="Cazadores de Sombras: Ciudad de Hueso">
      <h3>Cazadores de Sombras: Ciudad de Hueso</h3>
      <p>Cassandra Clare</p>
      <p><strong>$23</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\reinomaldito.png" alt="El Reino de los Malditos">
      <h3>El Reino de los Malditos</h3>
      <p>Kerri Manislasco</p>
      <p><strong>$17</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\reypirata.png" alt="La Hija del Rey Pirata">
      <h3>La Hija del Rey Pirata</h3>
      <p>Tricia Levenseller</p>
      <p><strong>$16.50</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\magoterramar.png" alt="Un Mago de Terramar">
      <h3>Un Mago de Terramar</h3>
      <p>Ursula K.Le Guin</p>
      <p><strong>$14</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\juegoalma.png" alt="El Juego del Alma">
      <h3>El Juego del Alma</h3>
      <p>Javier Castillo</p>
      <p><strong>$18</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\galactico.png" alt="Guía del Autoestopista Galáctico">
      <h3>Guía del Autoestopista Galáctico</h3>
      <p>Douglas Adams</p>
      <p><strong>$8.99</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\muerenlosdos.png" alt="Al final mueren los dos">
      <h3>Al final mueren los dos</h3>
      <p>Dan Silveira</p>
      <p><strong>$12</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\alassangre.png" alt="Alas de sangre">
      <h3>Alas de sangre</h3>
      <p>Rebecca Yarros</p>
      <p><strong>$10.99</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\sangreceniza.png" alt="De sangre y cenizas">
      <h3>De sangre y cenizas</h3>
      <p>Jennifer Armentrout</p>
      <p><strong>$25</strong></p>
    </div>
    <div class="libro-box">
      <img src="img\libros\asesinobrujas.png" alt="Asesino de brujas">
      <h3>Asesino de brujas</h3>
      <p>Shelby Maurin</p>
      <p><strong>$17.99</strong></p>
    </div>
    <!-- Más libros aquí -->
  </div>
</section>

<style>
  .mas-comprados {
  text-align: center;
  padding: 20px;
  background-color: #f5f5f5;
}

.mas-comprados h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

.libros-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 20px;
  justify-items: center;
}

.libro-box {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 10px;
  width: 200px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.libro-box img {
  max-width: 100%;
  height: auto;
  border-radius: 4px;
}

.libro-box h3 {
  font-size: 18px;
  margin: 10px 0 5px;
}

.libro-box p {
  margin: 5px 0;
}

.libro-box strong {
  font-size: 16px;
  color: #333;
}
</style>

  <!-- FOOTER -->
  <footer class="container" style="padding:25px">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2017–2021 Company, Inc. &middot</p>
  </footer>
</main>

<!-- Bootstrap JS desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
  // Funcionalidad de agregar al carrito
  const botonesComprar = document.querySelectorAll('.comprar-btn');

  botonesComprar.forEach(boton => {
    boton.addEventListener('click', function (event) {
      event.preventDefault(); // Prevenir la redirección por defecto

      // Extraer información del libro
      const titulo = this.dataset.titulo;
      const precio = parseFloat(this.dataset.precio);

      // Crear un objeto para el libro
      const libro = {
        titulo: titulo,
        precio: precio,
        cantidad: 1,
        total: precio
      };

      // Verificar si hay un carrito existente en localStorage
      let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

      // Revisar si el libro ya está en el carrito
      const libroExistente = carrito.find(item => item.titulo === titulo);
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
</html>
