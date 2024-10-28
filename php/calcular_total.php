<?php


// Incluir el archivo de conexión
include('../conexion.php');

// Consulta para calcular el precio total de todas las bebidas
$sql = "SELECT SUM(precio) as total FROM bebidas";
$result = $conn->query($sql);

// Contenedor con estilos para mostrar el resultado
echo "<div class='container mt-4'>";


// Mostrar el resultado con el color de alerta celeste (info)
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='alert alert-info' role='alert'>El precio total de todas las bebidas es: <strong>" . $row['total'] . " soles</strong></div>";
} else {
    echo "<div class='alert alert-warning' role='alert'>No hay bebidas registradas.</div>";
}

echo "</div>"; // Cerrar contenedor

// Cerrar la conexión
$conn->close();
?>
