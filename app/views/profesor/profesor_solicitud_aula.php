<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/profesor/solicitud_aula.css">
    <title>SALI · Solicitud de Llave</title>
</head>

<body>

    <?php require 'includes/header.php' ?>

    <?php require 'includes/back_to_main.php' ?>


    <!-- CONTENIDO DE SUS INTERFACES -->
    <main>
        <div id="form_solicitud" class="container-fluid col-md-7 col-12 px-3 mx-auto my-4 mb-5" style="max-width: 700px;">

            <h3 style="color: #143e63;" class="fw-semibold pt-0 mb-1">Formulario de solicitud de llave</h3>
            <p style="color: #3c3c3c;" class="mb-3">Ingrese la información solicitada en este formulario para completar su solicitud:</p>

            <div class="mb-3">
                <label for="fecha_uso" class="form-label">Indíque la fecha de utilización de la llave</label>
                <input type="date" id="fecha_uso" class="form-control" placeholder="Seleccione la fecha de utilización">
                <div class="invalid-feedback">
                    No puede seleccionar una fecha anterior al día de hoy
                </div>
            </div>

            <div class="mb-3">
                <div class="mb-3">
                    <label for="aula" class="form-label">Elija la llave que solicitará</label>
                    <select class="form-select" id="aula">
                        <option value="empty">Seleccione la llave</option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione la llave que solicitará
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Seleccione la hora inicial de uso</label>
                <input type="time" class="form-control" id="hora_inicio" placeholder="Hora inicial">
                <div class="invalid-feedback">
                    Indique una hora inicial anterior a la hora final de uso
                </div>
            </div>

            <div class="mb-3">
                <label for="hora_final" class="form-label">Seleccione la hora final de uso</label>
                <input type="time" class="form-control" id="hora_final" placeholder="Horal final ">
                <div class="invalid-feedback">
                    Indique una hora inicial posterior a la hora inicial de uso
                </div>
            </div>

            <div class="mb-3">
                <label for="justificacion" class="form-label">Provea una justificación para el uso de la llave</label>
                <textarea class="form-control" id="justificacion" rows="4" placeholder="Ej: Actividad particular, uso de herramienta o maquinaria..."></textarea>
                <div class="invalid-feedback">
                    La justificación no puede estar vacía
                </div>
            </div>

            <div class="mb-3" style="font-size: 15px; color: #212529">Esta solicitud <strong>no es aprobada automaticamente</strong>, el equipo administrativo debe procesar la solicitud, ya cuando sea procesada, podrá ver el resultado en el apartado de <strong>"Mi actividad"</strong>.</div>

            <div class="align-items-start" id="opt_buttons">
                <div class="col-12">
                    <button class="btn btn-primary col-12 py-2 mt-1 fw-bold" id="btn_request_key" disabled>Solicitar llave</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="reqkey_info" tabindex="-1" aria-labelledby="reqkey_infolabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="reqkey_infolabel">Información del proceso</h1>
                    </div>
                    <div class="modal-body">
                        <p id="reqkey_info_text"></p>
                    </div>
                    <div class="modal-footer">
                        <a href="profesor" type="button" class="w-100 fw-bold btn btn-primary">Entendido</a>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <footer>SALI · COVAO © <span id="app_year"></span></footer>

    <script>
        $('#app_year').html(new Date().getFullYear());
        $('#module_title').html('Solicitud de Llave');
    </script>

    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="./public/js/profesor/min/profesor_solicitud.js"></script>
</body>

</html>