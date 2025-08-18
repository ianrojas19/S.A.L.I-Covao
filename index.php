<?php

// Configuracion del tiempo de vida de la sesión en 1 día (86400 segundos)
$sessionLifetime = 86400;

// Establece el tiempo de vida de la cookie de sesión
ini_set('session.cookie_lifetime', $sessionLifetime);

// Establece el tiempo de vida de la sesión en el servidor
ini_set('session.gc_maxlifetime', $sessionLifetime);

// Inicia la sesión
session_start();

date_default_timezone_set('America/Costa_Rica');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './app/libs/PHPMailer/src/Exception.php';
require './app/libs/PHPMailer/src/PHPMailer.php';
require './app/libs/PHPMailer/src/SMTP.php';

require './app/controllers/authController.php';
require './app/controllers/profesorController.php';
require './app/controllers/administradorController.php';

$url = isset($_GET['url']) ? $_GET['url'] : 'index';

$authController = new AuthController();
$profesorController = new ProfesorController();
$administradorController = new AdministradorController();

switch ($url) {

        // ===========================   MODULOS DE AUTENTICACION Y AUTORIZACION   ==================================================

    case 'index':
        isset($_SESSION['mailLogged']) ? $authController->redirectUser($_SESSION['mailLogged']) : $authController->redirectUser(null);
        break;

    case 'login':
        if (isset($_SESSION['mailLogged']) && $_SESSION['mailLogged'] != 'credenciales_invalidas') {
            $authController->redirectUser($_SESSION['mailLogged']);
        } else {
            $authController->login();
        }
        break;

    case 'logout':
        isset($_SESSION['mailLogged']) ? $authController->logout($_SESSION['mailLogged']) : header('Location: index');
        header('Location: index');
        break;

    case 'registro':
        $authController->registro();
        break;

    case 's_rg':
        require './app/views/auth/success_registro.html';
        break;

    case 'f_rg':
        require './app/views/auth/fail_registro.html';
        break;

    case 'contraseña':
        $authController->restablish_pass();
        break;


        // ===========================   MODULOS DE ADMINISTRADOR   ==================================================

    case 'admin_perfiles':
        $at = $authController->authorizedUser('Administrador', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $administradorController->showPerfiles();
        } else {
            header('Location: index');
        }
        break;

    case 'admin_actividad':
        $at = $authController->authorizedUser('Administrador', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $administradorController->showActividad();
        } else {
            header('Location: index');
        }
        break;

    case 'admin_solicitudes':
        $at = $authController->authorizedUser('Administrador', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $administradorController->showSolicitudes();
        } else {
            header('Location: index');
        }
        break;

    case 'admin_llaves':
        $at = $authController->authorizedUser('Administrador', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $administradorController->showLlaves();
        } else {
            header('Location: index');
        }
        break;

    case 'faq_admin':
        $at = $authController->authorizedUser('Administrador', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            include './app/views/admin/faq.php';
        } else {
            header('Location: index');
        }

    case 'gestion_general':
        $at = $authController->authorizedUser('Administrador', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $administradorController->showGesGen();
        } else {
            header('Location: index');
        }

        break;

    case 'cod_retiro':
        $at = $authController->authorizedUser('Administrador', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $administradorController->showCode();
        } else {
            header('Location: index');
        }
        break;


        // ===========================   MODULOS DE PROFESOR   ==================================================
    case 'profesor':
        $at = $authController->authorizedUser('Profesor', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $profesorController->dashboardProfesor($_SESSION['cedUser']);
        } else {
            header('Location: index');
        }
        break;

    case 'profesor_solicitud':
        $at = $authController->authorizedUser('Profesor', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $profesorController->showSolicitudAula();
        } else {
            header('Location: index');
        }
        break;

    case 'profesor_retiro':
        $at = $authController->authorizedUser('Profesor', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $profesorController->showRetiroLlaves($_SESSION['cedUser']);
        } else {
            header('Location: index');
        }
        break;

    case 'profesor_devolucion':
        $at = $authController->authorizedUser('Profesor', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $profesorController->showDevLllaves($_SESSION['cedUser']);
        } else {
            header('Location: index');
        }
        break;

    case 'profesor_actividad':
        $at = $authController->authorizedUser('Profesor', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $profesorController->showActividad($_SESSION['cedUser']);
        } else {
            header('Location: index');
        }
        break;

    case 'profesor_horario':
        $at = $authController->authorizedUser('Profesor', $_SESSION['mailLogged'] ?? null);
        if ($at == 'Acceso autorizado') {
            $profesorController->showHorario($_SESSION['cedUser']);
        } else {
            header('Location: index');
        }
        break;

    case 'imgs':
        include './app/views/random/index.php';
        break;
        

    default:
        //Redirige la pagina de Pagina no encotrada (ERROR 404)
        require_once './app/views/auth/error.html';
        break;
}
