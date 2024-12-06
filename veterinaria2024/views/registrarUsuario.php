<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
</head>
<body>
    <h1>Registrar Usuario</h1>
    <form action="../controllers/Usuariocontrolador.php?accion=registrar" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required>

    <label for="rol">Rol:</label>
    <select name="rol" required>
        <option value="administrador">Administrador</option>
        <option value="usuario">Usuario</option>
    </select>

    <button type="submit">Registrar</button>
</form>

</body>
</html>
