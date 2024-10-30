<?php
session_start();
require 'conexion.php'; // Asegúrate de que el archivo de conexión esté incluido

// Obtener datos del formulario de inicio de sesión
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Consulta para obtener el hash de la contraseña y el rol del usuario
$sql = "SELECT id, nombre, contraseña, rol, estado FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

// Verifica si el usuario existe
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $nombre, $hashed_password, $rol, $estado);
    $stmt->fetch();

    // Verifica que el usuario esté activo
    if ($estado !== 'activo') {
        echo "<script>
                alert('Cuenta inactiva. Por favor, contacta con el administrador.');
                window.location.href = 'login.php';
              </script>";
        exit();
    }

    // Verifica la contraseña
    if (password_verify($password, $hashed_password)) {
        // Contraseña correcta: inicia sesión
        $_SESSION['id'] = $id;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['rol'] = $rol;

        // Redirecciona según el rol
        if ($rol === 'administrador') {
            header("Location: index.php");
        } else {
            header("Location: login1.php");
        }
        exit();
    } else {
        // Contraseña incorrecta
        echo "<script>
                alert('Contraseña incorrecta.');
                window.location.href = 'login.php';
              </script>";
    }
} else {
    // Usuario no encontrado
    echo "<script>
            alert('Usuario no encontrado.');
            window.location.href = 'login.php';
          </script>";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
