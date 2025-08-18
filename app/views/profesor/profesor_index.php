<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/profesor/profesor_actions.css">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            if ("geolocation" in navigator && "permissions" in navigator) {
                navigator.permissions.query({ name: "geolocation" }).then(function (permissionStatus) {
                    const geo_permission_state = permissionStatus.state;
        
                    if (geo_permission_state === "granted") {
                        $('#note_geo').remove();
                    }
        
                    // Escucha cambios futuros en el permiso
                    permissionStatus.onchange = function () {
                        if (permissionStatus.state === "granted") {
                            $('#note_geo').remove();
                        }
                    };
                }).catch(function (error) {
                    console.error("Error consultando permisos de geolocalización:", error);
                });
            } else {
                console.warn("Geolocalización o API de permisos no soportadas en este navegador.");
            }
        });

    </script>
    <title>SALI · Acciones</title>
</head>

<body>

    <?php require 'includes/header.php' ?>

    <!-- Modal -->
    <div class="modal fade" id="md_gestion_llaves" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" data-bs-theme="dark">
                    <h1 class="modal-title fs-5 fw-bold">Acciones para llaves</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                <div id="note_geo" class="text-muted py-0" style="font-size: 0.9em;">Para acceder, <strong>permita el acceso de ubicación cuando se le solicite</strong>; de lo contrario, no podrá usar estos módulos hasta permitirlo.</div>
                    <a href="profesor_retiro" class="gl-block w-100 d-flex flex-column gap-3 justify-content-center align-items-center rounded shadow-sm border">
                        <svg fill="currentColor" height="50px" width="50px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 473.506 473.506" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path d="M396.314,0H291.578c-28.469,0-51.542,23.074-51.542,51.543v37.895h103.918c34.866,0,63.135,28.269,63.135,63.135 c0,34.865-28.268,63.134-63.135,63.134H240.036v206.257c0,28.469,23.073,51.543,51.542,51.543h104.736 c28.469,0,51.543-23.074,51.543-51.543V51.543C447.857,23.074,424.783,0,396.314,0z M366.411,335.493v29.247 c0,11.405-9.232,20.654-20.652,20.654c-11.407,0-20.655-9.249-20.655-20.654v-29.247c-8.353-6.29-13.81-16.185-13.81-27.436 c0-19.028,15.428-34.48,34.465-34.48c19.034,0,34.463,15.452,34.463,34.48C380.222,319.309,374.766,329.203,366.411,335.493z"></path>
                                    <path d="M383.413,152.572c0-21.796-17.663-39.459-39.459-39.459H65.107c-21.796,0-39.459,17.663-39.459,39.459 c0,21.795,17.663,39.458,39.459,39.458h278.847C365.75,192.03,383.413,174.367,383.413,152.572z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="w-100 fs-5 fw-bold text-center">Retirar Llaves</span>
                    </a>
                    <a href="profesor_devolucion" class="gl-block w-100 d-flex flex-column gap-3 justify-content-center align-items-center rounded shadow-sm border">
                        <svg fill="currentColor" height="50px" width="50px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 301.617 301.617" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path d="M272.455,111.216H229.51c-1.232,6.214-3.847,12.173-7.836,17.318c-4.493,5.795-36.072,46.528-40.702,52.5 c-7.806,10.069-20.072,16.08-32.812,16.08c-12.74,0-25.006-6.011-32.812-16.08c-4.629-5.971-36.209-46.705-40.701-52.5 c-3.989-5.145-6.604-11.104-7.836-17.318h-37.65c-8.284,0-15,6.716-15,15v160.401c0,8.284,6.716,15,15,15h243.293 c8.284,0,15-6.716,15-15V126.216C287.455,117.932,280.739,111.216,272.455,111.216z M242.238,269.25c-8.284,0-15-6.716-15-15 c0-8.284,6.716-15,15-15c8.284,0,15,6.716,15,15C257.238,262.534,250.523,269.25,242.238,269.25z M184.087,239.25 c8.284,0,15,6.716,15,15c0,8.284-6.716,15-15,15c-8.284,0-15-6.716-15-15C169.087,245.966,175.803,239.25,184.087,239.25z"></path>
                                    <path d="M66.403,13.745c18.865,10.926,33.915,27.699,42.694,47.833c4.08,9.357,6.807,19.437,7.926,30h-9.564 c-4.396,0-8.408,2.502-10.342,6.449c-1.934,3.947-1.453,8.651,1.24,12.125l40.702,52.5c2.182,2.814,5.542,4.461,9.102,4.461 s6.921-1.647,9.102-4.461l40.702-52.5c2.693-3.474,3.174-8.178,1.24-12.125c-1.934-3.947-5.947-6.449-10.342-6.449h-11.522 c-1.119-10.562-3.844-20.644-7.923-30C153.617,25.337,117.481,0,75.42,0c-1.938,0-3.864,0.054-5.776,0.16 c-3.217,0.179-5.935,2.45-6.682,5.584C62.214,8.878,63.614,12.13,66.403,13.745z"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="w-100 fs-5 fw-bold text-center">Devolver Llaves</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-100 fw-bold" data-bs-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>

    <main class="d-flex justify-content-center align-items-center my-2">
        <div id="menu_profesor" class="w-100 d-flex flex-column justify-content-center align-items-center gap-3 ">
            <div class="d-flex justify-content-between align-items-center gap-3 w-100 px-4 flex-md-row flex-column">

                <div id="option_llaves_gestion" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#md_gestion_llaves"
                    class="option_menu d-flex justify-content-center align-items-center gap-3 option_container col-md-6 col-12 flex-column border shadow-sm">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-key">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                            <path d="M15 9h.01" />
                        </svg>
                    </div>
                    <div class="menu_opt_title fs-5">Gestión de Llaves</div>
                </div>


                <a class="option_menu d-flex justify-content-center align-items-center gap-3 option_container col-md-6 col-12 flex-column border shadow-sm"
                    href="profesor_horario">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                            <path d="M16 3l0 4" />
                            <path d="M8 3l0 4" />
                            <path d="M4 11l16 0" />
                            <path d="M8 15h2v2h-2z" />
                        </svg>
                    </div>
                    <div class="menu_opt_title fs-5">Mi Horario</div>
                </a>
            </div>

            <div class="d-flex justify-content-between align-items-center gap-3 w-100 px-4 flex-md-row flex-column">
                <a class="option_menu d-flex justify-content-center align-items-center gap-3 option_container col-md-6 col-12 flex-column border shadow-sm"
                    href="profesor_solicitud">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-receipt">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2" />
                        </svg>
                    </div>
                    <div class="menu_opt_title fs-5">Solicitud de Llave</div>
                </a>
                <a class="option_menu d-flex justify-content-center align-items-center gap-3 option_container col-md-6 col-12 flex-column border shadow-sm"
                    href="profesor_actividad">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-clock-search">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20.993 11.646a9 9 0 1 0 -9.318 9.348" />
                            <path d="M12 7v5l1 1" />
                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M20.2 20.2l1.8 1.8" />
                        </svg>
                    </div>
                    <div class="menu_opt_title fs-5">Mi Actividad</div>
                </a>
            </div>
        </div>
    </main>

    <footer>SALI · COVAO © <span id="app_year"></span></footer>

    <script>
        $('#app_year').html(new Date().getFullYear());
    </script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/loader.js"></script>

</body>

</html>