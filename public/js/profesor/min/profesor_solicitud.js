$(document).ready(function () {
    console.log('new')
    const sonido_exito = new Audio("./public/assets/audio/success.mp3");
  function a() {
    $("#fecha_uso").removeClass("is-invalid").addClass("is-valid");
      return true;
  }
  function i() {
    let a = $("#aula").val();
    return (
      console.log(a),
      "empty" == a
        ? ($("#aula").addClass("is-invalid"), !1)
        : ($("#aula").removeClass("is-invalid").addClass("is-valid"), !0)
    );
  }
  function e() {
    let a = $("#hora_inicio").val(),
      i = $("#hora_final").val();
    return "" === a || "" === i || a >= i
      ? ($("#hora_inicio").addClass("is-invalid"),
        $("#hora_final").addClass("is-invalid"),
        !1)
      : ($("#hora_inicio").removeClass("is-invalid").addClass("is-valid"),
        $("#hora_final").removeClass("is-invalid").addClass("is-valid"),
        !0);
  }
  function o() {
    return "" === $("#justificacion").val().trim()
      ? ($("#justificacion").addClass("is-invalid"), !1)
      : ($("#justificacion").removeClass("is-invalid").addClass("is-valid"),
        !0);
  }
  keys.forEach((a) => {
    if (999 !== a.numeroLlave) {
      let i = document.createElement("option");
      (i.value = a.numeroLlave),
        (i.innerHTML = `N°${a.numeroLlave} - ${a.nombreAula}`),
        $("#aula").append(i);
    }
  }),
    $("#btn_request_key").prop("disabled", !0),
    $("#fecha_uso").on("change", a),
    $("#aula").on("change", i),
    $("#hora_inicio, #hora_final").on("change", e),
    $("#justificacion").on("input", o),
    $("#fecha_uso, #aula, #hora_inicio, #hora_final, #justificacion").on(
      "input change",
      function () {
        a() && i() && e() && o()
          ? $("#btn_request_key").prop("disabled", !1)
          : $("#btn_request_key").prop("disabled", !0);
      }
    ),
    $("#btn_request_key").on("click", () => {
      $("#btn_request_key").prop("disabled", !0),
        $("#btn_request_key").html("Procesando..."),
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
          success: function (a) {
            sonido_exito.play();
            $("#reqkey_info").modal("show"),
              a
                ? $("#reqkey_info_text").html(
                    'La solicitud ha sido enviada con éxito, recuerde revisar el estado de su solicitud en el apartado de <b>"Mi actividad"</b>.'
                  )
                : $("#reqkey_info_text").html(
                    "La solicitud no pudo ser enviada, inténtelo más tarde"
                  );
          },
          error: function (a) {
            console.log(a),
              $("#reqkey_info").modal("show"),
              $("#reqkey_info_text").html(
                "La solicitud no pudo ser enviada, inténtelo más tarde"
              );
          },
        });
    });
});
