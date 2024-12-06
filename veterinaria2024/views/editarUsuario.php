<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="../controllers/Usuariocontrolador.php?accion=editar&id=<?= $usuario['Codusuario'] ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['Nombre']) ?>" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($usuario['Apellido']) ?>" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['Email']) ?>" required>

        <label for="contrasena">Contraseña (opcional):</label>
        <input type="password" id="contrasena" name="contrasena">

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
