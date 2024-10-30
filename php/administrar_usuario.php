<?php
// Incluir archivo de conexión
include('../conexion.php');

// Función para agregar un nuevo usuario
function agregarUsuario($nombre, $email, $password) {
    global $conn;
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Función para eliminar un usuario
function eliminarUsuario($id) {
    global $conn;
    $sql = "DELETE FROM usuarios WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Función para actualizar un usuario
function actualizarUsuario($id, $nombre, $email, $password) {
    global $conn;
    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', password='$password' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Función para listar todos los usuarios
function listarUsuarios() {
    global $conn;
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. " - Email: " . $row["email"]. "<br>";
        }
    } else {
        echo "No hay usuarios";
    }
}

// Ejemplos de uso
// agregarUsuario('Juan Perez', 'juan@example.com', '123456');
// eliminarUsuario(1);
// actualizarUsuario(2, 'Maria Lopez', 'maria@example.com', 'abcdef');
// listarUsuarios();

$conn->close();
?>