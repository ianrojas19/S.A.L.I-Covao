<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './app/models/administradorModel.php';

class AdministradorController
{
    private $adminModel;
    private $authModel;

    public function __construct()
    {
        $this->adminModel = new AdministradorModel();
        $this->authModel = new AuthModel();
    }

    public function showActividad()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $users = $this->adminModel->getUsers();
            $keys = $this->adminModel->getAulas();
            $activity = $this->adminModel->getAllActivity();
            require './app/views/admin/admin_actividad.php';
        }
    }

    public function showLlaves()
    {
        $users = $this->adminModel->getUsers();
        $keys = $this->adminModel->getAulas();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            require './app/views/admin/admin_llaves_pr.php';
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action_type = $_POST['action_type'];

            if ($action_type == 'search_profesores') {
                header('Content-Type: application/json');
                echo json_encode($users);
            }

            if ($action_type == 'consult_update_pos') {
                $key_on_action = $_POST['key_to_update'];
                $check_reason_key_use = $this->adminModel->check_reason_key($key_on_action);
                echo $check_reason_key_use;
            }

            if ($action_type == 'update_key') {
                $key_to_update = $_POST['key_to_update'];

                $check_reason_key_use = $this->adminModel->check_reason_key($key_to_update);

                if ($check_reason_key_use != 'GO') {
                    $response_updatekey = 'ocupada';
                } else {
                    $key_to_update = $_POST['key_to_update'];
                    $act_key_state = $_POST['act_key_state'];
                    $act_key_state == 0 ? $act_portador = null : $act_portador = $_POST['act_portador'];
                    $act_key_state == 0 ? $act_reason = 'Sin razón' : $act_reason = $_POST['act_reason'];
                    $response_updatekey = $this->adminModel->updateKey($key_to_update, $act_key_state, $act_reason, $act_portador);
                }

                echo $response_updatekey;
            }
        }
    }


    public function showPerfiles()
    {
        // Función para convertir imagen a WEBP y redimensionarla a 200px de altura
        function convertir_a_webp($archivo_entrada, $archivo_salida)
        {

            try {
                // Crear objeto Imagick
                $imagen = new Imagick($archivo_entrada);

                // Obtener dimensiones originales
                $ancho_original = $imagen->getImageWidth();
                $alto_original = $imagen->getImageHeight();

                // Calcular nuevo ancho proporcional a 200px de altura
                $nuevo_ancho = ($ancho_original / $alto_original) * 200;
                $nuevo_alto = 200;

                // Redimensionar la imagen manteniendo la proporción
                $imagen->resizeImage($nuevo_ancho, $nuevo_alto, Imagick::FILTER_LANCZOS, 1);

                // Establecer formato WEBP
                $imagen->setImageFormat('webp');

                // Establecer calidad de compresión
                $imagen->setImageCompressionQuality(80);

                // Guardar imagen en formato WEBP
                $imagen->writeImage($archivo_salida);

                // Liberar memoria
                $imagen->clear();
                $imagen->destroy();

                return true; // Éxito en la conversión
            } catch (Exception $e) {
                return false; // Error en la conversión
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            // Llamar a todas las especialidades 
            $especialidades = $this->adminModel->getEspecialidades();
            $subareas = $this->adminModel->getSubareas();
            $llaves = $this->adminModel->getAulas();

            // Llamar a todos los perfiles y los almacenamos en un array
            $users = $this->adminModel->getUsers();

            require './app/views/admin/admin_perfiles.php';
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $action_type = $_POST['action_type'];

            if ($action_type == 'get_profesor_data') {

                $ced_profesor = $_POST['ced_profesor'];
                $profesor_data = $this->adminModel->getSingleUser($ced_profesor);

                $res_horario_por_especialidad = $this->adminModel->get_sch_data($ced_profesor);


                $res_profesor_data = [
                    'cedula' => $ced_profesor,
                    'nombre' => $profesor_data[1],
                    'correoins' => $profesor_data[2],
                    'phonect' => $profesor_data[4],
                    'correoct' => $profesor_data[5],
                    'link_photo' => $profesor_data[6],
                ];

                $get_profesor_data = [
                    'profesor_data' => $res_profesor_data,
                    'sch_and_esps' => [
                        'horario' => $res_horario_por_especialidad[0],
                        'especialidades' => $res_horario_por_especialidad[1],
                    ],
                    'empty_sch' => $res_horario_por_especialidad,
                ];

                header('Content-Type: application/json');
                echo json_encode($get_profesor_data);
            }

            if ($action_type == 'add_specialty_to_professor') {
                $ced_profesor = intval($_POST['ced_profesor']);
                $new_sp_id = intval($_POST['new_sp_id']);
                $response = $this->adminModel->add_specialty_to_professor($ced_profesor, $new_sp_id);
                echo $response;
            }

            if ($action_type == 'update_bloque_lectivo') {
                $id_row_sch = $_POST['id_row_sch'];
                $new_subarea = $_POST['new_subarea'];
                $new_llave = $_POST['new_llave'];
                $new_grupo = $_POST['new_grupo'];

                $response = $this->adminModel->update_sch_row($id_row_sch, $new_subarea, $new_llave, $new_grupo);
                echo $response;
            }

            if ($action_type == 'delete_specialty_from_professor') {
                $ced_profesor = intval($_POST['ced_profesor']);
                $sp_id = intval($_POST['esp_id']);
                $response = $this->adminModel->delete_specialty_to_professor($sp_id, $ced_profesor);
                echo $response;
            }

            if ($action_type == 'update_pp') {
                if (isset($_FILES['pp_image_profile']) && $_FILES['pp_image_profile']['error'] === UPLOAD_ERR_OK) {
            
                    $ced = intval($_POST['ced_profesor']);
                    $nombre_original = $_FILES['pp_image_profile']['name'];
                    $nombre_temporal = $_FILES['pp_image_profile']['tmp_name'];
            
                    $directorio_destino = './public/assets/images/fotos_perfil/';
                    $nombre_webp = 'phop_' . $ced . '.webp';
                    $ruta_salida = $directorio_destino . $nombre_webp;
            
                    // Mueve temporalmente
                    $ruta_temporal = $directorio_destino . 'temp_' . basename($nombre_original);
                    if (!move_uploaded_file($nombre_temporal, $ruta_temporal)) {
                        echo 'Error al mover el archivo subido.';
                        exit;
                    }
            
                    // Elimina si ya existe una versión anterior
                    if (file_exists($ruta_salida)) {
                        unlink($ruta_salida);
                    }
            
                    // Convierte a WebP
                    if (convertir_a_webp($ruta_temporal, $ruta_salida)) {
                        unlink($ruta_temporal);
                        $pp_response = $this->adminModel->update_pp($ced, $ruta_salida);
                        echo $pp_response;
                    } else {
                        unlink($ruta_temporal);
                        echo 'Error al convertir la imagen a WebP.';
                    }
                } else {
                    echo 'No se recibió archivo válido.';
                }
        }



            if ($action_type == 'delete_pp') {
                $ced = intval($_POST['ced_profesor']);
                $ruta_default = './public/assets/images/fotos_perfil/default.webp';
                $pp_response = $this->adminModel->update_pp($ced, $ruta_default);
                echo $pp_response;
            }

            if ($action_type == 'get_admin_data') {

                $profile_ced = $_POST['profile_ced'];

                $data_profile = $this->adminModel->getSingleUser($profile_ced);

                $response = [
                    'cedula' => $data_profile[0],
                    'nombre' => $data_profile[1],
                    'rol' => $data_profile[7],
                    'correoins' => $data_profile[2],
                    'passins' => $data_profile[3],
                    'phonect' => $data_profile[4],
                    'correoct' => $data_profile[5],
                    'link_photo' => $data_profile[6],
                    'especialidad' => $data_profile[8],
                ];

                header('Content-Type: application/json');
                echo json_encode($response);
            }

            // Verificar si la acción es actualizar usuario
            if ($action_type == 'update_single_user') {
                $ncedula = $_POST['ced'];
                $nomcomp = $_POST['nombre'];
                $nmci = $_POST['mail_inst'];

                $data_profile = $this->adminModel->getSingleUser($ncedula);

                if ($_POST['pass_inst'] == 'false') {
                    $npass_mci = $data_profile[3]; // Mantener la contraseña actual
                } else {
                    $npass_mci = password_hash($_POST['pass_inst'], PASSWORD_BCRYPT); // Encriptar nueva contraseña
                }

                $ntelfct = $_POST['numct'];
                $nemailct = empty($_POST['mailct']) ? 'n/a' : $_POST['mailct'];

                // Obtener datos actuales del usuario
                $data_profile = $this->adminModel->getSingleUser($ncedula);
                $linkPhoto_new = $data_profile[6]; // Mantener la imagen actual por defecto

                // Actualizar usuario en la base de datos
                $updateCall = $this->adminModel->updateUser(
                    $ncedula,
                    $nomcomp,
                    $nmci,
                    $npass_mci,
                    $ntelfct,
                    $nemailct,
                    $linkPhoto_new
                );

                echo $updateCall;
            }

            if ($action_type == 'create_single_user') {

                //CEDULA
                $cr_ced = $_POST['cr_cedula'];
                //NOMBRE COMPLETO
                $cr_nom = $_POST['cr_nombre'];
                //ROL
                $cr_rol = $_POST['cr_rol'];

                //ESPECIALIDAD
                $cr_idesp = $_POST['cr_especialidad'];

                //CORREO COVAO
                $cr_correoinst = $_POST['cr_emailins'];

                //CONSTRASENA COVAO
                $cr_passinst = password_hash($_POST['cr_password'], PASSWORD_BCRYPT);

                // TELEFONO DE CONTACTO
                $cr_telfct = $_POST['cr_phone'];

                // CORREO DE CONTACTO
                $cr_correoct = $_POST['cr_emaict'];

                // Set default photo path
                $crlinkPhoto = './public/assets/images/fotos_perfil/default.webp';

                // Handle profile photo upload
                if (isset($_FILES['cr_photo_profile']) && $_FILES['cr_photo_profile']['error'] === UPLOAD_ERR_OK) {
                    $nombre_temporal = $_FILES['cr_photo_profile']['tmp_name'];

                    $directorio_destino = './public/assets/images/fotos_perfil/';
                    $nombre_webp = 'phop_' . $cr_ced . '.webp';
                    $ruta_salida = $directorio_destino . $nombre_webp;

                    // Move uploaded file
                    if (move_uploaded_file($nombre_temporal, $ruta_salida)) {
                        // Try to convert to WebP
                        if (!convertir_a_webp($ruta_salida, $ruta_salida)) {
                            // If conversion fails, delete uploaded file and use default
                            unlink($ruta_salida);
                            $crlinkPhoto = './public/assets/images/fotos_perfil/default.webp';
                        } else {
                            $crlinkPhoto = $ruta_salida;
                        }
                    } else {
                        $crlinkPhoto = './public/assets/images/fotos_perfil/default.webp';
                    }
                }

                // Creamos el usuario
                $responseCreateUser = $this->adminModel->registerUser(
                    $cr_ced,
                    $cr_nom,
                    $cr_correoinst,
                    $cr_passinst,
                    $cr_telfct,
                    $cr_correoct,
                    $crlinkPhoto,
                    $cr_rol,
                    $cr_idesp
                );

                $resultado = $responseCreateUser;

                echo $resultado;
            }

            if ($action_type == 'delete_single_user') {
                $delete_ced = $_POST['delete_ced'];
                $delete_user_rol = $_POST['delete_user_rol'];
                $response = $this->adminModel->deleteUser($delete_ced, $delete_user_rol);
                echo $response;
            }

            //Consulta de aula, especialidad y aulas en BD
            if ($action_type == 'get_esps_&_users_&_aulas') {
                // Enviar respuesta como JSON
                header('Content-Type: application/json');

                $response = [
                    'especialidades' => $this->adminModel->getEspecialidades(),
                    'users' => $this->adminModel->getUsers(),
                    'subareas' => $this->adminModel->getSubareas(),
                    'aulas' => $this->adminModel->getAulas()
                ];

                echo json_encode($response);
            }
        }
    }

    public function showSolicitudes()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            // Llamar a todos los perfiles y los almacenamos en un array
            $users = $this->adminModel->getUsers();

            $keys = $this->adminModel->getAulas();

            //Llamar a todas las solicitudes de llaves
            $keyreqs = $this->adminModel->getAllKeyRequests();

            require './app/views/admin/admin_solicitudes.php';
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action_type = $_POST['action_type'];


            switch ($action_type) {
                case 'deny_rg':
                    $ced_rechazo_rg = $_POST['ced_rechazo'];

                    $link_photo_rg = $_POST['photo_rg'];

                    $_POST['razon_rechazo'] == 'false' ? $razon_rechazo_rg = 'No se adjunta razón' : $razon_rechazo_rg = $_POST['razon_rechazo'];

                    $correo_ins_rg = $_POST['correo_ins'];

                    $correo_rol_rg = $_POST['rol'];

                    $delete_user_rp = $this->adminModel->deleteUser($ced_rechazo_rg, $correo_rol_rg);

                    $link_photo_rg != './public/assets/images/fotos_perfil/default.webp' ? unlink($link_photo_rg) : '';

                    if ($delete_user_rp == 'OK') {

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
                        $mail->addAddress($correo_ins_rg);     //Add a recipient
                        // $mail->addAddress('ian.rsq@gmail.com');     //Add a recipient

                        //Content
                        $mail->IsHTML(true);

                        // Activo condificacción utf-8 para corregir problemas de caracteres especiales como las tildes y la "ñ"
                        $mail->CharSet = 'utf-8';

                        $mail->Subject = 'Solicitud de Registro en SALI';

                        // Leer el contenido del archivo HTML
                        $htmlContent = file_get_contents('./app/libs/PHPMailer/email_templates/rechazo_registro.html');

                        $emailBody = str_replace(
                            ['{{razon}}'],
                            [$razon_rechazo_rg],
                            $htmlContent
                        );

                        $mail->Body = $emailBody;
                        $mail->AltBody = strip_tags($emailBody);

                        $mail->send();
                        echo 'success';
                    } else {
                        echo 'error';
                    }
                    break;

                case 'accept_rg':
                    $ced_aceptacion = $_POST['ced_aprobado'];

                    $resultadoAceptacion = $this->adminModel->acceptUser($ced_aceptacion);

                    if ($resultadoAceptacion) {

                        $correo_ins_accepted = $_POST['correo_ins'];

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
                        $mail->addAddress($correo_ins_accepted);     //Add a recipient
                        // $mail->addAddress('ian.rsq@gmail.com');     //Add a recipient

                        //Content
                        $mail->IsHTML(true);

                        // Activo condificacción utf-8 para corregir problemas de caracteres especiales como las tildes y la "ñ"
                        $mail->CharSet = 'utf-8';

                        $mail->Subject = 'Solicitud de Registro en SALI';

                        // Leer el contenido del archivo HTML
                        $htmlContent = file_get_contents('./app/libs/PHPMailer/email_templates/aceptacion_registro.html');

                        $emailBody = str_replace(
                            ['{{correo_ins}}'],
                            [$correo_ins_accepted],
                            $htmlContent
                        );

                        $mail->Body = $emailBody;
                        $mail->AltBody = strip_tags($emailBody);

                        $mail->send();

                        // Dar la respuesta al ajax
                        echo 'success';
                    } else {
                        echo 'error';
                    }
                    break;

                case 'process_key_req':
                    $pr_key_data = $_POST['requestData'];
                    $result_sol_llave = $this->adminModel->process_key_request($pr_key_data);

                    echo $result_sol_llave;
                    break;
            }
        }
    }

    public function showCode()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require './app/views/admin/cod_retiro.php';
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = $_POST['req_type'];

            switch ($action) {
                case 'set_ret_code':
                    $a1 = rand(0, 9);
                    $b2 = rand(0, 9);
                    $c3 = strval($a1) . strval($b2);
                    $newdatetime = date('Y-m-d H:i:s', strtotime('+30 seconds'));
                    $code = $this->adminModel->set_ret_code($c3, $newdatetime);
                    echo json_encode($code);
                    break;
                    
                    case 'get_ret_code':
                    $code = $this->adminModel->get_ret_code();
                    // echo $code['retiro_llave_access_code_mfa'];
                    echo json_encode($code);
                    break;

                case 'checkLocationState':
                    // $loc_st = $this->adminModel->checkLocationState();
                    echo $loc_st;
                    break;
            }
        }
    }


    public function showGesGen()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $keys = $this->adminModel->getAulas();
            $especialidades = $this->adminModel->getEspecialidades();
            $subareas = $this->adminModel->getSubareas();

            require_once './app/views/admin/gestion.php';
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $action_type = $_POST['action_type'];

            // ESPECIALIDADES 

            if ($action_type == 'add_esp') {
                $nombreEspecialidad = $_POST['name_esp'];
                if ($nombreEspecialidad == '') {
                    $response = 'Los datos ingresados no son válidos.';
                } else {
                    $response = $this->adminModel->createEspecialidad($nombreEspecialidad);
                }
                echo $response;
            }

            if ($action_type == 'mod_esp') {
                $idEspecialidad = $_POST['idEsp'];
                $nombreEspecialidad = $_POST['name_esp'];
                if ($idEspecialidad == 0 || $nombreEspecialidad == '') {
                    $response = 'Los datos ingresados no son válidos.';
                } else {
                    $response = $this->adminModel->updateEspecialidad($idEspecialidad, $nombreEspecialidad);
                }
                echo $response;
            }

            if ($action_type == 'delete_esp') {
                $idEspecialidad = $_POST['idEsp'];
                $response = $this->adminModel->deleteEspecialidad($idEspecialidad);
                echo $response;
            }

            // SUBAREAS

            if ($action_type == 'add_sub') {
                $idEspecialidad = $_POST['idEsp'];
                $nombreSubarea = $_POST['name_sub'];
                $nombreEspecialidad = $_POST['name_esp'];
                if ($nombreSubarea == '' || $idEspecialidad == 0) {
                    $response = 'Los datos ingresados no son válidos.' + " " + $nombreSubarea + " " + $idEspecialidad;
                } else {
                    $response = $this->adminModel->createSubarea($idEspecialidad, $nombreSubarea, $nombreEspecialidad);
                }
                echo $response;
            }

            if ($action_type == 'mod_sub') {
                $idSubarea = $_POST['idSub'];
                $idEspecialidad = $_POST['idEsp'];
                $nombreSubarea = $_POST['name_sub'];
                $nombreEspecialidad = $_POST['name_esp'];
                if ($idSubarea == 0 || $nombreSubarea == '' || $idEspecialidad == 0) {
                    $response = 'Los datos ingresados no son válidos.';
                } else {
                    $response = $this->adminModel->updateSubarea($idSubarea, $nombreSubarea, $idEspecialidad, $nombreEspecialidad);
                }
                echo $response;
            }

            if ($action_type == 'delete_sub') {
                $idSubarea = $_POST['idSub'];
                $idEspecialidad = $_POST['idEsp'];
                $nombreEspecialidad = $_POST['name_esp'];
                if ($idSubarea == "" || $idEspecialidad == 0) {
                    $response = 'Los datos ingresados no son válidos.';
                } else {
                    $response = $this->adminModel->deleteSubarea($idSubarea, $idEspecialidad, $nombreEspecialidad);
                }
                echo $response;
            }

            // LLAVES

            if ($action_type == 'create_key') {
                $numeroLlave = $_POST['numeroLlave'];
                $nombreAula = $_POST['nombreAula'];
                if ($numeroLlave == 0 || $nombreAula == '') {
                    $response = 'Los datos ingresados no son válidos.';
                } else {
                    $response = $this->adminModel->createKey($numeroLlave, $nombreAula);
                }
                echo $response;
            }

            if ($action_type == 'update_key') {
                $numeroLlave = $_POST['numeroLlave'];
                $nombreAula = $_POST['nombreAula'];

                if ($numeroLlave == 0 || $nombreAula == '') {
                    $response = 'Los datos ingresados no son válidos.';
                } else {
                    $response = $this->adminModel->updateKey_Name($numeroLlave, $nombreAula);
                }
                echo $response;
            }

            if ($action_type == 'delete_key') {
                $numeroLlave = $_POST['numeroLlave'];
                $response = $this->adminModel->delete_key($numeroLlave);
                echo $response;
            }
        }
    }
}
