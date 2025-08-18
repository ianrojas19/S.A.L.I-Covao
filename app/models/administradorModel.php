<?php
class AdministradorModel
{
    private $conn;

    public function __construct()
    {
        // Inicializar la conexión a la base de datos
        require './app/config/bd.php';

        $this->conn = $conn;

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die('Conexión fallida: ' . $this->conn->connect_error);
        }
    }

    public function getUsers()
    {
        $usersResult = mysqli_query($this->conn, "SELECT * FROM usuario");

        $user = [];

        $users = [];

        // Recorrer el resultado obtenido
        while ($row = mysqli_fetch_assoc($usersResult)) {

            $user[0] = $row['cedulaUsuario'];
            $user[1] = $row['nombreCompleto'];
            $user[2] = $row['correoInstitucional'];
            $user[3] = $row['contraseñaCorreoInstitucional'];
            $user[4] = $row['numeroContacto'];
            $user[5] = $row['correoContacto'];
            $user[6] = $row['linkFotoPerfil'];

            if ($row['idRol'] == 1) {
                $rolUser = 'Administrador';
            } else {
                $rolUser = 'Profesor';
            }

            $user[7] = $rolUser;

            $user[9] = $row['usuarioLogeado'];

            $user[10] = $row['idEstadoAdmision'];

            $users[] = $user;
        }

        mysqli_free_result($usersResult);

        return $users;
    }

    public function getSingleUser(int $nprofile_ced)
    {
        $userSearch = mysqli_prepare($this->conn, "SELECT * FROM usuario WHERE cedulaUsuario = ?");

        mysqli_stmt_bind_param($userSearch, 'i', $nprofile_ced);

        mysqli_stmt_execute($userSearch);

        $userResult = mysqli_stmt_get_result($userSearch);

        $us = [];

        while ($row = mysqli_fetch_assoc($userResult)) {

            // Cedula
            $us[0] = $row['cedulaUsuario'];

            // Nombre
            $us[1] = $row['nombreCompleto'];

            // Correo institucional
            $us[2] = $row['correoInstitucional'];

            // // Contraseña
            $us[3] = $row['contraseñaCorreoInstitucional'];

            // Numero telefono contacto
            $us[4] = $row['numeroContacto'];

            // Correo contacto
            $us[5] = $row['correoContacto'];

            // Foto de perfil
            $us[6] = $row['linkFotoPerfil'];

            // ROL
            // $row['idRol'] == 1 ? $rolUser = 'Administrador' : $rol = 'Profesor';

            // ROLL
            // $us[7] = $rolUser;
        }

        mysqli_stmt_free_result($userSearch);
        mysqli_stmt_close($userSearch);

        return $us;
    }

    public function get_sch_data(int $cedula_profesor)
    {
        $schs_query = "
    SELECT 
    h.id_row_sh,    
    h.idEspecialidad,
        e.nombreEspecialidad AS nombreEspecialidad,
        h.diaLectivo,
        h.bloqueLectivo,
        h.idSubarea,
        h.numeroLlave,
        h.Grupo,
        h.last_sch_update
    FROM 
        horario h
    JOIN 
        especialidad e ON h.idEspecialidad = e.idEspecialidad
    WHERE 
        h.cedulaProfesor = ?
    ORDER BY 
        h.idEspecialidad, h.diaLectivo, h.bloqueLectivo;
    ";

        $stmt = mysqli_prepare($this->conn, $schs_query);

        if (!$stmt) {
            error_log("Error preparando la consulta: " . mysqli_error($this->conn));
            return 'ERROR PREPARANDO CONSULTA';
        }

        mysqli_stmt_bind_param($stmt, 'i', $cedula_profesor);

        if (!mysqli_stmt_execute($stmt)) {
            error_log("Error ejecutando la consulta: " . mysqli_stmt_error($stmt));
            mysqli_stmt_close($stmt);
            return 'ERROR EJECUTANDO CONSULTA';
        }

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            error_log("Error obteniendo el resultado: " . mysqli_error($this->conn));
            mysqli_stmt_close($stmt);
            return 'ERROR OBTENIENDO RESULTADO';
        }

        $horarios = [];
        $especialidades = [];

        while ($row = $result->fetch_assoc()) {
            $esp = $row['nombreEspecialidad'];
            $dia = $row['diaLectivo'];
            $bloque = (int)$row['bloqueLectivo'] - 1; // opcional: para indexar del 0 al 16

            // Agregar la especialidad al array si no existe, en el formato [idEspecialidad, nombreEspecialidad]
            $existe = false;
            foreach ($especialidades as $espItem) {
                if ($espItem[0] == $row['idEspecialidad']) {
                    $existe = true;
                    break;
                }
            }

            !$existe ? $especialidades[] = [$row['idEspecialidad'], $row['nombreEspecialidad']] : '';

            // Inicializar estructura si no existe
            if (!isset($horarios[$esp])) {
                $horarios[$esp] = [
                    'Lunes' => array_fill(0, 17, null),
                    'Martes' => array_fill(0, 17, null),
                    'Miercoles' => array_fill(0, 17, null),
                    'Jueves' => array_fill(0, 17, null),
                    'Viernes' => array_fill(0, 17, null),
                ];
            }

            $horarios[$esp][$dia][$bloque] = [
                'id_row_sh' => $row['id_row_sh'],
                'idEsp' => $row['idEspecialidad'],
                'subarea' => $row['idSubarea'],
                'llave' => $row['numeroLlave'],
                'grupo' => $row['Grupo'],
                'last_sch_update' => $row['last_sch_update']
            ];
        }

        mysqli_stmt_close($stmt);

        return !empty($horarios) ? [$horarios, $especialidades] : 'NO DATA FOUND';
    }

    public function delete_specialty_to_professor(int $idEspecialidad, int $cedula_profesor)
    {
        $deleteSch_query = "DELETE FROM `horario` WHERE `idEspecialidad` = ? AND `cedulaProfesor` = ?";
        $deleteSch = mysqli_prepare($this->conn, $deleteSch_query);
        mysqli_stmt_bind_param($deleteSch, 'ii', $idEspecialidad, $cedula_profesor);

        if (mysqli_stmt_execute($deleteSch)) {
            mysqli_stmt_close($deleteSch);
            return 'OK';
        } else {
            mysqli_stmt_close($deleteSch);
            return 'ERROR';
        }
    }

    public function getEspecialidades()
    {
        $findEspecialidades_Query = 'SELECT * FROM especialidad';

        $find_Espec = mysqli_prepare($this->conn, $findEspecialidades_Query);

        mysqli_stmt_execute($find_Espec);

        // Obtener el resultado del find_Espec
        $fceresultado = mysqli_stmt_get_result($find_Espec);

        // Recorrer el resultado obtenido
        $especialidades = [];
        while ($row = mysqli_fetch_assoc($fceresultado)) {
            $especialidades[] = [
                $row['idEspecialidad'],
                $row['nombreEspecialidad']
            ];
        }

        mysqli_stmt_free_result($find_Espec);

        mysqli_stmt_close($find_Espec);

        return $especialidades;
    }

    public function getSubareas()
    {
        $findSubs_Query = 'SELECT * FROM subarea';

        $find_Subs = mysqli_prepare($this->conn, $findSubs_Query);

        mysqli_stmt_execute($find_Subs);

        // Obtener el resultado del find_Espec
        $susberesultado = mysqli_stmt_get_result($find_Subs);

        // Recorrer el resultado obtenido
        $subareas = [];

        while ($row = mysqli_fetch_assoc($susberesultado)) {
            $subareas[] = [
                'idSubarea' => $row['idSubarea'],
                'nombreSubarea' => $row['nombreSubarea'],
                'idEspecialidad' => $row['idEspecialidad']
            ];
        }


        mysqli_stmt_free_result($find_Subs);

        mysqli_stmt_close($find_Subs);

        return $subareas;
    }

    public function getAulas()
    {
        $findKeys_Query = 'SELECT * FROM llave ORDER BY numeroLlave ASC';

        $find_Keys = mysqli_prepare($this->conn, $findKeys_Query);

        mysqli_stmt_execute($find_Keys);

        // Obtener el resultado del find_Espec
        $keyresultado = mysqli_stmt_get_result($find_Keys);

        // Recorrer el resultado obtenido
        $keys = [];

        while ($row = mysqli_fetch_assoc($keyresultado)) {
            $keys[] = [
                'numeroLlave' => $row['numeroLlave'],
                'nombreAula' => $row['nombreAula'],
                'cedulaProfesor' => $row['cedulaProfesor'],
                'razonUso' => $row['razonOcupada'],
                'isTaken' => $row['Ocupada']
            ];
        }


        mysqli_stmt_free_result($find_Keys);

        mysqli_stmt_close($find_Keys);

        return $keys;
    }

    public function getSchedule(int $cedula_profesor)
    {
        $findSchedule_query = 'SELECT * FROM horario WHERE cedulaUsuario = ?';
        $findSchedule = mysqli_prepare($this->conn, $findSchedule_query);
        mysqli_stmt_bind_param($findSchedule, 'i', $cedula_profesor);

        mysqli_stmt_execute($findSchedule);

        $sch_result = mysqli_stmt_get_result($findSchedule);

        $schedule = mysqli_fetch_all($sch_result);

        mysqli_stmt_free_result($findSchedule);
        mysqli_stmt_close($findSchedule);

        return $schedule;
    }

    function create_specialty(int $ced, int $idEspecialidad)
    {
        $diasLectivos = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];


        // Verificar si hay horarios asignados para esta especialidad
        $check_sch_query = "SELECT COUNT(*) FROM horario WHERE idEspecialidad = ? AND cedulaProfesor = ?";
        $check_sch = mysqli_prepare($this->conn, $check_sch_query);
        mysqli_stmt_bind_param($check_sch, 'ii', $idEspecialidad, $ced);
        mysqli_stmt_execute($check_sch);
        mysqli_stmt_bind_result($check_sch, $count);
        mysqli_stmt_fetch($check_sch);
        mysqli_stmt_close($check_sch);

        if ($count > 0) {
            return false;
        } else {
            for ($dias = 0; $dias < 5; $dias++) {
                $dia_actual = $diasLectivos[$dias];
                for ($rounds = 0; $rounds < 17; $rounds++) {
                    $bloque_actual = $rounds + 1;
                    $createSchedule = mysqli_prepare($this->conn, 'INSERT INTO `horario`(`cedulaProfesor`, `idEspecialidad`, `diaLectivo`, `bloqueLectivo`, `idSubarea`, `numeroLlave`, `Grupo`, `last_sch_update`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

                    if (!$createSchedule) {
                        throw new Exception("Error preparando la consulta: " . mysqli_error($this->conn));
                    }

                    $sch_date = date('Y-m-d');

                    $grupo_default = 'no asignado';
                    $llave_default = 999;
                    $subarea_default = 1;
                    if (!mysqli_stmt_bind_param($createSchedule, 'iisissss', $ced, $idEspecialidad, $dia_actual, $bloque_actual, $subarea_default, $llave_default, $grupo_default, $sch_date)) {
                        throw new Exception("Error vinculando parámetros: " . mysqli_stmt_error($createSchedule));
                    }

                    if (!mysqli_stmt_execute($createSchedule)) {
                        throw new Exception("Error ejecutando la consulta: " . mysqli_stmt_error($createSchedule));
                    }

                    mysqli_stmt_close($createSchedule);
                }
            }

            return true;
        }
    }

    public function registerUser(
        int $ced,
        string $nom,
        string $correoIns,
        string $passCorreoIns,
        int $numCont,
        string $correoCont,
        string $linkPhoto,
        int $rol,
        int $idEspecialidad
    ) {
        try {

            if (isset($idEspecialidad) && $idEspecialidad != 1) {
                $this->create_specialty($ced, $idEspecialidad);
            }
            // Input validation
            if (empty($nom) || empty($correoIns) || empty($passCorreoIns)) {
                return 'ERROR: Required fields cannot be empty';
            }

            $createUser_Query = "INSERT INTO `usuario`
              (`cedulaUsuario`, `nombreCompleto`, `correoInstitucional`, `contraseñaCorreoInstitucional`, 
              `numeroContacto`, `correoContacto`, `linkFotoPerfil`, `idRol`, `idEstadoAdmision`, `usuarioLogeado`) 
              VALUES (?,?,?,?,?,?,?,?,?,?)";

            $createUser = mysqli_prepare($this->conn, $createUser_Query);

            if (!$createUser) {
                throw new Exception("Error preparing statement: " . mysqli_error($this->conn));
            }

            $defaultUsuarioLogeado = 0;
            $defaultAceptado = 1;

            if (!mysqli_stmt_bind_param(
                $createUser,
                'isssissiii',
                $ced,
                $nom,
                $correoIns,
                $passCorreoIns,
                $numCont,
                $correoCont,
                $linkPhoto,
                $rol,
                $defaultAceptado,
                $defaultUsuarioLogeado
            )) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($createUser));
            }

            if (!mysqli_stmt_execute($createUser)) {
                throw new Exception("Error executing statement: " . mysqli_stmt_error($createUser));
            }

            $responseCreate = 'OK';
        } catch (Exception $e) {
            $responseCreate = 'ERROR: ' . $e->getMessage();
        } finally {
            if (isset($createUser) && $createUser) {
                mysqli_stmt_close($createUser);
            }
        }

        return $responseCreate;
    }


    public function add_specialty_to_professor($ced_professor, $id_new_specialty)
    {
        try {
            $responseCreateSP = $this->create_specialty($ced_professor, $id_new_specialty);
            return $responseCreateSP;
        } catch (\Throwable $th) {
            return 'ERROR' . $th->getMessage();
        }
    }

    public function update_sch_row(int $id_row, int $idSub, int $newKey, string $grupo)
    {
        $updateSch_query = "UPDATE `horario` SET `idSubarea`= ?, `numeroLlave`= ?, `Grupo`= ? WHERE id_row_sh = ?";
        $updateSch = mysqli_prepare($this->conn, $updateSch_query);
        mysqli_stmt_bind_param($updateSch, 'iisi', $idSub, $newKey, $grupo, $id_row);

        if (mysqli_stmt_execute($updateSch)) {
            mysqli_stmt_close($updateSch);
            return 'OK';
        } else {
            mysqli_stmt_close($updateSch);
            return 'ERROR';
        }
    }



    public function updateUser(
        int $nced,
        string $nnom,
        string $nci,
        string $npass_ci,
        int $ntelct,
        string $nmailct,
        string $nlink_photo
    ) {
        try {
            // Consulta de actualización
            $updateProfileQuery = "UPDATE `usuario` SET 
                `nombreCompleto` = ?, 
                `correoInstitucional` = ?, 
                `contraseñaCorreoInstitucional` = ?, 
                `numeroContacto` = ?, 
                `correoContacto` = ?, 
                `linkFotoPerfil` = ?  
                WHERE `cedulaUsuario` = ?";

            // Preparar la declaración
            $updateProfile = mysqli_prepare($this->conn, $updateProfileQuery);

            // Enlazar los parámetros
            mysqli_stmt_bind_param(
                $updateProfile,
                'sssissi',
                $nnom,
                $nci,
                $npass_ci,
                $ntelct,
                $nmailct,
                $nlink_photo,
                $nced
            );

            // Ejecutar la consulta
            if (mysqli_stmt_execute($updateProfile)) {
                // Confirmar la transacción
                $updateProfileResult = 'OK';
            } else {
                // Revertir la transacción si falla
                $updateProfileResult = 'ERROR';
            }

            // Cerrar la declaración preparada
            mysqli_stmt_close($updateProfile);
        } catch (Exception $e) {
            $updateProfileResult = 'ERROR: ' . $e->getMessage();
        }

        return $updateProfileResult;
    }

    public function updateSchedule($idDL, $idBl, $idSubA, $idKey, $userCed, $seccion)
    {
        date_default_timezone_set('America/Costa_Rica');

        $date = new DateTime();
        $year = $date->format('Y');

        // Preparar la consulta UPDATE en lugar de INSERT
        $update_sch = mysqli_prepare(
            $this->conn,
            'UPDATE `horario` 
             SET `idSubarea` = ?, `numeroLlave` = ?, `añoHorario` = ?, `seccion` = ?
             WHERE `idDiaLectivo` = ? AND `idBloqueLectivo` = ? AND `cedulaUsuario` = ?'
        );

        if (!$update_sch) {
            error_log("Error preparando la consulta: " . mysqli_error($this->conn));
            return 'ERROR PREPARANDO CONSULTA';
        }

        // Enlazar los parámetros en el orden correspondiente
        mysqli_stmt_bind_param($update_sch, 'iiisiii', $idSubA, $idKey, $year, $seccion, $idDL, $idBl, $userCed);

        // Ejecutar la consulta
        if (!mysqli_stmt_execute($update_sch)) {
            error_log("Error ejecutando la consulta: " . mysqli_stmt_error($update_sch));
            return 'ERROR EJECUTANDO CONSULTA';
        }

        mysqli_stmt_free_result($update_sch);
        mysqli_stmt_close($update_sch);

        return 'SUCCESS'; // Retornar 'SUCCESS' si la consulta se ejecuta correctamente
    }


    public function deleteUser(int $delete_ced, string $rol)
    {
        // Eliminar el horario si el rol es 'Profesor'
        if ($rol == 'Profesor') {

            // LIBERAR LLAVES QUE TENGA EL PROFESOR
            $freekeys_query = "UPDATE `llave` SET `Ocupada`= 0, `razonOcupada`='Sin razón', `cedulaProfesor`= NULL WHERE cedulaProfesor = ?";
            $freeKeys = mysqli_prepare($this->conn, $freekeys_query);
            mysqli_stmt_bind_param($freeKeys, 'i', $delete_ced);
            mysqli_stmt_execute($freeKeys);
            mysqli_stmt_close($freeKeys);

            // ELIMINAR TODAS LAS SOLICITUDES
            $deletesolis_query = 'DELETE FROM solicitudllave WHERE cedulaUsuario = ?';
            $deleteSolis = mysqli_prepare($this->conn, $deletesolis_query);
            mysqli_stmt_bind_param($deleteSolis, 'i', $delete_ced);
            mysqli_stmt_execute($deleteSolis);
            mysqli_stmt_close($deleteSolis);

            // ELIMINAR TODA LA ACTIVIDAD
            $deleteSchedule_query = 'DELETE FROM registro_actividad WHERE cedulaProfesor = ?';
            $deleteActivity = mysqli_prepare($this->conn, $deleteSchedule_query);
            mysqli_stmt_bind_param($deleteActivity, 'i', $delete_ced);
            mysqli_stmt_execute($deleteActivity);
            mysqli_stmt_close($deleteActivity);

            // ELIMINAR EL HORARIO
            $deleteScheduleQuery = 'DELETE FROM horario WHERE cedulaProfesor = ?';
            $deleteSchedule = mysqli_prepare($this->conn, $deleteScheduleQuery);
            mysqli_stmt_bind_param($deleteSchedule, 'i', $delete_ced);
            mysqli_stmt_execute($deleteSchedule);
            mysqli_stmt_close($deleteSchedule);
        }


        // Eliminar el perfil de usuario
        $deleteProfileQuery = 'DELETE FROM usuario WHERE cedulaUsuario = ?';
        $deleteProfile = mysqli_prepare($this->conn, $deleteProfileQuery);
        mysqli_stmt_bind_param($deleteProfile, 'i', $delete_ced);

        // Ejecutar y verificar el resultado
        if (mysqli_stmt_execute($deleteProfile)) {
            $deleteProfileResult = 'OK';
        } else {
            $deleteProfileResult = 'ERROR';
        }

        mysqli_stmt_close($deleteProfile);

        return $deleteProfileResult;
    }


    public function acceptUser(int $cedUser)
    {
        $acceptUserQuery = 'UPDATE usuario SET idEstadoAdmision = 1 WHERE cedulaUsuario = ?';

        $acceptUser = mysqli_prepare($this->conn, $acceptUserQuery);

        mysqli_stmt_bind_param($acceptUser, 'i', $cedUser);

        if (mysqli_stmt_execute($acceptUser)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllKeyRequests()
    {
        $keyrqs = mysqli_query($this->conn, 'SELECT * FROM solicitudllave');

        if ($keyrqs) {
            $results = mysqli_fetch_all($keyrqs, MYSQLI_ASSOC); // Obtiene todos los resultados en un array asociativo
            mysqli_close($this->conn);
            return $results; // Devuelve el array con los resultados
        } else {
            // Manejo de errores si la consulta falla
            echo "Error en la consulta: " . mysqli_error($this->conn);
            mysqli_close($this->conn);
            return 'ERROR';
        }
    }

    public function process_key_request(array $k_rq_dt)
    {
        // Obtener idSolicitud correctamente
        $sol_id = $k_rq_dt['idSolicitud'];

        // Determinar el estado de solicitud
        $act_cond = ($k_rq_dt['accion'] == 'aceptar') ? 1 : 3;
        $act_state = ($k_rq_dt['accion'] == 'aceptar') ? 1 : 2;

        // Actualizar estado de solicitud
        $process_sol = mysqli_query($this->conn, "UPDATE solicitudllave SET idEstadoSolicitud = $act_cond WHERE idSolicitudLlave = $sol_id");

        // Verificar si la actualización fue exitosa
        if (!$process_sol) {
            // Manejar error de actualización
            return false;
        }

        // Tipo de actividad (3)
        $kind_act = 3;

        $today_date =  date("Y/m/d");
        $today_hour = date('H:i:s');

        // Preparar la consulta para insertar en registro_actividad
        $insert_to_activity = mysqli_prepare(
            $this->conn,
            "INSERT INTO `registro_actividad`(
                `codigo_tipo_actividad`, 
                `cedulaProfesor`, 
                `fecha_actividad`, 
                `hora_inicio_actividad`, 
                `numeroLlave_solicitada`, 
                `fecha_uso_llave_solicitada`, 
                `cod_estado_solicitud`, 
                `hora_inicio_llave_solicitada`, 
                `hora_final_llave_solicitada`, 
                `razon_uso_llave_solicitada`
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        // Verificar si la preparación fue exitosa
        if (!$insert_to_activity) {
            // Manejar error de preparación
            return false;
        }

        // Enlazar los parámetros con los valores correspondientes
        mysqli_stmt_bind_param(
            $insert_to_activity,
            'iissisisss',
            $kind_act,
            $k_rq_dt['cedulaUsuario'],
            $today_date,
            $today_hour,
            $k_rq_dt['numeroLlave'],
            $k_rq_dt['fechaUtilizacion'],
            $act_state,
            $k_rq_dt['horaInicio'],
            $k_rq_dt['horaFinal'],
            $k_rq_dt['razonUso']
        );

        // Ejecutar la consulta e insertar actividad
        $result_activity = mysqli_stmt_execute($insert_to_activity);

        // Cerrar la consulta preparada
        mysqli_stmt_close($insert_to_activity);

        // Retornar el resultado de la ejecución
        return $result_activity;
    }


    public function getAllActivity()
    {
        $year = date("Y");
        $getAllActivity = mysqli_query($this->conn, "SELECT * FROM registro_actividad WHERE YEAR(fecha_actividad) = $year ORDER BY fecha_actividad DESC");

        $getAllActivity_rst = array_reverse(mysqli_fetch_all($getAllActivity));

        mysqli_free_result($getAllActivity);

        mysqli_close($this->conn);

        return $getAllActivity_rst;
    }

    public function check_reason_key(int $key)
    {
        $check_reason = mysqli_prepare($this->conn, "SELECT razonOcupada FROM llave WHERE numeroLlave = ?");
        mysqli_stmt_bind_param($check_reason, 'i', $key);
        mysqli_stmt_execute($check_reason);
        $result_check_reason = mysqli_stmt_get_result($check_reason);
        $row = mysqli_fetch_assoc($result_check_reason);
        mysqli_free_result($result_check_reason);
        mysqli_stmt_close($check_reason);

        // Verificar el valor de 'razonOcupada' y retornar el resultado
        return isset($row['razonOcupada']) && $row['razonOcupada'] != 'use_by_sch' ? 'GO' : 'GO';
    }

    public function updateKey(int $uptKey, int $uptKeyState, string $uptReason, $ced_professor)
    {
        // Si ced_professor es NULL, ajustamos la consulta
        if ($ced_professor === null) {
            // En lugar de asignar un parámetro, usamos 'NULL' en la consulta
            $update_key = mysqli_prepare($this->conn, "UPDATE `llave` SET `Ocupada`= ?, `razonOcupada`= ?, `cedulaProfesor`= NULL WHERE `numeroLlave` = ?");
            mysqli_stmt_bind_param($update_key, 'isi', $uptKeyState, $uptReason, $uptKey);
        } else {
            // Si ced_professor tiene un valor, lo tratamos como un entero
            $update_key = mysqli_prepare($this->conn, "UPDATE `llave` SET `Ocupada`= ?, `razonOcupada`= ?, `cedulaProfesor`= ? WHERE `numeroLlave` = ?");
            mysqli_stmt_bind_param($update_key, 'isii', $uptKeyState, $uptReason, $ced_professor, $uptKey);
        }

        if (mysqli_stmt_execute($update_key)) {
            mysqli_stmt_close($update_key);
            return 'SUCCESS';
        } else {
            mysqli_stmt_close($update_key);
            return 'ERROR';
        }
    }

    public function updateKey_Name(int $uptKey, string $uptKeyName)
    {
        $update_key_name = mysqli_prepare($this->conn, "UPDATE `llave` SET `nombreAula`= ? WHERE `numeroLlave` = ?");
        mysqli_stmt_bind_param($update_key_name, 'si', $uptKeyName, $uptKey);

        if (mysqli_stmt_execute($update_key_name)) {
            mysqli_stmt_close($update_key_name);
            return 'La llave ha sido actualizada exitosamente.';
        } else {
            mysqli_stmt_close($update_key_name);
            return 'Hubo un error al actualizar la llave.';
        }
    }


    public function set_ret_code(string $new_code, $newdatetime)
    {
        // Escapar y preparar los valores para evitar inyecciones SQL
        $new_code_escaped = mysqli_real_escape_string($this->conn, $new_code);
        $newdatetime_escaped = mysqli_real_escape_string($this->conn, $newdatetime);
    
        // Ejecutar la consulta UPDATE correctamente
        $query = "UPDATE `retiro_llave_access_code_mfa` SET `retiro_llave_access_code_mfa` = '$new_code_escaped', `datetime_act` = '$newdatetime_escaped'";
        mysqli_query($this->conn, $query);
    
        // Recuperar el valor actualizado
        $code = mysqli_query($this->conn, "SELECT `retiro_llave_access_code_mfa`, `datetime_act` FROM `retiro_llave_access_code_mfa` LIMIT 1");
        $res_code = mysqli_fetch_assoc($code);
    
        return $res_code;
    }
    
    public function get_ret_code()
    {
        $code = mysqli_query($this->conn, "SELECT retiro_llave_access_code_mfa, datetime_act FROM retiro_llave_access_code_mfa");
        $res_code = mysqli_fetch_assoc($code);
        return $res_code;
    }

    public function createKey(int $key, string $aula)
    {
        // First check if key already exists
        $check_key = mysqli_prepare($this->conn, "SELECT COUNT(*) FROM llave WHERE numeroLlave = ?");
        mysqli_stmt_bind_param($check_key, 'i', $key);
        mysqli_stmt_execute($check_key);
        mysqli_stmt_bind_result($check_key, $count);
        mysqli_stmt_fetch($check_key);
        mysqli_stmt_close($check_key);

        // If key exists, return error
        if ($count > 0) {
            return 'La llave que intenta registrar ya existe.';
        } else {
            // If key doesn't exist, create it
            $create_key = mysqli_prepare($this->conn, "INSERT INTO `llave`(`numeroLlave`, `Ocupada`, `nombreAula`, `razonOcupada`, `cedulaProfesor`) VALUES (?,?,?,?,?)");
            $reason = 'Sin razón'; // Default reason for new keys
            $occupied = 0;
            $null_professor = NULL;
            mysqli_stmt_bind_param($create_key, 'iisss', $key, $occupied, $aula, $reason, $null_professor);
            if (mysqli_stmt_execute($create_key)) {
                mysqli_stmt_close($create_key);
                return 'La llave ha sido registrada exitosamente.';
            } else {
                mysqli_stmt_close($create_key);
                return 'Hubo un error al registrar la llave.';
            }
        }
    }

    public function delete_key(int $dkey)
    {
        try {
            // Delete from solicitudllave
            $delete_solicitud = mysqli_prepare($this->conn, "DELETE FROM solicitudllave WHERE numeroLlave = ?");
            if (!$delete_solicitud) {
                throw new Exception("Error preparing solicitudllave query");
            }
            mysqli_stmt_bind_param($delete_solicitud, 'i', $dkey);
            if (!mysqli_stmt_execute($delete_solicitud)) {
                throw new Exception("Error executing solicitudllave query");
            }
            mysqli_stmt_close($delete_solicitud);

            // Delete from registro_actividad
            $delete_registro = mysqli_prepare($this->conn, "DELETE FROM registro_actividad WHERE 
                numeroLlave_solicitada = ? OR 
                numeroLlave1_ryd = ? OR 
                numeroLlave2_ryd = ? OR 
                numeroLlave3_ryd = ? OR 
                numeroLlave4_ryd = ? OR 
                numeroLlave5_ryd = ?");
            if (!$delete_registro) {
                throw new Exception("Error preparing registro_actividad query");
            }
            mysqli_stmt_bind_param($delete_registro, 'iiiiii', $dkey, $dkey, $dkey, $dkey, $dkey, $dkey);
            if (!mysqli_stmt_execute($delete_registro)) {
                throw new Exception("Error executing registro_actividad query");
            }
            mysqli_stmt_close($delete_registro);

            // Update schedule table
            $update_schedule = mysqli_prepare($this->conn, "UPDATE horario SET numeroLlave = 999 WHERE numeroLlave = ?");
            if (!$update_schedule) {
                throw new Exception("Error preparing horario query");
            }
            mysqli_stmt_bind_param($update_schedule, 'i', $dkey);
            if (!mysqli_stmt_execute($update_schedule)) {
                throw new Exception("Error executing horario query");
            }
            mysqli_stmt_close($update_schedule);

            // Delete from llave
            $delete_key = mysqli_prepare($this->conn, "DELETE FROM llave WHERE numeroLlave = ?");
            if (!$delete_key) {
                throw new Exception("Error preparing llave query");
            }
            mysqli_stmt_bind_param($delete_key, 'i', $dkey);
            if (!mysqli_stmt_execute($delete_key)) {
                throw new Exception("Error executing llave query");
            }
            mysqli_stmt_close($delete_key);

            return 'La llave ha sido eliminada exitosamente.';
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function createEspecialidad(string $nom_esp)
    {
        // First check if key already exists
        $check_esp = mysqli_prepare($this->conn, "SELECT COUNT(*) FROM especialidad WHERE nombreEspecialidad = ?");
        mysqli_stmt_bind_param($check_esp, 's', $nom_esp);
        mysqli_stmt_execute($check_esp);
        mysqli_stmt_bind_result($check_esp, $count);
        mysqli_stmt_fetch($check_esp);
        mysqli_stmt_close($check_esp);

        if ($count > 0) {
            return 'La especialidad que intenta registrar ya existe.';
        } else {
            $create_esp = mysqli_prepare($this->conn, "INSERT INTO `especialidad`(`nombreEspecialidad`) VALUES (?)");
            mysqli_stmt_bind_param($create_esp, 's', $nom_esp);
            if (mysqli_stmt_execute($create_esp)) {
                mysqli_stmt_close($create_esp);
                return 'La especialidad ha sido registrada exitosamente.';
            } else {
                mysqli_stmt_close($create_esp);
                return 'Hubo un error al registrar la especialidad.';
            }
        }
    }

    public function updateEspecialidad(int $idESp, string $new_esp_name)
    {
        $update_esp = mysqli_prepare($this->conn, "UPDATE `especialidad` SET `nombreEspecialidad`= ? WHERE `idEspecialidad` = ?");
        mysqli_stmt_bind_param($update_esp, 'si', $new_esp_name, $idESp);
        if (mysqli_stmt_execute($update_esp)) {
            mysqli_stmt_close($update_esp);
            return 'La especialidad ha sido actualizada exitosamente.';
        } else {
            mysqli_stmt_close($update_esp);
            return 'Hubo un error al actualizar la especialidad.';
        }
    }

    public function deleteEspecialidad(int $idEsp)
    {
        // Eliminar primero los horarios relacionados con la especialidad
        $delete_horarios = mysqli_prepare($this->conn, "DELETE FROM `horario` WHERE `idEspecialidad` = ?");
        mysqli_stmt_bind_param($delete_horarios, 'i', $idEsp);
    
        if (!mysqli_stmt_execute($delete_horarios)) {
            mysqli_stmt_close($delete_horarios);
            return 'Hubo un error al eliminar los horarios de la especialidad.';
        }
        mysqli_stmt_close($delete_horarios);
    
        // Luego eliminar las subáreas relacionadas
        $delete_subs_from_esp = mysqli_prepare($this->conn, "DELETE FROM `subarea` WHERE `idEspecialidad` = ?");
        mysqli_stmt_bind_param($delete_subs_from_esp, 'i', $idEsp);
    
        if (!mysqli_stmt_execute($delete_subs_from_esp)) {
            mysqli_stmt_close($delete_subs_from_esp);
            return 'Hubo un error al eliminar las subáreas de la especialidad.';
        }
        mysqli_stmt_close($delete_subs_from_esp);
    
        // Finalmente eliminar la especialidad
        $delete_esp = mysqli_prepare($this->conn, "DELETE FROM `especialidad` WHERE `idEspecialidad` = ?");
        mysqli_stmt_bind_param($delete_esp, 'i', $idEsp);
    
        if (mysqli_stmt_execute($delete_esp)) {
            mysqli_stmt_close($delete_esp);
            return 'La especialidad ha sido eliminada exitosamente.';
        } else {
            mysqli_stmt_close($delete_esp);
            return 'Hubo un error al eliminar la especialidad.';
        }
    }


    public function createSubarea(int $idEspecialidad, string $subarea, string $nombreEspecialidad)
    {

        $check_sub = mysqli_prepare($this->conn, "SELECT COUNT(*) FROM subarea WHERE nombreSubarea = ? AND idEspecialidad = ?");
        mysqli_stmt_bind_param($check_sub, 'si', $subarea, $idEspecialidad);
        mysqli_stmt_execute($check_sub);
        mysqli_stmt_bind_result($check_sub, $count);
        mysqli_stmt_fetch($check_sub);
        mysqli_stmt_close($check_sub);

        if ($count > 0) {
            return "La subárea que intenta registrar ya existe en la especialidad $nombreEspecialidad.";
        } else {
            $create_subarea = mysqli_prepare($this->conn, "INSERT INTO `subarea`(`idEspecialidad`, `nombreSubarea`) VALUES (?, ?)");
            mysqli_stmt_bind_param($create_subarea, 'is', $idEspecialidad, $subarea);
            if (mysqli_stmt_execute($create_subarea)) {
                mysqli_stmt_close($create_subarea);
                return "La subárea ha sido registrada exitosamente en la especialidad $nombreEspecialidad.";
            } else {
                mysqli_stmt_close($create_subarea);
                return 'Hubo un error al registrar la subárea.';
            }
        }
    }

    public function updateSubarea(int $idSubarea, string $nombreSubarea, int $idEspecialidad, string $nombreEspecialidad)
    {
        // Check if another subarea with the same new name exists, excluding the current one
        $check_sub = mysqli_prepare($this->conn, "SELECT COUNT(*) FROM subarea WHERE nombreSubarea = ? AND idEspecialidad = ? AND idSubarea != ?");
        mysqli_stmt_bind_param($check_sub, 'sii', $nombreSubarea, $idEspecialidad, $idSubarea);
        mysqli_stmt_execute($check_sub);
        mysqli_stmt_bind_result($check_sub, $count);
        mysqli_stmt_fetch($check_sub);
        mysqli_stmt_close($check_sub);

        if ($count > 0) {
            return "La subárea con el nombre $nombreSubarea ya existe en la especialidad $nombreEspecialidad.";
        } else {
            $update_sub = mysqli_prepare($this->conn, "UPDATE `subarea` SET `nombreSubarea`= ? WHERE `idEspecialidad` = ? AND `idSubarea` = ?");
            mysqli_stmt_bind_param($update_sub, 'sii', $nombreSubarea, $idEspecialidad, $idSubarea);
            if (mysqli_stmt_execute($update_sub)) {
                mysqli_stmt_close($update_sub);
                return "La subárea perteneciente a la especialidad $nombreEspecialidad, ha sido actualizada exitosamente.";
            } else {
                mysqli_stmt_close($update_sub);
                return 'Hubo un error al actualizar la subárea.';
            }
        }
    }

    public function deleteSubarea(int $idSubarea, int $idEspecialidad, string $nombreEspecialidad)
    {
        $update_subs_in_sch = mysqli_prepare($this->conn, "UPDATE `horario` SET `idSubarea` = 1 WHERE `idSubarea` = ?");
        mysqli_stmt_bind_param($update_subs_in_sch, 'i', $idSubarea);
        if (mysqli_stmt_execute($update_subs_in_sch)) {
            mysqli_stmt_close($update_subs_in_sch);

            $delete_sub = mysqli_prepare($this->conn, "DELETE FROM `subarea` WHERE `idSubarea` = ? AND `idEspecialidad` = ?");
            mysqli_stmt_bind_param($delete_sub, 'ii', $idSubarea, $idEspecialidad);
            if (mysqli_stmt_execute($delete_sub)) {
                mysqli_stmt_close($delete_sub);
                return "La subárea perteneciente a la especialidad $nombreEspecialidad, ha sido eliminada exitosamente.";
            } else {
                mysqli_stmt_close($delete_sub);
                return 'Hubo un error al eliminar la subárea.';
            }
        } else {
            $error = mysqli_stmt_error($update_subs_in_sch);
            mysqli_stmt_close($update_subs_in_sch);
            return "Error actualizando el horario: $error";
        }
    }
    
    public function update_pp(int $ced, string $link_pp) {
        $update_pp = mysqli_prepare($this->conn, "UPDATE `usuario` SET `linkFotoPerfil` = ? WHERE `cedulaUsuario` = ?");
        
        // Aquí el orden correcto es: string, int -> 'si'
        mysqli_stmt_bind_param($update_pp, 'si', $link_pp, $ced);
    
        if (mysqli_stmt_execute($update_pp)) {
            mysqli_stmt_close($update_pp);
            return 'OK';
        } else {
            mysqli_stmt_close($update_pp);
            return 'ERROR';
        }
    }

}
