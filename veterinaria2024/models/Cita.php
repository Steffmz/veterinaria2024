<?php
class Cita {
    private $conn;
    private $table_name = "Citas";

    public $Codcita;
    public $Fecha;
    public $Hora;
    public $Mascota;
    public $Veterinario;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " (Fecha, Hora, Mascota, Veterinario)
                VALUES (:Fecha, :Hora, :Mascota, :Veterinario)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":Fecha", $this->Fecha);
        $stmt->bindParam(":Hora", $this->Hora);
        $stmt->bindParam(":Mascota", $this->Mascota);
        $stmt->bindParam(":Veterinario", $this->Veterinario);

        return $stmt->execute();
    }

    public function listar() {
        $query = "SELECT Citas.*, Mascotas.Nombre AS MascotaNombre, Veterinarios.Nombre AS VeterinarioNombre 
                FROM " . $this->table_name . "
                JOIN Mascotas ON Citas.Mascota = Mascotas.Codmascota
                JOIN Veterinarios ON Citas.Veterinario = Veterinarios.Codveterinario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>