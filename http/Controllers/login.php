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

    // Consulta SQL para buscar el usuario en la nueva base de datos
    $sql = "SELECT id_usuarios, nombre_usuario, email_usuario, password_usuario, tipo_usuario FROM usuarios WHERE email_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Comparar directamente sin password_verify() (Se recomienda almacenar contraseñas hasheadas)
        if ($password == $usuario["password_usuario"]) {
            // Iniciar sesión y almacenar datos del usuario
            $_SESSION["usuario_id"] = $usuario["id_usuarios"];
            $_SESSION["usuario_nombre"] = $usuario["nombre_usuario"];
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

