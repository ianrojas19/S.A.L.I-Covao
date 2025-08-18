<?php

class ProfesorModel
{
    private $conn;

    public function __construct()
    {
        // Inicializar la conexión a la base de datos
        require('./app/config/bd.php');
        $this->conn = $conn;

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die('Conexión fallida: ' . $this->conn->connect_error);
        }
    }
    
    
    
    
    
    public function get_ret_keys_sch(int $cedProfesor, string $nom_dia) {
    
    $get_keys_sch = mysqli_prepare(
        $this->conn,
        "SELECT numeroLlave 
         FROM horario 
         WHERE cedulaProfesor = ? 
           AND diaLectivo = ? 
           AND numeroLlave != 999

         UNION

         SELECT numeroLlave 
         FROM solicitudllave 
         WHERE cedulaUsuario = ? 
           AND idEstadoSolicitud = 1 
           AND DATE(fechaUtilizacion) = ? 
           AND numeroLlave != 999"
    );

    $fechaHoy = date('Y-m-d');
    
    // Enlazar cuatro parámetros: cedProfesor, nom_dia, cedProfesor, fechaHoy
    mysqli_stmt_bind_param($get_keys_sch, 'isis', $cedProfesor, $nom_dia, $cedProfesor, $fechaHoy);

        if (mysqli_stmt_execute($get_keys_sch)) {
            $result = mysqli_stmt_get_result($get_keys_sch);
    
            if (mysqli_num_rows($result) == 0) {
                $data = 'no_keys';
            } else {
                $data = [];
                $added_keys = [];
    
                while ($row = mysqli_fetch_assoc($result)) {
                    $llave = $row['numeroLlave'];
    
                    if (!in_array($llave, $added_keys)) {
                        $data[] = $row;
                        $added_keys[] = $llave;
                    }
                }
            }
    
            mysqli_free_result($result);
            mysqli_stmt_close($get_keys_sch);
    
            return $data;
        } else {
            mysqli_stmt_close($get_keys_sch);
            return false;
        }
    }


    
    
      public function get_dev_keys_sch(int $cedProfesor) {
        $get_keys_sch = mysqli_prepare(
            $this->conn,
            "SELECT numeroLlave FROM llave WHERE cedulaProfesor = ? AND numeroLlave != 999 AND Ocupada = 1"
        );
    
        mysqli_stmt_bind_param($get_keys_sch, 'i', $cedProfesor);
    
        if (mysqli_stmt_execute($get_keys_sch)) {
            $result = mysqli_stmt_get_result($get_keys_sch);
    
            if (mysqli_num_rows($result) == 0) {
                $data = 'no_keys';
            } else {
                $data = [];
                $added_keys = []; // Para llevar control de llaves agregadas
    
                while ($row = mysqli_fetch_assoc($result)) {
                    $llave = $row['numeroLlave'];
    
                    if (!in_array($llave, $added_keys)) {
                        $data[] = $row;
                        $added_keys[] = $llave;
                    }
                }
            }
    
            mysqli_free_result($result);
            mysqli_stmt_close($get_keys_sch);
    
            return $data;
        } else {
            mysqli_stmt_close($get_keys_sch);
            return false;
        }
    }


    
    

    public function requestKey(
        $fechaSeleccionada,
        $horaInicio,
        $horaFinal,
        $n_llave,
        $prof_ced,
        $justificacion
    ) {
        // Formato de fecha y hora para la base de datos
        $today_date = date('Y-m-d'); // Formato estándar de fecha
        $now_time = date('H:i'); // Formato de hora de 24 horas
        $default_state = 2;

        // Preparar la consulta con un solo 'INSERT INTO'
        $reqkey = mysqli_prepare(
            $this->conn,
            "INSERT INTO `solicitudllave` (`fechaEmision`, `horaEmision`, `fechaUtilizacion`, `horaInicio`, `horaFinal`, `numeroLlave`, `cedulaUsuario`, `idEstadoSolicitud`, `razonUso`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        // Vincular parámetros con tipos correctos
        mysqli_stmt_bind_param(
            $reqkey,
            'sssssiiis',
            $today_date,
            $now_time,
            $fechaSeleccionada,
            $horaInicio,
            $horaFinal,
            $n_llave,
            $prof_ced,
            $default_state,
            $justificacion
        );

        // Ejecutar la consulta y verificar el resultado
        if (mysqli_stmt_execute($reqkey)) {
            mysqli_stmt_free_result($reqkey);
            mysqli_stmt_close($reqkey);
            return true;
        } else {
            mysqli_stmt_free_result($reqkey);
            mysqli_stmt_close($reqkey);
            return false;
        }
    }


    public function getRetCode()
    {
        $result = mysqli_query($this->conn, "SELECT retiro_llave_access_code_mfa FROM retiro_llave_access_code_mfa WHERE idretiro_llave_access_code_mfa = 1");

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
        } else {
            $row = 'na';
        }

        // Cerrar la conexión
        mysqli_close($this->conn);

        // Devolver el resultado (puede ser un valor o un array con los datos)
        return $row;
    }

    public function processRetiro($prof_ced, $k1, $k2 = null, $k3 = null, $k4 = null, $k5 = null, $k6 = null, $k7 = null, $k8 = null, $k9 = null)
        {
            $today_date = date("Y/m/d");
            $current_time = date("H:i:s");
            $conn = $this->conn;
        
            $llaves = [
                $k1 ?? '', $k2 ?? '', $k3 ?? '', $k4 ?? '', $k5 ?? '',
                $k6 ?? '', $k7 ?? '', $k8 ?? '', $k9 ?? ''
            ];
        
            $params = array_merge([$prof_ced, $today_date, $current_time], $llaves);
            $type = str_repeat("s", count($params));
        
            $sql = "INSERT INTO registro_actividad (
                        codigo_tipo_actividad, cedulaProfesor, fecha_actividad, hora_inicio_actividad,
                        numeroLlave1_ryd, numeroLlave2_ryd, numeroLlave3_ryd, numeroLlave4_ryd, numeroLlave5_ryd,
                        numeroLlave6_ryd, numeroLlave7_ryd, numeroLlave8_ryd, numeroLlave9_ryd
                    ) VALUES (
                        1, ?, ?, ?,
                        ?, ?, ?, ?, ?,
                        ?, ?, ?, ?
                    )";
        
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                return "Error preparando la consulta de inserción: " . $conn->error;
            }
        
            $stmt->bind_param($type, ...$params);
            if ($stmt->execute() === false) {
                return "Error ejecutando la consulta de inserción: " . $stmt->error;
            }
        
            $stmt->close();
        
            // Filtrar las llaves no vacías para evitar pasar llaves vacías al WHERE
            $llaves_actualizar = array_filter($llaves, fn($val) => !empty($val));
        
            if (!empty($llaves_actualizar)) {
                $placeholders = implode(', ', array_fill(0, count($llaves_actualizar), '?'));
                $sql_update = "UPDATE llave 
                               SET Ocupada = 1, razonOcupada = 'use_by_sch', cedulaProfesor = ? 
                               WHERE numeroLlave IN ($placeholders)";
        
                $stmt_update = $conn->prepare($sql_update);
                if ($stmt_update === false) {
                    return "Error preparando la consulta de actualización: " . $conn->error;
                }
        
                $update_params = array_merge([$prof_ced], $llaves_actualizar);
                $update_types = str_repeat("s", count($update_params));
        
                $stmt_update->bind_param($update_types, ...$update_params);
                if ($stmt_update->execute() === false) {
                    return "Error ejecutando la consulta de actualización: " . $stmt_update->error;
                }
        
                $stmt_update->close();
            }
        
            $conn->close();
            return "OK";
        }
        
        
       public function processDevolucion(
            $prof_ced, $k1, $k2 = null, $k3 = null, $k4 = null, $k5 = null,
            $k6 = null, $k7 = null, $k8 = null, $k9 = null,
            $bitacora, $gravedad, $razon
        ) {
            $today_date = date("Y/m/d");
            $current_time = date("H:i:s");
            $conn = $this->conn;
        
            // Arreglo de llaves con valores null si no se pasan
            $llaves = [
                $k1, $k2, $k3, $k4, $k5,
                $k6, $k7, $k8, $k9
            ];
        
            // Parámetros completos para el insert
            $params = array_merge([$prof_ced, $today_date, $current_time], $llaves, [$bitacora, $gravedad, $razon]);
            $type = str_repeat("s", count($params)); // Todos como string
        
            $sql = "INSERT INTO registro_actividad (
                        codigo_tipo_actividad, cedulaProfesor, fecha_actividad, hora_inicio_actividad,
                        numeroLlave1_ryd, numeroLlave2_ryd, numeroLlave3_ryd, numeroLlave4_ryd, numeroLlave5_ryd,
                        numeroLlave6_ryd, numeroLlave7_ryd, numeroLlave8_ryd, numeroLlave9_ryd,
                        bitacora_devolucion, cod_gravedad_devolucion, razon_devolucion
                    ) VALUES (
                        2, ?, ?, ?,
                        ?, ?, ?, ?, ?,
                        ?, ?, ?, ?, ?, ?, ?
                    )";
        
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                return "Error preparando la consulta de inserción: " . $conn->error;
            }
        
            $stmt->bind_param($type, ...$params);
            if ($stmt->execute() === false) {
                return "Error ejecutando la consulta de inserción: " . $stmt->error;
            }
        
            $stmt->close();
        
            // Filtrar llaves no vacías para el UPDATE
            $llaves_actualizar = array_filter($llaves, fn($val) => !empty($val));
        
            if (!empty($llaves_actualizar)) {
                $placeholders = implode(', ', array_fill(0, count($llaves_actualizar), '?'));
                $sql_update = "UPDATE llave 
                               SET Ocupada = 0, razonOcupada = 'Sin razón', cedulaProfesor = NULL 
                               WHERE numeroLlave IN ($placeholders)";
        
                $stmt_update = $conn->prepare($sql_update);
                if ($stmt_update === false) {
                    return "Error preparando la consulta de actualización: " . $conn->error;
                }
        
                $update_types = str_repeat("s", count($llaves_actualizar));
                $stmt_update->bind_param($update_types, ...$llaves_actualizar);
        
                if ($stmt_update->execute() === false) {
                    return "Error ejecutando la consulta de actualización: " . $stmt_update->error;
                }
        
                $stmt_update->close();
            }
        
            $conn->close();
            return "OK";
        }

        
             

        

    public function getProfActivity($prof_ced)
    {
        $year = date("Y");
        $acquery = "SELECT * FROM registro_actividad WHERE cedulaProfesor = ? AND YEAR(fecha_actividad) = $year ORDER BY fecha_actividad ASC";
        $activity = mysqli_prepare($this->conn, $acquery);
        mysqli_stmt_bind_param($activity, 'i', $prof_ced);

        if (mysqli_stmt_execute($activity)) {
            $acproc = mysqli_stmt_get_result($activity);
            $acresult = mysqli_fetch_all($acproc);
            mysqli_free_result($acproc);
            mysqli_stmt_close($activity);
            return $acresult;
        } else {
            mysqli_stmt_close($activity);
            return false;
        }
    }

    public function getKeysTakenbyProf($prof_ced)
    {
        $keysTaken = mysqli_prepare($this->conn, "SELECT * FROM llave WHERE cedulaProfesor = ? AND Ocupada = 1");
        mysqli_stmt_bind_param($keysTaken, 'i', $prof_ced);
        if (mysqli_stmt_execute($keysTaken)) {
            $pr = mysqli_stmt_get_result($keysTaken);
            $keysTakenResult = mysqli_fetch_all($pr);
            mysqli_free_result($pr);
            mysqli_stmt_close($keysTaken);
            return $keysTakenResult;
        } else {
            mysqli_stmt_close($keysTaken);
            return false;
        }
    }
    
    public function getProfMonthActivity($prof_ced)
    {
        $year = date("Y");
        $month = date("m");
        $acmquery = "SELECT * FROM registro_actividad WHERE cedulaProfesor = ? AND YEAR(fecha_actividad) = $year 
            AND MONTH(fecha_actividad) = $month
            ORDER BY fecha_actividad ASC";
        $activitym = mysqli_prepare($this->conn, $acmquery);
        mysqli_stmt_bind_param($activitym, 'i', $prof_ced);

        if (mysqli_stmt_execute($activitym)) {
            $acproc = mysqli_stmt_get_result($activitym);
            $acresult = array_reverse(mysqli_fetch_all($acproc));
            mysqli_free_result($acproc);
            mysqli_stmt_close($activitym);
            return $acresult;
        } else {
            mysqli_stmt_close($activitym);
            return false;
        }
    }
}
