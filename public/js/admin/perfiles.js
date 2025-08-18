$(document).ready(function () {
  // Inicializamos tooltips de Bootstrap
  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );
  const notyf = new Notyf({
    duration: 3000,
    dismissible: true,
    position: {
      x: "right",
      y: "bottom",
    },
  });
  // Importamos los sonidos de exito y fallo para los distintos procesos que realizemos en la app
  const sonido_exito = new Audio("./public/assets/audio/success.mp3");
  const sonido_fallo = new Audio("./public/assets/audio/fail.mp3");

  //Boton para actualizar la pagina y borrar la cache despues de transacciones
  $("#reload_page_profiles").on("click", function () {
    location.reload(true);
  });

  //Filtros por tipo de usuarios
  const filters_users = document.querySelectorAll(".filter_users_kind");

  filters_users.forEach((filter) => {
    filter.addEventListener("input", function () {
      let profile_tr = document.querySelectorAll(".profile_row");
      let profile_rol = document.querySelectorAll(
        ".profile_row .rol .info_data"
      );

      switch (filter.id) {
        case "see_all_users":
          profile_tr.forEach((row) => {
            row.style.display = ""; // Mostrar todas las filas
          });
          break;

        case "see_profesores":
          profile_tr.forEach((row, index) => {
            if (profile_rol[index].innerHTML.trim() == "Profesor") {
              row.style.display = ""; // Mostrar
            } else {
              row.style.display = "none"; // Ocultar
            }
          });
          break;

        case "see_admins":
          profile_tr.forEach((row, index) => {
            if (profile_rol[index].innerHTML.trim() == "Administrador") {
              row.style.display = ""; // Mostrar
            } else {
              row.style.display = "none"; // Ocultar
            }
          });
          break;

        default:
          break;
      }
    });
  });

  // Busqueda por nombre
  $("#search_names").on("input", function () {
    $("#see_all_users").attr("checked", true);
    let searchValue = this.value.toLowerCase().trim();
    let profile_tr = document.querySelectorAll(".profile_row");
    let profile_names = document.querySelectorAll(
      ".profile_row .prof_search_by_name .info_data"
    );

    profile_tr.forEach((row, index) => {
      let name = profile_names[index].innerText.toLowerCase().trim();

      // Si el nombre incluye el valor del input, muestra la fila
      if (name.includes(searchValue)) {
        row.style.display = ""; // Mostrar fila
      } else {
        row.style.display = "none"; // Ocultar fila
      }
    });
  });

  const $navMob = $("#navigation_mobile");
  const $createUser = $("#create_user");
  const $adminHeader = $("#ds_panel_header");
  const $panelBody = $("#ds_panel_body");

  let lastScrollTop = 0; // Posición de scroll anterior

  $(window).on("scroll", function () {
    const scrollTop = $(this).scrollTop();

    // Parte del nav de abajo
    if (scrollTop > lastScrollTop) {
      $createUser.css("bottom", "40px");
      $navMob.css("bottom", "-72px");
    } else {
      $createUser.css("bottom", "80px");
      $navMob.css("bottom", "0");
    }

    lastScrollTop = Math.max(0, scrollTop); // Evitar números negativos

    // Parte de la barra de búsqueda y el botón de filtros
    if (scrollTop >= 95) {
      $adminHeader.css({ position: "fixed", top: "0" });
      $panelBody.css("marginTop", "80px");
    } else {
      $adminHeader.css({ position: "static", top: "unset" });
      $panelBody.css("marginTop", "0px");
    }
  });

  // Responsive de la búsqueda por nombres
  const $busquedaCont = $("#ds_panel_header");
  const $inputBusqueda = $("#search_names");
  const $closeSearch = $("#close_search");

  $inputBusqueda.on("focusin", function () {
    $busquedaCont.addClass("search_active");
  });

  $inputBusqueda.on("focusout", function () {
    $busquedaCont.removeClass("search_active");
    $inputBusqueda.val("");
  });

  $closeSearch.on("click", function () {
    $busquedaCont.removeClass("search_active");
    $inputBusqueda.val("");
  });

  $(".mhtd:not(.bloque_hora):not(.first_mhtd)").on("click", function () {
    $("#professor_data_modal").css("filter", "brightness(50%)");

    $("#update_bloque_lectivo_modal").on("hidden.bs.modal", function () {
      $("#professor_data_modal").css("filter", "brightness(100%)");
    });
    $("#update_bloque_lectivo_modal").modal("show");
  });

  let sch_mode_diurno = true;

  $("#change_sch_mode").on("click", function () {
    if (sch_mode_diurno) {
      sch_mode_diurno = false;
      $("#sch_mode").text("Horario nocturno");
      $("#show_bloques_diurno").removeClass("text-primary");
      $("#show_bloques_nocturno").addClass("text-primary");
      $(".tr_diurno").hide();
      $(".tr_nocturno").show();
      $("#change_sch_mode")
        .addClass("sch_nocturno")
        .removeClass("sch_diurno  ");
    } else {
      sch_mode_diurno = true;
      $("#sch_mode").text("Horario diurno");
      $("#show_bloques_nocturno").removeClass("text-primary");
      $("#show_bloques_diurno").addClass("text-primary");
      $(".tr_nocturno").hide();
      $(".tr_diurno").show();
      $("#change_sch_mode").addClass("sch_diurno").removeClass("sch_nocturno");
    }
  });

  // Initialize with diurno visible and nocturno hidden
  $(".tr_nocturno").hide();
  $(".tr_diurno").show();

  // CREAR USUARIO
  let create_rol_selected_admin = true;
  $("#create_rol").on("change", function () {
    if (create_rol_selected_admin) {
      create_rol_selected_admin = false;
      $("#create_esp_cont").removeClass("d-none");
      $("#create_esp").val("not_set");
    } else {
      create_rol_selected_admin = true;
      $("#create_esp_cont").addClass("d-none");
      $("#create_esp").val(1);
    }
  });

  // Guardar el valor inicial del src de la imagen para poder reestablecerlo si es necesario
  $("#create_photo_perfil").on("input", function () {
    let prev_img = $("#create_photo_perfil_img").attr("src");

    const file = this.files[0];

    if (file) {
      if (file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (e) {
          $("#create_photo_perfil_img").attr("src", e.target.result);
        };
        reader.readAsDataURL(file);
      } else {
        $("#create_photo_perfil_img").attr("src", prev_img);
        alert("Por favor, ingrese un archivo de imagen.");
      }
    } else {
      $("#create_photo_perfil_img").attr("src", prev_img);
    }
  });

  $("#delete_photo_profile_create").on("click", function () {
    // Reestablecer la imagen al valor inicial
    $("#create_photo_perfil_img").attr(
      "src",
      "./public/assets/images/fotos_perfil/default.webp"
    );
    // Limpiar el input de archivo
    $("#create_photo_perfil").val("");
  });

  $("#create_profile_btn").on("click", function () {
    let cedula = $("#create_ced").val();
    let nombre = $("#create_nombrecom").val();

    let rol = $("#create_rol").val();
    let cr_especialidad = $("#create_esp").val();

    let create_phonect = $("#create_phonect").val();
    let create_correoct = $("#create_correoct").val() || "n/a";

    let correoinst = $("#create_correoinst").val();
    let create_contrainst = $("#create_contrainst").val();

    // Procesar la imagen
    let image = $("#create_photo_perfil").prop("files")[0];

    // Validar los campos obligatorios
    if (
      cedula == "" ||
      nombre == "" ||
      (rol != "1" && cr_especialidad == "not_set") ||
      create_phonect == ""
    ) {
      sonido_fallo.play();
      notyf.error("Por favor, complete todos los campos obligatorios.");
    } else {
      let createuser_formData = new FormData();

      createuser_formData.append("cr_rol", rol);
      createuser_formData.append("cr_cedula", cedula);
      createuser_formData.append("cr_nombre", nombre);
      createuser_formData.append("cr_phone", create_phonect);
      createuser_formData.append("cr_emaict", create_correoct);
      createuser_formData.append("cr_especialidad", cr_especialidad);
      createuser_formData.append("cr_emailins", correoinst);
      createuser_formData.append("cr_password", create_contrainst);
      createuser_formData.append("cr_photo_profile", image);
      createuser_formData.append("action_type", "create_single_user");

      $.ajax({
        url: "admin_perfiles",
        method: "POST",
        data: createuser_formData,
        processData: false, // <- importante
        contentType: false, // <- importante
        success: function (response) {
          if (response == "OK") {
            sonido_exito.play();
            notyf.success("Usuario creado exitosamente.");
            setTimeout(() => {
              location.reload(true);
            }, 1500);
          } else {
            sonido_fallo.play();
            notyf.error("Error al crear el usuario.");
          }
        },
        error: function (error) {
          console.error("Error:", error);
          sonido_fallo.play();
          notyf.error("Error al crear el usuario.");
        },
      });
    }
  });

  let sch_esps = "";
  let sch = "";
  let empty_sch = "";

  function hide_placeholders_profesor_modal() {
    $("#profile_professor_data .placeholder").removeClass("placeholder");
    $("#wait_specialities").css("display", "none");
    $(".specialty").removeClass("d-none").addClass("d-flex");
    $("#schedule_area").removeClass("placeholder");
    $(
      "#btn_change_image_profile, #btn_delete_image_profile, #btn_save_professor_profile_changes, #btn_delete_professor_profile"
    ).attr("disabled", false);
  }

  // RESETEAR LA INFO DE PROFESOR
  $("#professor_data_modal").on("hidden.bs.modal", function (e) {
    $("#profile_professor_data input, #profile_professor_data img").addClass(
      "placeholder"
    );
    $("#wait_specialities").css("display", "inline-block");
    $(".specialty").addClass("d-none").removeClass("d-flex");
    $("#schedule_area").addClass("placeholder");
    $(
      "#btn_change_image_profile, #btn_delete_image_profile, #btn_save_professor_profile_changes, #btn_delete_professor_profile"
    ).attr("disabled", true);
  });

  function callProfesor(idProf, nomEsp) {
    sch_esps = "";
    sch = "";
    state_sch = "";
    $("#ppic").attr("src", "...");

    $.ajax({
      url: "admin_perfiles",
      method: "POST",
      data: {
        action_type: "get_profesor_data",
        ced_profesor: idProf,
        especialidades: especialidades,
        subareas: subareas,
        llaves: llaves,
      },
      dataType: "json",
      success: function (response) {
        $("#sp_ls .specialty").remove();
        $("#ppic").attr("src", response.profesor_data.link_photo);
        $("#cedula").val(response.profesor_data.cedula);
        $("#nombre_completo").val(response.profesor_data.nombre);
        $("#correo_institucional").val(response.profesor_data.correoins);
        $("#numero_telefonico").val(response.profesor_data.phonect);
        response.correoct == ""
          ? $("#correo_personal").val("n/a")
          : $("#correo_personal").val(response.profesor_data.correoct);

        // Refleja las especialidades del profesor
        sch_esps = response.sch_and_esps.especialidades;
        sch = response.sch_and_esps.horario;
        empty_sch = response.empty_sch;

        if (typeof sch_esps != "string") {
          $("#empty_sch_msg").addClass("d-none").removeClass("d-block");
          $("#esp_schs_container").addClass("d-flex").removeClass("d-none");
          $("#schedule_container").addClass("d-flex").removeClass("d-none");
          sch_esps.forEach((especialidad, index) => {
            const esp_button = $(`
              <button id='${especialidad[0]}' data-esp-id='${especialidad[0]}' data-esp-nombre='${especialidad[1]}'
                class="specialty rounded fw-bold btn btn-primary d-flex justify-content-center align-items-center gap-2 fw-semibold">
                <span>${especialidad[1]}</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="icon icon-tabler icons-tabler-outline icon-tabler-dots crud_specialty" type="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                  <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                  <path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                </svg>
                <ul class="dropdown-menu mt-2">
                  <li><span class="dropdown-item text-danger fw-semibold bg-white delete_specialty" data-espnombre='${especialidad[1]}' data-idesp="${especialidad[0]}">Eliminar especialidad</span></li>
                </ul>
              </button>
            `);

            $("#sp_ls").append(esp_button);

            if (nomEsp != undefined) {
              change_sp(nomEsp);
              document.querySelectorAll(".specialty").forEach((element) => {
                if (element.getAttribute("data-esp-nombre") === nomEsp) {
                  element.classList.add("active");
                } else {
                  element.classList.remove("active");
                }
              });
            } else {
              index == 0
                ? (change_sp(especialidad[1]), esp_button.addClass("active"))
                : "";
            }
          });
        } else {
          $("#empty_sch_msg").addClass("d-block").removeClass("d-none");
          $("#esp_schs_container").addClass("d-none").removeClass("d-flex");
          $("#schedule_container").addClass("d-none").removeClass("d-flex");
        }
        hide_placeholders_profesor_modal();
      },
      error: function (error) {
        console.error("Error fetching data:", error);
        alert(
          "Error al obtener los datos del profesor. Por favor, inténtelo de nuevo más tarde."
        );
        state_sch = "ERROR";
      },
    });

    
  }

  // CONSULTAR LOS DATOS DEL PROFESOR
  $(".call_profesor").on("click", function () {
    callProfesor($(this).attr("id"), undefined);
  });

  $("#btn_submit_specialty").on("click", function () {
    $.ajax({
      url: "admin_perfiles",
      method: "POST",
      data: {
        action_type: "add_specialty_to_professor",
        new_sp_id: $("#submit_specialty_select").val(),
        ced_profesor: $("#cedula").val(),
      },
      success: function (response) {
        if (response) {
          sonido_exito.play();
          notyf.success("Especialidad agregada exitosamente.");
          callProfesor(
            $("#cedula").val(),
            $("#submit_specialty_select option:selected").text()
          );
        } else {
          sonido_fallo.play();
          !response
            ? notyf.error("La especialidad ya existe en el perfil.")
            : notyf.error("Error al agregar la especialidad.");
        }
      },
      error: function (error) {
        console.error("Error:", error);
        sonido_fallo.play();
        notyf.error("Error al agregar la especialidad.");
      },
    });
  });

  // // Cambiar especialidad
  function change_sp(nombre_esp) {
    let subarea = "";
    let id_row_sh = "";
    let llave = "";
    let grupo = "Grupo no asignado";
    $("#esp_showed").text(nombre_esp);

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
        const llaveObj = llaves.find(
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

  // ELIMINAR ESPECIALIDAD
  $(document).on("click", ".delete_specialty", function () {
    let esp_id = $(this).data("idesp");
    let esp_nombre = $(this).data("espnombre");
    confirmation = confirm(
      `¿Está seguro de que desea eliminar la especialidad ${esp_nombre}?`
    );
    if (confirmation) {
      $.ajax({
        url: "admin_perfiles",
        method: "POST",
        data: {
          action_type: "delete_specialty_from_professor",
          esp_id: esp_id,
          ced_profesor: $("#cedula").val(),
        },
        success: function (response) {
          if (response == "OK") {
            sonido_exito.play();
            notyf.success("Especialidad eliminada exitosamente");
            callProfesor($("#cedula").val());
          } else {
            sonido_fallo.play();
            notyf.error("Error al eliminar la especialidad");
          }
        },
        error: function (error) {
          console.error("Error:", error);
          sonido_fallo.play();
          notyf.error("Error al eliminar la especialidad.");
        },
      });
    }
  });

  $(document).on("click", ".specialty svg", function (e) {
    e.stopPropagation(); // Evita que se dispare el evento del button
    e.preventDefault();
  });

  // BOTON PARA CAMBIAR ESPECILIDAD DE HORARIO
  $(document).on("click", ".specialty", function (e) {
    e.preventDefault();
    e.stopPropagation();
    $(".specialty").removeClass("active");
    $(this).addClass("active");
    change_sp($(this).data("esp-nombre"));
  });

  $(".mhtd").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    let dia = $(this).attr("data-dia");
    dia == "miercoles"
      ? (dia = "Miércoles")
      : (dia = dia.charAt(0).toUpperCase() + dia.slice(1));

    let hora = $(this).attr("data-hora");
    let idEsp = $(this).attr("id_esp");
    let id_row_sch = $(this).attr("id_row_sch");
    let subarea = $(this).attr("id_sub");
    let llave = $(this).attr("num_llave");
    let grupo = $(this).attr("grupo");
    let nom_esp = $(this).attr("nom_esp");
    $("#hour_block_to_change").text(`${dia} · ${hora}`);

    $(".choose_subarea_option").each(function () {
      if ($(this).data("id-esp") == idEsp || $(this).text() == "Sin asignar") {
        $(this).removeClass("d-none");
      } else {
        $(this).addClass("d-none");
      }
    });

    $("#choose_subarea").val(subarea);
    $("#choose_llave").val(llave);
    grupo == "no asignado"
      ? $("#insert_group").val("")
      : $("#insert_group").val(grupo);

    $("#update_bloque_lectivo").attr("id_row_sch", id_row_sch);
    $("#update_bloque_lectivo").attr("nom_esp", nom_esp);
  });

  // Actualizar bloque lectivo
  $("#update_bloque_lectivo").on("click", function () {
    let grupo = $("#insert_group").val() || "no asignado";
    let id_row_sch = $(this).attr("id_row_sch");
    let nom_esp = $(this).attr("nom_esp");
    $(this).attr("disabled", true).text("Actualizando bloque lectivo...");

    $.ajax({
      url: "admin_perfiles",
      method: "POST",
      data: {
        action_type: "update_bloque_lectivo",
        id_row_sch: id_row_sch,
        new_subarea: $("#choose_subarea").val(),
        new_llave: $("#choose_llave").val(),
        new_grupo: grupo,
      },
      success: function (response) {
        if (response == "OK") {
          sonido_exito.play();
          notyf.success("Bloque lectivo actualizado exitosamente");
          $("#update_bloque_lectivo_modal").modal("hide");
          $("#update_bloque_lectivo")
            .attr("disabled", false)
            .text("Actualizar bloque lectivo");
          callProfesor($("#cedula").val(), nom_esp);
        } else {
          sonido_fallo.play();
          $("#update_bloque_lectivo_modal").modal("hide");
          $("#update_bloque_lectivo")
            .attr("disabled", false)
            .text("Actualizar bloque lectivo");
          notyf.error("Error al actualizar el bloque lectivo");
        }
      },
      error: function (error) {
        console.error("Error:", error);
        $(this).attr("disabled", false).text("Actualizar bloque lectivo");
        sonido_fallo.play();
        notyf.error("Error al actualizar el bloque lectivo.");
      },
    });
  });

  // accionar input foto
  $("#btn_change_image_profile").on("click", function () {
    $("#in_pp_prof").trigger("click");
  });

  $("#in_pp_prof").on("input", function () {
    const file = this.files[0];
    if (file) {
    $('#btn_change_image_profile').attr('disabled', true);
    $('#btn_change_image_profile span').text('Cambiando');
      if (file.type.startsWith("image/")) {
        let updateppData = new FormData();
        updateppData.append("action_type", "update_pp");
        updateppData.append("ced_profesor", $("#cedula").val());
        updateppData.append("pp_image_profile", file);

        $.ajax({
          url: "admin_perfiles",
          method: "POST",
          data: updateppData,
          processData: false,
          contentType: false,
          success: function (response) {
            console.log(response);

            if (response === "OK") {
              const reader = new FileReader();
              reader.onload = function (e) {
                $("#ppic").attr("src", e.target.result);
              };
              reader.readAsDataURL(file);

              sonido_exito.play();
              notyf.success("Imagen actualizada");
              $('#btn_change_image_profile').attr('disabled', false);
              $('#btn_change_image_profile span').text('Cambiar');
            } else {
              sonido_fallo.play();
              notyf.error("Error al actualizar la imagen");
              $('#btn_change_image_profile').attr('disabled', false);
              $('#btn_change_image_profile span').text('Cambiar');
            }
          },
          error: function (error) {
            console.error("Error:", error);
            sonido_fallo.play();
            notyf.error("Error al actualizar la imagen");
            $('#btn_change_image_profile').attr('disabled', false);
            $('#btn_change_image_profile span').text('Cambiar');
          },
        });
      } else {
        alert("El archivo ingresado no es una imagen");
        $('#btn_change_image_profile').attr('disabled', false);
      }
    }
  });

  $("#btn_delete_image_profile").on("click", function () {
    $('#btn_delete_image_profile').attr('disabled', true);
    $.ajax({
        url: 'admin_perfiles',
        type: 'POST',
        data: {
            action_type: 'delete_pp',
            ced_profesor: $('#cedula').val()
        },
        success: function (response){
            console.log(response);
            if(response == "OK"){
                sonido_exito.play();
                $('#btn_delete_image_profile').attr('disabled', false);
                notyf.success("Imagen eliminada");
                $('#ppic').attr('src', './public/assets/images/fotos_perfil/default.webp');
            } else{
                sonido_fallo.play();
                notyf.error("Error al eliminar la imagen"); 
                $('#btn_delete_image_profile').attr('disabled', false);
            }
            
        },
        error: function (error){
            console.log(error);
            sonido_fallo.play();
            notyf.error("Error al eliminar la imagen.");
            $('#btn_delete_image_profile').attr('disabled', false);
        }
    })
  });

  $("#btn_delete_professor_profile").on("click", function () {
    if (confirm("¿Está seguro de continuar con la eliminación del perfil?")) {
      $.ajax({
        url: "admin_perfiles",
        method: "POST",
        data: {
          action_type: "delete_single_user",
          delete_user_rol: "Profesor",
          delete_ced: $("#cedula").val(),
        },
        success: function (response) {
          console.log(response);
          if (response === "OK") {
            sonido_exito.play();
            notyf.success("Perfil eliminado exitosamente");
            const cedulaVal = $("#cedula").val();
            $('.profile_row[data-ced="' + cedulaVal + '"]').remove();
            $(".profile_row").show();
          } else {
            sonido_fallo.play();
            notyf.error("Error al eliminar perfil.");
          }
          $("#professor_data_modal").modal("hide");
        },
        error: function (error) {
          console.error("Error:", error);
          sonido_fallo.play();
          notyf.error("Error al eliminar perfil");
          $("#professor_data_modal").modal("hide");
        },
      });
    }
  });

  $("#btn_save_professor_profile_changes").on("click", function () {
    let contrasena =
      $("#nueva_contrasena").val() == ""
        ? "false"
        : $("#nueva_contrasena").val();
    $.ajax({
      url: "admin_perfiles",
      method: "POST",
      data: {
        action_type: "update_single_user",
        ced: $("#cedula").val(),
        nombre: $("#nombre_completo").val(),
        mail_inst: $("#correo_institucional").val(),
        pass_inst: contrasena,
        numct: $("#numero_telefonico").val(),
        mailct: $("#correo_personal").val(),
      },
      success: function (response) {
        console.log(response);
        if (response === "OK") {
          sonido_exito.play();
          notyf.success("Perfil actualizado exitosamente");
        } else {
          sonido_fallo.play();
          notyf.error("Error al actualizar perfil");
        }
      },
      error: function (error) {
        console.error("Error:", error);
        sonido_fallo.play();
        notyf.error("Error al actualizar perfil");
      },
    });
  });
});
