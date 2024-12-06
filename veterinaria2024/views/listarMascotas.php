<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mascotas</title>
</head>
<body>
    <h1>Lista de Mascotas</h1>
    <a href="../controllers/MascotaControlador.php?accion=registrar">Registrar Nueva Mascota</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>Edad</th>
                <th>Propietario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($mascotas) && $mascotas): ?>
                <?php foreach ($mascotas as $mascota): ?>
                    <tr>
                        <td><?= htmlspecialchars($mascota['Nombre']) ?></td>
                        <td><?= htmlspecialchars($mascota['Especie']) ?></td>
                        <td><?= htmlspecialchars($mascota['Raza']) ?></td>
                        <td><?= htmlspecialchars($mascota['Edad']) ?></td>
                        <td><?= htmlspecialchars($mascota['Propietario']) ?></td>
                        <td>
                            <a href="../controllers/MascotaControlador.php?accion=editar&Codmascota=<?= $mascota['Codmascota'] ?>">Editar</a>
                            <a href="../controllers/MascotaControlador.php?accion=eliminar&Codmascota=<?= $mascota['Codmascota'] ?>" onclick="return confirm('¿Estás seguro de eliminar esta mascota?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No se encontraron mascotas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
