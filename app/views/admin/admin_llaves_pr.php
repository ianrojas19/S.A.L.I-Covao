<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./public/css/admin/admin_llaves.css">
    <title>SALI · Panel de llaves</title>
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
                    <h1 id="ds_title"><span class="d-md-inline d-none">Panel de </span>Llaves</h1>



                    <!-- FILTROS DE LA INTERFAZ -->
                    <div id="ds_panel_filters" class="w-50 d-flex justify-content-end align-items-center "
                        style="gap: 7px;">

                        <input type="text" name="search_names" id="search_names" class="form-control w-75"
                            placeholder="Ingrese el nombre o número de llave">
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
                                <label for="see_all_keys" class="dropdown-item py-3">
                                    <input class="form-check-input filter_activity_kind" type="radio"
                                        name="filters_actividad" id="see_all_keys" checked>
                                    <label class="form-check-label" for="see_all_keys">
                                        Mostrar todas las llaves
                                    </label>
                                </label>
                            </li>
                            <li>
                                <label for="see_key_retiros" class="dropdown-item py-3">
                                    <input class="form-check-input filter_activity_kind" type="radio"
                                        name="filters_actividad" id="see_key_retiros">
                                    <label class="form-check-label" for="see_key_retiros">
                                        Mostrar Llaves Disponibles
                                    </label>
                                </label>
                            </li>
                            <li>
                                <label for="see_key_devoluciones" class="dropdown-item py-3">
                                    <input class="form-check-input filter_activity_kind" type="radio"
                                        name="filters_actividad" id="see_key_devoluciones">
                                    <label class="form-check-label" for="see_key_devoluciones">
                                        Mostrar Llaves Ocupadas
                                    </label>
                                </label>
                            </li>

                        </ul>

                    </div>
                </div>


                <!-- CONTENIDO DE LAS INTERFACES  -->
                <div id="ds_panel_body">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-2 g-lg-3">
                        <?php
                        foreach ($keys as $key => $value) {
                            if ($value["numeroLlave"] != 999) {
                                // Valor de portador por default
                                $name_prof = 'Sin portador/a';
                                foreach ($users as $key => $prof) {
                                    if ($value['cedulaProfesor'] == $prof[0]) {
                                        $name_prof = $prof[1];
                                        break;
                                    }
                                }
                                ?>
                                <?php require 'includes/llaves/llave.php' ?>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>




        <!-- Modal informacion de proceso -->
        <div class="modal fade" id="modal_info_proceso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modal_info_proceso_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal_info_proceso_label">Información del proceso</h1>
                    </div>
                    <div class="modal-body">
                        <p id="info_process_text" class="mb-0"></p>
                    </div>
                    <div class="modal-footer">

                        <a href="admin_llaves" type="button" class="btn w-100 btn-primary fw-bold">Entendido</a>
                    </div>
                </div>
            </div>
        </div>



    </section>

    <!-- Menu lateral (responsive) -->
    <?php include 'includes/nav_principal_mb.php' ?>

    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/js/admin/min/llaves_min.js"></script>
    <script src="./public/node_modules/@popperjs/core/dist/umd/popper.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('#goto-llavesmb').classList.add('nvm_opt_active');
        document.querySelector('#goto-llaves').classList.add('nvm_opt_active');
    </script>
</body>

</html>