<!-- NAV RESPONSIVE FIXED MOBILE-->
<nav id="navigation_mobile">

    <div id="goto-actividadmb" class="nvm_opt" onclick="location.href = 'admin_actividad'">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-device-desktop-analytics">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
            <path d="M7 20h10" />
            <path d="M9 16v4" />
            <path d="M15 16v4" />
            <path d="M9 12v-4" />
            <path d="M12 12v-1" />
            <path d="M15 12v-2" />
            <path d="M12 12v-1" />
        </svg>
        <span>Actividad</span>
    </div>

    <div id="goto-llavesmb" class="nvm_opt" onclick="location.href = 'admin_llaves'">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-key">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
                d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
            <path d="M15 9h.01" />
        </svg>
        <span>Llaves</span>
    </div>

    <div id="goto-perfilesmb" class="nvm_opt" onclick="location.href = 'admin_perfiles'">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-users">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
        </svg>
        <span>Perfiles</span>
    </div>

    <div id="goto-solicitudesmb" class="nvm_opt" onclick="location.href = 'admin_solicitudes'">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-inbox">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
            <path d="M4 13h3l3 3h4l3 -3h3" />
        </svg>
        <span>Solicitudes</span>
    </div>
</nav>

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
                        Mi Perfil
                    </button>
                </span>

                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#opt-menu_opciones">
                    <div class="accordion-body">
                        <a class="redirect_menu_opt border" href="contraseña">Cambiar contraseña</a>
                        <hr class="ac_body_hr">
                        <a href="logout" class="redirect_menu_opt border">Cerrar sesión</a>
                    </div>
                </div>
            </div>

            <div class="accordion-item gap-3">
                <div class="accordion-body">
                    <button class="btn btn-link redirect_menu_opt border text-start mb-2" onclick="location.href='https://ayuda.salicovao.com'">Manual de usuario</button>
                    <button class="btn btn-link redirect_menu_opt border text-start mb-2" onclick="location.href='gestion_general'">Gestión general</button>
                    <button class="btn btn-link redirect_menu_opt border text-start mb-2" onclick="location.href='cod_retiro'">Código de retiro de llave</button>
                </div>
            </div>

        </div>

    </div>

</div>