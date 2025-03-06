<?php
header("Content-Type: application/json");
include "db_connection.php"; // Conectar a la base de datos

$sql = "SELECT id_productos, nombre_producto, precio_producto, stock_del_producto FROM productos";
$result = $conn->query($sql);

$productos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Devolver JSON válido
echo json_encode($productos);
$conn->close();
?>

