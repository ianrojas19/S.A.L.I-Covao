$(document).ready(function () {
  //Sonido de exito
  const sonido_exito = new Audio("./public/assets/audio/success.mp3");

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
  });

  //SWITCH ENTRE IMBOXES (SOLICITUDES DE REGISTROS Y SOLICITUDES DE AULA)
  function switchImboxes(numInbox) {
    switch (numInbox) {
      case 1:
        $("#inbox_aulas").addClass("d-none");
        $("#inbox_registro").removeClass("d-none");

        $("#btn_inbox_llaves").removeClass("s_inbox_active");
        $("#btn_inbox_registros").addClass("s_inbox_active");
        break;

      case 2:
        $("#inbox_registro").addClass("d-none");
        $("#inbox_aulas").removeClass("d-none");

        $("#btn_inbox_registros").removeClass("s_inbox_active");
        $("#btn_inbox_llaves").addClass("s_inbox_active");
        break;
    }
  }

  // ASIGNACION DE LA FUNCION A LOS BOTONES DE LOS IMBOXES
  $("#btn_inbox_registros").on("click", function () {
    switchImboxes(1);
  });

  $("#btn_inbox_llaves").on("click", function () {
    switchImboxes(2);
  });

  // PROCESAR SOLICITUDES DE REGISTRO

  //Tomamos los datos de la solicitud

  let rg_ced = "";
  let rg_correo_inst = "";
  let rg_rol = "";
  let photo_rg = "";

  let btn_proc_registro = document.querySelectorAll(".sol_btn_process");

  btn_proc_registro.forEach((button) => {
    button.addEventListener("click", function () {
      rg_ced = button.attributes["data-us_ced"].value;
      rg_correo_inst = button.attributes["data-us_ci"].value;
      rg_rol = button.attributes["data-us_rol"].value;
      photo_rg = button.attributes["data-us_lphoto"].value;

      //Tomamos los valores del perfil
      $("#rg_user_ced .rg_info_val").html(
        button.attributes["data-us_ced"].value
      );
      $("#rg_user_nom .rg_info_val").html(
        button.attributes["data-us_nom"].value
      );
      $("#rg_user_ci .rg_info_val").html(button.attributes["data-us_ci"].value);
      $("#rg_user_rol .rg_info_val").html(
        button.attributes["data-us_rol"].value
      );

      //Si es un administrador no se muestra la especialdad
      if (button.attributes["data-us_rol"].value == "Administrador") {
        $("#rg_user_esp").removeClass("d-flex").addClass("d-none");
      } else {
        $("#rg_user_esp .rg_info_val").html(
          button.attributes["data-us_esp"].value
        );
        $("#rg_user_esp").addClass("d-flex").removeClass("d-none");
      }

      $("#rg_user_telct .rg_info_val").html(
        button.attributes["data-us_tlc"].value
      );
      $("#rg_user_mailct .rg_info_val").html(
        button.attributes["data-us_mlc"].value
      );
      $("#rg_user_photo").attr(
        "src",
        button.attributes["data-us_lphoto"].value
      );
    });
  });

  $("#confirm_deny_check").on("change", function () {
    $("#confirm_deny_check").prop("checked")
      ? $("#deny_rg_sl").attr("disabled", false)
      : $("#deny_rg_sl").attr("disabled", true);
  });

  $("#deny_feedback_check").on("change", function () {
    $("#deny_feedback_check").prop("checked")
      ? $("#deny_feedback").attr("disabled", false)
      : $("#deny_feedback").attr("disabled", true);
  });

  //ELIMINAR SOLICITUD DE REGISTRO
  $("#deny_rg_sl").on("click", function () {
    $("#deny_rg_sl").attr("disabled", true);
    $("#sc_reg_aprobar").attr("disabled", true);
    $("#deny_rg_sl").html("Procesando...");

    let razon_rechazo =
      $("#deny_feedback").val() === "" ? false : $("#deny_feedback").val();

    $.ajax({
      url: "admin_solicitudes",
      type: "POST",
      data: {
        action_type: "deny_rg",
        ced_rechazo: rg_ced,
        correo_ins: rg_correo_inst,
        razon_rechazo: razon_rechazo,
        rol: rg_rol,
        photo_rg: photo_rg,
      },
      success: function (response) {
        sonido_exito.play();

        if (response == "success") {
          $("#md_proc_registro").modal("hide");
          $("#md_rechazar_registro").modal("hide");
          $("#md_info_proceso").modal("show");
          $("#info_proc_text").html(
            "El rechazo de la solicitud de registro ha sido existoso."
          );
        }
      },
      error: function (error) {},
    });
  });

  $("#sc_reg_aprobar").on("click", function () {
    $("#sc_reg_rechazar").attr("disabled", true);
    $("#sc_reg_aprobar").attr("disabled", true);
    $("#sc_reg_aprobar").html("Procesando...");

    $.ajax({
      url: "admin_solicitudes",
      type: "POST",
      data: {
        action_type: "accept_rg",
        correo_ins: rg_correo_inst,
        ced_aprobado: rg_ced,
      },
      success: function (response) {
        sonido_exito.play();
        $("#md_proc_registro").modal("hide");
        $("#md_info_proceso").modal("show");
        if (response == "success") {
          if (rg_rol == "Administrador") {
            $("#info_proc_text").html(
              "La solicitud de registro fue aprobada con éxito."
            );
          } else {
            $("#info_proc_text").html(
              `La solicitud de registro fue aprobada con éxito. <br><br>Para asignar los datos relacionados al horario de este usuario, debe ir a la sección de <b>Perfiles</b>, seleccionar el perfil e ingresar al apartado de <b>Horario</b>.`
            );
          }
        } else {
          $("#info_proc_text").html(
            "La solicitud de registro no se pudo realizar."
          );
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  });

  // Seleccionamos el botón "Aceptar" o "Rechazar"
  $(".accept_sol, .deny_sol").click(function () {
    // Desabilitar botones de accion
    $(".accept_sol, .deny_sol").prop("disabled", true);
    $(this).html("Procesando...");

    // Recopilamos los datos del padre ".sol_details" usando 'closest' para obtener el contenedor más cercano
    const solDetails = $(this).parent().children()[0];

    const requestData = {
      idSolicitud: solDetails.getAttribute("data-id-solicitud"),
      cedulaUsuario: solDetails.getAttribute("data-ced-prof"),
      fechaEmision: solDetails.getAttribute("data-date-in"),
      horaEmision: solDetails.getAttribute("data-time-in"),
      numeroLlave: solDetails.getAttribute("data-key"),
      fechaUtilizacion: solDetails.getAttribute("data-date-use"),
      horaInicio: solDetails.getAttribute("data-time-init"),
      horaFinal: solDetails.getAttribute("data-time-finish"),
      razonUso: solDetails.getAttribute("data-justify"),
      accion: $(this).hasClass("accept_sol") ? "aceptar" : "rechazar", // Identificamos si es aceptar o rechazar
    };

    // Enviamos los datos por AJAX
    $.ajax({
      url: "admin_solicitudes", // Archivo PHP que procesará la solicitud
      type: "POST",
      data: {
        action_type: "process_key_req",
        requestData: requestData,
      },
      success: function (response) {
        // Procesamos la respuesta del servidor
        $("#md_info_proceso").modal("show");
        sonido_exito.play();
        response
          ? requestData["accion"] == "aceptar"
            ? $("#info_proc_text").html(
                "La solicitud se ha aprobado con éxito, en caso de ser necesario, recuerde al usuario que, el estado de esta solicitud se encuentra en el apartado de Mi Actividad."
              )
            : $("#info_proc_text").html(
                "La solicitud se ha rechazado con éxito, en caso de ser necesario, recuerde al usuario que, el estado de esta solicitud se encuentra en el apartado de Mi Actividad."
              )
          : $("#info_proc_text").html(
              "Hubo un error en el proceso, inténtelo más tarde."
            );
      },
      error: function (xhr, status, error) {
        // Manejo de errores
        console.error("Error en la solicitud AJAX:", error);
        alert("Hubo un problema al procesar la solicitud.");
        window.location.href = "admin_solicitudes";
      },
    });
  });
});
