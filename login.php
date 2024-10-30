<?php
session_start();
include 'conexion.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se enviaron los datos del formulario
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Preparar y ejecutar la consulta
    $query = "SELECT * FROM usuarios WHERE usuario = ? AND contraseña = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si la consulta devolvió un resultado
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['nombre'] = $row['nombre']; // Cambia 'nombre' al campo correcto en tu base de datos
        $_SESSION['rol'] = $row['rol']; // Asegúrate de que 'rol' sea el campo adecuado

        // Redirigir según el rol del usuario
        if ($row['rol'] === 'administrador') {
            header("Location: index.php");
        } else {
            header("Location: index1.php"); //Originalmente => usuario.php
        }
        exit(); // Asegúrate de salir después de la redirección
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="container">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form action="login.php" method="POST" class="bg-light p-4 rounded shadow">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" id="usuario" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <button type="submit" name="Iniciar" class="btn btn-primary w-100">Iniciar</button>
        </form>
        <p class="text-center mt-3">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
