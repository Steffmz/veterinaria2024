<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Veterinarios</title>
</head>
<body>
    <h1>Lista de Veterinarios</h1>
    <a href="../views/registrarVeterinario.php">Registrar Nuevo Veterinario</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Especialidad</th>
                <th>Descripción</th> <!-- Nueva columna -->
                <th>Horarios de Atención</th> <!-- Nueva columna -->
                <th>Experiencia</th> <!-- Nueva columna -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($veterinarios) && $veterinarios->rowCount() > 0): ?>
                <?php while ($veterinario = $veterinarios->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($veterinario['Codveterinario']) ?></td>
                        <td><?= htmlspecialchars($veterinario['Nombre']) ?></td>
                        <td><?= htmlspecialchars($veterinario['email']) ?></td>
                        <td><?= htmlspecialchars($veterinario['telefono']) ?></td>
                        <td><?= htmlspecialchars($veterinario['Especialidad']) ?></td>
                        <td><?= htmlspecialchars($veterinario['descripcion']) ?></td> <!-- Mostrar descripción -->
                        <td><?= htmlspecialchars($veterinario['horarios_atencion']) ?></td> <!-- Mostrar horarios -->
                        <td><?= htmlspecialchars($veterinario['experiencia']) ?></td> <!-- Mostrar experiencia -->
                        <td>
                            <a href="../controllers/VeterinarioControlador.php?accion=editar&Codveterinario=<?= $veterinario['Codveterinario'] ?>">Editar</a>
                            <a href="../controllers/VeterinarioControlador.php?accion=eliminar&Codveterinario=<?= $veterinario['Codveterinario'] ?>" onclick="return confirm('¿Estás seguro de eliminar este veterinario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No se encontraron veterinarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
