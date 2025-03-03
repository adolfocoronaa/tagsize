<?php
session_start();
include "db_connection.php"; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre   = trim($_POST["nombre"]);
    $email    = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validación de campos vacíos
    $errores = [];
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }
    if (empty($password) || strlen($password) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }
    if (!empty($errores)) {
        $_SESSION["errores"] = $errores;
        header("Location: ../Views/error.php");
        exit();
    }

    // Verificar si el correo ya existe en la base de datos
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $_SESSION["errores"] = ["El correo ya está registrado."];
        header("Location: ../Views/error.php");
        exit();
    }

    // Insertar nuevo usuario sin encriptar la contraseña
    $tipo_usuario = 'E'; // Tipo de usuario por defecto

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, tipo_usuario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $email, $password, $tipo_usuario);

    if ($stmt->execute()) {
        $_SESSION["mensaje_exito"] = "Usuario registrado correctamente.";
        header("Location: ../Views/success.php");
        exit();
    } else {
        $_SESSION["errores"] = ["Error al registrar el usuario."];
        header("Location: ../Views/error.php");
        exit();
    }
}

$conn->close();
?>
