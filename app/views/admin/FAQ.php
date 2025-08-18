<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./public/css/admin/FAQ.css">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/js/admin/redirects.js"></script>
    <title>SALI · FAQ</title>
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
                    <h1 id="ds_title">Preguntas frecuentes</h1>

                </div>
                <hr class="title-dividor">

                <!-- CONTENIDO DE LAS INTERFACES  -->
                <div id="ds_panel_body" class=" px-5">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    ¿Qué hacer si tengo problemas técnicos con el sistema?
                                    <span class="icon" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionExample">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Las llaves son generalmente personales y no deben ser compartidas con otros. Esto es
                                    para asegurar la seguridad y el control del acceso a los laboratorios y talleres.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item d-none" id="more-accordion">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    ¿Qué medidas de seguridad se implementan en el sistema de llaves?
                                    <span class="icon" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6.5a.5.5 0 0 1 .854-.354L8 10.293l5.646-4.146a.5.5 0 1 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5z" />
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    El sistema cuenta con controles de acceso y registro de actividad para asegurar que
                                    solo las personas autorizadas tengan acceso a las llaves.
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
                </div>
            </div>

        </section>

        <?php include 'includes/nav_principal_mb.php' ?>
        <script>
            document.getElementById('loadMore').addEventListener('click', function () {
                const hiddenItems = document.querySelectorAll('.accordion-item.d-none');
                hiddenItems.forEach(item => {
                    item.classList.remove('d-none'); // Muestra los acordeones ocultos
                });
                this.style.display = 'none'; // Oculta el botón después de hacer clic
            });
        </script>

        <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="./public/js/admin/solicitudes.js"></script>
</body>

</html>