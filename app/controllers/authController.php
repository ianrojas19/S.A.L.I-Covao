<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './app/models/authModel.php';

class AuthController
{
    private $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }


    public function logout(string|null $emailUser)
    {
        $this->authModel->changeLoggedStatus($emailUser, 0);

        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $emailUser = $_POST['user'];
            $passwordUser = $_POST['password'];

            $full_user_data = $this->authModel->processLogin($emailUser, $passwordUser);
            if (isset($full_user_data['idEstadoAdmision'])) {

                if ($full_user_data['idEstadoAdmision'] === 1) {

                    // GUARDAMOS EN LAS COOKIES LOS DATOS DEL USUARIO QUE ESTA ACEPTADO EN EL SISTEMA 
                    // Y QUE INGRESO LAS CREDENCIALES VALIDAS (SOLO LAS NECESARIAS)

                    // NOMBRE COMPLETO
                    $_SESSION['cedUser'] = $full_user_data['cedulaUsuario'];
                    $_SESSION['fullNameUser'] = $full_user_data['nombreCompleto'];

                    //ROL
                    $full_user_data['idRol'] == 1 ? $_SESSION['rolUser'] = 'Administrador' : $_SESSION['rolUser'] = 'Profesor';
                    
                    // CORREOS INSTITUCIONAL
                    $_SESSION['mailLogged'] = $emailUser;

                    //LINK DE FOTO DE PERFIL
                    $_SESSION['linkPhotoUser'] = $full_user_data['linkFotoPerfil'];

                    $this->authModel->changeLoggedStatus($emailUser, 1);
                    $response = true;
                } else {
                    $_SESSION['mailLogged'] = 'credenciales_invalidas';
                    $response = false;
                }
            } else {
                $_SESSION['mailLogged'] = 'credenciales_invalidas';
                $response = false;
            }

            session_write_close();
            echo json_encode($response);
        } else {
            include './app/views/auth/login.php';
        }
    }

    public function authorizedUser(string $user_type, string|null $user_email): string
    {
        if (!isset($user_email) || empty($user_email) || $user_email == 'credenciales_invalidas') {
            header('Location: login');
            exit();
        }

        $rol_user = $this->authModel->searchRolUser($user_email);

        if ($rol_user != $user_type) {
            return 'Acceso restringido';
        } else {
            return 'Acceso autorizado';
        }
    }

    public function redirectUser(string|null $user_email): void
    {
        if (!isset($user_email) || empty($user_email) || $_SESSION['mailLogged'] == 'credenciales_invalidas') {
            header('Location: login');
            exit();
        }

        $rol = $this->authModel->searchRolUser($user_email);
        if ($rol == 'Administrador') {
            header('Location: admin_actividad');
            exit();
        } elseif ($rol == 'Profesor') {
            header('Location: profesor');
            exit();
        } else {
            header('Location: login');
            exit();
        }
    }



    public function registro()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $especialidades = $this->authModel->getespecialidades();

            require './app/views/auth/registro.php';
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            isset($_POST['action_type']) ? $action_type = $_POST['action_type'] : $action_type = null;

            if ($action_type == 'get_users') {
                $users = $this->authModel->getAllUsers();

                $response = $users;

                header('Content-Type: application/json');
                echo json_encode($response);
            } else {

                // Setear zona de tiempo de Costa Rica
                date_default_timezone_set('America/Costa_Rica');

                // Info de registro

                // Cedula
                $ced = $_POST['userCedula'];

                // Nombre Completo
                $nom = $_POST['userNombreCompleto'];

                // Rol
                $rol = $_POST['userRol'];

                // Especialidad 
                $rol == 'Administrador'? $esp = 'Administrador' : $esp = $_POST['userEspecialidad'];
                
                // Correo Institucionalde inicio de sesion
                $ci = $_POST['userCorreoInstitucional'];

                // Constraseña de inicio de sesion
                $pass_ci = $_POST['userCorreoInstitucionalPass'];

                //Contraseña hasheada
                $pass_ci_hashed = password_hash($pass_ci, PASSWORD_BCRYPT);

                // Telefono de contacto
                $telct = $_POST['userTelefonoContacto'];

                // Mail de contacto
                $mailct = $_POST['userCorreoContacto'] == '' ? 'n/a' : $_POST['userCorreoContacto'];

                // Fecha de emision de solicitud de registro
                $emisionDate = date('d/m/Y h:i A');


                //Funciono para convertir las fotos a .webp
                function convertirAWebP($rutaImagenOriginal, $rutaImagenWebP)
                {
                    // Obtener la extensión del archivo original
                    $extension = strtolower(pathinfo($rutaImagenOriginal, PATHINFO_EXTENSION));

                    // Crear una imagen desde el archivo original según su tipo
                    switch ($extension) {
                        case 'jpeg':
                        case 'jpg':
                            $imagenOriginal = imagecreatefromjpeg($rutaImagenOriginal);
                            break;
                        case 'png':
                            $imagenOriginal = imagecreatefrompng($rutaImagenOriginal);
                            break;
                        case 'gif':
                            $imagenOriginal = imagecreatefromgif($rutaImagenOriginal);
                            break;
                        default:
                            return false; // Si el formato no es compatible, retorna false
                    }

                    // Convertir la imagen a WebP y guardarla en la ruta especificada
                    $resultado = imagewebp($imagenOriginal, $rutaImagenWebP);

                    // Liberar la memoria
                    imagedestroy($imagenOriginal);

                    return $resultado;
                }

                if ($_FILES['foto_perfil']['error'] == UPLOAD_ERR_NO_FILE) {
                    $linkPhoto = './public/assets/images/fotos_perfil/default.webp';
                } else {
                    // Verifica si se ha enviado un archivo
                    if ($_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {

                        // Información del archivo subido
                        $nombre_original = $_FILES['foto_perfil']['name'];
                        $nombre_temporal = $_FILES['foto_perfil']['tmp_name'];

                        // Directorio de destino
                        $directorio_destino = './public/assets/images/fotos_perfil/';

                        // Generar nombre para el archivo WebP
                        $nombre_webp = 'phop_' . $ced . '.webp';
                        $linkPhoto = $directorio_destino . $nombre_webp;

                        // Mover el archivo subido al directorio de destino
                        if (move_uploaded_file($nombre_temporal, $directorio_destino . $nombre_original)) {
                            try {
                                // Convertir a WebP si lo necesita
                                if (convertirAWebP($directorio_destino . $nombre_original, $linkPhoto)) {
                                    unlink($directorio_destino . $nombre_original);
                                } else {
                                    echo "Error al convertir la imagen a WebP.<br>";
                                    unlink($directorio_destino . $nombre_original);
                                }
                            } catch (Exception $e) {
                                echo 'Error al convertir a WebP: ' . $e->getMessage();
                                unlink($directorio_destino . $nombre_original);
                            }
                        } else {
                            echo "Error al subir el archivo.";
                        }
                    } else {
                        echo "Error al subir el archivo: " . $_FILES['foto_perfil']['error'];
                    }
                }

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {

                    //Funcion de registro de usuario
                    $this->authModel->registrarUsuario(
                        $ced,
                        $nom,
                        $ci,
                        $pass_ci_hashed,
                        $telct,
                        $mailct,
                        $linkPhoto,
                        $rol,
                        $esp,
                        2
                    );

                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                    $mail->Username = 'covao.sali@gmail.com';                     //SMTP username
                    $mail->Password = 'nfmr astt ndbx vcro';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                    $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('ian.rsq@gmail.com', 'SALI - COVAO Nocturno');
                    $mail->addAddress($ci);     //Add a recipient

                    //Content
                    $mail->IsHTML(true);

                    // Activo condificacción utf-8 para corregir problemas de caracteres especiales como las tildes y la "ñ"
                    $mail->CharSet = 'utf-8';

                    $mail->Subject = 'Nueva solicitud de registro en SALI';

                    // Leer el contenido del archivo HTML
                    $htmlContent = file_get_contents('./app/libs/PHPMailer/email_templates/nuevo_registro.html');

                    $emailBody = str_replace(
                        ['{{rol}}', '{{ced}}', '{{nom}}', '{{ci}}', '{{mailct}}', '{{telct}}', '{{emisionDate}}'],
                        [$rol, $ced, $nom, $ci, $mailct, $telct, $emisionDate],
                        $htmlContent
                    );

                    $mail->Body = $emailBody;
                    $mail->AltBody = strip_tags($emailBody);

                    $mail->send();

                    //Se muestra la pantalla de exito de registro
                    header('Location: s_rg');
                } catch (Exception $e) {
                    $err_msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}" . "\n\n$e";

                    //Se muestra el mensaje de error de registro
                    header('Location: f_rg');
                }
            }
        }
    }

    public function restablish_pass()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'GET') {

            require './app/views/auth/forgotpass.php';
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $action = $_POST['action_type'];

            if ($action == 'send_rec_code') {
                $_SESSION['mailtorec'] = $_POST['email_to_rec'];
                $_SESSION['new_rec_code'] = random_int(10000, 99999);;

                // Comprobamos si el usuario existe
                $exists_response = $this->authModel->user_exists($_SESSION['mailtorec']);

                if (!$exists_response) {
                    echo 'user_not_found';
                    return;
                } else {
                    try {

                        //Create an instance; passing `true` enables exceptions
                        $mail = new PHPMailer(true);
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                        $mail->Username = 'covao.sali@gmail.com';                     //SMTP username
                        $mail->Password = 'nfmr astt ndbx vcro';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('ian.rsq@gmail.com', 'SALI - COVAO Nocturno');
                        $mail->addAddress($_SESSION['mailtorec']);     //Add a recipient
                        // $mail->addAddress('ian.rsq@gmail.com');     //Add a recipient

                        //Content
                        $mail->IsHTML(true);

                        // Activo condificacción utf-8 para corregir problemas de caracteres especiales como las tildes y la "ñ"
                        $mail->CharSet = 'utf-8';

                        $mail->Subject = 'Restablecer contraseña - SALI';

                        // Leer el contenido del archivo HTML
                        $htmlContent = file_get_contents('./app/libs/PHPMailer/email_templates/con_rec.html');

                        $emailBody = str_replace(
                            ['{{code}}'],
                            [$_SESSION['new_rec_code']],
                            $htmlContent
                        );

                        $mail->Body = $emailBody;
                        $mail->AltBody = strip_tags($emailBody);

                        $mail->send();

                        // ENVIAR EMAIL DE RECUPERACION
                        echo 'mail_sent';
                        return;
                    } catch (Error $e) {
                        echo 'mail_not_sent';
                        return;
                    }
                }
            }

            if ($action == 'confirm_rec_code') {
                $_SESSION['new_rec_code'] == $_POST['code_given'] ? $rsp  = 'code_correct' : $rsp = `code_incorrect`;
                echo $rsp;
            }


            if ($action == 'restablish_pass') {
                $res_pass = $this->authModel->restablish_pass($_SESSION['mailtorec'], $_POST['new_pss']);
                echo $res_pass;
            }

        }
    }
}
