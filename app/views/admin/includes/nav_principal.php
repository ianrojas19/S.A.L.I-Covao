<?php //require './app/views/includes/loader.php' 
?>

<header id="ds_header" class="ds-component">
    <!-- PERFIL -->
    <a href="index" class="profile_container">
        <img src="<?php echo $_SESSION['linkPhotoUser'] ?>">
        <div class="profile_data_container">
            <span class="name">
                <?php
                function contarSilabas($palabra)
                {
                    // Aproximación simple para contar vocales como sílabas (puede mejorarse)
                    return preg_match_all('/[aeiouáéíóúü]/i', $palabra);
                }

                $fullName = $_SESSION['fullNameUser'] ?? '';
                $words = explode(" ", trim($fullName));
                $totalSilabas = 0;

                foreach ($words as $word) {
                    $totalSilabas += contarSilabas($word);
                }

                if ($totalSilabas > 3) {
                    echo implode(' ', array_slice($words, 0, 3)); // Mostrar hasta 3 palabras
                } elseif ($totalSilabas == 2) {
                    echo implode(' ', array_slice($words, 0, 2)); // Mostrar 2 palabras
                } else {
                    echo $words[0] ?? ''; // Mostrar solo la primera palabra
                }
                ?>
            </span>

            <span class="rol"><?php echo $_SESSION['rolUser'] ?></span>
        </div>
    </a>

    <!-- NAVEGACION DESKTOP -->
    <nav class="dhopt_group">
        <div id="goto-actividad" class="dhopt" onclick="location.href = 'admin_actividad'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"
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
        <div id="goto-llaves" class="dhopt" onclick="location.href = 'admin_llaves'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-key">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                <path d="M15 9h.01" />
            </svg>
            <span>Panel de llaves</span>
        </div>
        <div id="goto-perfiles" class="dhopt" onclick="location.href = 'admin_perfiles'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
            </svg>
            <span>Perfiles</span>
        </div>
        <div id="goto-solicitudes" class="dhopt" onclick="location.href = 'admin_solicitudes'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-inbox">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                <path d="M4 13h3l3 3h4l3 -3h3" />
            </svg>
            <span>Solicitudes</span>
        </div>
        <div id="goto-solicitudes" class="dhopt" onclick="location.href='gestion_general'">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments-horizontal">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M4 6l8 0" />
                <path d="M16 6l4 0" />
                <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M4 12l2 0" />
                <path d="M10 12l10 0" />
                <path d="M17 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M4 18l11 0" />
                <path d="M19 18l1 0" />
            </svg>
            <span>Gestión General</span>
        </div>
        <div class="dhopt" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#opciones_menu" aria-controls="opciones_menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
            </svg>
            <span>Opciones</span>
        </div>

    </nav>

    <!-- BOTON DE MENU DE OPCIONES MOBILE -->
    <div class="options_button" type="button" data-bs-toggle="offcanvas" data-bs-target="#opciones_menu"
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

</header>