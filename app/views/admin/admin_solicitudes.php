<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./public/css/admin/admin_solicitudes.css">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <title>SALI · Solicitudes</title>
</head>

<body>

    <section id="dashboard_admin" class="container-fluid d-flex p-0">

        <!-- Menu lateral izquierdo -->
        <?php include 'includes/nav_principal.php' ?>

        <!-- FINAL Menu lateral izquierdo -->

        <!-- Seccion del contenido -->
        <section id="ds_panel_container" class="ds_component">
            <div id="ds_panel">

                <!-- CONTENIDO DE SUS INTERFACES  -->
                <div id="ds_panel_body">
                    <div id="inboxes_solicitudes">

                        <!-- BOTON PARA VER IMBOX DE REGISTROS -->
                        <div id="btn_inbox_registros" class="s_inbox s_inbox_active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                            </svg>
                            <span><span class="mb-disp">Solicitudes de </span> Registro</span>
                        </div>

                        <!-- BOTON PARA VER IMBOX DE SOLICITUDES -->
                        <div id="btn_inbox_llaves" class="s_inbox">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-report-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                                <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2" />
                                <path
                                    d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M8 11h4" />
                                <path d="M8 15h3" />
                                <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" />
                                <path d="M18.5 19.5l2.5 2.5" />
                            </svg>
                            <span><span class="mb-disp">Solicitudes de </span> Llaves</span>
                        </div>
                    </div>

                    <!-- Contenido de los inboxes -->

                    <!-- IMBOX DE SOLICITUDES DE REGISTRO -->
                    <div id="inbox_registro">

                        <?php

                        $users_length = 0;

                        foreach ($users as $key => $value) {
                            if ($value[10] == 2) {

                                $users_length++

                        ?>
                                <div class="inbox_solicitud">
                                    <div class="sol_image">
                                        <img src="<?php echo $value[6] ?>">
                                    </div>
                                    <div class="sol_details">
                                        <div class="name"><?php echo $value[1] ?></div>
                                        <div class="rol_requested">Solicitud de registro para rol de <strong
                                                class="rol"><?php echo $value[7] ?></strong>
                                        </div>
                                    </div>
                                    <div class="sol_btn_process" data-us_ced="<?php echo $value[0] ?>"
                                        data-us_nom="<?php echo $value[1] ?>" data-us_ci="<?php echo $value[2] ?>"
                                        data-us_rol="<?php echo $value[7] ?>" data-us_tlc="<?php echo $value[4] ?>"
                                        data-us_mlc="<?php echo $value[5] ?>" data-us_lphoto="<?php echo $value[6] ?>"
                                        data-us_esp="<?php echo ($value[7] == 'Administrador') ? 'n/a' : $value[8]; ?>"
                                        data-bs-toggle="modal" data-bs-target="#md_proc_registro">
                                        <span>Procesar</span>
                                    </div>

                                </div>

                            <?php }
                        }


                        if ($users_length == 0) {
                            ?>
                            <div class="my-5 text-center" style="color:#0d375e">No hay solicitudes de registro pendientes...
                            </div>
                        <?php
                        } ?>
                    </div>

                    <!-- IMBOX DE SOLICITUDES DE AULA -->
                    <div id="inbox_aulas" class="d-none">

                        <?php
                        $cant_sol = 0;
                        // Iterar sobre cada solicitud utilizando foreach
                        foreach ($keyreqs as $row) {
                            if ($row['idEstadoSolicitud'] == 2) {
                                $cant_sol++;
                                // Formatear fechas y horas
                                $fechaEmision = date("d/m/Y", strtotime($row['fechaEmision']));
                                $fechaUtilizacion = date("d/m/Y", strtotime($row['fechaUtilizacion']));
                                $horaInicio = date("h:i A", strtotime($row['horaInicio']));
                                $horaFinal = date("h:i A", strtotime($row['horaFinal']));


                                foreach ($users as $key => $prof) {
                                    $prof[0] == $row['cedulaUsuario'] ? $nombreProfesor = $prof[1] : '';
                                }

                                foreach ($keys as $key => $llave) {
                                    $llave['numeroLlave'] == $row['numeroLlave'] ? $nombreAula = $llave['nombreAula'] : '';
                                }


                                // Mostrar el componente HTML con los datos de la solicitud
                        ?>
                                <div class="inbox_solicitud">
                                    <div class="sol_details sol_details_llave d-flex flex-column gap-1"
                                        data-id-solicitud="<?php echo $row['idSolicitudLlave']; ?>"
                                        data-ced-prof="<?php echo $row['cedulaUsuario']; ?>"
                                        data-date-in="<?php echo $row['fechaEmision']; ?>"
                                        data-key="<?php echo $row['numeroLlave'] ?>"
                                        data-date-use="<?php echo $row['fechaUtilizacion']; ?>"
                                        data-time-init="<?php echo $row['horaInicio']; ?>"
                                        data-time-finish="<?php echo $row['horaFinal']; ?>"
                                        data-justify="<?php echo $row['razonUso']; ?>"
                                        data-time-in="<?php echo $row['horaEmision']; ?>">


                                        <div class="name">Profesor solicitante: <span
                                                class="fw-medium"><?php echo $nombreProfesor; ?></span></div>

                                        <div class="text-dark rol_requested"><b>Llave solicitada:</b> <span
                                                class="fw-medium">Nº<?php echo $row['numeroLlave']; ?> -
                                                <?php echo $nombreAula; ?></span></div>

                                        <div class="text-dark rol_requested"><b>Fecha de emisión:</b> <span
                                                class="fw-medium"><?php echo $fechaEmision; ?></span></div>

                                        <div class="text-dark rol_requested"><b>Fecha y lapso para uso de llave:</b> <span
                                                class="fw-medium"><?php echo $fechaUtilizacion; ?>, de
                                                <?php echo $horaInicio; ?> a <?php echo $horaFinal; ?></span></div>

                                        <div class="text-dark rol_requested"><b>Justificación de solicitud:</b> <span
                                                class="fw-medium"><?php echo $row['razonUso']; ?></span></div>
                                    </div>
                                    <button class="btn btn-success sol_btn_process_ll accept_sol" style="margin-right: 10px">Aceptar</button>
                                    <button class="btn btn-danger sol_btn_process_ll deny_sol">Rechazar</button>
                                </div>
                            <?php


                            }
                        }

                        //

                        if ($cant_sol == 0) {
                            ?>
                            <div class="my-5 text-center" style="color:#0d375e">No hay solicitudes de llaves
                                pendientes...
                            </div>
                        <?php
                        }

                        ?>
                    </div>

                </div>

                <!-- Modal de proceso de registro -->
                <div class="modal fade" id="md_proc_registro" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content" style="height: 100vh">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Solicitud de registro</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="scrollbar-width: thin;">
                                <h4 class="fw-bold" style="color: #0d375e; margin-bottom: 4px">Detalles de solicitud
                                </h4>
                                <p class="nota mb-4">En caso de que haya algún dato erróneo, puede modificarlo en la
                                    sección de <b>perfiles</b>. </p>
                                <img id="rg_user_photo" src="" alt="Foto de perfil del solicitante">
                                <p class="text-center ad_pdp">Foto de perfil del solicitante</p>

                                <!-- Listado de info del solicitante -->
                                <div id="rg_user_ced" class="mb-3 d-flex flex-column">
                                    <span class="rg_info_val"></span>
                                    <span class="rg_info_title">Cédula del solicitante</span>
                                </div>


                                <div id="rg_user_nom" class="mb-3 d-flex flex-column">
                                    <span class="rg_info_val"></span>
                                    <span class="rg_info_title">Nombre del solicitante</span>
                                </div>

                                <div id="rg_user_ci" class="mb-3 d-flex flex-column">
                                    <span class="rg_info_val"></span>
                                    <span class="rg_info_title">Correo institucional del solicitante</span>
                                </div>

                                <div id="rg_user_rol" class="mb-3 d-flex flex-column">
                                    <span class="rg_info_val"></span>
                                    <span class="rg_info_title">Rol del solicitante</span>
                                </div>

                                <div id="rg_user_esp" class="mb-3 d-flex flex-column">
                                    <span class="rg_info_val"></span>
                                    <span class="rg_info_title">Especialidad del solicitante</span>
                                </div>

                                <div id="rg_user_telct" class="mb-3 d-flex flex-column">
                                    <span class="rg_info_val"></span>
                                    <span class="rg_info_title">Número telefónico de contacto</span>
                                </div>

                                <div id="rg_user_mailct" class="mb-3 d-flex flex-column">
                                    <span class="rg_info_val"></span>
                                    <span class="rg_info_title">Correo electrónico de contacto</span>
                                </div>
                            </div>


                            <div class="modal-footer w-100 d-flex flex-nowrap">


                                <!-- Rechazar solicitud registro -->
                                <button id="sc_reg_rechazar" type="button"
                                    class="btn btn-danger w-50 d-flex justify-content-center align-items-center gap-1"
                                    data-bs-toggle="modal" data-bs-target="#md_rechazar_registro">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                    <span>Rechazar solicitud</span>
                                </button>


                                <!-- Aprobar solicitud registro (ADMIN)-->
                                <button id="sc_reg_aprobar" type="button"
                                    class="btn btn-success w-50 d-flex justify-content-center align-items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                    <span>Aprobar solicitud</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal de proceso de rechazo de solicitud de registro -->
                <div class="modal fade" id="md_rechazar_registro" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content" style="height: 100vh">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Rechazo de registro</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="scrollbar-width: thin;">

                                <h4 class="fw-bold" style="color: #0d375e;">Confirmación</h4>
                                <p>¿Está usted en <b>total</b> conformidad con el rechazo de esta solicitud de
                                    registro?
                                </p>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="deny_reg"
                                        id="confirm_deny_check">
                                    <label class="form-check-label" for="confirm_deny_check">
                                        Sí, estoy conforme con esta decisión.
                                    </label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="deny_reg"
                                        id="deny_feedback_check">
                                    <label class="form-check-label" for="deny_feedback_check">
                                        Deseo ingresar el motivo del rechazo de la solicitud. <b>(Opcional)</b>
                                    </label>
                                </div>

                                <div class="">
                                    <label for="deny_feedback" class="mb-1 fw-bold fs-5" style="color:#0d375e;">Razón de
                                        rechazo</label>
                                    <textarea class="form-control"
                                        placeholder="Ingrese la razón del rechazo de la solicitud de registro..."
                                        id="deny_feedback" style="height: 225px" disabled></textarea>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#md_proc_registro">Atrás</button>
                                <button id="deny_rg_sl" type="button" class="btn btn-danger" disabled>Rechazar
                                    solicitud</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de informacion de proceso de solicitud de registro -->
                <?php require 'includes/solicitudes/modal_info_proceso.php' ?>
        </section>

    </section>

    <?php include 'includes/nav_principal_mb.php' ?>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/admin/min/solicitudes_min.js"></script>
    <script>
        document.querySelector('#goto-solicitudesmb').classList.add('nvm_opt_active');
        document.querySelector('#goto-solicitudes').classList.add('nvm_opt_active');
    </script>
</body>

</html>