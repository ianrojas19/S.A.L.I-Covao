<?php

require('./app/models/profesorModel.php');

class ProfesorController
{
    private $profesorModel;
    private $adminModel;

    public function __construct()
    {
        $this->profesorModel = new ProfesorModel();
        $this->adminModel = new AdministradorModel();
    }

    public function dashboardProfesor($prof_ced)
    {
        require_once './app/views/profesor/profesor_index.php';
    }

    public function showHorario($prof_ced)
    {
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $aulas = $this->adminModel->getAulas();
        $subareas = $this->adminModel->getSubareas();
        $especialidades = $this->adminModel->getEspecialidades();
?>
        <script>
            const ced_profesor = <?php echo $prof_ced ?>;
            const aulas = <?php echo json_encode($aulas) ?>;
            const subareas = <?php echo json_encode($subareas) ?>;
            const especialidades = <?php echo json_encode($especialidades) ?>;
        </script>
        <?php
        require_once './app/views/profesor/profesor_horario.php';
      } else{
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
      }
    }

    public function showSolicitudAula()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $keys = $this->adminModel->getAulas();
        ?>
            <script>
                const keys = <?php echo json_encode($keys); ?>;
            </script>
        <?php

            require_once './app/views/profesor/profesor_solicitud_aula.php';
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action_type = $_POST['action_type'];

            if ($action_type == 'request_key') {
                $n_llave = $_POST['n_llave'];
                $fechaSeleccionada = $_POST['fechaSeleccionada'];
                $horaInicio = $_POST['horaInicio'];
                $horaFinal = $_POST['horaFinal'];
                $justificacion = $_POST['justificacion'];

                $response_key_req = $this->profesorModel->requestKey(
                    $fechaSeleccionada,
                    $horaInicio,
                    $horaFinal,
                    $n_llave,
                    $_SESSION['cedUser'],
                    $justificacion
                );

                echo $response_key_req;
            }
        }
    }


    public function showRetiroLlaves($prof_ced)
    {
        if ($_SERVER["REQUEST_METHOD"] == 'GET') {
            // $sch = $this->adminModel->getSchedule($prof_ced);
            $aulas = $this->adminModel->getAulas();
        ?>
            <script>
                const aulas = <?php echo json_encode($aulas) ?>;
            </script>
        <?php

            require_once './app/views/profesor/profesor_retiro_llaves.php';
        } else if ($_SERVER["REQUEST_METHOD"] == 'POST') {

            if ($_POST['action_type'] == 'getretcode') {
                $retcode = $this->profesorModel->getRetCode();
                header('Content-Type: application/json');
                echo json_encode($retcode);
            }
            
            if($_POST['action_type'] == 'get_profesor_sch_keys'){
                $day = $_POST['dayNumber'];
                switch ($day) {
                    case 1:
                        $keys_of_sch = $this->profesorModel->get_ret_keys_sch(intval($_SESSION['cedUser']), 'Lunes');
                        break;
                    case 2:
                        $keys_of_sch = $this->profesorModel->get_ret_keys_sch(intval($_SESSION['cedUser']), 'Martes');
                        break;
                    case 3:
                        $keys_of_sch = $this->profesorModel->get_ret_keys_sch(intval($_SESSION['cedUser']), 'Miercoles');
                        break;
                    case 4:
                        $keys_of_sch = $this->profesorModel->get_ret_keys_sch(intval($_SESSION['cedUser']), 'Jueves');
                        break;
                    case 5:
                        $keys_of_sch = $this->profesorModel->get_ret_keys_sch(intval($_SESSION['cedUser']), 'Viernes');
                        break;
                    default:
                        $keys_of_sch =  'finde';
                        break;
                }
                
                echo json_encode($keys_of_sch);
            }
            
            if ($_POST['action_type'] == 'process_retiro') {
                $retiro_result = $this->profesorModel->processRetiro(
                    $_SESSION['cedUser'],
                    $_POST['key1'] ?? null,
                    $_POST['key2'] ?? null,
                    $_POST['key3'] ?? null,
                    $_POST['key4'] ?? null,
                    $_POST['key5'] ?? null,
                    $_POST['key6'] ?? null,
                    $_POST['key7'] ?? null,
                    $_POST['key8'] ?? null,
                    $_POST['key9'] ?? null,
                );

                echo $retiro_result;  
            }

            if ($_POST['action_type'] == 'activate_key_action') {
                if ($_POST['geo_permission_state'] === 'granted') {
                    // require_once './app/views/profesor/includes/retiro/retiro.php';
                } else {
                    echo 'Error al cargar el contenido';
                }
            }
        }
    }

    public function showDevLllaves($prof_ced)
    {
        if ($_SERVER["REQUEST_METHOD"] == 'GET') {

            $aulas = $this->adminModel->getAulas();
                ?>
                    <script>
                        const aulas = <?php echo json_encode($aulas) ?>;
                    </script>
                <?php
            require_once './app/views/profesor/profesor_devolucion_llaves.php';
        } else if ($_SERVER["REQUEST_METHOD"] == 'POST') {

            if($_POST['action_type'] == 'get_profesor_sch_keys'){
                
                $keys_of_sch = $this->profesorModel->get_dev_keys_sch(intval($_SESSION['cedUser']));
                
                echo json_encode($keys_of_sch);
            }


            if ($_POST['action_type'] == 'activate_key_action') {
                if ($_POST['geo_permission_state'] === 'granted') {
                    require_once './app/views/profesor/includes/devolucion/devolucion.php';
                } else {
                    echo 'Error al cargar el contenido';
                }
            }

            if ($_POST['action_type'] == 'process_devolution') {
                
                $bitacora = $_POST['bitacora'];
                $gravedad = $_POST['gravedad'];
                $reasons = $_POST['reasons'];
            
                $process_dev_response = $this->profesorModel->processDevolucion(
                    $_SESSION['cedUser'],
                    $_POST['key1'] ?? null,
                    $_POST['key2'] ?? null,
                    $_POST['key3'] ?? null,
                    $_POST['key4'] ?? null,
                    $_POST['key5'] ?? null,
                    $_POST['key6'] ?? null,
                    $_POST['key7'] ?? null,
                    $_POST['key8'] ?? null,
                    $_POST['key9'] ?? null,
                    $bitacora,
                    $gravedad,
                    $reasons
                );
                
                echo $process_dev_response;
            }
            
        }
    }

    public function showActividad($prof_ced)
    {
        $activity = $this->profesorModel->getProfMonthActivity($prof_ced);
        $keys = $this->adminModel->getAulas();
        ?>
        <script>
            const activity = <?php echo json_encode($activity) ?>;
            const keys = <?php echo json_encode($keys) ?>;
        </script>
<?php
        require_once './app/views/profesor/profesor_actividad.php';
    }
}
