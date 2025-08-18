$(document).ready(function () {
    $("#app_year").html(new Date().getFullYear()),
    $("#module_title").html("Mi Horario");
    
    
    function callProfesor(nomEsp) {
    sch_esps = "";
    sch = "";
    state_sch = "";

    $.ajax({
      url: "profesor_horario",
      method: "POST",
      data: {
        action_type: "get_profesor_data",
        ced_profesor: ced_profesor,
        especialidades: especialidades,
        subareas: subareas,
        llaves: aulas,
      },
      dataType: "json",
      success: function (response) {
          $('#wait_sch').remove();
          $('#main_content').removeClass('d-none');

        // Refleja las especialidades del profesor
        sch_esps = response.sch_and_esps.especialidades;
        sch = response.sch_and_esps.horario;
        empty_sch = response.empty_sch;
        console.log(sch_esps)
        console.log(sch)
        console.log(empty_sch)

        if (typeof sch_esps != "string") {
          $("#empty_sch_msg").addClass("d-none").removeClass("d-block");
          $("#esp_schs_container").addClass("d-flex").removeClass("d-none");
          $("#schedule_container").addClass("d-flex").removeClass("d-none");
          sch_esps.forEach((especialidad, index) => {
            if(index==0){
                const esp_button = $(`
              <div><input type="radio" name="options-base" class="btn-check change_sp_btn" id='${especialidad[0]}' data-esp-id='${especialidad[0]}' data-esp-nombre='${especialidad[1]}' autocomplete="off" checked>
              <label class="btn btn-outline-primary fw-semibold" for="${especialidad[0]}">${especialidad[1]}</label><br></div>
            `);
            $("#sp_list").append(esp_button);
            change_sp(especialidad[1]);
            $('#shown_sp').text(`${especialidad[1]}`);
            } else{
                const esp_button = $(`
              <div><input type="radio" name="options-base" class="btn-check change_sp_btn" id='${especialidad[0]}' data-esp-id='${especialidad[0]}' data-esp-nombre='${especialidad[1]}' autocomplete="off">
              <label class="btn btn-outline-primary fw-semibold" for="${especialidad[0]}">${especialidad[1]}</label><br></div>
            `);
            $("#sp_list").append(esp_button);
            }

            // if (nomEsp != undefined) {
            //   change_sp(nomEsp);
            // } else {
            //     change_sp(especialidad[1]),
            //     $('#shown_sp').text(`${especialidad[1]}`);
            // }
          });
        } else {
            $('main').html('<p class="text-center mt-5 fs-4">No hay horarios asignados</p>')
        }

      },
      error: function (error) {
          $('#wait_sch').remove();
        console.error("Error fetching data:", error);
        alert(
          "Error al obtener los datos del profesor. Por favor, inténtelo de nuevo más tarde."
        );
      },
    });
  }
    function change_sp(nombre_esp) {
    let subarea = "";
    let id_row_sh = "";
    let llave = "";
    let grupo = "Grupo no asignado";
    $("#shown_sp").text(nombre_esp);

    // Incrustar los bloques lectivos y su info
    let esp_sch = sch[nombre_esp];
    let days = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];

    days.forEach((day) => {
      esp_sch[`${day}`].forEach((bloque, index) => {
        // subarea
        let subarea = subareas.find(
          (subareaObj) => subareaObj["idSubarea"] == bloque.subarea
        )?.nombreSubarea;
        let llave = "-";
        const llaveObj = aulas.find(
          (item) => item["numeroLlave"] == bloque.llave
        );
        if (llaveObj && llaveObj["numeroLlave"] != 999) {
          llave = `Llave ${llaveObj["numeroLlave"]} · ${llaveObj["nombreAula"]}`;
        }

        grupo = bloque.grupo;

        $(`#${day.toLowerCase()}-${index + 1}`).attr(
          "id_row_sch",
          bloque.id_row_sh
        );
        $(`#${day.toLowerCase()}-${index + 1}`).attr("id_esp", bloque.idEsp);
        $(`#${day.toLowerCase()}-${index + 1}`).attr("nom_esp", nombre_esp);
        $(`#${day.toLowerCase()}-${index + 1}`).attr("num_llave", bloque.llave);
        $(`#${day.toLowerCase()}-${index + 1}`).attr("id_sub", bloque.subarea);
        $(`#${day.toLowerCase()}-${index + 1}`).attr("grupo", grupo);
        $(`#${day.toLowerCase()}-${index + 1} .subarea`).text(subarea);
        $(`#${day.toLowerCase()}-${index + 1} .llave`).text(llave);
        $(`#${day.toLowerCase()}-${index + 1} .grupo`).text("Grupo " + grupo);

        subarea == "Sin asignar"
          ? $(`#${day.toLowerCase()}-${index + 1}`).addClass("mhtd_empty")
          : $(`#${day.toLowerCase()}-${index + 1}`).removeClass("mhtd_empty");
      });
    });
  }
  
  // BOTON PARA CAMBIAR ESPECILIDAD DE HORARIO
  $(document).on("change", ".change_sp_btn", function (e) {
    change_sp($(this).data("esp-nombre"));
  });

    callProfesor();
    
    let sch_mode = 'diurno';
    
    function show_sch_rows(kind){
        if(kind == 'diurno'){
          $('.tr_nocturno').addClass('d-none');
          $('.tr_diurno').removeClass('d-none');
        } else{
            $('.tr_diurno').addClass('d-none');
            $('.tr_nocturno').removeClass('d-none');
        }
    }
    
    let last_sch_kind = localStorage.getItem("last_sch_king");
    
    if(last_sch_kind != null){
        show_sch_rows(last_sch_kind);
    } else{
       show_sch_rows('diurno');
    }
   
    $('#switch_sch_mode').on('click', function(){
        if(sch_mode == 'diurno'){
            $('#switch_sch_mode').addClass('btn_nocturno').removeClass('btn_diurno');
            $('#sch_mode').text('Horario nocturno');
            sch_mode = 'nocturno';
            show_sch_rows('nocturno');
        } else{
            $('#switch_sch_mode').removeClass('btn_nocturno').addClass('btn_diurno');
            $('#sch_mode').text('Horario diurno');
            sch_mode = 'diurno';
            show_sch_rows('diurno');
        }
    });
});
