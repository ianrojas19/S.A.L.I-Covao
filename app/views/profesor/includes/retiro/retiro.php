    <h3 style="color: #143e63;" class="fw-semibold pt-4 mb-1">Llaves para retirar</h3>
    <p style="color: #3c3c3c;" class="mb-2">Se muestran las llaves asignadas para el día de hoy en su horario, a continuación seleccione las llaves que desea retirar:</p>

    <section id="choose_key_to_retire" class="py-3 pt-0 d-flex flex-wrap gap-2">
        <div id="ingr1" class="input-group mb-2 mt-1 d-none">
            <div class="input-group-text bg-secondary">
                <input id="check_key_1" class="transjaja form-check-input mt-0" type="checkbox" checked>
            </div>
            <input type="text" id="key_name_1" class="form-control" readonly>
        </div>

        <div id="ingr2" class="input-group mb-2 d-none">
            <div class="input-group-text bg-secondary">
                <input id="check_key_2" class="transjaja form-check-input mt-0" type="checkbox" checked>
            </div>
            <input type="text" id="key_name_2" class="form-control" readonly>
        </div>

        <div id="ingr3" class="input-group mb-2 d-none">
            <div class="input-group-text bg-secondary">
                <input id="check_key_3" class="transjaja form-check-input mt-0" type="checkbox" checked>
            </div>
            <input type="text" id="key_name_3" class="form-control" readonly>
        </div>

        <div id="ingr4" class="input-group mb-2 d-none">
            <div class="input-group-text bg-secondary">
                <input id="check_key_4" class="transjaja form-check-input mt-0" type="checkbox" checked>
            </div>
            <input type="text" id="key_name_4" class="form-control" readonly>
        </div>

        <div id="ingr5" class="input-group mb-2 d-none">
            <div class="input-group-text bg-secondary">
                <input id="check_key_5" class="transjaja form-check-input mt-0" type="checkbox" checked>
            </div>
            <input type="text" id="key_name_5" class="form-control" readonly>
        </div>
    </section>

    <section id="code_2fa" class="d-flex flex-column">
        <!--<div id="no_code_container" class="p-4 bg-secondary rounded d-flex flex-column justify-content-center align-items-center gap-1">-->
        <!--    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-lock-cancel">-->
        <!--        <path stroke="none" d="M0 0h24v24H0z" fill="none" />-->
        <!--        <path d="M12.5 21h-5.5a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10a2 2 0 0 1 1.749 1.028" />-->
        <!--        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />-->
        <!--        <path d="M8 11v-4a4 4 0 1 1 8 0v4" />-->
        <!--        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />-->
        <!--        <path d="M17 21l4 -4" />-->
        <!--    </svg>-->
        <!--    <h2 class="text-center">Todas las llaves están <strong>ocupadas</strong></h2>-->
        <!--    <p class="text-white text-center">Las llaves que tiene <strong>para retirar</strong> están <strong>ocupadas</strong>, si desea <strong>devolver llaves</strong> ingrese al módulo de <a href="profesor_devolucion" class="text-info fw-bold">Devolución de llaves</a>, de lo contrario, actualice este módulo o comuníquese con el equipo de Coordinación.</p>-->
        <!--    <div class="d-flex flex-md-row flex-column gap-2 col-12 mx-auto justify-content-center" style="max-width: 800px;">-->
        <!--        <a href="profesor" class="d-flex justify-content-center align-items-center btn btn-dark fw-bold py-2 text-white col-md-6 col-12">-->
        <!--            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" class="icon icon-tabler icons-tabler-filled icon-tabler-caret-left">-->
        <!--                <path stroke="none" d="M0 0h24v24H0z" fill="none" />-->
        <!--                <path d="M13.883 5.007l.058 -.005h.118l.058 .005l.06 .009l.052 .01l.108 .032l.067 .027l.132 .07l.09 .065l.081 .073l.083 .094l.054 .077l.054 .096l.017 .036l.027 .067l.032 .108l.01 .053l.01 .06l.004 .057l.002 .059v12c0 .852 -.986 1.297 -1.623 .783l-.084 -.076l-6 -6a1 1 0 0 1 -.083 -1.32l.083 -.094l6 -6l.094 -.083l.077 -.054l.096 -.054l.036 -.017l.067 -.027l.108 -.032l.053 -.01l.06 -.01z" />-->
        <!--            </svg>-->
        <!--            <span>Volver a Inicio</span>-->
        <!--        </a>-->
        <!--        <a href="profesor_retiro" class="d-flex justify-content-center align-items-center gap-2 btn btn-info fw-bold py-2 text-white col-md-6 col-12">-->
        <!--            <span>Actualizar módulo</span>-->
        <!--            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">-->
        <!--                <path stroke="none" d="M0 0h24v24H0z" fill="none" />-->
        <!--                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />-->
        <!--                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />-->
        <!--            </svg>-->
        <!--        </a>-->
        <!--    </div>-->
        <!--</div>-->
        <div id="retire_available" class="d-flex flex-column">
            <h4 style="color: #0f63ad;" class="fw-semibold pt-2 mb-1 w-100 text-center">Seleccione el número de acceso</h4>
            <p class="text-light-emphasis text-center w-100 m-0" style="font-size: 0.9em;">En caso de no ver el código correcto de retiro en pantalla, refresque la página.</p>
            <div class="d-flex gap-3 m-2">

                <div id="box_of_code_1" class="cod_option border rounded shadow-sm d-flex justify-content-center align-items-center" style="z-index: 999;">
                    <span id="num_cod_1">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                </div>

                <div id="box_of_code_2" class="cod_option border rounded shadow-sm d-flex justify-content-center align-items-center" style="z-index: 999;">
                    <span id="num_cod_2">
                        <div class="spinner-border text-primary fw-medium" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                </div>
            </div>

            <div class="d-flex gap-3 m-2">
                <div id="box_of_code_3" class="cod_option border rounded shadow-sm d-flex justify-content-center align-items-center" style="z-index: 999;">
                    <span id="num_cod_3">
                        <div class="spinner-border text-primary fw-medium" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                </div>

                <div id="box_of_code_4" class="cod_option border rounded shadow-sm d-flex justify-content-center align-items-center" style="z-index: 999;">
                    <span id="num_cod_4">
                        <div class="spinner-border text-primary fw-medium" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </section>
