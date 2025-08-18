$(document).ready(function () {
    // Establecer el año actual y el título del módulo
    $('#app_year').html(new Date().getFullYear());
    $('#module_title').html('Devolución de Llaves');
    const sonido_exito = new Audio("./public/assets/audio/success.mp3");

    const today = new Date();
    let dayNumber = today.getDay();
    dayNumber = dayNumber === 0 ? 7 : dayNumber;

    let selected_keys = [];

    $.ajax({
        url: 'profesor_devolucion',
        method: 'POST',
        data: {
            action_type: "get_profesor_sch_keys",
        },
        dataType: "json",
        success: function (response) {
            $('#main_content_loader').remove();

            if (response === 'no_keys' || response === 'finde') {
                $('main').html('<p class="text-center mt-4">Sin llaves por devolver</p>');
            } else {
                let cant_taken_keys = 0;

                response.forEach((key) => {
                    let keynum = key.numeroLlave;

                    aulas.forEach(aula => {
                        if (aula.numeroLlave == keynum) {
                            const key_component = `
                                <div class="p-2">
                                    <div class="col card shadow-sm border-light-subtle">
                                        <div class="card-body py-4 d-flex flex-row flex-md-column align-items-center justify-content-center gap-3">
                                            <div class="key_logo text-white bg-primary rounded-circle d-flex justify-content-center align-items-center"
                                                style="width: fit-content; height: fit-content; padding: 12px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-key">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                                                    <path d="M15 9h.01" />
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center align-items-md-center mx-1">
                                                <h5 class="card-title fw-bold mb-0" style="color: #143e63;">Llave N°${aula.numeroLlave}</h5>
                                                <p class="card-text text-md-center">${aula.nombreAula}</p>
                                            </div>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <input type="checkbox" class="btn-check select_key" id="${aula.numeroLlave}" autocomplete="off">
                                                <label id="${aula.numeroLlave}_check_text" class="btn btn-outline-primary w-100 fw-semibold" for="${aula.numeroLlave}">
                                                    Seleccionar llave
                                                </label><br>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            `;

                            if (aula.isTaken !== 0) {
                                $('#keys_list').append(key_component);
                                cant_taken_keys++;
                            }

                            return;
                        }
                    });
                });

                $('#verify_dev_cont, #dev_keys_container').removeClass('d-none');

                if (cant_taken_keys === 0) {
                    $('#main_content').html('<p class="text-center mt-4">Sin llaves por devolver</p>');
                    $('#verify_dev_cont, #dev_keys_container').addClass('d-none');
                }
            }
        },
        error: function (error) {
            $('#main_content_loader').remove();
            alert('Hubo un error al cargar, intentelo más tarde');
            location.href = 'index';
            console.log(error);
        }
    });

    $('#condicion').on('change', function () {
        switch ($(this).val()) {
            case '1':
                $('#condicion').addClass('border-success').removeClass('border-warning border-danger');
                break;
            case '2':
                $('#condicion').addClass('border-warning').removeClass('border-success border-danger');
                break;
            case '3':
                $('#condicion').addClass('border-danger').removeClass('border-success border-warning');
                break;
        }
    });

    // Evento al hacer clic en un checkbox
    $(document).on("click", ".select_key", function () {
        const key = $(this);
        const key_id = key.attr('id');

        if (key.prop('checked')) {
            if (!selected_keys.includes(key_id)) {
                selected_keys.push(key_id);
            }
            $(`#${key_id}_check_text`).text('Llave seleccionada');
        } else {
            selected_keys = selected_keys.filter(id => id !== key_id);
            $(`#${key_id}_check_text`).text('Seleccionar llave');
        }
    });

    $('#verify_dev_cont_btn').on('click', function () {
        if (selected_keys.length === 0) {
            $('#no_keys_msg').removeClass('d-none');
            $('#back_to_dev').addClass('w-100');
            $('#form_dev_keys').addClass('d-none');
            $('#process_dev_keys').addClass('d-none');
        } else {
            $('#no_keys_msg').addClass('d-none');
            $('#back_to_dev').removeClass('w-100');
            $('#form_dev_keys').removeClass('d-none');
            $('#process_dev_keys').removeClass('d-none');
        }
    });

    $('#process_dev_keys').on('click', function () {
        const bitacora = $('#bitacora').val();
        const gravedad = $('#condicion').val();
        const razon = $('#razon').val();

        if (bitacora === '') {
            alert('Por favor, complete la bitácora antes de devolver las llaves.');
            return;
        }

        $.ajax({
            url: "profesor_devolucion",
            method: "POST",
            data: {
                action_type: "process_devolution",
                key1: selected_keys[0] || '',
                key2: selected_keys[1] || '',
                key3: selected_keys[2] || '',
                key4: selected_keys[3] || '',
                key5: selected_keys[4] || '',
                key6: selected_keys[5] || '',
                key7: selected_keys[6] || '',
                key8: selected_keys[7] || '',
                key9: selected_keys[8] || '',
                bitacora: bitacora,
                gravedad: gravedad,
                reasons: razon,
            },
            success: function (response) {
                sonido_exito.play();
                $('#details_dev').modal('hide');
                $('#process_devolucionres_modal').modal('show');

                if (response == 'OK') {
                    $('#process_dev_msg').text('La devolución de llaves se realizó correctamente.');
                } else {
                    $('#process_dev_msg').text('La devolución de llaves falló. Inténtelo más tarde o comuníquelo a la Oficina de Coordinación.');
                }
            },
            error: function (error) {
                console.log(error);
                $('#verify_code_modal').modal('hide');
                $('#process_devolucionres_modal').modal('show');
                $('#process_dev_msg').text('La devolución de llaves falló. Inténtelo más tarde o comuníquelo a la Oficina de Coordinación.');
            }
        });
    });
});
