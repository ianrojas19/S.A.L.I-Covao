$(document).ready(function () {
    $('#app_year').html(new Date().getFullYear());
    $('#module_title').html('Retiro de Llaves');
    const sonido_exito = new Audio("./public/assets/audio/success.mp3");
    
    
    const today = new Date();
    let dayNumber = today.getDay();
    dayNumber = dayNumber === 0 ? 7 : dayNumber;
    
    
    $.ajax({
      url: "profesor_retiro",
      method: "POST",
      data: {
        action_type: "get_profesor_sch_keys",
        dayNumber: dayNumber
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        
        $('#main_content_loader').remove();

        
        if(response == 'no_keys' || response == 'finde'){
            
            $('#main_content').html('<p class="text-center mt-4">Sin llaves por retirar</p>').removeClass('d-none');
        } else{
            $('#ret_keys_container').removeClass('d-none');
            let cant_keys = response.length;
            let cant_taken_keys = 0;
        
            response.forEach((key) => {
            let keynum = key.numeroLlave;
           
            aulas.forEach(aula =>{
               if(aula.numeroLlave == keynum){
                   aula.isTaken == 1 ? cant_taken_keys++ : '';
                   const key_component = `
                   <div class="p-2">
                        <div class="col card shadow-sm border-light-subtle">
                            <div class="card-body py-4 d-flex flex-row flex-md-column align-items-center justify-content-center gap-3">
                
                
                                <div class="key_logo text-white ${aula.isTaken == 0 ? 'bg-primary' : 'bg-secondary'} rounded-circle d-flex justify-content-center align-items-center"
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
                
                                <div class="d-flex flex-column justify-content-center align-items-md-center mx-1 ">
                                    <h5 class="card-title fw-bold mb-0" style="color: #143e63;">Llave N°${aula.numeroLlave}</h5>
                                    <p class="card-text text-md-center"> ${aula.nombreAula}</p>
                                </div>
                            </div>
                
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <input type="checkbox" class="btn-check select_key" id="${aula.numeroLlave}" autocomplete="off" ${aula.isTaken == 0 ? '' : 'disabled'}>
                                    <label id="${aula.numeroLlave}_check_text" class="btn 
                                    ${aula.isTaken == 0 ? 'btn-outline-primary' : 'btn-secondary'}
                                      w-100 fw-semibold" for="${aula.numeroLlave}">
                                    ${aula.isTaken == 0 ? 'Seleccionar llave' : "Llave ocupada"}
                                    </label><br>
                                </li>
                            </ul>
                
                        </div>
                    </div>
                   `
                   
                   $('#keys_list').append(key_component);
                   return;
               } 
            });
            
            
        });
            $('#verify_ret_cont, #ok_keys').removeClass('d-none');
            cant_keys == cant_taken_keys ? $('#verify_ret_cont_btn').addClass('btn-secondary').html('<span class="fw-semibold">Todas las llaves están ocupadas</span>').attr('disabled', true) : '';
        }
      },
      error: function (error) {
          console.log(error);
          alert('Hubo un error al cargar, intentelo mas tarde');
        //   location.href('index');
      }
    });

    
    
    // Inicializar localStorage
    localStorage.setItem('selected_keys', JSON.stringify([]));
    
    // Leer desde localStorage
    let selected_keys = JSON.parse(localStorage.getItem('selected_keys')) || [];
    let amount_slk = selected_keys.length;
    
    // Evento al hacer clic en un checkbox
    $(document).on("click", ".select_key", function() {
        const key = $(this);
        const key_id = key.attr('id');
    
        if (key.prop('checked')) {
            // Si se selecciona, agregar al array si no está
            if (!selected_keys.includes(key_id)) {
                selected_keys.push(key_id);
                amount_slk++;
            }
            $(`#${key_id}_check_text`).text('Llave seleccionada');
        } else {
            // Si se desmarca, remover del array
            selected_keys = selected_keys.filter(id => id !== key_id);
            amount_slk = Math.max(0, amount_slk - 1);
            $(`#${key_id}_check_text`).text('Seleccionar llave');
        }
    
        // Guardar array actualizado
        localStorage.setItem('selected_keys', JSON.stringify(selected_keys));
    });
    
         const correct_svg = '<svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>';
         const wrong_svg = '<svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>';
         const wait_c = `<div class="spinner-border text-secondary border-2" role="status">
             <span class="visually-hidden">Loading...</span>`; 
        
        function generateRndCode() {
            return `${Math.floor(Math.random() * 10)}${Math.floor(Math.random() * 10)}`;
        }
        
        function getretcode(){
             $('#no_keys_msg').addClass('d-none');
              $('#codes_for_retire').removeClass('d-none');
                    $('#select_tabl_text').removeClass('d-none');
                    $('.ch_code').html(wait_c);
                    
                    $.ajax({
                          url: "profesor_retiro",
                          method: "POST",
                          data: {
                            action_type: "getretcode",
                          },
                          dataType: "json",
                          success: function (response) {
                            let randomNum = Math.floor(Math.random() * 4) + 1;
                            
                             for (let i = 1; i < 5; i++) {
                                let code_generated = generateRndCode();
                                $(`#code_${i}`).html(code_generated).attr('data-cod', code_generated).removeClass('bg-success bg-danger text-white');
                                $('#fails_max').addClass('d-none');
                                fails = 0;
                             }
                             
                             $(`#code_${randomNum}`).html(response.retiro_llave_access_code_mfa).attr('data-cod', response.retiro_llave_access_code_mfa);
                           },
                          error: function (error) {
                              console.log(error);
                              alert('Error al generar codigos, intentelo mas tarde.')
                              location.href = 'index';
                          }
                    });      
        }
        
        $(document).on("click", "#verify_ret_cont_btn", function() {
                if(amount_slk == 0){
                    $('#no_keys_msg').removeClass('d-none');
                    $('#select_tabl_text').addClass('d-none');
                    $('#codes_for_retire').addClass('d-none');
                } else{
                   getretcode();
                }
         });
         
             
    
        $(document).on('click', "#renew_codes", function(){
            getretcode();
        });
         
       
        
        let fails = 0;
    
        $(document).on("click", ".ch_code", function() {
            const $btn = $(this); // guardar referencia del botón clickeado
            $btn.html(wait_c);    // mostrar mensaje "cargando" o similar
        
            $.ajax({
                url: "profesor_retiro",
                method: "POST",
                data: {
                    action_type: "getretcode",
                },
                dataType: "json",
                success: function (response) {
                    const userCode = $btn.attr('data-cod');
                    const serverCode = response.retiro_llave_access_code_mfa;
        
                    if (userCode == serverCode) {
                        $btn.addClass('bg-success text-white').html(correct_svg);
                        
                        $('#back_rkeys').attr('disabled', true).html('Procesando retiro');
                        
                        $.ajax({
                            url: "profesor_retiro",
                            method: "POST",
                            data: {
                                action_type: "process_retiro",
                                key1: selected_keys[0],
                                key2: selected_keys[1],
                                key3: selected_keys[2],
                                key4: selected_keys[3],
                                key5: selected_keys[4],
                                key6: selected_keys[5],
                                key7: selected_keys[6],
                                key8: selected_keys[7],
                                key9: selected_keys[8],
                            },
                            success: function (response) {
                                console.log(response);
                                $('#verify_code_modal').modal('hide');
                                $('#process_retiro_modal').modal('show');
                                if(response == 'OK'){
                                    sonido_exito.play();
                                    $('#process_retiro_msg').text('El retiro de llaves se realizo correctamente, proceda a tomar las llaves seleccionadas');
                                } else{
                                    $('#process_retiro_msg').text('El retiro de llaves falló, intentelo más tarde o comuniquelo en la Oficina de Coordinación');
                                }
                            },
                            error: function(error){
                                console.log(error);
                                $('#verify_code_modal').modal('hide');
                                $('#process_retiro_modal').modal('show');
                                $('#process_retiro_msg').text('El retiro de llaves falló, intentelo más tarde o comuniquelo en la Oficina de Coordinación');
                            }
                        });
                    } else {
                        $btn.addClass('bg-danger text-white').html(wrong_svg);
                        fails++;
                        if(fails >= 2){
                            $('#select_tabl_text, #codes_for_retire').addClass('d-none')
                            $('#fails_max').removeClass('d-none');
                            fails = 0;
                        }
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert('Ha ocurrido un error, intentelo mas tarde.');
                    location.href = 'index';
                }
            });
        });

});