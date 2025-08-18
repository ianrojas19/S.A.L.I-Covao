<?php //require './app/views/includes/loader.php' ?>

<header class="d-flex align-items-center justify-content-between px-2" style="z-index: 10000;">
    <section id="profile_container" class="d-flex align-items-center px-md-4 px-2">
        <div class="photo_container">
            <img src="<?php echo $_SESSION['linkPhotoUser'] ?>">
        </div>
        <div class="prof_data d-flex flex-column">
            <div class="prof_name"><?php echo $_SESSION['fullNameUser'] ?></div>
            <div class="prof_spec"><?php echo $_SESSION['rolUser'] ?> </div>
        </div>
    </section>

    <nav id="navigation_dsk_profesor" class="d-flex justify-content-end align-items-center">
        <div class="nv_opt"><a class="goto_home" href="profesor">Inicio</a></div>
        <div class="dropdown nv_opt">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mi Perfil
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="contraseña">Cambiar contraseña</a></li>
                <li><a class="dropdown-item" href="logout">Cerrar sesión</a></li>
            </ul>
        </div>

        <div class="dropdown nv_opt">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Soporte
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="https://ayuda.salicovao.com/home-profesor/">Manual de usuario</a></li>
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
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Perfil
                        </button>
                    </span>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#opt-menu_opciones">
                        <div class="accordion-body">
                            <a class="redirect_menu_opt" href="contraseña">Cambiar contraseña</a>
                            <hr class="ac_body_hr">
                            <a class="redirect_menu_opt" href="logout">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <span class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Manual de usuario
                        </button>
                    </span>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#opt-menu_opciones">
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

</header>