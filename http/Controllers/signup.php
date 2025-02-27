<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre   = $_POST["nombre"]   ?? "";
    $email    = $_POST["email"]    ?? "";
    $password = $_POST["password"] ?? "";

    // Validaciones
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
        // Guardar errores en sesión y redirigir a error.php
        $_SESSION["errores"] = $errores;
        header("Location: ../Views/error.php");
        exit();
    } else {
        // Redirigir a la página de éxito
        header("Location: ../Views/success.php");
        exit();
    }
}
?>
