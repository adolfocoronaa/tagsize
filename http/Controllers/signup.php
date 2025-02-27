<?php
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
        foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='../../html/signup.html'>Volver al formulario</a>";
        exit;
    }

    echo "<p>¡Registro exitoso!</p>";
    echo "<a href='../../html/login.html'>Inicia sesión</a>";
} else {
    header("Location: ../../html/signup.html");
    exit;
}
?>
