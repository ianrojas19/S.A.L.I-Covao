$(document).ready(function () {
    $('#app_year').html(new Date().getFullYear());
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    const fechaActual = new Date();
    const nombreMes = meses[fechaActual.getMonth()];
    $('#module_title').html(`Mi Actividad · ${nombreMes} ${fechaActual.getFullYear()}`);

    let act_ryd = [];
    let act_sol = [];

    const opcionesFH = { day: '2-digit', month: 'long', year: 'numeric' };
    const opcionesHR = { hour: '2-digit', minute: '2-digit', hour12: true };
    
    $('#inbox_ryd').on('click', function () {
        $(this).addClass('inbox-active');
        $('#inbox_solicitudes').removeClass('inbox-active');

        $('#ryd_activity_list').addClass('d-flex').removeClass('d-none');
        $('#sol_activity_list').addClass('d-none').addClass('opacity-0').removeClass('d-flex').removeClass('opacity-100');
        setTimeout(() => {
            $('#ryd_activity_list').removeClass('opacity-0').addClass('opacity-100');
        }, 100);
    });

    $('#inbox_solicitudes').on('click', function () {
        $(this).addClass('inbox-active');
        $('#inbox_ryd').removeClass('inbox-active');

        $('#sol_activity_list').addClass('d-flex').removeClass('d-none');
        $('#ryd_activity_list').addClass('d-none').addClass('opacity-0').removeClass('d-flex').removeClass('opacity-100');
        setTimeout(() => {
            $('#sol_activity_list').removeClass('opacity-0').addClass('opacity-100');
        }, 100);
    });

    function getKeyData(rkey) {
        for (const key of keys) {
            if (key['numeroLlave'] == rkey) {
                return `N°${rkey} - ${key['nombreAula']}`;
            }
        }
        return `NE`;
    }

    if (Array.isArray(activity[0])) {
        activity.forEach(activity_element => {
            try {
                if (!activity_element || activity_element.length < 6) {
                    throw new Error('Elemento de actividad no definido o incompleto');
                }

                const fechaStr = activity_element[3];
                const horaStr = activity_element[4];

                if (!fechaStr || !horaStr) {
                    throw new Error('Fecha u hora no proporcionada');
                }

                const fechaElemento = new Date(`${fechaStr}T${horaStr}`);
                if (isNaN(fechaElemento)) throw new Error('Fecha u hora inválida');

                if (activity_element[1] != 3) {
                   let razon_dev = '';

                    switch (activity_element[22]) {
                      case 1:
                        razon_dev = "Fin de uso regular de llave por horario";
                        break;
                    
                      case 2:
                        razon_dev = "Finalización de jornada laboral";
                        break;
                    
                      case 3:
                        razon_dev = "Motivos institucionales";
                        break;
                    
                      case 4:
                        razon_dev = "Ha ocurrido una emergencia";
                        break;
                    
                      default:
                        razon_dev = dev_razon;
                        break;
                    }
                    
                    act_ryd.push({
                        tipo: activity_element[1],
                        fecha: fechaElemento.toLocaleDateString('es-ES', opcionesFH),
                        hora: fechaElemento.toLocaleTimeString('es-ES', opcionesHR),
                        k1: getKeyData(activity_element[5]) || '',
                        k2: getKeyData(activity_element[6]) || '',
                        k3: getKeyData(activity_element[7]) || '',
                        k4: getKeyData(activity_element[8]) || '',
                        k5: getKeyData(activity_element[9]) || '',
                        k6: getKeyData(activity_element[10]) || '',
                        k7: getKeyData(activity_element[11]) || '',
                        k8: getKeyData(activity_element[12]) || '',
                        k9: getKeyData(activity_element[13]) || '',
                        cond_dev: activity_element[18],
                        bitacora: activity_element[17] || 'Sin bitácora',
                        razon: razon_dev
                    });
                    console.log(activity_element);
                } else {
                    act_sol.push({
                        fecha: fechaElemento.toLocaleDateString('es-ES', opcionesFH),
                        hora: fechaElemento.toLocaleTimeString('es-ES', opcionesHR),
                        k_sol: getKeyData(activity_element[14]),
                        fecha_uso: new Date(activity_element[15]).toLocaleDateString('es-ES', opcionesFH),
                        hora_in: new Date(`${activity_element[15]}T${activity_element[19]}`).toLocaleTimeString('es-ES', opcionesHR),
                        hora_fin: new Date(`${activity_element[15]}T${activity_element[20]}`).toLocaleTimeString('es-ES', opcionesHR),
                        sol_cond: activity_element[16],
                    });
                    console.log(activity_element);
                }
            } catch (error) {
                console.error('Error procesando un elemento de actividad:', error.message);
            }
        });
    } else {
        console.error('activity[0] no es un array válido.');
    }

    function renderActivities() {
        const rydContainer = $('#ryd_activity_list_cont');
        const solContainer = $('#sol_activity_list_cont');

        rydContainer.empty();
        solContainer.empty();

        if (act_ryd.length === 0) {
            rydContainer.html('<p>No hay actividad</p>');
        } else {
            act_ryd.forEach(act => {
                const condText = act.cond_dev == 1 ? 'Buena' : act.cond_dev == 2 ? 'Intermedia' : 'Grave';
                
                if(act.tipo == 1){
                
                rydContainer.append(`
                    <div class="activity_block p-3 shadow-sm border w-100 rounded d-flex flex-column gap-2">
                        <div class="act_data_group">
                            <div class="act_title mb-1 fs-4 fw-bold">Retiro de llaves</div>
                            <hr class="mb-3 mt-2">
                            <div class="act_data fw-semibold d-flex flex-wrap gap-1">
                                ${act.k1 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k1}</span>` : ''}
                                ${act.k2 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k2}</span>` : ''}
                                ${act.k3 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k3}</span>` : ''}
                                ${act.k4 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k4}</span>` : ''}
                                ${act.k5 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k5}</span>` : ''}
                            </div>
                            <div class="act_subtitle">Llaves retiradas</div>
                        </div>

                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.fecha}</div>
                            <div class="act_subtitle">Fecha de retiro</div>
                        </div>

                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.hora}</div>
                            <div class="act_subtitle">Hora de retiro</div>
                        </div>
                    </div>
                `);
                    
                } 
                else{
                    rydContainer.append(`
                    <div class="activity_block p-3 shadow-sm border w-100 rounded d-flex flex-column gap-2">
                        <div class="act_data_group">
                            <div class="act_title mb-1 fs-4 fw-bold">Devolución de llaves</div>
                            <hr class="mb-3 mt-2">
                            <div class="act_data fw-semibold d-flex flex-wrap gap-1">
                                ${act.k1 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k1}</span>` : ''}
                                ${act.k2 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k2}</span>` : ''}
                                ${act.k3 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k3}</span>` : ''}
                                ${act.k4 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k4}</span>` : ''}
                                ${act.k5 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k5}</span>` : ''}
                                ${act.k6 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k6}</span>` : ''}
                                ${act.k7 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k7}</span>` : ''}
                                ${act.k8 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k8}</span>` : ''}
                                ${act.k9 != 'NE' ? `<span class="key_cont text-white rounded py-2 px-3">${act.k9}</span>` : ''}
                            </div>
                            <div class="act_subtitle">Llaves devueltas</div>
                        </div>
                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.fecha}</div>
                            <div class="act_subtitle">Fecha de devolución</div>
                        </div>
                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.hora}</div>
                            <div class="act_subtitle">Hora de devolución</div>
                        </div>
                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.razon}</div>
                            <div class="act_subtitle">Razón(es) de devolución</div>
                        </div>
                        <div class="act_data_group">
                            <textarea class="form-control mb-1" rows="5" readonly>${act.bitacora}</textarea>
                            <div class="act_subtitle">Bitácora</div>
                        </div>
                        <div class="act_data_group">
                            ${act.cond_dev == 1 ? `<div class="act_data fw-semibold text-success">${condText}</div>` : ''}
                            ${act.cond_dev == 2 ? `<div class="act_data fw-semibold text-warning">${condText}</div>` : ''}
                            ${act.cond_dev == 3 ? `<div class="act_data fw-semibold text-danger">${condText}</div>` : ''}
                            <div class="act_subtitle">Condición de devolución</div>
                        </div>
                    </div>
                `);
                }
                
                
            });
        }

        if (act_sol.length === 0) {
            solContainer.html('<p>No hay solicitudes</p>');
        } else {
            act_sol.forEach(act => {
                solContainer.append(`
                    <div class="activity_block p-3 shadow-sm border w-100 rounded d-flex flex-column gap-2">
                        <div class="act_data_group">
                            <div class="act_title mb-1 fs-4 fw-bold">Solicitud de llave</div>
                            <hr class="mb-3 mt-2">
                                <div class="act_data fw-semibold d-flex flex-wrap gap-1">
                                    <span class="key_cont text-white rounded py-2 px-3">${act.k_sol}</span>
                                </div>
                                <div class="act_subtitle">Llave solicitada</div>
                        </div>
                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.fecha}</div>
                            <div class="act_subtitle">Fecha de proceso de solicitud</div>
                        </div>
                        <div class="act_data_group">
                            ${act.sol_cond == 1 ? `<div class="act_data fw-semibold text-success">Aceptada</div>` : `<div class="act_data fw-semibold text-danger">Rechazada</div>`}
                            <div class="act_subtitle">Estado de la solicitud</div>
                        </div>
                        
                        <hr class="my-1">
                        <p class="m-0 fw-medium fs-5">Período de uso de la llave</p>
                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.fecha_uso}</div>
                            <div class="act_subtitle">Fecha de uso de la llave</div>
                        </div>
                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.hora_in}</div>
                            <div class="act_subtitle">Hora inicial de uso de llave</div>
                        </div>
                        <div class="act_data_group">
                            <div class="act_data fw-semibold">${act.hora_fin}</div>
                            <div class="act_subtitle">Hora final de uso de llave</div>
                        </div>
                        
                        
                    </div>
                `);
            });
        }
    }
    renderActivities();
});