<?php
include 'conexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta SQL para evitar inyección SQL
    $sql = $conn->prepare("DELETE FROM `t-estudiante` WHERE id = ?");
    $sql->bind_param("i", $id);  // "i" indica que es un parámetro entero

    // Ejecutar la consulta
    if ($sql->execute()) {
        // Redirigir a la página de listado después de eliminar
        header("Location: mostrar.php");
        exit();  // Terminar la ejecución después de la redirección
    } else {
        echo "Error al eliminar el registro: " . $sql->error;
    }

    // Cerrar la consulta
    $sql->close();
} else {
    echo "ID no válido o no proporcionado.";
}

$conn->close();
?>
