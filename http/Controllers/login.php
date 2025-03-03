<?php
session_start();
include "db_connection.php"; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validación de campos vacíos
    if (empty($email) || empty($password)) {
        echo "❌ Todos los campos son obligatorios.";
        exit;
    }

    // Consulta SQL para buscar el usuario
    $sql = "SELECT id, nombre, email, password, tipo_usuario FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Comparar directamente sin password_verify()
        if ($password == $usuario["password"]) {
            // Iniciar sesión y almacenar datos del usuario
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nombre"] = $usuario["nombre"];
            $_SESSION["usuario_tipo"] = $usuario["tipo_usuario"];

            // Redirigir al dashboard
            header("Location: ../../html/dashboard.html");
            exit;
        } else {
            echo "❌ Contraseña incorrecta.";
        }
    } else {
        echo "❌ Usuario no encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>
