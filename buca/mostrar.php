<?php
include 'conexion.php';

// Asegurarse de que la conexión esté activa antes de realizar la consulta
if ($conn) {
    $sql = "SELECT id, name, email, create_at FROM `t-estudiante`";  // Usa backticks alrededor del nombre de la tabla
    $result = $conn->query($sql);
} else {
    die("Error en la conexión: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>

<body>

    <h2>Lista de Usuarios</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha de Creación</th>
        </tr>

        <?php
        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>" . htmlspecialchars($row["create_at"]) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay datos disponibles</td></tr>";
        }
        ?>

    </table>

    <?php
    // Cerrar la conexión al final
    $conn->close();
    ?>

</body>

</html>
