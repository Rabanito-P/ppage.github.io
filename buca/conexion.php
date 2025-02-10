<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "if0_38156863";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Todo bien<br>";
echo '<a href="https://www.php.net/" style="color: blue;">php</a>';
echo "<td><a href='index.php?id=".$row['id']."'>VOLVER</a></td>";
?>