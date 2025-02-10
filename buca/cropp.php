<?php

include 'conexion.php';


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM `t-estudiante` WHERE id = ?";


    if ($conn->query($sql) === TRUE) {

        header("Location: mostrar.php");

    } else {

        echo "Error deleting record: " . $conn->error;

    }

}


$conn->close();

?>