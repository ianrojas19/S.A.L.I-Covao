<?php

class AuthModel
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


    public function processLogin(string $emailUser, string $password)
    {
        $buscarUsuario = mysqli_prepare($this->conn, 'SELECT * FROM usuario WHERE correoInstitucional = ?');

        mysqli_stmt_bind_param($buscarUsuario, 's', $emailUser);

        mysqli_stmt_execute($buscarUsuario);

        $resultadoBU = mysqli_stmt_get_result($buscarUsuario);

        $usuario = mysqli_fetch_assoc($resultadoBU);

        if (mysqli_num_rows($resultadoBU) != 0) {
            if (password_verify($password, $usuario['contraseñaCorreoInstitucional'])) {
                mysqli_stmt_free_result($buscarUsuario);
                mysqli_stmt_close($buscarUsuario);
                return $usuario;
            } else {
                mysqli_stmt_free_result($buscarUsuario);
                mysqli_stmt_close($buscarUsuario);
                return false;
            }
        } else {
            mysqli_stmt_free_result($buscarUsuario);
            mysqli_stmt_close($buscarUsuario);
            return false;
        }
    }

    public function changeLoggedStatus(string $emailUser, int $logStatus): void
    {
        $changeStatus = mysqli_prepare($this->conn, 'UPDATE usuario SET usuarioLogeado = ? WHERE correoInstitucional = ?');
        mysqli_stmt_bind_param($changeStatus, 'is', $logStatus, $emailUser);
        mysqli_stmt_execute($changeStatus);
        mysqli_stmt_free_result($changeStatus);
        mysqli_stmt_close($changeStatus);
    }

    public function searchRolUser(string|null $emailUser): string
    {
        $query = '
        SELECT r.nombreRol 
        FROM usuario u
        JOIN rol r ON u.idRol = r.idRol
        WHERE u.correoInstitucional = ?
    ';

        $stmt = mysqli_prepare($this->conn, $query);
        if (!$stmt) {
            die('mysqli error: ' . mysqli_error($this->conn));
        }


        mysqli_stmt_bind_param($stmt, 's', $emailUser);


        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($result === false) {
            die('mysqli error: ' . mysqli_error($this->conn));
        }

        $row = mysqli_fetch_assoc($result);
        $rol = $row ? $row['nombreRol'] : 'Sin rol';


        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
        return $rol;
    }

    public function getAllUsers()
    {
        $getUsers = mysqli_query($this->conn, 'SELECT * FROM usuario');
        $users = mysqli_fetch_all($getUsers);
        mysqli_free_result($getUsers);
        mysqli_close($this->conn);
        return $users;
    }


    public function user_exists(string $email)
    {
        $getUser = mysqli_prepare($this->conn, "SELECT correoInstitucional FROM usuario WHERE correoInstitucional = ?");
        mysqli_stmt_bind_param($getUser, 's', $email);
        mysqli_stmt_execute($getUser);
        $getUsertrac = mysqli_stmt_get_result($getUser);
        $getUserResultreccode = mysqli_fetch_all($getUsertrac);
        mysqli_stmt_free_result($getUser);
        mysqli_stmt_close($getUser);

        if (empty($getUserResultreccode)) {
            return false;
        } else {
            return $getUserResultreccode;
        }
    }


    public function getEspecialidades()
    {
        $findEspecialidades_Query = 'SELECT nombreEspecialidad FROM especialidad';

        $find_Espec = mysqli_prepare($this->conn, $findEspecialidades_Query);

        mysqli_stmt_execute($find_Espec);

        // Obtener el resultado del find_Espec
        $fceresultado = mysqli_stmt_get_result($find_Espec);

        // Recorrer el resultado obtenido
        while ($row = mysqli_fetch_assoc($fceresultado)) {
            $especialidades[] = $row['nombreEspecialidad'];
        }

        mysqli_stmt_free_result($find_Espec);

        mysqli_stmt_close($find_Espec);

        // Devolver el array de especialidades
        return $especialidades;
    }


    public function getEspecialidad(int $idEsp)
    {
        $findEspecialidad_Query = 'SELECT nombreEspecialidad FROM especialidad WHERE idEspecialidad = ?';

        $find_Espec_byId = mysqli_prepare($this->conn, $findEspecialidad_Query);

        mysqli_stmt_bind_param($find_Espec_byId, 'i', $idEsp);

        mysqli_stmt_execute($find_Espec_byId);

        // Obtener el resultado del find_Espec
        $find_spec_byId_resultado = mysqli_stmt_get_result($find_Espec_byId);

        // Recorrer el resultado obtenido
        while ($row = mysqli_fetch_assoc($find_spec_byId_resultado)) {
            $especialidad = $row['nombreEspecialidad'];
        }

        mysqli_stmt_free_result($find_Espec_byId);

        mysqli_stmt_close($find_Espec_byId);

        // Devolver el array de especialidades
        return $especialidad;
    }


    public function registrarUsuario(
        int $ced,
        string $nom,
        string $correoIns,
        string $passCorreoIns,
        int $numCont,
        string $correoCont,
        string $linkPhoto,
        string $rol,
        string $especialidad,
        int $actionState
    ) {
        // Encontrar id de Rol y de Especialidad
        $findRol_Query = 'SELECT idRol FROM rol WHERE nombreRol = ?';
        $findEspec_Query = 'SELECT idEspecialidad FROM especialidad WHERE nombreEspecialidad = ?';

        $findRol = mysqli_prepare($this->conn, $findRol_Query);
        $findEspec = mysqli_prepare($this->conn, $findEspec_Query);

        // Vincular parámetros y ejecutar consulta para Rol
        mysqli_stmt_bind_param($findRol, 's', $rol);
        mysqli_stmt_execute($findRol);
        $resultRol = mysqli_stmt_get_result($findRol);
        $idRol = mysqli_fetch_assoc($resultRol)['idRol'];

        // Vincular parámetros y ejecutar consulta para Especialidad
        mysqli_stmt_bind_param($findEspec, 's', $especialidad);
        mysqli_stmt_execute($findEspec);
        $resultEspec = mysqli_stmt_get_result($findEspec);
        $idEspecialidad = mysqli_fetch_assoc($resultEspec)['idEspecialidad'];

        $createUser_Query = "INSERT INTO `usuario`
          (`cedulaUsuario`, `nombreCompleto`, `correoInstitucional`, `contraseñaCorreoInstitucional`, 
          `numeroContacto`, `correoContacto`, `linkFotoPerfil`, `idRol`, `idEstadoAdmision`, `usuarioLogeado`) 
          VALUES (?,?,?,?,?,?,?,?,?,?)";

        $createUser = mysqli_prepare($this->conn, $createUser_Query);

        $defaultEstadoAdmision = $actionState;
        $defaultUsuarioLogeado = 0;
        $correoIns = strtolower($correoIns);
        $correoCont = strtolower($correoCont);
mysqli_stmt_bind_param(
    $createUser,
    'isssissiii', // 10 tipos
    $ced,
    $nom,
    $correoIns,
    $passCorreoIns,
    $numCont,
    $correoCont,
    $linkPhoto,
    $idRol,
    $defaultEstadoAdmision,
    $defaultUsuarioLogeado
);


        if (!mysqli_stmt_execute($createUser)) {
            echo "Error: " . mysqli_stmt_error($createUser);
        }

        mysqli_stmt_free_result($createUser);

        mysqli_stmt_close($findEspec);

        mysqli_stmt_close($findRol);
    }
    
    public function restablish_pass(string $email, string $newpass_base)
    {
        // Hash de la nueva contraseña
        $newpass = password_hash($newpass_base, PASSWORD_BCRYPT);

        $newpass_query = "UPDATE usuario SET contraseñaCorreoInstitucional = ? WHERE correoInstitucional = ?";
        $restablishpass = mysqli_prepare($this->conn, $newpass_query);
        if (!$restablishpass) {
            error_log("Error al preparar la consulta: " . mysqli_error($this->conn));
            return false;
        }
        mysqli_stmt_bind_param($restablishpass, 'ss', $newpass, $email);
        $is_successful = mysqli_stmt_execute($restablishpass);
        mysqli_stmt_close($restablishpass);

        return $is_successful;
    }
}
