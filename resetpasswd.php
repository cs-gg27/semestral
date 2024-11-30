<?php
include 'db.php'; // Archivo que contiene la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $new_password = $_POST['new_password'];

    // Verificar que ambos campos estén completos
    if (!empty($correo) && !empty($new_password)) {
        $conexion = new Conecta(); // Clase para la conexión a la base de datos
        $conn = $conexion->conectarDB();

        // Verificar si el correo existe en la base de datos
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Actualizar la contraseña del usuario
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            $stmt->close(); // Cerramos el primer statement antes de crear el segundo

            $update_stmt = $conn->prepare("UPDATE usuarios SET password_hash = ? WHERE correo = ?");
            $update_stmt->bind_param("ss", $hashed_password, $correo);

            if ($update_stmt->execute()) {
                $message = "La contraseña ha sido actualizada correctamente.";
            } else {
                $message = "Error al actualizar la contraseña. Inténtalo nuevamente.";
            }
            $update_stmt->close();
        } else {
            $message = "No se encontró una cuenta registrada con ese correo.";
            $stmt->close(); // Cerramos el statement si no se encuentra el correo
        }

        $conn->close();
    } else {
        $message = "Por favor, completa todos los campos.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Restablecer contraseña">
    <meta name="author" content="Torre de Libros">
    <title>Restablecer Contraseña | Torre de Libros</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
        body {
            background-color: #f5f5f5;
        }
        .form-reset {
            max-width: 400px;
            padding: 15px;
            margin: auto;
        }
        .btn-reset {
            background-color: #b35759;
            border-color: #b35759;
        }
        .btn-reset:hover {
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
<header>
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="login.php">
                <img src="img/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                TORRE DE LIBROS |
            </a>
        </div>
    </nav>
</header>

<main class="form-reset">
    <br><br><br>
    <form action="resetpasswd.php" method="post">
        <img class="mb-4 mx-auto d-block" src="img/logo.png" alt="Logo Torre de Libros" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal text-center">Restablecer Contraseña</h1>

        <!-- Campo para el correo electrónico -->
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingEmail" name="correo" placeholder="name@example.com" required>
            <label for="floatingEmail">Correo Electrónico</label>
        </div>

        <!-- Campo para la nueva contraseña -->
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingNewPassword" name="new_password" placeholder="Nueva Contraseña" required>
            <label for="floatingNewPassword">Nueva Contraseña</label>
        </div>

        <button class="btn btn-reset w-100 py-2" type="submit">Restablecer Contraseña</button>
        <p class="mt-3 text-center">
            <a href="login.php">Volver al inicio de sesión</a>
        </p>

        <!-- Mostrar mensajes -->
        <?php if (isset($message)): ?>
            <div class="alert alert-info mt-3 text-center" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
    </form>
</main>

<footer class="footer">
    <p>&copy; 2024 Torre de Libros. Todos los derechos reservados.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

