<?php
session_start();
$errores = $_SESSION["errores"] ?? [];
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error - TagSize</title>
    <link rel="stylesheet" href="../../css/styles_error.css">
    <link rel="icon" type="image/png" href="../../public/img/logo-removebg-preview.png">
</head>
<body>
    <div class="container">
        <div class="error-box">
            <h2>❌ Hubo errores en el registro</h2>
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="javascript:history.back()" class="btn-return">🔙 Volver al formulario</a>
    </div>
</body>
</html>
