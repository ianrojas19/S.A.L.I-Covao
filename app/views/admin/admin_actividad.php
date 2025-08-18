<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./public/node_modules/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="./public/node_modules/flatpickr/dist/themes/airbnb.css">
    <link rel="stylesheet" href="./public/css/admin/admin_actividad.css">
    <title>SALI · Actividad</title>
</head>

<body>

    <section id="dashboard_admin" class="container-fluid d-flex p-0">

        <!-- Menu lateral izquierdo -->
        <?php include 'includes/nav_principal.php' ?>
        <!-- FINAL Menu lateral izquierdo -->

        <!-- Seccion del contenido -->
        <section id="ds_panel_container" class="ds_component">

            <div id="ds_panel">

                <!-- HEADER DE SUS INTERFACES -->
                <div id="ds_panel_header" class="d-flex justify-content-between align-items-center mb-2">

                    <!-- TITULO DE LA INTERFAZ  -->
                    <h1 id="ds_title">Actividad</h1>



                    <!-- FILTROS DE LA INTERFAZ -->
                    <div id="ds_panel_filters" class="w-50 d-flex justify-content-end align-items-center "
                        style="gap: 7px;">

                        <input type="text" name="search_names" id="search_names" class="form-control w-75"
                            placeholder="Ingrese el nombre de un usuario o aula...">
                        <svg id="close_search" xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>

                        <span id="filter_btn"
                            class="d-flex btn justify-content-center align-items-center bg-info dropdown-toggle"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Filtros
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                            </svg>
                        </span>

                        <ul id="filter_activity" class="dropdown-menu">
                            <li>
                                <label for="see_all_activity" class="dropdown-item py-3">
                                    <input class="form-check-input filter_activity_kind" type="radio"
                                        name="filters_roles" id="see_all_activity" checked>
                                    <label class="form-check-label" for="see_all_activity">
                                        Mostrar todo tipo de actividad
                                    </label>
                                </label>
                            </li>
                            <li>
                                <label for="see_key_retiros" class="dropdown-item py-3">
                                    <input class="form-check-input filter_activity_kind" type="radio"
                                        name="filters_roles" id="see_key_retiros">
                                    <label class="form-check-label" for="see_key_retiros">
                                        Mostrar Retiros de Llaves
                                    </label>
                                </label>
                            </li>
                            <li>
                                <label for="see_key_devoluciones" class="dropdown-item py-3">
                                    <input class="form-check-input filter_activity_kind" type="radio"
                                        name="filters_roles" id="see_key_devoluciones">
                                    <label class="form-check-label" for="see_key_devoluciones">
                                        Mostrar Devoluciones de Llaves
                                    </label>
                                </label>
                            </li>
                            <li>
                                <label for="see_key_solicitudes" class="dropdown-item py-3">
                                    <input class="form-check-input filter_activity_kind" type="radio"
                                        name="filters_roles" id="see_key_solicitudes">
                                    <label class="form-check-label" for="see_key_solicitudes">
                                        Mostrar Solicitudes de Llaves
                                    </label>
                                </label>
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- Selector de la fecha (por defecto la fecha del dia de hoy) -->
                <div id="date_of_activity" class="d-flex mb-3 gap-2 justify-content-start align-items-center"
                    style="margin:00px 4% 0 4%">
                    <input type="text" id="date_of_activity_selector" name="date_of_activity_selector">
                    <span id="date_of_activity_text"></span>
                </div>

                <!-- CONTENIDO DE LAS INTERFACES  -->
                <div id="ds_panel_body">

                    <!-- INTERFACE DE PERFILES - TABLA DE PERFILES -->
                    <form class="table-responsive">
                        <table id="activity_table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th id="act_hora" scope="col">Hora</th>
                                    <th id="act_actividad" scope="col">Actividad</th>
                                    <th id="act_profesor" scope="col">Profesor</th>
                                    <th id="act_aula" scope="col">Llaves</th>
                                    <!-- BOTON DE MAS INFORMACION -->
                                    <th id="act_info_actividad" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($activity as $key => $actions_data) {
                                    $time_act = '';
                                    $kind_act = '';
                                    $profesor_act = '';
                                    $key_rd_act1 = '';
                                    $key_rd_act2 = '';
                                    $key_rd_act3 = '';
                                    $key_rd_act4 = '';
                                    $key_rd_act5 = '';
                                    $key_rd_act6 = '';
                                    $key_rd_act7 = '';
                                    $key_rd_act8 = '';
                                    $key_rd_act9 = '';
                                    $key_solicitada = '';
                                    if ($actions_data[3] == date('Y-m-d')) {
                                        $class_act = 'activity_row';
                                    } else {
                                        $class_act = 'activity_row d-none';
                                    }
                                ?>

                                    <tr class="<?php echo $class_act; ?>" data-date-act="<?php echo $actions_data[3] ?>"
                                        data-kind-act="<?php echo $actions_data[1] ?>">

                                        <td class='act_time'>
                                            <div class="act_data_cont ps-0">
                                                <?php echo $actions_data[4];
                                                $time_act = $actions_data[4];
                                                ?>
                                            </div>
                                        </td>

                                        <td class="act_kind">
                                            <div class="act_data_cont">
                                                <?php
                                                switch ($actions_data[1]) {
                                                    case 1:
                                                        echo 'Retiro de llave(s)';
                                                        $kind_act = 'Retiro de llave';
                                                        break;
                                                    case 2:
                                                        echo 'Devolución de llave(s)';
                                                        $kind_act = 'Devolución de llave';
                                                        break;
                                                    case 3:
                                                        echo 'Solicitud de llave';
                                                        $kind_act = 'Solicitud de llave';
                                                        break;
                                                }
                                                ?>
                                            </div>
                                        </td>

                                        <td class="act_profesor">
                                            <div class="act_data_cont ">
                                                <?php
                                                foreach ($users as $key => $profesor_data) {
                                                    if ($profesor_data[0] == $actions_data[2]) {
                                                        echo $profesor_data[1];
                                                        $profesor_act = $profesor_data[1];
                                                        break;
                                                    }
                                                }

                                                ?>
                                            </div>
                                        </td>

                                        <td class="act_key">
                                            <div class="act_data_cont d-flex gap-3">
                                                <?php
                                                $keys_act_map = [
                                                    5 => &$key_rd_act1,
                                                    6 => &$key_rd_act2,
                                                    7 => &$key_rd_act3,
                                                    8 => &$key_rd_act4,
                                                    9 => &$key_rd_act5,
                                                    10 => &$key_rd_act6,
                                                    11 => &$key_rd_act7,
                                                    12 => &$key_rd_act8,
                                                    13 => &$key_rd_act9,
                                                    14=> &$key_solicitada
                                                ];

                                                foreach ($keys as $key_data) {
                                                    foreach ($keys_act_map as $index => &$variable) {
                                                        if ($key_data['numeroLlave'] == $actions_data[$index]) {
                                                ?>
                                                            <div class="key_pill">
                                                                <?php echo 'N°' . $key_data['numeroLlave'] . " - " . $key_data['nombreAula'];
                                                                $variable = 'N°' . $key_data['numeroLlave'] . " - " . $key_data['nombreAula']; ?>
                                                            </div>
                                                <?php
                                                            if ($index >= 9) {
                                                                break 2; // Sale del bucle si es actions_data[9] o [10]
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>

                                            </div>
                                        </td>

                                        <td class="act_see_more">
                                            <div class="btn_see_more act_data_cont d-flex justify-content-center align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#md_see_act"
                                                data-date="<?php echo htmlspecialchars($actions_data[3]); ?>"
                                                data-time="<?php echo htmlspecialchars($time_act); ?>"
                                                data-kind="<?php echo htmlspecialchars($kind_act); ?>"
                                                data-professor="<?php echo htmlspecialchars($profesor_act); ?>"
                                                data-key1="<?php echo htmlspecialchars($key_rd_act1); ?>"
                                                data-key2="<?php echo htmlspecialchars($key_rd_act2); ?>"
                                                data-key3="<?php echo htmlspecialchars($key_rd_act3); ?>"
                                                data-key4="<?php echo htmlspecialchars($key_rd_act4); ?>"
                                                data-key5="<?php echo htmlspecialchars($key_rd_act5); ?>"
                                                data-key6="<?php echo htmlspecialchars($key_rd_act6); ?>"
                                                data-key7="<?php echo htmlspecialchars($key_rd_act7); ?>"
                                                data-key8="<?php echo htmlspecialchars($key_rd_act8); ?>"
                                                data-key9="<?php echo htmlspecialchars($key_rd_act9); ?>"
                                                data-cond-sol-llave="<?php echo htmlspecialchars($actions_data[16]) ?>"
                                                data-key-solicitada="<?php echo htmlspecialchars($key_solicitada); ?>"
                                                data-key-fecha-uso-solicitud="<?php echo htmlspecialchars($actions_data[15]); ?>"
                                                data-cond-sol-horain-llave="<?php echo htmlspecialchars($actions_data[19]) ?>"
                                                data-cond-sol-horafin-llave="<?php echo htmlspecialchars($actions_data[20]) ?>"
                                                data-codigo-gravedad="<?php echo ($actions_data[18]); ?>"
                                                data-bitacora="<?php echo htmlspecialchars($actions_data[17]); ?>"
                                                data-razon-devolucion="<?php echo htmlspecialchars($actions_data[22]); ?>"
                                                data-razon-llave-solicitada="<?php echo htmlspecialchars($actions_data[21]); ?>">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                    <path d="M12 9h.01" />
                                                    <path d="M11 12h1v4h1" />
                                                </svg>
                                            </div>
                                        </td>

                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </form>



                    <div class="modal fade" id="md_see_act" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="title_see_act"></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <!-- GENEREAL -->
                                    <div class="mb-3 general">
                                        <div id="act_data_profesor" class="act_data_atr"></div>
                                        <div class="act_data_title">Nombre del profesor</div>
                                    </div>

                                    <div class="mb-3">
                                        <div id="act_fecha_hora" class="act_data_atr"></div>
                                        <div class="act_data_title">Fecha y hora de actividad</div>
                                    </div>
                                    <!-- FIN DATA GENERAL -->

                                    <div class="mb-3 devolucion">
                                        <div id="act_razon_devolucion" class="act_data_atr"></div>
                                        <div class="act_data_title">Razón(es) de devolución</div>
                                    </div>

                                    <div class="mb-3 retiro devolucion">
                                        <div id="act_data_llaves" class="act_data_atr d-flex flex-wrap gap-2"></div>
                                        <div class="act_data_title mt-1">Llaves adjuntas</div>
                                    </div>

                                    <div class="mb-3 solicitud">
                                        <div id="act_data_llave_solicitada" class="act_data_atr"></div>
                                        <div class="act_data_title">Llave solicitada</div>
                                    </div>

                                    <div class="mb-3 solicitud">
                                        <div id="act_data_fecha_uso" class="act_data_atr"></div>
                                        <div class="act_data_title">Fecha de uso de la llave solicitada</div>
                                    </div>

                                    <div class="mb-3 solicitud">
                                        <div id="act_hora_uso_in_sl" class="act_data_atr"></div>
                                        <div class="act_data_title">Hora inicial de uso de la llave solicitada</div>
                                    </div>

                                    <div class="mb-3 solicitud">
                                        <div id="act_hora_uso_fin_sl" class="act_data_atr"></div>
                                        <div class="act_data_title">Hora final de uso de la llave solicitada</div>
                                    </div>

                                    <div class="mb-3 solicitud">
                                        <div id="act_justificacion_sl" class="act_data_atr"></div>
                                        <div class="act_data_title">Justificación de uso de la llave solicitada</div>
                                    </div>

                                    <div class="mb-3 solicitud">
                                        <div id="act_data_cond_sol_llave">
                                            <div id="cond_sol_aprobed" class="text-success fw-bold"
                                                style="font-size:1.1em">
                                                Solicitud aprobada</div>
                                            <div id="cond_sol_rejected" class="text-danger fw-bold"
                                                style="font-size:1.1em">
                                                Solicitud rechazada</div>
                                        </div>
                                        <div class="act_data_title">Condición de la solicitud de llave</div>
                                    </div>

                                    <div class="mb-3 devolucion">
                                        <div id="act_data_gravedad" class="mb-1">
                                            <div id="cond_buena" class="btn btn-success rounded fs-6 fw-semibold">Sin problemas</div>
                                            <div id="cond_intermedia" class="btn btn-warning rounded fs-6 fw-semibold">
                                                Intermedia
                                            </div>
                                            <div id="cond_grave" class="btn btn-danger rounded fs-6 fw-semibold">Grave</div>
                                        </div>
                                        <div class="act_data_title">Gravedad de devolución</div>
                                    </div>

                                    <div class="mb-3 devolucion">
                                        <div class="act_bitacora_title mb-1">Bitácora</div>
                                        <textarea id="act_data_bitacora" class=" form-control"
                                            rows="4" readonly></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-bs-dismiss="modal"
                                        class="btn btn-primary w-100 fw-bold">Volver</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>





    </section>

    <!-- Menu lateral (responsive) -->
    <?php include 'includes/nav_principal_mb.php' ?>
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        document.querySelector('#goto-actividadmb').classList.add('nvm_opt_active');
        document.querySelector('#goto-actividad').classList.add('nvm_opt_active');
    </script>
    <script src="./public/node_modules/flatpickr/dist/flatpickr.min.js"></script>
    <script src="./public/node_modules/flatpickr/dist/l10n/es.js"></script>
    <script src="./public/js/admin/actividad.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/node_modules/@popperjs/core/dist/umd/popper.js"></script>
</body>

</html>