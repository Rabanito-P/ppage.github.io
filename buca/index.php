<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "if0_38156863";
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Si hay datos del formulario, insertar el nuevo alumno
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['email'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "INSERT INTO `t-estudiante` (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nuevo alumno agregado exitosamente');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

// Obtener todos los alumnos de la base de datos
$sql = "SELECT * FROM `t-estudiante` WHERE 1";
$result = $conn->query($sql);

$alumnos = [];
if ($result->num_rows > 0) {
    // Recoger los alumnos en un array
    while($row = $result->fetch_assoc()) {
        $alumnos[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #ccc;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"] {
            padding: 8px;
            width: 100%;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 8px 16px;
            background-color: #E8BB5D;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 10px;
            color: #4CAF50;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Gestión de Alumnos</h1>

        <!-- Formulario para agregar un alumno -->
        <div class="form-container">
            <form method="POST" action="">
                <input type="text" name="name" id="name" placeholder="Nombre del alumno" required>
                <input type="email" name="email" id="email" placeholder="Email del alumno" required>
                <button type="submit">Agregar Alumno</button>
            </form>
        </div>

        <!-- Tabla de alumnos -->
        <table id="tablaAlumnos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los alumnos se llenarán dinámicamente desde PHP -->
                <?php
                if (!empty($alumnos)) {
                    foreach ($alumnos as $alumno) {
                        echo "<tr>
                                <td>{$alumno['id']}</td>
                                <td>{$alumno['name']}</td>
                                <td>{$alumno['email']}</td>
                                <td><a href='eliminar.php?id={$alumno['id']}'>Eliminar</a></td>
                                </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay alumnos registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>



</body>
</html>
