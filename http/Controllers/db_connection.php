<?php
$host = "localhost";  // Servidor de MySQL
$user = "root";       // Usuario de MySQL (cambia si usas otro)
$password = "oracle";       // Contraseña de MySQL (déjala vacía si no configuraste una)
$dbname = "tennis";   // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} 

// Si la conexión es exitosa
echo "✅ Conexión exitosa a la base de datos.";
?>
