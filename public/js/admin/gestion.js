$(document).ready(function () {
  //Sonido de exito
  const sonido_exito = new Audio("./public/assets/audio/success.mp3");

  function showGes_llaves() {
    $("#ges_sec_llaves").addClass("active");
    $("#ges_sec_esps").removeClass("active");

    $("#list-group-title").text("Lista de llaves existentes");
    $("#esp_sub_list").hide();
    $("#key_list").css("display", "flex");
    $("#gest_llaves").show();
    $("#gest_esp").hide();
    $("#gest_subs").hide();
  }

  function showEsp_Subs() {
    $("#ges_sec_llaves").removeClass("active");
    $("#ges_sec_esps").addClass("active");

    $("#list-group-title").text("Lista de especialidades y subáreas");

    $("#esp_sub_list").show();
    $("#key_list").hide();
    $("#gest_llaves").hide();
    $("#gest_esp").show();
    $("#gest_subs").show();
  }

  localStorage.getItem("last_gestion_screen") == "llaves"
    ? showGes_llaves()
    : showEsp_Subs();

  $("#ges_sec_llaves").click(function () {
    showGes_llaves();
    localStorage.setItem("last_gestion_screen", "llaves");
  });

  $("#ges_sec_esps").click(function () {
    showEsp_Subs();
    localStorage.setItem("last_gestion_screen", "especialidades");
  });

  // KEYS
  $("#key_num").on("input", function () {
    let keyNum = $(this).val();
    let keyExists = false;
    let keyName = "";

    if (keyNum == "") {
      $("#upt_key, #del_key").prop("disabled", true);
      $("#create_key").prop("disabled", true);
      $("#key_name").val("");
      return;
    }

    // Find if key exists
    keys.forEach(function (key) {
      if (key.numeroLlave == keyNum) {
        keyExists = true;
        keyName = key.nombreAula;
      }
    });

    if (keyExists) {
      // If key exists, populate name and enable update/delete buttons
      $("#key_name").val(keyName);
      $("#upt_key, #del_key").prop("disabled", false);
      $("#create_key").prop("disabled", true);
    } else {
      // If key doesn't exist, clear name and enable create button
      $("#key_name").val("");
      $("#upt_key, #del_key").prop("disabled", true);
      $("#create_key").prop("disabled", false);
    }
  });

  // ESPECIALIDADES
  $("#select_esp, #name_esp").on("input change", function () {
    let selectedEsp = $("#select_esp").val();
    let newEspName = $("#name_esp").val().trim();
    let espExists = false;

    // If selected existing especialidad, enable delete regardless of name input
    if (selectedEsp !== "newesp") {
      $("#del_esp").prop("disabled", false);

      // Only check name validation if there's input
      if (newEspName === "") {
        $("#create_esp, #upt_esp").prop("disabled", true);
        return;
      }
    } else if (newEspName === "") {
      $("#create_esp, #upt_esp, #del_esp").prop("disabled", true);
      return;
    }

    // Check if name already exists
    especialidades.forEach(function (esp) {
      if (esp[1].toLowerCase() === newEspName.toLowerCase()) {
        espExists = true;
      }
    });

    if (selectedEsp === "newesp") {
      // Creating new especialidad
      if (!espExists) {
        $("#create_esp").prop("disabled", false);
        $("#upt_esp, #del_esp").prop("disabled", true);
      } else {
        $("#create_esp, #upt_esp, #del_esp").prop("disabled", true);
      }
    } else {
      // Editing existing especialidad
      let currentEspName = "";
      especialidades.forEach(function (esp) {
        if (esp[0] == selectedEsp) {
          currentEspName = esp[1];
        }
      });

      if (newEspName.toLowerCase() === currentEspName.toLowerCase()) {
        // Same name as current
        $("#upt_esp").prop("disabled", false);
        $("#create_esp").prop("disabled", true);
      } else if (!espExists) {
        // New unique name
        $("#upt_esp").prop("disabled", false);
        $("#create_esp").prop("disabled", true);
      } else {
        // Name exists but different from current
        $("#create_esp, #upt_esp").prop("disabled", true);
      }
    }
  });

  // SUBAREAS
  $("#esp_of_subs").on("change", function () {
    let selectedEsp = $(this).val();
    let subSelect = $("#select_sub");

    // Clear and add default option
    subSelect.html(
      '<option value="newsub" selected>--- Crear subárea ---</option>'
    );

    // Add subareas for selected especialidad
    subareas.forEach(function (sub) {
      if (sub.idEspecialidad == selectedEsp && sub.idSubarea != 1) {
        subSelect.append(
          `<option value="${sub.idSubarea}">${sub.nombreSubarea}</option>`
        );
      }
    });

    // Trigger validation
    $("#sub_nom").trigger("input");
  });

  $("#select_sub, #sub_nom").on("change input", function () {
    let selectedSub = $("#select_sub").val();
    let newSubName = $("#sub_nom").val().trim();

    // If an existing subarea is selected, enable the delete button; otherwise, disable it.
    if (selectedSub !== "newsub") {
      $("#del_sub").prop("disabled", false);
    } else {
      $("#del_sub").prop("disabled", true);
    }

    // Reset update and create buttons
    $("#upt_sub, #create_sub").prop("disabled", true);

    if (newSubName === "") {
      return;
    }

    if (selectedSub === "newsub") {
      // If creating a new subarea, enable the create button
      $("#create_sub").prop("disabled", false);
    } else {
      // If editing an existing subarea, enable the update button
      $("#upt_sub").prop("disabled", false);
    }
  });

  function showProcessing() {
    $("#create_key, #upt_key, #del_key").prop("disabled", true);
    $("#create_esp, #upt_esp, #del_esp").prop("disabled", true);
    $("#create_sub, #upt_sub, #del_sub").prop("disabled", true);
    $("#processing").css("z-index", "9999").css("opacity", "1").show();
    let count = 0;
    let dots = "";
    let procTextInterval = setInterval(() => {
      dots = dots.length >= 4 ? "" : dots + ".";
      $("#proc-text").text("Procesando" + dots);
    }, 500);
  }

  function hideProcessing() {
    $("#processing").css("z-index", "0").css("opacity", "0").remove();
  }

  // Key CRUD operations
  $("#create_key").click(function () {
    $(this).prop("disabled", true);

    if ($("#key_num").val() == "" || $("#key_name").val() == "") {
      alert("Ingrese un número de llave y un nombre de aula válido");
      $(this).prop("disabled", false);
      return;
    } else {
      showProcessing();

      $.ajax({
        url: "gestion_general",
        type: "POST",
        data: {
          action_type: "create_key",
          numeroLlave: $("#key_num").val(),
          nombreAula: $("#key_name").val(),
        },
        success: function (response) {
          sonido_exito.play();
          hideProcessing();
          setTimeout(() => {
            alert(response);
            location.reload();
          }, 200);
        },
        error: function () {
          alert("Error al crear la llave, intenta de nuevo");
          hideProcessing();
        },
      });
    }
  });

  $("#upt_key").click(function () {
    $(this).prop("disabled", true);

    if ($("#key_num").val() == "" || $("#key_name").val() == "") {
      alert("Ingrese un número de llave y un nombre de aula válido");
      $(this).prop("disabled", false);
      return;
    } else {
      showProcessing();
      $.ajax({
        url: "gestion_general",
        type: "POST",
        data: {
          action_type: "update_key",
          numeroLlave: $("#key_num").val(),
          nombreAula: $("#key_name").val(),
        },
        success: function (response) {
          sonido_exito.play();
          hideProcessing();
          setTimeout(() => {
            alert(response);
            location.reload();
          }, 200);
        },
        error: function () {
          alert("Error al actualizar la llave, intenta de nuevo");
          hideProcessing();
        },
      });
    }
  });

  $("#del_key").click(function () {
    $(this).prop("disabled", true);

    if ($("#key_num").val() == "" || $("#key_name").val() == "") {
      alert("Ingrese un número de llave y un nombre de aula válido");
      $(this).prop("disabled", false);
      return;
    } else {
      showProcessing();
      if (
        confirm(
          "¿Está seguro/a que desea eliminar esta llave? \n\nEsta acción eliminará todos los registros de esta llave y no se puede deshacer."
        )
      ) {
        $.ajax({
          url: "gestion_general",
          type: "POST",
          data: {
            action_type: "delete_key",
            numeroLlave: $("#key_num").val(),
          },
          success: function (response) {
            sonido_exito.play();
            hideProcessing();
            setTimeout(() => {
              alert(response);
              location.reload();
            }, 200);
          },
          error: function (error) {
            alert("Error al eliminar la llave, intenta de nuevo");
            hideProcessing();
          },
        });
      } else {
        $(this).prop("disabled", false);
      }
    }
  });

  // CRUD de especialidades
  $("#create_esp").click(function () {
    $(this).prop("disabled", true);
    if ($("#name_esp").val().trim() === "") {
      alert("Ingrese un nombre de especialidad válido");
      $(this).prop("disabled", false);
      return;
    }
    showProcessing();

    $.ajax({
      url: "gestion_general",
      type: "POST",
      data: {
        action_type: "add_esp",
        name_esp: $("#name_esp").val().trim(),
      },
      success: function (response) {
        sonido_exito.play();
        hideProcessing();
        setTimeout(function () {
          alert(response);
          location.reload();
        }, 200);
      },
      error: function () {
        alert("Error al crear la especialidad, intenta de nuevo");
        hideProcessing();
      },
    });
  });

  $("#upt_esp").click(function () {
    $(this).prop("disabled", true);
    if (
      $("#name_esp").val().trim() === "" ||
      $("#select_esp").val() === "newesp"
    ) {
      alert("Seleccione una especialidad existente y escriba un nombre válido");
      $(this).prop("disabled", false);
      return;
    }

    showProcessing();

    $.ajax({
      url: "gestion_general",
      type: "POST",
      data: {
        action_type: "mod_esp",
        idEsp: $("#select_esp").val(),
        name_esp: $("#name_esp").val().trim(),
      },
      success: function (response) {
        sonido_exito.play();
        hideProcessing();
        setTimeout(function () {
          alert(response);
          location.reload();
        }, 200);
      },
      error: function () {
        alert("Error al actualizar la especialidad, intenta de nuevo");
        hideProcessing();
      },
    });
  });

  $("#del_esp").click(function () {
    $(this).prop("disabled", true);
    if ($("#select_esp").val() === "newesp") {
      alert("Seleccione una especialidad para eliminar");
      $(this).prop("disabled", false);
      return;
    }
    if (
      confirm(
    "¿Está seguro/a de que desea eliminar esta especialidad?\n\nEsta acción también eliminará de forma permanente los horarios asociados a esta   especialidad para los profesores."
    )
    ) {
      showProcessing();
      console.log($("#select_esp").val());

      $.ajax({
        url: "gestion_general",
        type: "POST",
        data: {
          action_type: "delete_esp",
          idEsp: $("#select_esp").val(),
        },
        success: function (response) {
          sonido_exito.play();
          hideProcessing();
          setTimeout(function () {
            alert(response);
            location.reload();
          }, 200);
        },
        error: function () {
          alert("Error al eliminar la especialidad, intenta de nuevo");
          hideProcessing();
        },
      });
    } else {
      $(this).prop("disabled", false);
    }
  });

  $("#create_sub").click(function () {
    $(this).prop("disabled", true);

    if ($("#sub_nom").val().trim() === "") {
      alert("Ingrese un nombre de subárea válido");
      $(this).prop("disabled", false);
      return;
    }
    showProcessing();

    $.ajax({
      url: "gestion_general",
      type: "POST",
      data: {
        action_type: "add_sub",
        idEsp: $("#esp_of_subs").val(),
        name_sub: $("#sub_nom").val().trim(),
        name_esp: $("#esp_of_subs option:selected").text(),
      },
      success: function (response) {
        sonido_exito.play();
        hideProcessing();
        setTimeout(() => {
          alert(response);
          location.reload();
        }, 200);
      },
      error: function (error) {
        alert("Error al crear la subárea, intenta de nuevo");
        console.log(error);
        hideProcessing();
      },
    });
  });

  $("#upt_sub").click(function () {
    $(this).prop("disabled", true);

    if (
      $("#sub_nom").val().trim() === "" ||
      $("#select_sub").val() === "newsub"
    ) {
      alert("Seleccione una subárea existente y escriba un nombre válido");
      $(this).prop("disabled", false);
      return;
    }
    showProcessing();

    $.ajax({
      url: "gestion_general",
      type: "POST",
      data: {
        action_type: "mod_sub",
        idSub: $("#select_sub").val(),
        idEsp: $("#esp_of_subs").val(),
        name_sub: $("#sub_nom").val().trim(),
        name_esp: $("#esp_of_subs option:selected").text(),
      },
      success: function (response) {
        sonido_exito.play();
        hideProcessing();
        setTimeout(() => {
          alert(response);
          location.reload();
        }, 200);
      },
      error: function () {
        alert("Error al actualizar la subárea, intenta de nuevo");
        hideProcessing();
      },
    });
  });

  $("#del_sub").click(function () {
    $(this).prop("disabled", true);

    if ($("#select_sub").val() === "newsub") {
      alert("Seleccione una subárea para eliminar");
      $(this).prop("disabled", false);
      return;
    }

    if (
      confirm(
        "¿Está seguro/a que desea eliminar esta subárea?\n\nEsta acción dejará vacíos en los horarios de los profesores que impartan esta subárea, además, no se puede deshacer."
      )
    ) {
      showProcessing();
      $.ajax({
        url: "gestion_general",
        type: "POST",
        data: {
          action_type: "delete_sub",
          idSub: $("#select_sub").val(),
          idEsp: $("#esp_of_subs").val(),
          name_esp: $("#esp_of_subs option:selected").text()
        },
        success: function (response) {
          sonido_exito.play();
          hideProcessing();
          setTimeout(() => {
            alert(response);            
            location.reload();
          }, 200);
        },
        error: function () {
          alert("Error al eliminar la subárea, intenta de nuevo");
          hideProcessing();
        },
      });
    } else {
      $(this).prop("disabled", false);
    }
  });
});
