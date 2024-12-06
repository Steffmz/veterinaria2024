<?php 
class Veterinario {
    private $db;
    private $table = "Veterinarios"; // Tabla en la base de datos

    public $Codveterinario;  
    public $nombre;
    public $email;
    public $telefono;
    public $especialidad;
    public $descripcion;  // Nuevo campo
    public $horarios_atencion;  // Nuevo campo
    public $experiencia;  // Nuevo campo

    public function __construct($db) {
        $this->db = $db;
    }

    // Método para registrar un nuevo veterinario
    public function crearVeterinario() {
        $query = "INSERT INTO " . $this->table . " SET nombre = :nombre, email = :email, telefono = :telefono, especialidad = :especialidad, descripcion = :descripcion, horarios_atencion = :horarios_atencion, experiencia = :experiencia";

        $stmt = $this->db->prepare($query);

        // Limpiar los datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->especialidad = htmlspecialchars(strip_tags($this->especialidad));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->horarios_atencion = htmlspecialchars(strip_tags($this->horarios_atencion));
        $this->experiencia = htmlspecialchars(strip_tags($this->experiencia));

        // Vincular los parámetros
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":especialidad", $this->especialidad);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":horarios_atencion", $this->horarios_atencion);
        $stmt->bindParam(":experiencia", $this->experiencia);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para listar todos los veterinarios
    public function listarVeterinarios() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para actualizar la información del veterinario
    public function actualizarVeterinario() {
        $query = "UPDATE " . $this->table . " SET nombre = :nombre, email = :email, telefono = :telefono, especialidad = :especialidad, descripcion = :descripcion, horarios_atencion = :horarios_atencion, experiencia = :experiencia WHERE Codveterinario = :Codveterinario";

        $stmt = $this->db->prepare($query);

        // Limpiar los datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->especialidad = htmlspecialchars(strip_tags($this->especialidad));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->horarios_atencion = htmlspecialchars(strip_tags($this->horarios_atencion));
        $this->experiencia = htmlspecialchars(strip_tags($this->experiencia));
        $this->Codveterinario = htmlspecialchars(strip_tags($this->Codveterinario));

        // Vincular los parámetros
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":especialidad", $this->especialidad);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":horarios_atencion", $this->horarios_atencion);
        $stmt->bindParam(":experiencia", $this->experiencia);
        $stmt->bindParam(":Codveterinario", $this->Codveterinario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para obtener un veterinario por su ID
    public function obtenerVeterinario($Codveterinario) {
        $query = "SELECT * FROM " . $this->table . " WHERE Codveterinario = :Codveterinario LIMIT 0,1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":Codveterinario", $Codveterinario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    // Método para eliminar un veterinario
    public function eliminarVeterinario($Codveterinario) {
        $query = "DELETE FROM " . $this->table . " WHERE Codveterinario = :Codveterinario";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":Codveterinario", $Codveterinario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
