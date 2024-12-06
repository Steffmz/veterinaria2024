<?php
class Mascota {
    private $db;
    private $table = "Mascotas"; // Tabla en la base de datos

    public $Codmascota;
    public $Nombre;
    public $Especie;
    public $Raza;
    public $Edad;
    public $Propietario;

    public function __construct($db) {
        $this->db = $db;
    }

    // Método para registrar una nueva mascota
    public function crearMascota() {
        $query = "INSERT INTO " . $this->table . " SET Nombre = :nombre, Especie = :especie, Raza = :raza, Edad = :edad, Propietario = :propietario";
        $stmt = $this->db->prepare($query);

        // Limpiar los datos
        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->Especie = htmlspecialchars(strip_tags($this->Especie));
        $this->Raza = htmlspecialchars(strip_tags($this->Raza));
        $this->Edad = htmlspecialchars(strip_tags($this->Edad));
        $this->Propietario = htmlspecialchars(strip_tags($this->Propietario));

        // Vincular los parámetros
        $stmt->bindParam(":nombre", $this->Nombre);
        $stmt->bindParam(":especie", $this->Especie);
        $stmt->bindParam(":raza", $this->Raza);
        $stmt->bindParam(":edad", $this->Edad);
        $stmt->bindParam(":propietario", $this->Propietario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para listar todas las mascotas
    public function listarMascotas() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para obtener una mascota por su ID
    public function obtenerMascota($Codmascota) {
        $query = "SELECT * FROM " . $this->table . " WHERE Codmascota = :Codmascota LIMIT 0,1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":Codmascota", $Codmascota);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para actualizar la información de una mascota
    public function actualizarMascota() {
        $query = "UPDATE " . $this->table . " SET Nombre = :nombre, Especie = :especie, Raza = :raza, Edad = :edad, Propietario = :propietario WHERE Codmascota = :Codmascota";
        $stmt = $this->db->prepare($query);

        // Limpiar los datos
        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->Especie = htmlspecialchars(strip_tags($this->Especie));
        $this->Raza = htmlspecialchars(strip_tags($this->Raza));
        $this->Edad = htmlspecialchars(strip_tags($this->Edad));
        $this->Propietario = htmlspecialchars(strip_tags($this->Propietario));
        $this->Codmascota = htmlspecialchars(strip_tags($this->Codmascota));

        // Vincular los parámetros
        $stmt->bindParam(":nombre", $this->Nombre);
        $stmt->bindParam(":especie", $this->Especie);
        $stmt->bindParam(":raza", $this->Raza);
        $stmt->bindParam(":edad", $this->Edad);
        $stmt->bindParam(":propietario", $this->Propietario);
        $stmt->bindParam(":Codmascota", $this->Codmascota);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para eliminar una mascota
    public function eliminarMascota($Codmascota) {
        $query = "DELETE FROM " . $this->table . " WHERE Codmascota = :Codmascota";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":Codmascota", $Codmascota);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    
}
?>
