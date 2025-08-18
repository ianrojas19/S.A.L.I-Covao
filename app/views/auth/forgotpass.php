<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/auth/forgotpass.css">
    <title>SALI · Restablecer Contraseña</title>
</head>

<body>
    <?php //require './app/views/includes/loader.php' ?>

    <main class="container-fluid d-flex justify-content-center my-auto">
        <section id="form-recovery" class=" col-md-5 col-12 mx-auto my-5">
            <form>
                <div id="logocovao" class="d-flex justify-content-center align-items-center">
                    <img src="./public/assets/images/covao/logo-full-covao.png">
                </div>
                <p class="sali-title">Sistema de Administración de Llaves Institucional</p>

                <h1 class="mb-2">Restablecer contraseña</h1>

                <div id="rs_stage_1">
                    <div class="mb-3">
                        <label for="email_rec" class="form-label fw-medium">Ingrese su correo institucional</label>
                        <input type="text" class="form-control" id="email_rec" placeholder="Ejemplo: usuario@covao.ed.cr">
                        <div id="valid_msg" class="valid-feedback"></div>
                        <div class="invalid-feedback">
                            El correo ingresado no esta registrado en el sistema
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="code_rec" class="form-label fw-medium">Ingrese el código de restablecimiento <span class="fw-light">(5 dígitos)</span></label>
                        <input type="number" class="form-control" id="code_rec" min="1" max="99999" placeholder="Solo números" disabled>
                        <div class="valid-feedback">
                            Código válido
                        </div>
                        <div class="invalid-feedback">
                            El código ingresado no es válido
                        </div>
                    </div>
                </div>

                <div id="rs_stage_2" class="d-none">

                    <div class="mb-3">
                        <label for="new_pss" class="form-label fw-medium">Ingrese una nueva contraseña <span class="fw-light">(Min. 8 caractéres)</span></label>
                        <input type="text" class="form-control pass_fields" id="new_pss">
                    </div>
                    <div class="invalid-feedback">
                        La contraseña ingresada debe tener al menos 8 caractéres
                    </div>


                    <div class="mb-4">
                        <label for="new_pss_conf" class="form-label fw-medium">Confirme la nueva contraseña</label>
                        <input type="text" class="form-control pass_fields" id="new_pss_conf">
                        <div class="invalid-feedback">
                            Las contraseñas no coinciden
                        </div>
                    </div>
                </div>

                <div class="mb-4 d-flex justify-content-center align-items-center gap-2">
                    <a id="goto_home" href="index" type="button" class="btn btn-secondary fw-bold  recovery_btns">Volver</a>
                    <button id="send_rec_code" type="button" class="btn btn-primary fw-bold recovery_btns" disabled>Enviar código</button>
                    <button id="verify_code" type="button" class="btn btn-success fw-bold recovery_btns d-none" disabled>Confirmar</button>
                    <button id="change_psw" type="button" class="btn btn-success fw-bold recovery_btns d-none" disabled>Restablecer contraseña</button>
                </div>

            </form>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="info_modal" tabindex="-1" aria-labelledby="info_modal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="info_modal_label" style="color: #1b4b76;">Información del proceso</h1>
                </div>
                <div class="modal-body">
                    <p id="process_msg" class="mb-1"></p>
                </div>
                <div class="modal-footer">
                    <a href="logout" type="button" class="btn w-100 btn-primary fw-bold">Entendido</a>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="mail_sent_toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="./public/assets/images/covao/favicon-32x32.png" class="rounded me-2" style="width: 20px; height: 20px;">
                <strong class="me-auto fw-bold">Código enviado</strong>
                <small class="text-muted">Justo ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                El código de restablecimiento ha sido enviado al correo electrónico <strong id="mail_rc" style="color: #1b4b76;"></strong>
            </div>
        </div>
    </div>



    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/js/loader.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/auth/forgotpass.js"></script>
</body>

</html>