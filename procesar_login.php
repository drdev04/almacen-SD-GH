<?php
session_start();

// Conexión a la base de datos
$servername = "localhost"; // Cambia localhost a jupiter
$username = "root";
$password = ""; // Asegúrate de que la contraseña sea correcta
$dbname = "almacen_bebidas";
$port = 3306; // Especificar el puerto

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['password'];

// Consulta para verificar el usuario
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($contraseña, $row['contraseña'])) {
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['rol'] = $row['rol'];

        // Establecer variable de sesión para mostrar el mensaje de bienvenida
        $_SESSION['registro_exitoso'] = true;

        // Redirigir al index
        header("Location: index.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}

$conn->close();
?>
