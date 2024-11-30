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
    <title>Reseñas</title>
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
            <a class="nav-link active" href="resenas.php">Reseñas</a>
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
    <img src="img\resena_banner.png" class="d-block w-100" >
</div>

<div class="container py-5">
  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading fw-normal lh-1">
        "Asesino de brujas (Shelby Mahurin)"
        <span class="text-muted">- Juan Pérez</span>
      </h2>
      <p class="lead">
        "Este libro me atrapó desde el primer capítulo. Una historia de fantasía oscura que mezcla romance prohibido y magia en un mundo marcado por la persecución de brujas. Lou y Reid, dos personajes opuestos, deben trabajar juntos para sobrevivir, lo que genera una tensión romántica que es el núcleo de la trama. Si bien los personajes son cautivadores, el ritmo puede decaer en algunos momentos. Es una lectura ideal para fans de la fantasía romántica con tintes oscuros"
      </p>
    </div>
    <div class="col-md-5 order-md-1">
      <img class="bd-placeholder-img featurette-image img-fluid mx-auto" src="img\libros\asesinobrujas.png" alt="Portada del libro reseñado" width="500" height="500">
    </div>
  </div>

  <hr class="featurette-divider">

  <!-- Otra reseña -->
  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading fw-normal lh-1">
        "El juego del alma (Javier Castillo)"
        <span class="text-muted">- María García</span>
      </h2>
      <p class="lead">
        "Un thriller psicológico que combina misterio, drama y un toque de romance. La novela sigue a un periodista que investiga un caso enredado mientras lidia con traumas personales. Castillo logra mantener al lector al filo con giros inesperados y un ritmo ágil, aunque algunos personajes secundarios no están tan desarrollados como podrían. Perfecto para quienes disfrutan de thrillers intensos con trasfondos emocionales."
      </p>
    </div>
    <div class="col-md-5">
      <img class="bd-placeholder-img featurette-image img-fluid mx-auto" src="img\libros\juegoalma.png" alt="Portada del libro reseñado" width="500" height="500">
    </div>
  </div>

  <hr class="featurette-divider">

  <!-- 3ra reseña -->


  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading fw-normal lh-1">
        "La hija del rey pirata (Tricia Levenseller)"
        <span class="text-muted">- Juan Pérez</span>
      </h2>
      <p class="lead">
        "Una novela de aventuras repleta de romance y acción. Alosa, la protagonista, es una pirata audaz y astuta que se embarca en una misión secreta a bordo de un barco enemigo. La trama combina elementos de misterio y humor, mientras la protagonista lucha por demostrar su independencia en un mundo gobernado por hombres. Aunque la narrativa es dinámica y entretenida, algunos giros son previsibles. Ideal para quienes buscan una lectura ligera con toques de fantasía y una heroína carismática."
      </p>
    </div>
    <div class="col-md-5 order-md-1">
      <img class="bd-placeholder-img featurette-image img-fluid mx-auto" src="img\libros\reypirata.png" alt="Portada del libro reseñado" width="500" height="500">
    </div>
  </div>

  <hr class="featurette-divider">

  <!-- 4ta reseña -->

  <div class="row featurette">
    <div class="col-md-7">
      <h2 class="featurette-heading fw-normal lh-1">
        "Guía del autoestopista galáctico (Douglas Adams)"
        <span class="text-muted">- María García</span>
      </h2>
      <p class="lead">
        "Una obra de ciencia ficción hilarante que mezcla el absurdo con la crítica social. Arthur Dent, un humano ordinario, se ve lanzado a un viaje cósmico tras la destrucción de la Tierra. La narrativa está llena de diálogos ingeniosos, situaciones surrealistas y reflexiones existenciales envueltas en humor británico. Aunque el estilo puede desorientar al principio, su originalidad y sátira lo convierten en un clásico imprescindible para amantes del género."
      </p>
    </div>
    <div class="col-md-5">
      <img class="bd-placeholder-img featurette-image img-fluid mx-auto" src="img\libros\galactico.png" alt="Portada del libro reseñado" width="500" height="500">
    </div>
  </div>


</div>
