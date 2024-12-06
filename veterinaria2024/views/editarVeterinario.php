<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veterinario</title>
</head>
<body>
    <h1>Editar Veterinario</h1>
    <form action="../controllers/VeterinarioControlador.php?accion=editar&Codveterinario=<?= $veterinario['Codveterinario'] ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($veterinario['Nombre']) ?>" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($veterinario['email']) ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($veterinario['telefono']) ?>" required>

        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad" value="<?= htmlspecialchars($veterinario['Especialidad']) ?>" required>

        <!-- Campo de Descripción -->
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($veterinario['descripcion']) ?></textarea>

        <!-- Campo de Horarios de Atención -->
        <label for="horarios_atencion">Horarios de Atención:</label>
        <input type="text" id="horarios_atencion" name="horarios_atencion" value="<?= htmlspecialchars($veterinario['horarios_atencion']) ?>" required>

        <!-- Campo de Experiencia -->
        <label for="experiencia">Experiencia (años):</label>
        <input type="number" id="experiencia" name="experiencia" value="<?= htmlspecialchars($veterinario['experiencia']) ?>" required>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
