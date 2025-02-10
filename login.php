<?php

require 'conectar.php';

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];

    $password = $_POST["password"];


    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");

    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["user_id"] = $user["id"];

        $_SESSION["username"] = $user["username"];

        header("Location: AdminLTE-3.2.0\index.html");

        exit;

    } else {

        echo "Usuario o contraseña incorrectos.";

    }

}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <title>Document</title>
</head>

<body class="bg-primary">
    <h1 class="text-center">fomulario</h1>

    <div class="container d-flex justify-content-center">
        <form method="POST">
            <input class="form-control" type="text" name="username" placeholder="Usuario" required><br>
            <input class="form-control" type="password" name="password" placeholder="Contraseña" required><br>
            <button  class="btn btn-outline-dark " type="submit">Iniciar Sesión</button>

            <a href="registrar.php" class="btn btn-outline-dark">Registrar</a>

        </form>
    </div>
</body>

</html>