-- Base de datos
CREATE DATABASE veterinaria2024;
USE veterinaria2024;
-- Tabla Veterinarios
CREATE TABLE Veterinarios (
    Codveterinario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50),
    Correo VARCHAR(100) UNIQUE,
    Telefono VARCHAR(15),
    Especialidad VARCHAR(50)
    
);

-- Tabla Mascotas
CREATE TABLE Mascotas (
    Codmascota INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Especie VARCHAR(50) NOT NULL,
    Raza VARCHAR(50),
    Edad INT,
    Propietario INT NOT NULL,
    FOREIGN KEY (Propietario) REFERENCES Usuarios(Codusuario) ON DELETE CASCADE
);

-- Tabla Citas
CREATE TABLE Citas (
    Codcita INT AUTO_INCREMENT PRIMARY KEY,
    Fecha DATE,
    Hora TIME,
    Mascota INT,
    Veterinario INT,
    FOREIGN KEY (Mascota) REFERENCES Mascotas(Codmascota),
    FOREIGN KEY (Veterinario) REFERENCES Veterinarios(Codveterinario)
);

-- Tabla Tratamientos
CREATE TABLE Tratamientos (
    Codtratamiento INT AUTO_INCREMENT PRIMARY KEY,
    Mascota INT,
    Descripcion TEXT,
    Activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (Mascota) REFERENCES Mascotas(Codmascota)
);

CREATE TABLE IF NOT EXISTS Usuarios (
    Codusuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Contrasena VARCHAR(255) NOT NULL,
    RolUsu ENUM('administrador', 'usuario') NOT NULL
);
ALTER TABLE Veterinarios
MODIFY COLUMN email VARCHAR(100) NOT NULL,  -- Verifica si la columna está correctamente configurada
MODIFY COLUMN telefono VARCHAR(15);         -- Ajusta el tipo de columna para el teléfono si es necesario

ALTER TABLE Veterinarios
ADD COLUMN descripcion TEXT,
ADD COLUMN horarios_atencion VARCHAR(100),
ADD COLUMN experiencia INT;




