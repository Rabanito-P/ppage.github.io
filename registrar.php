<?php

require 'conectar.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["regi"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Verifica si el nombre de usuario ya existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "El nombre de usuario ya está registrado.";
    } else {
        // Inserta el nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $password])) {
            echo "<script>alert('Registrado correctamente');</script>";
        } else {
            echo "<script>alert('ERROR');</script>";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logi"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: AdminLTE-3.2.0\index.php");
        exit;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="POST">
                <label for="chk" aria-hidden="true">Registrar</label>
                <input type="text" name="username" placeholder="Usuario" required=""><br>
                <input type="password" name="password" placeholder="Contraseña" required=""><br>
                <button type="submit" name="regi">Registrar</button>
            </form>
        </div>

        <div class="login">
            <form method="POST">
                <label for="chk" aria-hidden="true">Iniciar Sesion</label>
                <input class="form-control" type="text" name="username" placeholder="Usuario" required><br>
                <input class="form-control" type="password" name="password" placeholder="Contraseña" required><br>
                <button class="btn btn-outline-dark " type="submit" name="logi">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>

</html>



<!-- !!!!!!!!!!!!!!!!!!!!!!!! -->