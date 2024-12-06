<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "administrador") {
    header("Location: ../views/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Administrador</title>
</head>
<body>
    <h1>Bienvenido, Administradoor</h1>
    <a href="../controllers/Usuariocontrolador.php?accion=listar">Gestionar Usuarios</a>
    <a href="../controllers/Usuariocontrolador.php?accion=logout">Cerrar Sesión</a>


</body>
</html>
