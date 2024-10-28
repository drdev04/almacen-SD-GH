<?php
session_start();
include 'conexion.php';

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si hay un usuario conectado
if (isset($_SESSION['id'])) {
    $usuario_id = $_SESSION['id']; // Asumiendo que el ID del usuario se almacena en la sesión

    // Cambiar el estado del usuario a "inactivo"
    $updateQuery = "UPDATE usuarios SET estado = 'inactivo' WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("i", $usuario_id); // Suponiendo que el ID del usuario es un entero
    $updateStmt->execute();
    $updateStmt->close(); // Cerrar la declaración de actualización

    // Destruir la sesión
    session_unset(); // Libera todas las variables de sesión
    session_destroy(); // Destruye la sesión actual

    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.html?mensaje=Sesión cerrada con éxito");
    exit(); // Asegúrate de salir después de la redirección
} else {
    // Si no hay sesión activa, redirigir a login
    header("Location: login.php");
    exit();
}
?>
