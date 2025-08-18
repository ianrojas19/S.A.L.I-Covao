<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/profesor/profesor_actividad.css">
    <title>SALI · Mi Actividad</title>
</head>

<body>

    <?php require 'includes/header.php' ?>

    <?php require 'includes/back_to_main.php' ?>


    <main class="px-3 pb-5" style="min-height: 90vh;">
        <!-- Botón de Filtros -->
        <button id="filter_button" onclick="toggleFilterMenu()">
            <svg id="filter_icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 11.414V20a1 1 0 01-1.447.894l-4-2A1 1 0 019 18v-6.586L3.293 6.707A1 1 0 013 6V4z" />
            </svg>
        </button>

        <!-- Capa de Modal y Menú -->
        <div id="filter_modal">
            <div id="filter_menu">
                <div class="filter_option" onclick="toggleBlock('retiro')">
                    <span>RETIROS</span>
                    <svg fill="currentColor" height="50px" width="50px" version="1.1" id="Capa_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 473.506 473.506" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M396.314,0H291.578c-28.469,0-51.542,23.074-51.542,51.543v37.895h103.918c34.866,0,63.135,28.269,63.135,63.135 c0,34.865-28.268,63.134-63.135,63.134H240.036v206.257c0,28.469,23.073,51.543,51.542,51.543h104.736 c28.469,0,51.543-23.074,51.543-51.543V51.543C447.857,23.074,424.783,0,396.314,0z M366.411,335.493v29.247 c0,11.405-9.232,20.654-20.652,20.654c-11.407,0-20.655-9.249-20.655-20.654v-29.247c-8.353-6.29-13.81-16.185-13.81-27.436 c0-19.028,15.428-34.48,34.465-34.48c19.034,0,34.463,15.452,34.463,34.48C380.222,319.309,374.766,329.203,366.411,335.493z">
                                </path>
                                <path
                                    d="M383.413,152.572c0-21.796-17.663-39.459-39.459-39.459H65.107c-21.796,0-39.459,17.663-39.459,39.459 c0,21.795,17.663,39.458,39.459,39.458h278.847C365.75,192.03,383.413,174.367,383.413,152.572z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="filter_option" onclick="toggleBlock('devolucion')">
                    <span>DEVOLUCIONES</span>
                    <svg fill="currentColor" height="50px" width="50px" version="1.1" id="Capa_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 301.617 301.617" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M272.455,111.216H229.51c-1.232,6.214-3.847,12.173-7.836,17.318c-4.493,5.795-36.072,46.528-40.702,52.5 c-7.806,10.069-20.072,16.08-32.812,16.08c-12.74,0-25.006-6.011-32.812-16.08c-4.629-5.971-36.209-46.705-40.701-52.5 c-3.989-5.145-6.604-11.104-7.836-17.318h-37.65c-8.284,0-15,6.716-15,15v160.401c0,8.284,6.716,15,15,15h243.293 c8.284,0,15-6.716,15-15V126.216C287.455,117.932,280.739,111.216,272.455,111.216z M242.238,269.25c-8.284,0-15-6.716-15-15 c0-8.284,6.716-15,15-15c8.284,0,15,6.716,15,15C257.238,262.534,250.523,269.25,242.238,269.25z M184.087,239.25 c8.284,0,15,6.716,15,15c0,8.284-6.716,15-15,15c-8.284,0-15-6.716-15-15C169.087,245.966,175.803,239.25,184.087,239.25z">
                                </path>
                                <path
                                    d="M66.403,13.745c18.865,10.926,33.915,27.699,42.694,47.833c4.08,9.357,6.807,19.437,7.926,30h-9.564 c-4.396,0-8.408,2.502-10.342,6.449c-1.934,3.947-1.453,8.651,1.24,12.125l40.702,52.5c2.182,2.814,5.542,4.461,9.102,4.461 s6.921-1.647,9.102-4.461l40.702-52.5c2.693-3.474,3.174-8.178,1.24-12.125c-1.934-3.947-5.947-6.449-10.342-6.449h-11.522 c-1.119-10.562-3.844-20.644-7.923-30C153.617,25.337,117.481,0,75.42,0c-1.938,0-3.864,0.054-5.776,0.16 c-3.217,0.179-5.935,2.45-6.682,5.584C62.214,8.878,63.614,12.13,66.403,13.745z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="filter_option" onclick="toggleBlock('solicitudes')">
                    <span>SOLICITUDES</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-receipt">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2" />
                    </svg>
                </div>
            </div>
        </div>


        <section id="activity_list"
            class="d-flex flex-column justify-content-center align-items-center mx-auto gap-3 py-3"
            style="max-width: 700px;">

            <!-- BLOQUE DE RETIRO -->
            <div class="activity_block p-3 shadow-sm border w-100 rounded d-flex flex-column gap-2">
                <div class="act_data_group">
                    <div class="act_title mb-1 fs-4 fw-bold">Retiro de llaves</div>
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">
                        <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span>
                        <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span>
                        <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span>
                        <!-- <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span>
                        <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span> -->
                    </div>
                    <div class="act_subtitle">Llaves retiradas</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">Fechite perri</div>
                    <div class="act_subtitle">Fecha de retiro</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">Horita mi perri</div>
                    <div class="act_subtitle">Hora de retiro</div>
                </div>
            </div>


            <!-- BLOQUE DE DEVOLUCION -->
            <div class="activity_block p-3 shadow-sm border w-100 rounded d-flex flex-column gap-2">
                <div class="act_data_group">
                    <div class="act_title mb-1 fs-4 fw-bold">Devolución de llaves</div>
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">
                        <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span>
                        <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span>
                        <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span>
                        <!-- <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span>
                        <span class="key_cont text-white rounded py-2 px-3">N°11 - Laboratorio B9</span> -->
                    </div>
                    <div class="act_subtitle">Llaves devueltas</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">Fechite perri</div>
                    <div class="act_subtitle">Fecha de devolución</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">Horita mi perri</div>
                    <div class="act_subtitle">Hora de devolución</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">Horita mi perri</div>
                    <div class="act_subtitle">Razón de devolución</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">Horita mi perri</div>
                    <div class="act_subtitle">Condiciom de la devolución</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">Horita mi perri</div>
                    <div class="act_subtitle">Bitacora</div>
                </div>
            </div>

            <!-- BLOQUE DE SOLICITUDES -->
            <div class="activity_block p-3 shadow-sm border w-100 rounded d-flex flex-column gap-2">
                <div class="act_data_group">
                    <div class="act_title mb-1 fs-4 fw-bold">Solicitud de llaves</div>
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">
                        <span class="key_cont text-white rounded py-2 px-3">N°12 - Laboratorio B8</span>
                    </div>
                    <div class="act_subtitle">Llaves solicitadas</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">22/11/2024</div>
                    <div class="act_subtitle">Fecha de utilización</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">08:20 PM</div>
                    <div class="act_subtitle">Hora inicial de uso</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">09:00 PM</div>
                    <div class="act_subtitle">Hora final de uso</div>
                </div>

                <div class="act_data_group">
                    <div class="act_data fw-semibold d-flex flex-wrap gap-1">Taller de cisco</div>
                    <div class="act_subtitle">Motivo de la solicitud</div>
                </div>
            </div>

        </section>
    </main>

    <script>
    const filterButton = document.getElementById('filter_button');
    const filterModal = document.getElementById('filter_modal');
    const filterIcon = document.getElementById('filter_icon');

    // Función para abrir/cerrar el modal y animar la "X"
    function toggleFilterMenu() {
        const isOpen = filterModal.style.display === 'flex';

        if (isOpen) {
            filterModal.style.display = 'none';
            filterButton.classList.remove('open'); 
            filterIcon.innerHTML =
                `<path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 11.414V20a1 1 0 01-1.447.894l-4-2A1 1 0 019 18v-6.586L3.293 6.707A1 1 0 013 6V4z" />`;
        } else {
            filterModal.style.display = 'flex';
            filterButton.classList.add('open'); 
            filterIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />`;
        }
    }

    // Mostrar/Ocultar bloques
    function toggleBlock(blockId) {
        const block = document.getElementById(blockId + '_block');
        block.style.display = block.style.display === 'none' ? 'block' : 'none';

        // Añadir clase 'selected' a la opción seleccionada para animación de zoom
        const allOptions = document.querySelectorAll('.filter_option');
        allOptions.forEach(option => {
            if (option.id === blockId + '_block') {
                option.classList.add('selected');
            } else {
                option.classList.remove('selected');
            }
        });
    }
    </script>


    <footer>SALI · COVAO Nocturno © <span id="app_year"></span></footer>
    <script src="./public/js/loader.js"></script>
    <script src="./public/js/profesor/profesor_actividad.js"></script>
</body>

</html>