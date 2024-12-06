<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mascota</title>
</head>
<body>
    <h1>Editar Mascota</h1>
    <form action="../controllers/MascotaControlador.php?accion=editar&Codmascota=<?= $mascota['Codmascota'] ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($mascota['Nombre']) ?>" required><br><br>

        <label for="especie">Especie:</label>
        <input type="text" id="especie" name="especie" value="<?= htmlspecialchars($mascota['Especie']) ?>" required><br><br>

        <label for="raza">Raza:</label>
        <input type="text" id="raza" name="raza" value="<?= htmlspecialchars($mascota['Raza']) ?>" required><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="<?= htmlspecialchars($mascota['Edad']) ?>" required><br><br>

        <label for="propietario">Propietario:</label>
        <select name="propietario" id="propietario" required>
            <?php
            foreach ($usuarios as $usuario) {
                // Preseleccionar el propietario actual
                $selected = ($usuario['Codusuario'] == $mascota['Propietario']) ? 'selected' : '';
                echo "<option value='" . $usuario['Codusuario'] . "' $selected>" . $usuario['Nombre'] . "</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
