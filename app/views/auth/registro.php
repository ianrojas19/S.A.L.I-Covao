<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./public/node_modules/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="./public/css/auth/registro.css">
    <title>SALI · Registro</title>
</head>

<body>

    <?php //require './app/views/includes/loader.php' ?>

    <main class="container-fluid d-flex justify-content-center">
        <section class="form-container col-md-5 col-12 mx-auto">
            <form class="form-auth" action="registro" method="post" id="form_registro" enctype="multipart/form-data">
                <div id="logocovao" class="logocovao-register d-flex justify-content-center align-items-center">
                    <img src="./public/assets/images/covao/logo-full-covao.png" alt="">
                </div>
                <p class="sali-title">Sistema de Administración de Llaves Institucional</p>
                <h1>Solicitud de registro</h1>

                <div id="stage-inicio" class="data-form-container">
                    <p>Para registrarse en el sistema SALI, es necesario que conozca la siguiente información:</p>
                    <ul>
                        <li class="reg-condition">Se le pedirá ingresar datos acerca de su identidad y su rol en la
                            institución, datos de contacto y sus credenciales en el sistema.</li>
                        <li class="reg-condition">Los campos marcados con un “<b style="color: red;">*</b>” son
                            <b>obligatorios</b>, en caso de no llenarlos, no podrá continuar ni concluir el proceso de
                            registro.
                        </li>
                        <li class="reg-condition">Su perfil <b>NO</b> será creado automáticamente, ya que debe ser
                            admitido por el personal de Coordinación del COVAO Nocturno.</li>
                        <li class="reg-condition">Se le notificará la aprobación o rechazo de su solicitud de registro
                            <b>a través del correo electrónico institucional</b> brindado en esta solicitud.
                        </li>
                        <li class="reg-condition">Procure recordar el correo institucional y la contraseña que ingrese,
                            ya que serán las credenciales que se le pediran para iniciar sesión en el sistema</li>
                    </ul>

                    <div class="checkbox-wrapper-33">
                        <label class="checkbox">
                            <input id="accept-tyc" class="checkbox__trigger visuallyhidden" type="checkbox" />
                            <span class="checkbox__symbol">
                                <svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px"
                                    viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 14l8 7L24 7"></path>
                                </svg>
                            </span>
                            <p class="checkbox__textwrapper">Acepto las condiciones del registro.</p>
                        </label>
                    </div>


                </div>

                <div id="stage-personal" class="data-form-container" style="display: none;">
                    <h2>Datos personales</h2>
                    <label for="foto_perfil" class="form-label">Foto de perfil</label>
                    <div class="mb-3 d-flex flex-row align-items-center justify-content-start gap-3">
                        <label for="foto_perfil" class="photo-container">
                            <img id='uploaded_photo' src="./public/assets/images/fotos_perfil/default.webp">
                        </label>
                        <button class="container-btn-file">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-link">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 15l6 -6" />
                                <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
                                <path
                                    d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                            </svg>
                            <span>Adjuntar foto</span>
                            <input name="foto_perfil" type="file" id="foto_perfil" class="file" accept="image/*" />
                        </button>
                    </div>

                    <div class="mb-4">
                        <label for="userRol" class="form-label">Rol institucional <b class="isRequired">*</b></label>
                        <select class="form-select" id="userRol" name="userRol">
                            <option selected value="Administrador">Administrador</option>
                            <option value="Profesor">Profesor</option>
                        </select>
                    </div>

                    <div class="mb-4" style="display: none;" id="userEspecialidad_cont">
                        <label for="userEspecialidad" class="form-label">Especialidad <b
                                class="isRequired">*</b></label>

                        <select class="form-select" id="userEspecialidad" name="userEspecialidad">

                            <!-- Listado de especialidades -->
                            <?php
                            foreach ($especialidades as $key => $value) {
                                if ($value != 'Administrador') {
                            ?>
                                    <option selected value="<?php echo $value ?>" data-esp-op-<?php echo $key ?>>
                                        <?php echo $value ?>
                                    </option>
                                <?php
                                } else {
                                ?>
                                    <option value="Administrador" style="display: none;"></option>
                            <?php
                                }
                            }
                            ?>

                        </select>

                    </div>

                    <div class="mb-4">
                        <label for="userCedula" class="form-label">Cédula de identidad <b>(solo números) </b> <b
                                class="isRequired">*</b></label>
                        <input type="text" class="form-control mb-1 in_number" id="userCedula" name="userCedula" minlength="9"
                            maxlength="9" placeholder="Ej: 301230456">
                        <div id="ifb_ced" class="invalid-feedback"></div>
                    </div>

                    <div class="mb-4">
                        <label for="userNombreCompleto" class="form-label">Nombre completo <b
                                class="isRequired">*</b></label>
                        <input type="text" class="form-control" id="userNombreCompleto" name="userNombreCompleto"
                            minlength="3">
                        <div id="ifb_nom" class="invalid-feedback"></div>
                    </div>

                </div>

                <div id="stage-credenciales" class="data-form-container" style="display:none">
                    <h2>Crendenciales en SALI</h2>
                    <div class="mb-4">
                        <label for="userCorreoInstitucional" class="form-label">Correo electrónico institucional <b
                                class="isRequired">*</b></label>
                        <input type="text" class="form-control mb-1" id="userCorreoInstitucional"
                            name="userCorreoInstitucional" minlength="15" style="text-transform:lowercase;">
                        <div id="ifb_ci" class="invalid-feedback"></div>
                    </div>

                    <div class="mb-4">
                        <label for="userCorreoInstitucionalPass" class="form-label">Contraseña <b
                                class="isRequired">*</b></label>
                        <input type="text" class="form-control mb-2" id="userCorreoInstitucionalPass"
                            name="userCorreoInstitucionalPass" minlength="8">
                        <div id="ifb_cip" class="invalid-feedback"></div>
                    </div>

                    <div class="mb-4">
                        <label for="userCorreoInstitucionalConfPass" class="form-label">Confirmar contraseña <b
                                class="isRequired">*</b></label>
                        <input type="text" class="form-control" id="userCorreoInstitucionalConfPass"
                            name="userCorreoInstitucionalConfPass" minlength="8" style="text-transform:lowercase;">
                        <div id="ifb_cifp" class="invalid-feedback"></div>
                    </div>

                </div>

                <div id="stage-contacto" class="data-form-container" style="display:none">
                    <h2>Datos de contacto</h2>
                    <p>Estos medios de contacto se utilizarán exclusivamente para asuntos institucionales de relevancia.
                    </p>


                    <div class="mb-4">
                        <label for="userTelefonoContacto" class="form-label">Teléfono celular de contacto <b
                                class="isRequired">*</b></label>
                        <input type="text" class="form-control mb-1 in_number" id="userTelefonoContacto"
                            name="userTelefonoContacto" maxlength="8">
                        <div id="ifb_tel" class="invalid-feedback"></div>
                    </div>


                    <div class="mb-4">
                        <label for="userCorreoContacto" class="form-label">Correo electrónico de contacto</label>
                        <input type="email" class="form-control mb-1" id="userCorreoContacto" name="userCorreoContacto">
                    </div>


                </div>

                <div class="actions d-flex gap-2 mb-2">
                    <div id="btn-action-back" class="back-btn">Atrás</div>
                    <div id="btn-action-next" class="next-btn">Comenzar registro</div>
                    <button type="submit" id="confirm_register" class="" style="display: none;">
                        <span>Finalizar</span>
                        <div id="registro_spinner" class="spinner-border text-light mx-auto" role="status"
                            style="display: none;">
                        </div>
                    </button>
                </div>
                <p id="tooltip-tolog" class="tooltip-form mb-2 pt-2">Ya posee una cuenta en el sistema? <a
                        href="login">Iniciar sesión</a></p>
            </form>

        </section>

    </main>

    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/loader.js"></script>
    <script src="./public/js/auth/register.js"></script>
</body>

</html>