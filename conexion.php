<?php
$servername = "localhost"; // Cambia localhost a jupiter
$username = "root";
$password = ""; // Asegúrate de que la contraseña sea correcta
$dbname = "almacen_bebidas";
$port = 3306; // Especificar el puerto

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
