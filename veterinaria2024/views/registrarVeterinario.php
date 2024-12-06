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
    <title>Registrar Veterinario</title>
</head>
<body>
    <h1>Registrar Veterinario</h1>
    <form action="../controllers/VeterinarioControlador.php?accion=registrar" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>

        <label for="especialidad">Especialidad:</label>
        <input type="text" id="especialidad" name="especialidad" required>

        <!-- Campo de Descripción -->
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <!-- Campo de Horarios de Atención -->
        <label for="horarios_atencion">Horarios de Atención:</label>
        <input type="text" id="horarios_atencion" name="horarios_atencion" required>

        <!-- Campo de Experiencia -->
        <label for="experiencia">Experiencia (años):</label>
        <input type="number" id="experiencia" name="experiencia" required>

        <button type="submit">Registrar Veterinario</button>
    </form>
</body>
</html>
