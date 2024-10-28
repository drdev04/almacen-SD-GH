<?php

// Incluir el archivo de conexión
include('../conexion.php');

// Si se envía el formulario, realizar la consulta
if (isset($_POST['marca'])) {
    $marca = $_POST['marca'];

    // Consulta para calcular el precio total por marca
    $sql = "SELECT SUM(precio) as total FROM bebidas WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $marca); // Enlazamos el parámetro de marca
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='container mt-4 d-flex justify-content-center'>"; // Contenedor con centrado

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Usamos la clase de Bootstrap 'alert' con estilo 'info' para el resultado
        echo "<div class='alert alert-info text-center' style='width: 100%; max-width: 800px;' role='alert'>";
        echo "El precio total de la marca <strong>" . htmlspecialchars($marca) . "</strong> es: <strong>" . $row['total'] . " soles</strong>.";
        echo "</div>";
    } else {
        // Si no hay bebidas, mostrar una alerta de advertencia
        echo "<div class='alert alert-warning text-center' style='width: 100%; max-width: 800px;' role='alert'>";
        echo "No hay bebidas registradas para la marca seleccionada.";
        echo "</div>";
    }

    echo "</div>"; // Cerrar el contenedor

    $stmt->close();
} else {
    // Mostrar formulario si aún no se ha enviado el formulario
    ?>
 
        
    <form method="POST" action="php/calcular_marca.php" class="mt-4">
        <div class="form-group">
            <label for="marca">Selecciona una marca:</label>
            <select name="marca" id="marca" class="form-control">
                <?php
                // Obtener todas las marcas de la base de datos para mostrarlas en el dropdown
                $sql = "SELECT DISTINCT nombre FROM bebidas";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['nombre']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Calcular precio por marca</button>
    </form>
    <?php
}

$conn->close();
?>
