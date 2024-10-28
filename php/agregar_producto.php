<?php

// Incluir el archivo de conexión
include('../conexion.php');

// Si el formulario fue enviado, procesar los datos
if (isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['litros']) && isset($_POST['precio']) && isset($_POST['origen']) && isset($_POST['porcentaje_azucar']) && isset($_POST['promocion']) && isset($_POST['id_estanteria'])) {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $litros = $_POST['litros'];
    $precio = $_POST['precio'];
    $origen = $_POST['origen'];
    $porcentaje_azucar = $_POST['porcentaje_azucar'];
    $promocion = $_POST['promocion'];
    $id_estanteria = $_POST['id_estanteria'];

    // Preparar la consulta SQL para insertar el nuevo producto
    $sql = "INSERT INTO bebidas (nombre, tipo, litros, precio, origen, porcentaje_azucar, promocion, id_estanteria) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // El bind_param debe tener una cadena de 8 caracteres para los 8 valores.
    $stmt->bind_param("ssddssdi", $nombre, $tipo, $litros, $precio, $origen, $porcentaje_azucar, $promocion, $id_estanteria);

    if ($stmt->execute()) {
        // Mostrar una alerta de éxito usando PHP
        echo "<script>alert('Producto agregado exitosamente.'); window.location.href = '../index.html';</script>";
        exit(); // Detener la ejecución para que no vuelva a mostrar el formulario
    } else {
        echo "<script>alert('Error al agregar el producto.'); window.location.href = '../index.html';</script>";
        exit(); // Detener la ejecución en caso de error
    }

    $stmt->close();
} else {
    // Mostrar el formulario si aún no se ha enviado el formulario
    ?>

    <!-- Formulario para agregar productos -->
    <form method="POST" action="php/agregar_producto.php">
        <label for="nombre">Nombre del producto:</label>
        <input type="text" name="nombre" id="nombre" required class="form-control">

        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" required class="form-control">

        <label for="litros">Litros:</label>
        <input type="number" step="0.01" name="litros" id="litros" required class="form-control">

        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio" id="precio" required class="form-control">

        <label for="origen">Origen:</label>
        <input type="text" name="origen" id="origen" class="form-control">

        <label for="porcentaje_azucar">Porcentaje de Azúcar:</label>
        <input type="number" step="0.01" name="porcentaje_azucar" id="porcentaje_azucar" class="form-control">

        <label for="promocion">¿Está en promoción?</label>
        <select name="promocion" id="promocion" class="form-control">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>

        <label for="id_estanteria">Selecciona una estantería:</label>
        <select name="id_estanteria" id="id_estanteria" class="form-control">
            <?php
            // Obtener todas las estanterías de la base de datos
            $sql = "SELECT id, ubicacion FROM estanterias";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['ubicacion']) . "</option>";
                }
            }
            ?>
        </select>

        <button type="submit" class="btn btn-primary mt-2">Agregar producto</button>
    </form>
    <?php
}

$conn->close();
?>
