<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/profesor/profesorFAQ.css">
    <title>SALI · Preguntas frecuentes</title>
</head>

<body>

    <header class="d-flex align-items-center justify-content-between px-2">
        <section id="profile_container" class="d-flex align-items-center px-md-4 px-2">
            <div class="photo_container">
                <img src="./public/assets/images/fotos_perfil/Salii.png">
            </div>
            <div class="prof_data d-flex flex-column">
                <div class="prof_name">SALI</div>
                <div class="prof_spec">Desarrollo Web</div>
            </div>
        </section>

        <nav id="navigation_dsk_profesor" class="d-flex justify-content-end align-items-center">
            <div class="nv_opt"><a class="goto_home" href="profesor_index">Inicio</a></div>
            <div class="dropdown nv_opt">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Mi Perfil
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
                    <li><a class="dropdown-item" href="logout">Cerrar sesión</a></li>
                </ul>
            </div>
            <div class="dropdown nv_opt">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Soporte
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Manual de usuario</a></li>
                    <li><a class="dropdown-item" href="profesor_FAQ">F.A.Q</a></li>
                </ul>
            </div>
        </nav>

        <!-- BOTON DE MENU DE OPCIONES MOBILE -->
        <div class="options_button px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#opciones_menu"
            aria-controls="opciones_menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="35px" heigth="35px" viewBox="0 0 24 24" fill="none"
                stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
            </svg>
        </div>

        <!-- OFFCANVAS DE OPCIONES -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="opciones_menu" aria-labelledby="opciones_menu">
            <div class="offcanvas-header" data-bs-theme="dark">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Opciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="accordion accordion-flush" id="opt-menu_opciones">
                    <div class="accordion-item">
                        <span class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Perfil
                            </button>
                        </span>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#opt-menu_opciones">
                            <div class="accordion-body">
                                <a class="redirect_menu_opt">Ver mi perfil</a>
                                <hr class="ac_body_hr">
                                <a class="redirect_menu_opt">Cambiar contraseña</a>
                                <hr class="ac_body_hr">
                                <a href="logout" class="redirect_menu_opt">Cerrar sesión</a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <span class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                                Manual de usuario
                            </button>
                        </span>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            data-bs-parent="#opt-menu_opciones">
                            <div class="accordion-body">
                                <a class="redirect_menu_opt">Manual de Profesor</a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <span class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                                Soporte
                            </button>
                        </span>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                            data-bs-parent="#opt-menu_opciones">
                            <div class="accordion-body">
                                <a class="redirect_menu_opt">Generar un reporte</a>
                                <hr class="ac_body_hr">
                                <a class="redirect_menu_opt">FAQ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </header>
    <!-- <div class="back_to_main d-flex align-items-center">
        <div class="btn_back">
            <a href="index"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15 6l-6 6l6 6" />
                </svg></a>
        </div>

        <div id="module_title">Mi Horario</div>
    </div>-->


    <!-- CONTENIDO DE SUS INTERFACES -->
    <main>
        <!-- TITULO DE LA INTERFAZ  -->
        <h1 id="ds_title">Preguntas frecuentes</h1>
        <hr>
        <!-- CONTENIDO DE LAS INTERFACES  -->
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        ¿Qué hacer si tengo problemas técnicos con el sistema?
                        <span class="icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                            </svg>
                        </span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Si encuentras algún problema técnico, contacta al soporte técnico a través del
                        correo electrónico proporcionado en la sección de ayuda.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        ¿Cómo puedo actualizar mis datos de usuario en el sistema?
                        <span class="icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                            </svg>
                        </span>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Accede a tu perfil en la plataforma y busca la opción de edición para actualizar tu
                        información personal.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        ¿Cómo puedo solicitar una llave?
                        <span class="icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                            </svg>
                        </span>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Para solicitar una llave, debes completar el formulario de solicitud en la
                        plataforma. Asegúrate de proporcionar todos los detalles necesarios, como el
                        laboratorio o taller que necesitas y la razón de la solicitud.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        ¿Hay un límite en el número de llaves que puedo solicitar?
                        <span class="icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                            </svg>
                        </span>
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Sí, el número de llaves que puedes solicitar puede variar según las políticas de la
                        institución. Consulta con el administrador para conocer los límites específicos.
                    </div>
                </div>
            </div>

            <div class="accordion-item d-none" id="more-accordion">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        ¿Las llaves son personales o pueden ser compartidas?
                        <span class="icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                            </svg>
                        </span>
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Las llaves son generalmente personales y no deben ser compartidas con otros. Esto es para
                        asegurar la seguridad y el control del acceso a los laboratorios y talleres.
                    </div>
                </div>
            </div>

            <div class="accordion-item d-none" id="more-accordion">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        ¿Qué medidas de seguridad se implementan en el sistema de llaves?
                        <span class="icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                            </svg>
                        </span>
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        El sistema cuenta con controles de acceso y registro de actividad para asegurar que solo las
                        personas autorizadas tengan acceso a las llaves.
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <button id="loadMore" class="btn">
                <div class="loader">
                    <div class="circle" tabindex="0"></div>
                    <div class="circle" tabindex="0"></div>
                    <div class="circle" tabindex="0"></div>
                    <div class="circle" tabindex="0"></div>
                    <div class="circle" tabindex="0"></div>
                </div>
            </button>
        </div>


    </main>

    <footer>C.O.V.A.O Nocturno © <span id="year"></span></footer>
    <script>
        document.getElementById('loadMore').addEventListener('click', function() {
            const hiddenItems = document.querySelectorAll('.accordion-item.d-none');
            hiddenItems.forEach(item => {
                item.classList.remove('d-none'); // Muestra los acordeones ocultos
            });
            this.style.display = 'none'; // Oculta el botón después de hacer clic
        });
        </script>

    <script>
    let year = document.getElementById('year');

    let y = new Date();

    y = y.getFullYear();

    year.innerText = y;
    </script>

    <script src="./public/js/profesor/redirects.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>