<?php


include('../conexion.php'); // Incluir el archivo de conexión

// Consulta para obtener la información de las bebidas y las estanterías
$sql = "SELECT bebidas.*, estanterias.ubicacion AS estanteria_ubicacion 
        FROM bebidas 
        LEFT JOIN estanterias ON bebidas.id_estanteria = estanterias.id";
$result = $conn->query($sql);

echo "<div class='container mt-5'>"; // Contenedor con margen superior



// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Clase table-responsive para hacer la tabla adaptable
    echo "<div class='table-responsive shadow-sm p-3 mb-5 bg-body-tertiary rounded'>"; // Añadimos sombra y redondeado
    echo "<table class='table table-striped table-bordered table-hover'>"; // Tabla con bordes, líneas y efecto hover
    echo "<thead class='table-dark'><tr> <!-- Cabecera con fondo oscuro --> 
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Litros</th>
            <th>Precio</th>
            <th>Origen</th>
            <th>Porcentaje Azúcar</th>
            <th>Promoción</th>
            <th>Estantería</th> <!-- Añadimos columna de Estantería -->
          </tr></thead>";
    echo "<tbody>";
    // Mostrar los datos en una tabla HTML
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["tipo"] . "</td>
                <td>" . $row["litros"] . "</td>
                <td>" . $row["precio"] . "</td>
                <td>" . ($row["origen"] ? $row["origen"] : "N/A") . "</td>
                <td>" . ($row["porcentaje_azucar"] !== NULL ? $row["porcentaje_azucar"] : "N/A") . "</td>
                <td>" . ($row["promocion"] ? "Sí" : "No") . "</td>
                <td>" . ($row["estanteria_ubicacion"] ? $row["estanteria_ubicacion"] : "No asignada") . "</td> <!-- Mostrar la estantería -->
              </tr>";
    }
    echo "</tbody></table>";
    echo "</div>"; // Cierra el contenedor de tabla responsive
    echo "</div>"; // Cierra el contenedor principal
} else {
    echo "<div class='alert alert-warning mt-4 text-center'>No se encontraron bebidas.</div>"; // Mensaje si no hay datos
}

$conn->close();
?>
