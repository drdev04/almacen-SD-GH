<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    // Redirige al login si no hay una sesión activa
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h2>
    <p>Has iniciado sesión correctamente.</p>
</body>
</html>
