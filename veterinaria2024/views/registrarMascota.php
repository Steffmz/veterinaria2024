<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Mascota</title>
</head>
<body>
    <h1>Registrar Mascota</h1>
    <form action="../controllers/MascotaControlador.php?accion=registrar" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="especie">Especie:</label>
        <input type="text" id="especie" name="especie" required><br><br>

        <label for="raza">Raza:</label>
        <input type="text" id="raza" name="raza" required><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br><br>

        <label for="propietario">Propietario:</label>
        <select name="propietario" id="propietario" required>
            <?php
            // Mostrar todos los propietarios
            foreach ($usuarios as $usuario) {
                echo "<option value='" . $usuario['Codusuario'] . "'>" . $usuario['Nombre'] . "</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Registrar Mascota</button>
    </form>
</body>
</html>
