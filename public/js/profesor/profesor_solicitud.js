$(document).ready(function () {
  keys.forEach((key) => {
    if (key.numeroLlave !== 999) {
      let newOption = document.createElement("option");
      newOption.value = key.numeroLlave;
      newOption.innerHTML = `N°${key.numeroLlave} - ${key.nombreAula}`;
      $("#aula").append(newOption);
    }
  });

  // Deshabilita el botón al cargar la página
  $("#btn_request_key").prop("disabled", true);

  // Función para validar la fecha de uso
  function validarFecha() {
      $("#fecha_uso").removeClass("is-invalid").addClass("is-valid");
      return true;
  }

  // Función para validar la llave seleccionada
  function validarAula() {
    let aulaSeleccionada = $("#aula").val();
    console.log(aulaSeleccionada);
    if (aulaSeleccionada == "empty") {
      $("#aula").addClass("is-invalid");
      return false;
    } else {
      $("#aula").removeClass("is-invalid").addClass("is-valid");
      return true;
    }
  }

  // Función para validar la hora de inicio y la hora final
  function validarHoras() {
    let horaInicio = $("#hora_inicio").val();
    let horaFinal = $("#hora_final").val();

    if (horaInicio === "" || horaFinal === "" || horaInicio >= horaFinal) {
      $("#hora_inicio").addClass("is-invalid");
      $("#hora_final").addClass("is-invalid");
      return false;
    } else {
      $("#hora_inicio").removeClass("is-invalid").addClass("is-valid");
      $("#hora_final").removeClass("is-invalid").addClass("is-valid");
      return true;
    }
  }

  // Función para validar la justificación
  function validarJustificacion() {
    let justificacion = $("#justificacion").val().trim();

    if (justificacion === "") {
      $("#justificacion").addClass("is-invalid");
      return false;
    } else {
      $("#justificacion").removeClass("is-invalid").addClass("is-valid");
      return true;
    }
  }

  // Función para habilitar o deshabilitar el botón de enviar
  function habilitarBoton() {
    if (
      validarFecha() &&
      validarAula() &&
      validarHoras() &&
      validarJustificacion()
    ) {
      $("#btn_request_key").prop("disabled", false);
    } else {
      $("#btn_request_key").prop("disabled", true);
    }
  }

  // Eventos de validación para cada campo
  $("#fecha_uso").on("change", validarFecha);
  $("#aula").on("change", validarAula);
  $("#hora_inicio, #hora_final").on("change", validarHoras);
  $("#justificacion").on("input", validarJustificacion);

  // Evento general para verificar todo el formulario cada vez que haya un cambio en los campos
  $("#fecha_uso, #aula, #hora_inicio, #hora_final, #justificacion").on(
    "input change",
    habilitarBoton
  );

  $("#btn_request_key").on("click", () => {
    $("#btn_request_key").prop("disabled", true);
    $("#btn_request_key").html("Procesando...");

    $.ajax({
      url: "profesor_solicitud",
      type: "POST",
      data: {
        action_type: "request_key",
        n_llave: $("#aula").val(),
        fechaSeleccionada: $("#fecha_uso").val(),
        horaInicio: $("#hora_inicio").val(),
        horaFinal: $("#hora_final").val(),
        justificacion: $("#justificacion").val(),
      },
      success: function (response) {
        $("#reqkey_info").modal("show");
        if (response) {
          $("#reqkey_info_text").html(
            `La solicitud ha sido enviada con éxito, recuerde revisar el estado de su solicitud en el apartado de <b>"Mi actividad"</b>.`
          );
        } else {
          $("#reqkey_info_text").html(
            `La solicitud no pudo ser enviada, inténtelo más tarde`
          );
        }
      },
      error: function (error) {
        console.log(error);
        $("#reqkey_info").modal("show");
        $("#reqkey_info_text").html(
          `La solicitud no pudo ser enviada, inténtelo más tarde`
        );
      },
    });
  });
});
