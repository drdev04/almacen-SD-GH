<?php

// Incluir el archivo de conexión
include('../conexion.php');

// Si el formulario fue enviado, procesar la eliminación
if (isset($_POST['ids'])) {
    $ids = $_POST['ids'];

    // Limpiar la entrada y separar los IDs por comas
    $ids_array = array_map('intval', explode(',', $ids));

    if (count($ids_array) > 0) {
        // Convertir el array a una cadena separada por comas
        $ids_string = implode(',', $ids_array);

        // Preparar la consulta SQL para eliminar los productos por ID
        $sql = "DELETE FROM bebidas WHERE id IN ($ids_string)";
        
        if ($conn->query($sql)) {
            // Mostrar una alerta de éxito usando PHP
            echo "<script>alert('Productos eliminados exitosamente.'); window.location.href = '../index.html';</script>";
            exit(); // Detener la ejecución para que no vuelva a mostrar el formulario
        } else {
            echo "<script>alert('Error al eliminar los productos.'); window.location.href = '../index.html';</script>";
            exit(); // Detener la ejecución en caso de error
        }
    } else {
        echo "<script>alert('No se proporcionaron IDs válidos.'); window.location.href = '../index.html';</script>";
    }
} else {
    // Mostrar el formulario si aún no se ha enviado el formulario
    ?>

    <!-- Formulario para eliminar productos por múltiples IDs -->
    <form method="POST" action="php/eliminar_producto.php">
        <label for="ids">IDs de los productos a eliminar (separados por comas):</label>
        <input type="text" name="ids" id="ids" placeholder="Ejemplo: 1,2,3,4" required class="form-control">

        <button type="submit" class="btn btn-danger mt-2">Eliminar productos</button>
    </form>
    <?php
}

$conn->close();
?>
