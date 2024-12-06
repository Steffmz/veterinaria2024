<?php
session_start();

require_once "../models/Veterinario.php";
require_once "../config/Conexion.php";

class VeterinarioControlador {
    private $db;
    private $veterinario;

    public function __construct() {
        $conexion = new Database();
        $this->db = $conexion->getConnection();
        $this->veterinario = new Veterinario($this->db);
    }

    // Registrar un nuevo veterinario
    public function registrarVeterinario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_POST["nombre"], $_POST["email"], $_POST["telefono"], $_POST["especialidad"], $_POST["descripcion"], $_POST["horarios_atencion"], $_POST["experiencia"])) {
                echo "Faltan datos para registrar el veterinario.";
                return;
            }

            $this->veterinario->nombre = $_POST["nombre"];
            $this->veterinario->email = $_POST["email"];
            $this->veterinario->telefono = $_POST["telefono"];
            $this->veterinario->especialidad = $_POST["especialidad"];
            $this->veterinario->descripcion = $_POST["descripcion"];
            $this->veterinario->horarios_atencion = $_POST["horarios_atencion"];
            $this->veterinario->experiencia = $_POST["experiencia"];

            if ($this->veterinario->crearVeterinario()) {
                header("Location: ../controllers/VeterinarioControlador.php?accion=listar");
                exit;
            } else {
                echo "Error al registrar el veterinario.";
            }
        }
    }

    // Listar veterinarios
    public function listarVeterinarios() {
        if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "administrador") {
            header("Location: ../views/login.html");
            exit;
        }

        $veterinarios = $this->veterinario->listarVeterinarios();
        include "../views/listarVeterinarios.php";
    }

    // Editar un veterinario
    public function editarVeterinario($Codveterinario) {
        if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "administrador") {
            header("Location: ../views/login.html");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->veterinario->Codveterinario = $Codveterinario;
            $this->veterinario->nombre = $_POST["nombre"];
            $this->veterinario->email = $_POST["email"];
            $this->veterinario->telefono = $_POST["telefono"];
            $this->veterinario->especialidad = $_POST["especialidad"];
            $this->veterinario->descripcion = $_POST["descripcion"];
            $this->veterinario->horarios_atencion = $_POST["horarios_atencion"];
            $this->veterinario->experiencia = $_POST["experiencia"];

            if ($this->veterinario->actualizarVeterinario()) {
                header("Location: ../controllers/VeterinarioControlador.php?accion=listar");
                exit;
            } else {
                echo "Error al actualizar el veterinario.";
            }
        } else {
            $veterinario = $this->veterinario->obtenerVeterinario($Codveterinario);
            include "../views/editarVeterinario.php";
        }
    }

    // Eliminar un veterinario
    public function eliminarVeterinario($Codveterinario) {
        if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "administrador") {
            header("Location: ../views/login.html");
            exit;
        }

        if ($this->veterinario->eliminarVeterinario($Codveterinario)) {
            header("Location: ../controllers/VeterinarioControlador.php?accion=listar");
            exit;
        } else {
            echo "Error al eliminar el veterinario.";
        }
    }

    // Asegúrate de que el método obtenerVeterinario esté correctamente definido en el controlador.
public function obtenerVeterinario($Codveterinario) {
    // Aquí se asegura de que el modelo esté bien configurado
    $veterinario = $this->veterinario->obtenerVeterinario($Codveterinario);
    include "../views/editarVeterinario.php";
}

    
    
    
}

if (isset($_GET['accion'])) {
    $controlador = new VeterinarioControlador();

    switch ($_GET['accion']) {
        case 'registrar':
            $controlador->registrarVeterinario();
            break;

        case 'listar':
            $controlador->listarVeterinarios();
            break;

        case 'editar':
            $controlador->editarVeterinario($_GET['Codveterinario']);
            break;

        case 'eliminar':
            $controlador->eliminarVeterinario($_GET['Codveterinario']);
            break;

        default:
            echo "Acción no válida.";
            break;
    }
} else {
    echo "No se especificó ninguna acción.";
}
?>
