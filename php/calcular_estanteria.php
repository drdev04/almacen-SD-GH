<?php


include('../conexion.php'); // Incluir el archivo de conexión

// Si se envía el formulario, realizar la consulta
if (isset($_POST['estanteria'])) {
    $estanteria = $_POST['estanteria'];

    // Consulta para calcular el precio total por estantería
    $sql = "SELECT SUM(precio) as total FROM bebidas WHERE id_estanteria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $estanteria); // Enlazamos el parámetro de estantería
    $stmt->execute();
    $result = $stmt->get_result();

    // Contenedor con estilos para mostrar el resultado
    echo "<div class='container mt-4'>";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class='alert alert-success' role='alert'>El precio total de los productos en la estantería " . htmlspecialchars($estanteria) . " es: " . $row['total'] . " soles.</div>";
    } else {
        echo "<div class='alert alert-warning' role='alert'>No hay productos registrados para la estantería seleccionada.</div>";
    }
    echo "</div>";

    $stmt->close();
} else {
    // Mostrar el formulario si aún no se ha enviado el formulario
    ?>
 
    
    <div class="container mt-4">
        <form method="POST" action="php/calcular_estanteria.php" class="p-4 bg-light border rounded">
            <div class="mb-3">
                <label for="estanteria" class="form-label">Selecciona una estantería:</label>
                <select name="estanteria" id="estanteria" class="form-select">
                    <?php
                    // Obtener todas las estanterías de la base de datos para mostrarlas en el dropdown
                    $sql = "SELECT id, ubicacion FROM estanterias";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['ubicacion']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay estanterías disponibles</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Calcular precio por estantería</button>
        </form>
    </div>
    <?php
}

$conn->close();
?>
