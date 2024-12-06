<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../models/Mascota.php";
require_once "../config/Conexion.php";
require_once "../models/Usuario.php";  // Asegúrate de que esta línea esté presente


class MascotaControlador {
    private $db;
    private $mascota;

    public function __construct() {
        $conexion = new Database();
        $this->db = $conexion->getConnection();
        $this->mascota = new Mascota($this->db);
    }

    // Registrar una nueva mascota
    public function registrarMascota() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_POST["nombre"], $_POST["especie"], $_POST["raza"], $_POST["edad"], $_POST["propietario"])) {
                echo "Faltan datos para registrar la mascota.";
                return;
            }
    
            $this->mascota->Nombre = $_POST["nombre"];
            $this->mascota->Especie = $_POST["especie"];
            $this->mascota->Raza = $_POST["raza"];
            $this->mascota->Edad = $_POST["edad"];
            $this->mascota->Propietario = $_POST["propietario"];
    
            if ($this->mascota->crearMascota()) {
                header("Location: ../controllers/MascotaControlador.php?accion=listar");
                exit;
            } else {
                echo "Error al registrar la mascota.";
            }
        } else {
            // Obtener la lista de usuarios para los propietarios
            $usuarioModelo = new Usuario($this->db);
            $usuarios = $usuarioModelo->listarUsuarios();  // Obtén todos los usuarios (propietarios)
            
            include "../views/registrarMascota.php";  // Asegúrate de que esta vista reciba los usuarios
        }
    }
    
    

    // Listar mascotas
    public function listarMascotas() {
        $mascotas = $this->mascota->listarMascotas();
        include "../views/listarMascotas.php"; // Debes crear una vista para mostrar la lista de mascotas
    }

    // Editar mascota
    public function editarMascota($Codmascota) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->mascota->Codmascota = $Codmascota;
            $this->mascota->Nombre = $_POST["nombre"];
            $this->mascota->Especie = $_POST["especie"];
            $this->mascota->Raza = $_POST["raza"];
            $this->mascota->Edad = $_POST["edad"];
            $this->mascota->Propietario = $_POST["propietario"];
    
            if ($this->mascota->actualizarMascota()) {
                header("Location: ../controllers/MascotaControlador.php?accion=listar");
                exit;
            } else {
                echo "Error al actualizar la mascota.";
            }
        } else {
            // Obtener la mascota por ID
            $mascota = $this->mascota->obtenerMascota($Codmascota);
    
            // Obtener la lista de usuarios (propietarios)
            $usuarioModelo = new Usuario($this->db);
            $usuarios = $usuarioModelo->listarUsuarios();  // Obtener todos los usuarios (propietarios)
    
            // Pasar los datos a la vista de edición
            include "../views/editarMascota.php";  // Asegúrate de que esta vista reciba los datos correctamente
        }
    }
    

    // Eliminar una mascota
    public function eliminarMascota($Codmascota) {
        if ($this->mascota->eliminarMascota($Codmascota)) {
            header("Location: ../controllers/MascotaControlador.php?accion=listar");
            exit;
        } else {
            echo "Error al eliminar la mascota.";
        }
    }
}

$controlador = new MascotaControlador();

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'registrar':
            $controlador->registrarMascota();
            break;
        case 'listar':
            $controlador->listarMascotas();
            break;
        case 'editar':
            $controlador->editarMascota($_GET['Codmascota']);
            break;
        case 'eliminar':
            $controlador->eliminarMascota($_GET['Codmascota']);
            break;
        default:
            echo "Acción no válida.";
            break;
    }
} else {
    echo "No se especificó ninguna acción.";
}
?>
