<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>Gestión General</title>

    <style>
        html,
        body {
            background: linear-gradient(38deg, rgb(255, 255, 255) 15%, #c3cfe2 100%);
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }

        .page-item {
            width: auto;
            cursor: pointer;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        #list-group-title {
            background: rgb(18, 84, 142);
            background: -moz-linear-gradient(302deg, rgba(18, 84, 142, 1) 0%, rgba(11, 43, 71, 1) 100%);
            background: -webkit-linear-gradient(302deg, rgba(18, 84, 142, 1) 0%, rgba(11, 43, 71, 1) 100%);
            background: linear-gradient(302deg, rgba(18, 84, 142, 1) 0%, rgba(11, 43, 71, 1) 100%);
        }

        .active>.page-link,
        .page-link.active {
            background-color: rgb(13, 61, 103) !important;
            border-color: rgb(2, 20, 37) !important;
            color: white !important;
        }

        #key_list, #esp_sub_list {
            height: 100% !important;
            overflow-y: scroll;
            border-end-end-radius: 5px;
            border-end-start-radius: 5px;
            scrollbar-width: thin;
        }

        #key_list li,
        #esp_sub_list .accordion-button {
            font-weight: 700;
            color: rgb(18, 68, 117);
        }

        .sec_container {
            max-width: 1440px;
            height: calc(100vh - 100px) !important;
        }

        .btn {
            transition: all 0.3s;
        }

        #processing {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: 0.5s all ease;
            flex-direction: column;
            z-index: 0;
            backdrop-filter: blur(3px);
        }

        @media screen and (max-width: 992px) {
            .sec_container {
                height: auto !important;
            }

            html,
            body {
                height: fit-content !important;
            }

        }

        @media screen and (max-width: 768px) {
            .page-item {
                width: 100%;
            }

            .btn {
                width: 100% !important;
            }


            .pagination {
                width: 93% !important;
            }
        }

        #change_ges_area {
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div id="processing">
        <div class="spinner-grow text-light mb-2" style="width: 75px; height: 75px;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span id="proc-text" class="text-light fs-3 fw-bold">Procesando...</span>
    </div>


    <section id="change_ges_area" class="col-12 d-flex justify-content-center align-items-center">
        <nav aria-label="change_ges_area_container" class="col-12 mx-auto">
            <ul class="pagination d-flex justify-content-center flex-column flex-md-row my-3 mx-auto shadow" style="width: fit-content;">

                <li class="page-item"><a class="fw-semibold page-link bg-light text-dark shadow-none border-1 d-flex justify-content-center align-items-center gap-2 mt-md-0 mt-2" href="index">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                        </svg>
                        <span>Volver a inicio</span>
                    </a>
                </li>

                <li id="ges_sec_llaves" class="page-item active">
                    <div class="fw-semibold page-link shadow-none border-1 d-flex justify-content-center align-items-center gap-2 mt-md-0 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-key">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z"></path>
                            <path d="M15 9h.01"></path>
                        </svg>
                        <span>Gestión de Llaves</span>
                    </div>
                </li>

                <li id="ges_sec_esps" class="page-item">
                    <div class="fw-semibold page-link shadow-none border-1 d-flex justify-content-center align-items-center gap-2 mt-md-0 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-school">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"></path>
                            <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"></path>
                        </svg>
                        <span>Gestión de Especialidades y Subáreas</span>
                    </div>
                </li>

            </ul>
        </nav>
    </section>


    <section id="ges_sec" class="sec_container col-12 d-flex flex-md-row flex-column-reverse justify-content-center p-3 px-md-5 px-3 gap-2 mx-auto">

        <div id="group_list" class="list-group col-12 col-md-4 col-12 border shadow bg-white">
            <span id="list-group-title" class="list-group-item active fw-semibold fs-5 border">Lista de llaves existentes</span>

            <div id="key_list" class="align-items-center flex-column gap-2 p-2" style="display: flex;">
                <?php
                // Sort keys by numeroLlave
                usort($keys, function ($a, $b) {
                    return $a['numeroLlave'] - $b['numeroLlave'];
                });

                foreach ($keys as $key): ?>
                    <?php if ($key['numeroLlave'] != 999): ?>
                        <li class="w-100 list-group-item shadow-sm"><?php echo "Llave N°" . $key['numeroLlave'] . " - " . $key['nombreAula']; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div id="esp_sub_list" class="accordion m-1" style="display: none;">
                <?php foreach ($especialidades as $esp): ?>
                    <?php if ($esp[1] !== 'Administrador'): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#esp<?php echo $esp[0]; ?>">
                                    <?php echo $esp[1]; ?>
                                </button>
                            </h2>
                            <div id="esp<?php echo $esp[0]; ?>" class="accordion-collapse collapse">
                                <div class="accordion-body p-2">
                                    <ul class="list-group">
                                        <?php
                                        $hasSubareas = false;
                                        foreach ($subareas as $sub):
                                            if ($sub['idEspecialidad'] == $esp[0]):
                                                $hasSubareas = true;
                                        ?>
                                                <li class="list-group-item"><?php echo $sub['nombreSubarea']; ?></li>
                                            <?php
                                            endif;
                                        endforeach;
                                        if (!$hasSubareas):
                                            ?>
                                            <li class="list-group-item">No hay subareas</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="gest_container" class="d-flex flex-column col-md-8 col-12 gap-4">

            <div id="gest_llaves" class="gest_1 list-group col-12">

                <div id="list-group-title" class="list-group-item active fw-semibold fs-5 border">Gestión de Llaves</div>

                <div class="list-group-item bg-white shadow p-3">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="key_num" class="form-label fw-bold">Número de llave</label>
                            <input type="number" class="form-control" id="key_num" name="key_num" required>
                        </div>

                        <div class="col-md-6">
                            <label for="key_name" class="form-label fw-bold">Nombre de aula</label>
                            <input type="text" class="form-control" id="key_name" name="key_name" required>
                        </div>

                        <div class="col-12 d-flex gap-2 flex-wrap">

                            <button id="create_key" type="button" class="btn btn-success fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                <span>Crear Llave</span>
                            </button>

                            <button id="upt_key" type="button" class="btn btn-primary fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                </svg>
                                <span>Actualizar Llave</span>
                            </button>

                            <button id="del_key" type="button" class="btn btn-danger fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                <span>Eliminar Llave</span>
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <div id="gest_esp" class="gest_2 list-group col-12" style="display: none;">

                <div id="list-group-title" class="list-group-item active fw-semibold fs-5 border">Gestión de Especialidades</div>

                <div class="list-group-item bg-white shadow p-3">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="select_esp" class="form-label fw-bold">Selección de especialidad</label>
                            <select id="select_esp" name="select_esp" class="form-select" aria-label="Default select example">
                                <option value="newesp" selected>--- Crear especialidad ---</option>
                                <?php foreach ($especialidades as $esp): ?>
                                    <?php if ($esp[1] !== 'Administrador'): ?>
                                        <option value="<?php echo $esp[0]; ?>"><?php echo $esp[1]; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div class="col-md-6">
                            <label for="name_esp" class="form-label fw-bold">Nombre de especialidad</label>
                            <input type="text" class="form-control" id="name_esp" name="name_esp" required>
                        </div>

                        <div class="col-12 d-flex gap-2 flex-wrap">

                            <button id="create_esp" type="button" class="btn btn-success fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                <span>Crear Especialidad</span>
                            </button>

                            <button id="upt_esp" type="button" class="btn btn-primary fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                </svg>
                                <span>Actualizar Especialidad</span>
                            </button>

                            <button id="del_esp" type="button" class="btn btn-danger fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                <span>Eliminar Especialidad</span>
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <div id="gest_subs" class="gest_2 list-group col-12" style="display: none;">

                <div id="list-group-title" class="list-group-item active fw-semibold fs-5 border">Gestión de Subáreas</div>

                <div class="list-group-item bg-white shadow p-3">

                    <div class="row g-3">


                        <div class="col-md-3">
                            <label for="esp_of_subs" class="form-label fw-bold">Especialidad de subárea </label>
                            <select id="esp_of_subs" name="esp_of_subs" class="form-select">

                                <?php foreach ($especialidades as $esp): ?>
                                    <?php if ($esp[1] !== 'Administrador'): ?>
                                        <option value="<?php echo $esp[0]; ?>"><?php echo $esp[1]; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="select_sub" class="form-label fw-bold">Nombre de la subárea </label>
                            <select id="select_sub" name="select_sub" class="form-select">
                                <option value="newsub" selected>--- Crear subárea ---</option>
                                <?php foreach ($subareas as $sub): ?>
                                    <?php if ($sub['idSubarea'] != 1): ?>
                                        <option value="<?php echo $sub['idSubarea']; ?>"><?php echo $sub['nombreSubarea']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="sub_nom" class="form-label fw-bold">Nombre actualizado de subárea</label>
                            <input type="text" class="form-control" id="sub_nom" name="sub_nom" required>
                        </div>

                        <div class="col-12 d-flex gap-2 flex-wrap">

                            <button id="create_sub" type="button" class="btn btn-success fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                <span>Crear Subárea</span>
                            </button>

                            <button id="upt_sub" type="button" class="btn btn-primary fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                </svg>
                                <span>Actualizar Subárea</span>
                            </button>

                            <button id="del_sub" type="button" class="btn btn-danger fw-semibold d-flex gap-1 justify-content-center align-items-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                <span>Eliminar Subárea</span>
                            </button>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </section>

    <script>
        let keys = <?php echo json_encode($keys); ?>;
        let especialidades = <?php echo json_encode($especialidades); ?>;
        let subareas = <?php echo json_encode($subareas); ?>;
    </script>
    <script src=" ./public/js/admin/gestion.js"></script>
</body>

</html>