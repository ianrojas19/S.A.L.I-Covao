$(document).ready(function () {

    let profesores;

    $.ajax({
        url: 'admin_llaves',
        type: 'POST',
        data: { action_type: 'search_profesores' },
        dataType: 'json',
        success: function (response) {
            profesores = response;
        },
        error: function (error) {
            alert('No hay usuarios, redirigiendo a modulo de perfiles para crear al menos un profesor')
            window.location.href = 'admin_perfiles';
        }
    });

    const keyContainer = document.querySelectorAll('.col'); // Contenedor de llaves
    const searchInput = document.getElementById('search_names');
    const filterRadios = document.querySelectorAll('input[name="filters_actividad"]');

    function filterKeys() {
        const searchTerm = searchInput.value.toLowerCase();
        let showAvailable = false;
        let showOccupied = false;

        // Determinar qué radio está seleccionado
        filterRadios.forEach(radio => {
            if (radio.checked) {
                if (radio.id === 'see_key_retiros') {
                    showAvailable = true;
                } else if (radio.id === 'see_key_devoluciones') {
                    showOccupied = true;
                }
            }
        });

        keyContainer.forEach(key => {
            const keyNumber = key.dataset.kn.toLowerCase();
            const keyRoom = key.dataset.kan.toLowerCase(); // Obtener el nombre del aula
            const keyState = key.dataset.kst; // 0 = disponible, 1 = ocupado
            const matchesSearch = keyNumber.includes(searchTerm) || keyRoom.includes(searchTerm); // Filtrar por número de llave o nombre del aula

            // Determinar si se debe mostrar la llave
            let shouldDisplay = false;

            if (showAvailable && keyState === '0' && matchesSearch) {
                shouldDisplay = true; // Mostrar llave disponible que coincide con la búsqueda
            } else if (showOccupied && keyState === '1' && matchesSearch) {
                shouldDisplay = true; // Mostrar llave ocupada que coincide con la búsqueda
            } else if (!showAvailable && !showOccupied && matchesSearch) {
                shouldDisplay = true; // Mostrar llave si coincide con la búsqueda
            }

            key.style.display = shouldDisplay ? 'block' : 'none'; // Mostrar u ocultar llave
        });
    }

    // Agregar event listeners
    searchInput.addEventListener('input', filterKeys); // Filtro por búsqueda
    filterRadios.forEach(radio => {
        radio.addEventListener('change', filterKeys); // Filtro por tipo
    });


    //Sonido de exito
    const sonido_exito = new Audio('./public/assets/audio/success.mp3');
    const nav_mob = document.getElementById("navigation_mobile");

    let lastScrollTop = 0; // Posición de scroll anterior

    window.addEventListener("scroll", function () {
        // Parte del nav de abajo
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            nav_mob.style.bottom = "-72px";
        } else {
            nav_mob.style.bottom = "0";
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Para evitar números negativos

        //Parte de la barra de busqueda y el boton de filtros
        const adminHeader = document.getElementById("ds_panel_header");
        const panelBody = document.getElementById("ds_panel_body");

        if (window.scrollY >= 95) {
            adminHeader.style.position = "fixed";
            adminHeader.style.top = "0";
            panelBody.style.marginTop = "80px";
        } else {
            adminHeader.style.position = "static";
            adminHeader.style.top = "unset";
            panelBody.style.marginTop = "0px";
        }
    });


    // Cambiar estado de llave
    $('.btn_change_key_state').each(function () {
        const key = this.closest('.col');
        const type_of_change = this.getAttribute('data-free-key');
        const key_portador = key.getAttribute('data-knp');
        const key_state = key.getAttribute('data-kst');
        const reason_key = key.getAttribute('data-kru');
        const act_reason_key = key.querySelector('.key_use_reason');
        const btn_act_key = key.querySelector('.act_key_info');
        const nom_portador_key = key.querySelector('.key_portador')

        this.addEventListener('change', function () {
            //Si hay algun cambio
            if (type_of_change != key_state) {
                btn_act_key.disabled = false;
            }
            // Si cambia de disponibilidad
            if (type_of_change == '1') {
                nom_portador_key.removeAttribute('readonly')
                act_reason_key.removeAttribute('readonly');
                act_reason_key.value = reason_key != '' && act_reason_key.value != 'Sin razón' ? reason_key : '';
                nom_portador_key.value = '';
            } else if (type_of_change == '0') {
                nom_portador_key.setAttribute('readonly', true);
                act_reason_key.setAttribute('readonly', true);
                act_reason_key.value = 'Sin razón';
                nom_portador_key.value = 'Sin portador/a';
            }
            // Si ya estaba disponibilidad
            if (type_of_change == '0' && key_state == type_of_change) {
                btn_act_key.disabled = true;
            }
        });
    });


    $('.key_use_reason').each(function () {
        const key = this.closest('.col');
        const btn_act = $(key).find('.act_key_info'); // Convertir btn_act a jQuery
        this.addEventListener('input', () => {
            btn_act.attr('disabled', false);  // Ahora btn_act es un objeto jQuery
        });
    });

    $('.key_portador').each(function () {
        const key = this.closest('.col');
        const btn_act = $(key).find('.act_key_info'); // Convertir btn_act a jQuery
        this.addEventListener('input', () => {
            btn_act.attr('disabled', false);  // Ahora btn_act es un objeto jQuery
        });
    });




    $('.act_key_info').each(function () {
        const key = this.closest('.col');
        const act_key_number = key.getAttribute('data-kn');
        const key_new_portador = key.querySelector('.key_portador');
        const key_new_reason = key.querySelector('.key_use_reason');

        let can_be_updated = false;

        this.addEventListener('click', async function () {

            this.disabled = true;
            this.innerHTML = 'Procesando...';

            // Obtén el estado del radio seleccionado
            const key_new_state = key.querySelector('input[name="btn_state_group_' + act_key_number + '"]:checked').getAttribute('data-free-key');

            let professor_found = false;
            let professor_ced = '';

            profesores.forEach(profesor => {
                if (profesor[1] == key_new_portador.value) {
                    professor_found = true;
                    professor_ced = profesor[0];
                }
            });

            if (key_new_reason.value != '' && key_new_portador.value != '' && (professor_found || (key_new_portador.value == 'Sin portador/a' && key_new_state == 0))) {
                // Consultamos disponibilidad de actualizar la llave
                if (!professor_found && key_new_portador.value == 'Sin portador/a') {
                    professor_ced = null;
                }

                try {
                    let response = await $.ajax({
                        url: 'admin_llaves',
                        type: 'POST',
                        data: { action_type: 'consult_update_pos', key_to_update: act_key_number }
                    });

                    // Si se puede actualizar la info de la llave
                        try {
                            let updateResponse = await $.ajax({
                                url: 'admin_llaves',
                                type: 'POST',
                                data: {
                                    action_type: 'update_key',
                                    key_to_update: act_key_number,
                                    act_portador: professor_ced,
                                    act_reason: key_new_reason.value,
                                    act_key_state: key_new_state // Ahora obtiene el estado seleccionado
                                }
                            });

                            if (updateResponse == 'SUCCESS') {
                                sonido_exito.play();
                                $('#info_process_text').html('La actualización ha sido exitosa');
                                $('#modal_info_proceso').modal('show');
                            } else {
                                console.log('No pudimos procesar la actualización, inténtelo más tarde.');
                                window.location.href = 'admin_llaves';
                            }
                        } catch (error) {
                            alert('No pudimos procesar la actualización, inténtelo más tarde.');
                            window.location.href = 'admin_llaves';
                        }
                    } 

                } catch (error) {
                    alert('No pudimos procesar la consulta, inténtelo más tarde.');
                    window.location.href = 'admin_llaves';
                }

            } else {

                if (!professor_found) {
                    alert('Ingrese un nombre de portador válido');
                } else {
                    alert('Ingrese la información necesaria para la actualización de la llave, ya sea el nombre del portador o la razón de uso.');
                }
                this.innerHTML = 'Actualizar llave';
                this.disabled = false;
            }
        });
    });



});