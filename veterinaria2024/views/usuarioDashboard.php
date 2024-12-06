<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Usuario</title>
</head>
<body>
    <h1>Bienvenido, Usuario</h1>
    <nav>
        <a href="../views/registrarMascota.php">Registrar Mascota</a>
        <a href="../controllers/Mascotacontrolador.php?accion=listar">Ver Mis Mascotas</a>
        <a href="../controllers/Usuariocontrolador.php?accion=logout">Cerrar Sesión</a>
    </nav>
</body>
</html>
