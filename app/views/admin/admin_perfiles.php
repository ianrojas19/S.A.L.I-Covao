<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/notyf/notyf.min.css">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./public/css/admin/admin_perfiles.css">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>

    <style>
        .form-check-input {
            height: 15px !important;
        }

        #professor_data_modal {
            transition: 0.3s all ease;
        }

        #schedule_area {
            overflow-y: auto;
        }

        #schedule_area thead {
            position: sticky;
            top: -8px;
            z-index: 30;
        }

        .tr_diurno {
            display: none;
        }

        .specialty {
            transition: background-color 0.3s;
            background-color: #19446a;
            color: white;
            border-color: #19446a;
            min-width: fit-content;
            max-width: fit-content;
            border-radius: 100px !important;
            text-transform: capitalize;
            z-index: 222222222;
        }

        #profile_professor_data {
            overflow-y: auto;
            overflow-x: hidden;
            height: 100%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* min-width: 350px; */
        }

        #sp_ls {
            width: fit-content;
            max-width: 600px;
        }

        #add_specialty {
            width: fit-content;
        }

        #schedule_area.placeholder * {
            visibility: hidden;
        }

        .sch_diurno {
            background-color: #0b66b6;
        }

        .sch_nocturno {
            background-color: #0d4678;
        }

        @media (max-width: 1200px) {

            #change_sch_mode_button,
            #change_sch_mode {
                width: 100%;

            }

            #profile_screen {
                overflow-y: scroll !important;
            }

            #add_specialty {
                width: 100% !important;
            }


            #profile_professor_data {
                overflow: visible;
                height: fit-content;
            }

            #sp_ls {
                max-width: 100%;
            }

        }

        .input-group-text {
            background-color: #19446a !important;
            color: white !important;
        }

        #profile_professor_data .form-label {
            color: #1f5381 !important;
            font-weight: 600 !important;
            font-size: 1.1rem !important;
            margin-bottom: 0rem !important;
        }

        #schedule_area strong,
        #schedule_area span {
            text-align: center;
        }

        #profile_professor_data img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        .profesor-data-title {
            color: #19446a;
            font-weight: bolder;
        }

        .first_mhtd {
            background-color: #19446a !important;
            color: white;
            padding: 10px !important;
            cursor: default !important;
            height: fit-content !important;
        }

        .mhtd {
            height: 125px;
            min-width: 180px;
            min-height: fit-content;
            padding: 20px;
            border-bottom: 1px solid #0b66b61e;
            transition: 0.2s all ease;
            position: relative;
        }

        .mhtd .llave,
        .mhtd .subarea,
        .mhtd .grupo {
            /* max-width: 140px; */
            white-space: nowrap;
            /* overflow: hidden; */
            /* text-overflow: ellipsis; */
            display: inline-block;
        }

        .mhtd .grupo {
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 0 0 4px 10px;
            color: #19446a;
            background-color: rgba(61, 145, 219, 0.1);
            padding: 2px 10px;
            font-size: 14px;
            border-radius: 4px;
        }

        .bloque_hora {
            background-color: #2828280e;
        }

        .mhtd:hover:not(.bloque_hora) {
            background-color: #0e75ce2c;
            border-bottom: 1px solid #0b66b6 !important;
            cursor: pointer;
        }

        .mhtd.mhtd_empty {
            border-bottom: 1px solid #0b66b61e !important;
            color:rgba(0, 0, 0, 0.3) !important;
        }

        .mhtd.mhtd_empty:hover {
            background-color: rgb(239, 239, 239) !important;
            border-bottom: 1px solid #0b66b61e !important;
        }

        #schedule_table th,
        #schedule_table td {
            padding: 0 !important;
        }

        .crud_specialty {
            transition: background-color 0.3s;
            background-color: #ffffff00;
            color: white;
            border-color: #19446a;
            min-width: fit-content;
            border-radius: 100px !important;
            padding: 2px;
        }

        .crud_specialty:hover {
            background-color: #ffffff3c;
            color: #ffff;
            border-color: #1f5381;
        }
    </style>


    <title>SALI · Perfiles</title>
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
                    <h1 id="ds_title">Perfiles</h1>

                    <!-- FILTROS DE LA INTERFAZ -->
                    <div id="ds_panel_filters" class="w-50 d-flex justify-content-end align-items-center "
                        style="gap: 7px;">
                        <input type="text" name="search_names" id="search_names" class="form-control w-75"
                            placeholder="Ingrese el nombre de un usuario...">
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

                        <ul id="filter_users" class="dropdown-menu">
                            <li>
                                <label for="see_all_users" class="dropdown-item py-3">
                                    <input class="form-check-input filter_users_kind" type="radio" name="filters_roles"
                                        id="see_all_users" checked>
                                    <label class="form-check-label" for="see_all_users">
                                        Mostrar todos los usuarios
                                    </label>
                                </label>
                            </li>
                            <li>
                                <label for="see_profesores" class="dropdown-item py-3">
                                    <input class="form-check-input filter_users_kind" type="radio" name="filters_roles"
                                        id="see_profesores">
                                    <label class="form-check-label" for="see_profesores">
                                        Mostrar Profesores
                                    </label>
                                </label>
                            </li>
                            <li>
                                <label for="see_admins" class="dropdown-item py-3">
                                    <input class="form-check-input filter_users_kind" type="radio" name="filters_roles"
                                        id="see_admins">
                                    <label class="form-check-label" for="see_admins">
                                        Mostrar Administradores
                                    </label>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- CONTENIDO DE LAS INTERFACES  -->
                <div id="ds_panel_body">

                    <!-- INTERFACE DE PERFILES - TABLA DE PERFILES -->
                    <form class="table-responsive-md">
                        <table id="profiles_table" class="table">
                            <thead>
                                <tr>
                                    <!-- FOTO DE PERIL -->
                                    <th id="tb_foto_perfil" scope="col"></th>
                                    <!-- NOMBRE -->
                                    <th id="tb_nombre" scope="col">Nombre</th>
                                    <!-- CORREO INSTITUCIONAL -->
                                    <th id="tb_correo_ins" scope="col">Correo institucional</th>
                                    <!-- ROL -->
                                    <th id="tb_rol" scope="col">Rol</th>
                                    <!-- BOTON DE MAS INFORMACION -->
                                    <th id="tb_see_profile" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>



                                <?php
                                // Llama solo a los perfiles que han sido aceptados (se omite nuestro propio perfil)      
                                foreach ($users as $key => $value) {

                                    if ($value[10] == 1 && $value[2] != $_SESSION['mailLogged']) {
                                ?>
                                        <tr class="profile_row" data-ced="<?php echo $value[0]; ?>">
                                            <td class="info_container profile_pic_container">
                                                <div class="info_data justify-content-center profile_pic">
                                                    <img src="<?php echo $value[6] . '?nocache=' . time(); ?>">
                                                </div>
                                            </td>
                                            <td class="info_container username prof_search_by_name">
                                                <div class="info_data">
                                                    <?php echo $value[1] ?>
                                                </div>
                                            </td>
                                            <td class="info_container email">
                                                <div class="info_data">
                                                    <a href="mailto:<?php echo $value[2] ?>"><?php echo $value[2] ?></a>
                                                </div>
                                            </td>
                                            <td class="info_container rol">
                                                <div class="info_data">
                                                    <?php echo $value[7] ?>
                                                </div>
                                            </td>
                                            <td class="info_container see_profile">
                                                <div class="info_data justify-content-center">
                                                    <span id="<?php echo $value[0] ?>" class="call_user <?php echo 'call_' . strtolower($value[7]) ?>" data-bs-toggle="modal"
                                                        <?php echo $value[7] == 'Profesor' ? 'data-bs-target="#professor_data_modal"' : 'data-bs-target="#admin_data_modal"'; ?>>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                            <path d="M12 9h.01" />
                                                            <path d="M11 12h1v4h1" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </form>

                    <!-- BOTON MOSTRAR MODAL DE CREAR PERFIL -->
                    <span id="create_user" class="btn" data-bs-toggle="modal" data-bs-target="#create_user_modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </span>
                </div>
            </div>
        </section>
    </section>

    <!-- modal professor data -->
    <?php require 'includes/perfiles/profesor_data.php' ?>
    <?php require 'includes/perfiles/modal_ver_perfil.php' ?>
    <?php require 'includes/perfiles/modal_crear_perfil.php' ?>

    <?php include 'includes/nav_principal_mb.php' ?>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/node_modules/@popperjs/core/dist/umd/popper.js"></script>
    <script src="./public/node_modules/notyf/notyf.min.js"></script>
    <script src="./public/js/admin/perfiles.js"></script>
    <script>
        let llaves = <?php echo json_encode($llaves); ?>;
        let especialidades = <?php echo json_encode($especialidades); ?>;
        let subareas = <?php echo json_encode($subareas); ?>;
        // console.log(llaves);


        document.querySelector('#goto-perfilesmb').classList.add('nvm_opt_active');
        document.querySelector('#goto-perfiles').classList.add('nvm_opt_active');
    </script>
</body>


</html>