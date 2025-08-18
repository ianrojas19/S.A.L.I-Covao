$(document).ready(function () {
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

  //Responsive de la busqueda por nombres
  let busquedaCont = document.getElementById("ds_panel_header");

  let inputBusqueda = document.getElementById("search_names");

  let closeSearch = document.getElementById("close_search");

  inputBusqueda.addEventListener("focusin", function () {
    busquedaCont.classList.add("search_active");
  });

  inputBusqueda.addEventListener("focusout", function () {
    busquedaCont.classList.remove("search_active");
    inputBusqueda.value = "";
    filter_act_by_date($("#date_of_activity_selector").val());
  });

  closeSearch.addEventListener("click", function () {
    busquedaCont.classList.remove("search_active");
    inputBusqueda.value = "";
  });

  // Función para filtrar actividades por nombre del profesor o aula
  $("#search_names").on("input", function () {
    const search_val = this.value.trim().toLowerCase(); // Convertir a minúsculas
    const date_selected = new Date($("#date_of_activity_selector").val());

    $(".activity_row").each(function () {
      const act_row = this;
      const act_keys = act_row.children[3].children[0].innerText
        .trim()
        .toLowerCase(); // Convertir a minúsculas
      const act_professor = act_row.children[2].children[0].innerText
        .trim()
        .toLowerCase(); // Convertir a minúsculas

      const dateAct = new Date($(act_row).data("date-act"));

      // Comparar solo las fechas (puedes usar .toDateString() para evitar problemas de tiempo)
      const dateMatches =
        dateAct.toDateString() === date_selected.toDateString();
      const searchMatches =
        search_val === "" ||
        act_keys.includes(search_val) ||
        act_professor.includes(search_val);

      // Mostrar u ocultar la fila según los resultados
      if (dateMatches && searchMatches) {
        $(act_row).removeClass("d-none"); // Mostrar fila
      } else {
        $(act_row).addClass("d-none"); // Ocultar fila
      }
    });
  });

  // FILTROS POR TIPO DE ACTIVIDAD
  $("#filter_activity input").on("input", function () {
    let kind_act_filter = this.id; // El id del filtro seleccionado
    let selected_date = $("#date_of_activity_selector").val() || new Date(); // Obtener la fecha seleccionada

    $(".activity_row").each(function () {
      let kind_act = $(this).data("kind-act"); // Obtener el tipo de actividad (ya es string)
      let date_act = $(this).data("date-act"); // Obtener la fecha de la actividad
      let act_row = $(this);
      function filter_act(param_kind_act) {
        // Comprobamos si el tipo de actividad y la fecha coinciden
        if (kind_act == param_kind_act && date_act == selected_date) {
          act_row.removeClass("d-none"); // Mostrar la fila si coincide
        } else {
          console.log(date_act);
          console.log(selected_date);
          act_row.addClass("d-none"); // Ocultar la fila si no coincide
        }
      }

      // Usar el switch para filtrar por el tipo de actividad
      switch (kind_act_filter) {
        case "see_all_activity":
          filter_act_by_date(selected_date);
          break;
        case "see_key_retiros":
          filter_act("1"); // Filtrar retiros de llaves (data-kind-act="1")
          break;

        case "see_key_devoluciones":
          filter_act("2"); // Filtrar devoluciones de llaves (data-kind-act="2")
          break;

        case "see_key_solicitudes":
          filter_act("3"); // Filtrar solicitudes de llaves (data-kind-act="3")
          break;
      }
    });
  });

  // Función para obtener y mostrar la fecha en el formato requerido
  function convertirFecha(fecha) {

    // Array de días y meses en español
    const dias = [
      "Domingo",
      "Lunes",
      "Martes",
      "Miércoles",
      "Jueves",
      "Viernes",
      "Sábado",
    ];
    const meses = [
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre",
    ];
    // Obtener el día de la semana, el día, el mes y el año
    const diaSemana = dias[fecha.getDay()];
    const diaMes = fecha.getDate();
    const mes = meses[fecha.getMonth()];
    const año = fecha.getFullYear();

    // Construir el texto con el formato requerido
    const fechaTexto = `${diaSemana} ${diaMes} de ${mes}, ${año}`;

    // Mostrar el texto en el párrafo
    document.getElementById("date_of_activity_text").innerHTML = fechaTexto;
  }

  // Función para obtener la fecha actual en la zona horaria de Costa Rica
  function obtenerFechaActual() {
    const now = new Date(); // Obtener la fecha actual
    now.setHours(now.getUTCHours()); // Ajustar a la zona horaria de Costa Rica (GMT-6)
    convertirFecha(now);
  }

  // Fecha de actividad
  $("#date_of_activity_selector").on("input", function () {
    const fechaSeleccionada = $(this).val();
    if (fechaSeleccionada) {
      // Validar formato de fecha (puedes agregar más validaciones si es necesario)
      const regex = /^\d{4}-\d{2}-\d{2}$/;
      if (!regex.test(fechaSeleccionada)) {
        console.error("Formato de fecha incorrecto:", fechaSeleccionada);
        return;
      }

      const fechaParts = fechaSeleccionada.split("-");
      const fechaCR = new Date(fechaParts[0], fechaParts[1] - 1, fechaParts[2]);
      convertirFecha(fechaCR);
    }
    $("#search_names").val("");
    $("#see_all_activity").prop("checked", true);
  });

  // Llamar a la función para mostrar la fecha actual
  obtenerFechaActual();

  function formatTime(dateString) {
    // Extrae solo los primeros 5 caracteres (HH:MM) si el valor es del formato HH:MM:SS
    let timeParts = dateString.trim().split(":"); // Divide la cadena en partes separadas por ':'
    if (timeParts.length < 2) return "Hora inválida"; // Verifica que haya al menos horas y minutos

    let hours = parseInt(timeParts[0], 10);
    let minutes = parseInt(timeParts[1], 10);

    let ampm = hours >= 12 ? "p.m" : "a.m";
    hours = hours % 12;
    hours = hours ? hours : 12; // Si la hora es 0, mostrar 12
    minutes = minutes < 10 ? "0" + minutes : minutes;

    return hours + ":" + minutes + " " + ampm;
  }

  const act_time = document.querySelectorAll(".act_time .act_data_cont");
  act_time.forEach((element) => {
    element.innerHTML = formatTime(element.innerHTML);
  });

  flatpickr("#date_of_activity_selector", {
    locale: "es",
    locale: {
      firstDayOfWeek: 1, // Comienza la semana en lunes
    },
    defaultDate: "today", // Establecer la fecha por defecto a la fecha de hoy
  });


  // Función para mostrar el modal con los datos según el tipo de acción
  $(".btn_see_more").on("click", function () {
    const modalTitle = $("#title_see_act");
    const professor = $(this).data("professor");
    const time = $(this).data("time");
    let date = $(this).data("date");

    // Crear un objeto de fecha
    const fecha = new Date(date);
    fecha.setDate(fecha.getDate() + 1);

    // Opciones para formatear la fecha
    const opciones = {
      weekday: "long", // Día de la semana completo
      year: "numeric", // Año
      month: "long",   // Mes completo
      day: "numeric",  // Día del mes
    };

    // Formatear la fecha en español
    const fechaFormateada = fecha.toLocaleDateString("es-ES", opciones);
    date = fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1);;

    const kind = $(this).data("kind");
    const key1 = $(this).data("key1");
    const key2 = $(this).data("key2");
    const key3 = $(this).data("key3");
    const key4 = $(this).data("key4");
    const key5 = $(this).data("key5");
    const key6 = $(this).data("key6");
    const key7 = $(this).data("key7");
    const key8 = $(this).data("key8");
    const key9 = $(this).data("key9");
    const cond_keySolicitada = $(this).data("cond-sol-llave");
    const horain_keySolicitada = $(this).data("cond-sol-horain-llave");
    const horafin_keySolicitada = $(this).data("cond-sol-horafin-llave");
    const justificacion_keySolicitada = $(this).data("razon-llave-solicitada");
    const keySolicitada = $(this).data("key-solicitada");
    const keyFechaUso = $(this).data("key-fecha-uso-solicitud");
    const codigoGravedad = $(this).data("codigo-gravedad");
    const bitacora = $(this).data("bitacora");
    const dev_razon = $(this).data("razon-devolucion")

    // Limpiar el contenido del modal antes de llenarlo
    $(".act_data_atr").text("");

    // Ocultar todas las secciones al inicio
    $(".retiro, .devolucion, .solicitud").hide();

    // Llenar los datos comunes
    $("#act_data_profesor").text(professor);
    $("#act_fecha_hora").text(`${date} - ${formatTime(time)}`);

    // Verificar el tipo de acción y mostrar las secciones correspondientes
    if (kind === "Retiro de llave") {
      modalTitle.text("Detalles de Retiro");

      // Mostrar solo las secciones de retiro
      $(".retiro").show();

      // Mostrar llaves retiradas
      const keys = [key1, key2, key3, key4, key5, key6, key7, key8, key9].filter((key) => key);

      const llavesHTML = keys.length
        ? keys.map((key) => `<span>${key}</span>`).join("") // Crear un <div> por cada llave
        : "<span>No hay llaves retiradas</span>"; // Mostrar mensaje si no hay llaves

      $("#act_data_llaves").html(llavesHTML);

    } else if (kind === "Devolución de llave") {
      modalTitle.text("Detalles de Devolución");

      // Mostrar solo las secciones de devolución
      $(".devolucion").show();

      // Mostrar llaves devueltas
      const keys = [key1, key2, key3, key4, key5].filter((key) => key);

      const llavesHTML = keys.length
        ? keys.map((key) => `<span>${key}</span>`).join("") // Crear un <div> por cada llave
        : "<spans>No hay llaves devueltas</spans>"; // Mostrar mensaje si no hay llaves

      $("#act_data_llaves").html(llavesHTML);

      // Mostrar gravedad según código
      $("#cond_buena, #cond_intermedia, #cond_grave").hide();
      if (codigoGravedad == "1") {
        $("#cond_buena").show();
      } else if (codigoGravedad == "2") {
        $("#cond_intermedia").show();
      } else if (codigoGravedad == "3") {
        $("#cond_grave").show();
      }

      // Mostrar bitácora
      $("#act_data_bitacora").text(bitacora || "Sin bitácora");

      switch (dev_razon) {
        case 1:
          $('#act_razon_devolucion').text("Fin de uso regular de llave por horario");
          break;

        case 2:
          $('#act_razon_devolucion').text("Finalización de jornada laboral");
          break;

        case 3:
          $('#act_razon_devolucion').text("Motivos institucionales");
          break;
          
        case 4:
          $('#act_razon_devolucion').text("Ha ocurrido una emergencia");
          break;

        default:
          $('#act_razon_devolucion').text(dev_razon);
          break;
      }

    } else if (kind === "Solicitud de llave") {
      modalTitle.text("Detalles de Solicitud");

      // Mostrar solo las secciones de solicitud
      $(".solicitud").show();

      // Mostrar llave solicitada y fecha de uso
      $("#act_data_llave_solicitada").text(
        keySolicitada || "No hay llave solicitada"
      );
      $("#act_data_fecha_uso").text(keyFechaUso || "Sin fecha de uso");
      $("#act_hora_uso_in_sl").text(`${formatTime(horain_keySolicitada)}`);
      $("#act_hora_uso_fin_sl").text(`${formatTime(horafin_keySolicitada)}`);
      $("#act_justificacion_sl").text(justificacion_keySolicitada);
      // Mostrar la condición de la solicitud
      if (cond_keySolicitada == 1) {
        $("#cond_sol_aprobed").show();
        $("#cond_sol_rejected").hide();
      } else {
        $("#cond_sol_aprobed").hide();
        $("#cond_sol_rejected").show();
      }
    }
  });

  function filter_act_by_date(date) {
    $(".activity_row").each(function () {
      date == $(this).data("date-act")
        ? $(this).removeClass("d-none")
        : $(this).addClass("d-none");
    });
  }

  // Escucha los cambios del selector de fecha y ejecuta la función con el nuevo valor
  $("#date_of_activity_selector").on("input", function () {
    const selectedDate = $(this).val();
    filter_act_by_date(selectedDate);
  });
});
