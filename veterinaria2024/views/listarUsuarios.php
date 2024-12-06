<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <a href="../views/registrarUsuario.php">Registrar Nuevo Usuario</a>
    <a href="../controllers/Usuariocontrolador.php?accion=logout">Cerrar Sesión</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($usuarios) && !empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['Codusuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['Nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['Apellido']) ?></td>
                        <td><?= htmlspecialchars($usuario['Email']) ?></td>
                        <td><?= htmlspecialchars($usuario['RolUsu']) ?></td>
                        <td>
                            <a href="../controllers/Usuariocontrolador.php?accion=editar&id=<?= $usuario['Codusuario'] ?>">Editar</a>
                            <a href="../controllers/Usuariocontrolador.php?accion=eliminar&id=<?= $usuario['Codusuario'] ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No se encontraron usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
