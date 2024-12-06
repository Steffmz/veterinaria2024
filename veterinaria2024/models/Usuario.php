<?php
class Usuario {
    private $conn;
    private $table_name = "Usuarios";

    public $Codusuario;
    public $Nombre;
    public $Apellido;
    public $Email;
    public $Contrasena;
    public $Rolusu;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function verificarDuplicado($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Email = :Email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Email", $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function crearusu() {
        if ($this->verificarDuplicado($this->Email)) {
            return false; // Si el correo ya existe, retornamos falso
        }
        $query = "INSERT INTO " . $this->table_name . " (Nombre, Apellido, Email, Contrasena, RolUsu)
                  VALUES (:Nombre, :Apellido, :Email, :Contrasena, :Rolusu)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":Nombre", $this->Nombre);
        $stmt->bindParam(":Apellido", $this->Apellido);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":Contrasena", $this->Contrasena);
        $stmt->bindParam(":Rolusu", $this->Rolusu);
    
        // Ejecutar la consulta y verificar si se ejecuta correctamente
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo(); // Obtiene información del error
            echo "Error al registrar usuario: " . $errorInfo[2];
            return false;
        }
    }
    

    public function listarUsuarios() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuario($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Codusuario = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario() {
        $query = "UPDATE " . $this->table_name . " SET Nombre = :Nombre, Apellido = :Apellido, Email = :Email" .
                 (!empty($this->Contrasena) ? ", Contrasena = :Contrasena" : "") .
                 " WHERE Codusuario = :Codusuario";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":Nombre", $this->Nombre);
        $stmt->bindParam(":Apellido", $this->Apellido);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":Codusuario", $this->Codusuario);
        if (!empty($this->Contrasena)) {
            $stmt->bindParam(":Contrasena", $this->Contrasena);
        }
    
        // Ejecuta la actualización
        return $stmt->execute();
    }
    

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE Codusuario = :Codusuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Codusuario", $id);
        return $stmt->execute();
    }

    public function verificarCredenciales() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Email = :Email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->Contrasena, $usuario["Contrasena"])) {
                return $usuario;
            }
        }
        return false;
    }
}
?>
