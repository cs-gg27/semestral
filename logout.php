<?php
session_start();
session_destroy();  // Cerrar la sesión actual
header('Location: index.php');  // Redirigir al usuario a la página de inicio
exit();
?>
