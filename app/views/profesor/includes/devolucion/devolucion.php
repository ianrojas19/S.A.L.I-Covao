<h3 style="color: #143e63;" class="fw-semibold pt-4 mb-1">Llaves para devolver</h3>
<p style="color: #3c3c3c;" class="mb-2">Se muestran las llaves que posee actualmente <span class="text-muted">(adquiridas por horario o por solicitud)</span>, a continuación seleccione las llaves que desea devolver:</p>

<section id="choose_key_to_return" class="py-3 pt-0 d-flex flex-wrap gap-2"></section>

<section id="return_details">
    <h3 style="color: #194c78;">Detalles de devolución</h3>
    <div id="return_reason" class="d-flex flex-column">
        <p class="fw-medium" style="color: #2265a0; font-size: 1.1em;">Seleccione la razón de la devolución</p>
        <div class="d-flex flex-wrap">
            <div class="form-check col-md-3 col-12 py-md-0 py-2 pt-0">
                <input class="form-check-input reasons" type="checkbox" name="reason_check1" id="reason_check1">
                <label class="form-check-label text-primary-emphasis" for="reason_check1">
                    Continuidad de horario
                </label>
            </div>

            <div class="form-check col-md-3 col-12 py-md-0 py-2">
                <input class="form-check-input reasons" type="checkbox" name="reason_check2" id="reason_check2">
                <label class="form-check-label text-primary-emphasis" for="reason_check2">
                    Fin de jornada laboral
                </label>
            </div>

            <div class="form-check col-md-3 col-12 py-md-0 py-2">
                <input class="form-check-input reasons" type="checkbox" name="reason_check3" id="reason_check3">
                <label class="form-check-label text-primary-emphasis" for="reason_check3">
                    Fin de préstamo de llave
                </label>
            </div>

            <div class="form-check col-md-3 col-12 py-md-0 py-2">
                <input class="form-check-input reasons" type="checkbox" name="reason_check4" id="reason_check4">
                <label class="form-check-label text-dark" for="reason_check4">
                    Otra razón (debe especificar más adelante)
                </label>
            </div>

        </div>
    </div>

    <div id="return_condition" class="d-none flex-column mt-4">
        <p class="fw-medium" style="color: #2265a0; font-size: 1.1em;">Indique la condición de la devolución</p>
        <div class="d-flex flex-wrap justify-content-between">

            <div class="form-check col-md-3 col-12 py-md-0 py-2 pt-0">
                <input class="form-check-input conditions" type="radio" name="condition" id="condition1">
                <label class="form-check-label text-success" for="condition1">
                    <strong>Buena</strong> - Sin ningún inconveniente
                </label>
            </div>


            <div class="form-check col-md-3 col-12 py-md-0 py-2">
                <input class="form-check-input conditions" type="radio" name="condition" id="condition2">
                <label class="form-check-label" for="condition2" style="color: rgb(239 165 25);">
                    <strong>Intermedia</strong> - Inconvenientes menores
                </label>
            </div>

            <div class="form-check col-md-3 col-12 py-md-0 py-2">
                <input class="form-check-input conditions" type="radio" name="condition" id="condition3">
                <label class="form-check-label text-danger" for="condition3">
                    <strong>Grave</strong> - Inconvenientes mayores
                </label>
            </div>


        </div>
    </div>

    <div id="return_bitacora" class="d-none flex-column mt-4">
        <p class="fw-medium mb-0" style="color: #2265a0; font-size: 1.1em;">Anote la bitácora de esta devolución</p>

        <p class="text-dark">Por favor, detalle de manera clara y precisa el uso de cada llave. Incluya los acontecimientos relevantes, equipos o personas involucradas, y cualquier otra información que considere importante.</p>
        <textarea id="bitacora" class="form-control" rows="10" placeholder="Ejemplo: En el Laboratorio B9 un cable Ethernet tuvo que ser reemplazado etc..." id="floatingTextarea" style="min-height: fit-content;"></textarea>
    </div>

    <div id="return_another_reason" class="d-none flex-column mt-4">
        <p class="fw-medium mb-0" style="color: #2265a0; font-size: 1.1em;">Indique la razón de esta devolución</p>
        <p class="text-dark">Si desea elegir otra de las 3 razones de devolución anteriores, <a href="#razon_cont_horario" class="text-primary">de click aquí</a>, de lo contrario indique aqui su razón de devolución de llave(s):</p>
        <textarea id="another_reason" class="form-control" rows="10" placeholder="Ejemplo: Falla de servicio eléctrico, emergencia, falla en conexión de internet, riesgo sanitario..." id="floatingTextarea" style="min-height: fit-content;"></textarea>
    </div>

    <button id="process_devolution" type="button" class="btn btn-primary w-100 fw-bold my-4 mb-1">Procesar devolución</button>


    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="ErrorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-header">
                <strong class="me-auto text-danger">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Cerrar"></button>
            </div>
            <div id="toast_error_message" class="toast-body"></div>
        </div>
    </div>



</section>