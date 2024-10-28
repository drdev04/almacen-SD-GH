<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia localhost a jupiter
$username = "root";
$password = ""; // Asegúrate de que la contraseña sea correcta
$dbname = "almacen_bebidas";
$port = 3306; // Especificar el puerto

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$contraseña = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña
$rol = 'usuario'; // Asignar rol de usuario de forma predeterminada
$estado = 'activo'; // Estado predeterminado

// Insertar usuario en la base de datos
$sql = "INSERT INTO usuarios (usuario, nombre, apellido, contraseña, email, rol, estado) 
        VALUES ('$usuario', '$nombre', '$apellido', '$contraseña', '$email', '$rol', '$estado')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Registro exitoso. Ahora puedes iniciar sesión.');
            window.location.href = 'login.php';
          </script>";
} else {
    echo "<script>
            alert('Error al registrar. Por favor, inténtalo de nuevo.');
            window.location.href = 'registro.php';
          </script>";
}

$conn->close();
?>
