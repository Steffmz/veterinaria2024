<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Asegura que la sesión esté activa

require_once "../models/Usuario.php";
require_once "../config/Conexion.php";

class Usuariocontrolador {
    private $db;
    private $usuario;

    public function __construct() {
        $conexion = new Database();
        $this->db = $conexion->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    public function registrarUsuario() {
        if (!isset($_SESSION["id"]) || !isset($_SESSION["rol"])) {
            header("Location: ../views/login.html");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_POST["nombre"], $_POST["apellido"], $_POST["email"], $_POST["contrasena"], $_POST["rol"])) {
                echo "Faltan datos para registrar el usuario.";
                return;
            }

            $this->usuario->Nombre = $_POST["nombre"];
            $this->usuario->Apellido = $_POST["apellido"];
            $this->usuario->Email = $_POST["email"];
            $this->usuario->Contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
            $this->usuario->Rolusu = $_POST["rol"];

            if ($this->usuario->crearusu()) {
                header("Location: ../controllers/Usuariocontrolador.php?accion=listar");
                exit;
            } else {
                echo "El correo ya está registrado.";
            }
        }
    }

    public function iniciarSesion() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_POST["email"], $_POST["contrasena"])) {
                echo "Faltan datos para iniciar sesión.";
                return;
            }

            $this->usuario->Email = $_POST["email"];
            $this->usuario->Contrasena = $_POST["contrasena"];

            $usuario = $this->usuario->verificarCredenciales();

            if ($usuario) {
                $_SESSION["id"] = $usuario["Codusuario"];
                $_SESSION["rol"] = $usuario["RolUsu"];

                if ($_SESSION["rol"] === "administrador") {
                    header("Location: ../views/adminDashboard.php");
                } else {
                    header("Location: ../views/usuarioDashboard.php");
                }
                exit;
            } else {
                echo "Credenciales incorrectas.";
            }
        }
    }

    public function listarUsuarios() {
        if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "administrador") {
            header("Location: ../views/login.html");
            exit;
        }

        $usuarios = $this->usuario->listarUsuarios();
        include "../views/listarUsuarios.php";
    }

    public function editarUsuario($id) {
        if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "administrador") {
            header("Location: ../views/login.html");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->usuario->Codusuario = $id;
            $this->usuario->Nombre = $_POST["nombre"];
            $this->usuario->Apellido = $_POST["apellido"];
            $this->usuario->Email = $_POST["email"];
            if (!empty($_POST["contrasena"])) {
                $this->usuario->Contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
            }

            if ($this->usuario->actualizarUsuario()) {
                header("Location: ../controllers/Usuariocontrolador.php?accion=listar");
                exit;
            } else {
                echo "Error al actualizar el usuario.";
            }
        } else {
            $usuario = $this->usuario->obtenerUsuario($id);
            include "../views/editarUsuario.php";
        }
    }

    public function eliminarUsuario($id) {
        if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== "administrador") {
            header("Location: ../views/login.html");
            exit;
        }

        if ($this->usuario->eliminar($id)) {
            header("Location: ../controllers/Usuariocontrolador.php?accion=listar");
            exit;
        } else {
            echo "Error al eliminar el usuario.";
        }
    }

    public function logout() {
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión
    
        // Redirige al login después de cerrar sesión
        header("Location: ../views/login.html");
        exit;
    }
    
}

if (isset($_GET['accion'])) {
    
    $controlador = new Usuariocontrolador();

    switch ($_GET['accion']) {
        case 'registrar':
            $controlador->registrarUsuario();
            break;

        case 'login':
            $controlador->iniciarSesion();
            break;

        case 'listar':
            $controlador->listarUsuarios();
            break;

        case 'editar':
            $controlador->editarUsuario($_GET['id']);
            break;

        case 'eliminar':
            $controlador->eliminarUsuario($_GET['id']);
            break;

        case 'logout': // Asegúrate de que esta acción esté incluida
            $controlador->logout();
            break;

        default:
            echo "Acción no válida.";
            break;
    }
} else {
    echo "No se especificó ninguna acción.";
}
