// Abri ventana de detalles del ambiente
function mostrar_detalles(
  id_ambiente,
  num_ambiente,
  boton_ambiente,
  id_reserva,
  estado_ambi,
  img_ambi
) {
  cardAmbientes = document.querySelectorAll(".cardAmbiente");
  cardAmbientes.forEach((element) => {
    element.classList.remove("ambiente_abierto_da");
  });
  var menuinveambi = document.querySelector(".menu-inve-ambi");
  var menuestadoambi = document.querySelector(".menu-estado-ambi");
  $(".cont-ven-da").addClass("mostrar-cont-ven-da");
  var valorNum_ambie = num_ambiente == 0 ? "" : num_ambiente;
  $(".num_ambiente").text(valorNum_ambie);
  // MODIFIQUE
  $(".menu-asig-ambi").addClass("selec-op-menu");
  $(".menu-asig-ambi span").addClass("selec-op-span");
  $(".menu-asig-ambi svg").addClass("selec-op-svg");
  $("#asig-ambi").addClass("mostrar-contenedor-op");
  // MODIFIQUE
  $("#asig-ambi").css("z-index", "1");
  if (id_reserva) {
    const contenedor_ru = document.querySelector(".cont-form-edit-da");
    const idRol = contenedor_ru.getAttribute("data-rol_usua");
    if (idRol == 1 || idRol == 3) {
      menuestadoambi.setAttribute("data-id_reserva", id_reserva);
    }
  } else {
    const contenedor_ru = document.querySelector(".cont-form-edit-da");
    const idRol = contenedor_ru.getAttribute("data-rol_usua");
    if (idRol == 1 || idRol == 3) {
      menuestadoambi.setAttribute("data-id_reserva", "nodis");
    }
  }

  if (menuestadoambi) {
    if (estado_ambi == "Disponible") {
      menuestadoambi.style.display = "none";
    } else {
      menuestadoambi.style.display = "flex";
    }
  }
  menuinveambi.setAttribute("data-id_ambiente", id_ambiente);
  const contenedor_ru = document.querySelector(".cont-form-edit-da");
  const idRol = contenedor_ru.getAttribute("data-rol_usua");
  if (idRol == 1 || idRol == 3) {
    menuestadoambi.setAttribute("data-id_ambiente", id_ambiente);
  }
  ambiente_presionado =
    boton_ambiente.parentElement.parentElement.parentElement;
  ambiente_presionado.classList.add("ambiente_abierto_da");
  if (id_reserva) {
    asig_ambi_actu_da(id_reserva);
  } else {
    $(".info-usua").addClass("remove-info-usua");
  }
  $(".img-da").attr("src", img_ambi);
  asig_ambi(id_ambiente);
}

function cerrar_detalles() {
  existe_primero = document.querySelector(".mostrar-menu-da-respon");
  if (existe_primero) {
    $(".nav-da").removeClass("mostrar-menu-da-respon");
    return;
  }
  $(".cont-ven-da").removeClass("mostrar-cont-ven-da");
  const contenedores = document.querySelectorAll(".contenedor-op");
  contenedores.forEach((element) => {
    element.classList.remove("mostrar-contenedor-op");
    element.style.zIndex = "0";
  });
  var botones = document.querySelectorAll(".op-menu");
  botones.forEach((element) => {
    const span = element.querySelector("span");
    const svg = element.querySelector("svg");
    element.classList.remove("selec-op-menu");
    span.classList.remove("selec-op-span");
    svg.classList.remove("selec-op-svg");
  });
  $(".form-asig-ambi").removeClass("mostrar-form-asig-ambi");
  $("#calendar-asig").removeClass("ocultar-cal-da");
}

document.addEventListener("click", function (event) {
  var existe_primero = document.querySelector(".mostrar-menu-da-respon");
  var existe = document.querySelector(".mostrar-cont-ven-da");
  var venda = document.querySelector(".ven-da");
  var navDa = document.querySelector(".nav-da");
  var verInfo = document.querySelectorAll(".verInfo");
  var botonAbrirMenuDa = document.querySelectorAll(".boton-abrir-menu-da");
  var cerrarDa = document.querySelector(".cerrar-da");
  var cerrarDa = document.querySelector(".cerrar-da");
  var contCliqueado = event.target;

  const esBotonEspecifico = Array.from(verInfo).some((element) =>
    element.contains(contCliqueado)
  );
  const otroBotonEs = Array.from(botonAbrirMenuDa).some((element) =>
    element.contains(contCliqueado)
  );

  if (existe_primero) {
    if (!otroBotonEs) {
      if (!navDa.contains(contCliqueado)) {
        $(".nav-da").removeClass("mostrar-menu-da-respon");
        return;
      }
    }
  }

  if (existe) {
    if (!venda.contains(contCliqueado)) {
      if (!esBotonEspecifico) {
        // MODIFIQUE
        if (
          !contCliqueado.classList.contains("fc-list-day-text") &&
          !contCliqueado.classList.contains("fc-list-day-side-text") &&
          !contCliqueado.classList.contains("fc-daygrid-day-number")
        ) {
          $(".cont-ven-da").removeClass("mostrar-cont-ven-da");
          const contenedores = document.querySelectorAll(".contenedor-op");
          contenedores.forEach((element) => {
            element.classList.remove("mostrar-contenedor-op");
            element.style.zIndex = "0";
          });
          var botones = document.querySelectorAll(".op-menu");
          botones.forEach((element) => {
            const span = element.querySelector("span");
            const svg = element.querySelector("svg");
            element.classList.remove("selec-op-menu");
            span.classList.remove("selec-op-span");
            svg.classList.remove("selec-op-svg");
          });
          $(".form-asig-ambi").removeClass("mostrar-form-asig-ambi");
          $("#calendar-asig").removeClass("ocultar-cal-da");
        }
      }
    }
  } else {
    otro_existe = document.querySelector(".ambiente_abierto_da");
    if (otro_existe) {
      if (!cerrarDa.contains(contCliqueado)) {
        if (!esBotonEspecifico) {
          cardAmbientes = document.querySelectorAll(".cardAmbiente");
          cardAmbientes.forEach((element) => {
            element.classList.remove("ambiente_abierto_da");
          });
        }
      }
    }
  }
});

function asig_ambi_actu_da(id_reserva) {
  $(".info-usua").removeClass("remove-info-usua");
  $.ajax({
    url: "php/info_usu.php",
    type: "POST",
    data: { id_reserva: id_reserva },
    dataType: "json",
    success: function (datos) {
      if (datos.dispoNohay) {
        $(".info-usua").addClass("remove-info-usua");
        return;
      }
      if (datos.datos_reserva.estado_ambiente == 2) {
        var id_usu_ingresado = $("#estado-ambi").attr("data-id_usuario");
        if (datos.datos_reserva.idusuario == id_usu_ingresado) {
          $(".info-usua>div>h4").text("Actualmente Ocupado por ti:");
        }
        $(".img-usua").attr("src", "imgusuario/" + datos.datos_reserva.imagen);
        $(".usuario>span>div>h4").text(datos.datos_reserva.nombre_usuario);
        $(".rol_usua-da").text(datos.datos_reserva.nombre_rol);
        $(".tele_usua-da").text(datos.datos_reserva.telefono);
        if (datos.datos_reserva.numero_ficha == 1) {
          $(".formacion>span>h4").text(datos.datos_reserva.formacion);
          $(".motivo-da").text(datos.datos_reserva.motivo);
        } else {
          $(".titulo-info_usua-da").text("Formación: ");
          $(".formacion>span>h4").text(datos.datos_reserva.formacion);
          $(".motivo-da").text(datos.datos_reserva.motivo);
          $(".ficha-da").text(datos.datos_reserva.numero_ficha);
        }
      } else {
        $(".info-usua").addClass("remove-info-usua");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function abri_menu_da() {
  $(".nav-da").addClass("mostrar-menu-da-respon");
}

// MODIFIQUE

function atras_calen_da() {
  var existe = document.querySelector(".mostrar_presionado-reserva-dis");
  if (existe) {
    $(".dis-reserva-da > button").removeClass("mostrar_presionado-reserva-dis");
    $(".dias_reserva_dispo").removeClass("mostra-opcion-form-da");
    $(".form-edit-da").addClass("mostra-opcion-form-da");
    $(".acciones-form-edit-da").removeClass("oculta-cont-input-form");
    $(".cont-form-edit-da").css("height", "80%");
    return;
  }
  $(this).css("display", "none");
  $(".form-asig-ambi").removeClass("mostrar-form-asig-ambi");
  $("#calendar-asig").removeClass("ocultar-cal-da");
  if (window.innerWidth < 691) {
    $(".boton-abrir-menu-da").css("display", "flex");
  }
}

window.addEventListener("resize", function () {
  if (window.innerWidth < 691) {
    mostrarFormAsigAmbi = document.querySelector(".mostrar-form-asig-ambi");
    if (!mostrarFormAsigAmbi) {
      $(".boton-abrir-menu-da").css("display", "flex");
    } else {
      $(".boton-abrir-menu-da").css("display", "none");
    }
  } else {
    $(".boton-abrir-menu-da").css("display", "none");
  }
});

function mostrar_sec_da(id_cont, boton) {
  var cont_selecionado = document.querySelector("#" + id_cont + "");
  var contenedores = document.querySelectorAll(".contenedor-op");
  var botones = document.querySelectorAll(".op-menu");
  var span_click = boton.querySelector("span");
  var svg_clcik = boton.querySelector("svg");
  contenedores.forEach((element) => {
    element.classList.remove("mostrar-contenedor-op");
    element.style.zIndex = "0";
  });
  existe_primero = document.querySelector(".mostrar-menu-da-respon");
  if (existe_primero) {
    $(".nav-da").removeClass("mostrar-menu-da-respon");
  }
  botones.forEach((element) => {
    const span = element.querySelector("span");
    const svg = element.querySelector("svg");
    element.classList.remove("selec-op-menu");
    span.classList.remove("selec-op-span");
    svg.classList.remove("selec-op-svg");
  });
  if (id_cont == "inve-ambi") {
    inve_ambi();
  }
  // MODIFIQUE
  if (id_cont == "asig-ambi") {
    asig_ambi();
  }
  if (id_cont == "estado-ambi") {
    var selectMotivo = document.querySelector("#motivo");
    selectMotivo.addEventListener("change", habilitarMotivo);
  }
  cont_selecionado.classList.add("mostrar-contenedor-op");
  cont_selecionado.style.zIndex = "1";
  boton.classList.add("selec-op-menu");
  span_click.classList.add("selec-op-span");
  svg_clcik.classList.add("selec-op-svg");
}

// MODIFIQUE

function asig_ambi(idAmb) {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");
  atras_calen_da();
  var id_ambiente = 0;
  if (!idAmb) {
    var contenedor = document.querySelector(".menu-inve-ambi");
    id_ambiente = contenedor.getAttribute("data-id_ambiente");
  } else {
    id_ambiente = idAmb;
  }
  $.ajax({
    url: "php/detalle_ambiente.php",
    type: "POST",
    data: { id_ambiente: id_ambiente },
    dataType: "json",
    success: function (datos) {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");
      mostrar_calendario_asig(datos);
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function mostrar_calendario_asig(datos) {
  var calendarEl = document.getElementById("calendar-asig");

  var header_config = {
    left: "prev,next today",
    center: "title",
    right: "multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay",
  };

  var editable_config = false;

  var eventos = [];
  if (datos != null) {
    datos.forEach((dato) => {
      color_estado = null;
      if (dato.estado_ambiente == 1) {
        color_estado = "#FFC436";
      } else if (dato.estado_ambiente == 2) {
        color_estado = "#D71313";
      } else if (dato.estado_ambiente == 3) {
        color_estado = "#54b435";
      }
      var evento = {
        id: dato.idsolicitud,
        classNames: dato.idusuario,
        title: dato.formacion,
        backgroundColor: color_estado,
        start: dato.fecha_inicio,
        end: dato.fecha_fin,
        allDay: false,
        editable: false,
      };
      eventos.push(evento);
    });

    header_config.left += " listYear";
    editable_config = true;
  }

  mostrar_calen_festivos(eventos, calendarEl, editable_config, header_config);
}

function mostrar_calen_festivos(
  eventos,
  calendarEl,
  editable_config,
  header_config
) {
  // $.ajax({
  //   url: "php/festivos_calendario.php",
  //   type: "POST",
  //   dataType: "json",
  //   success: function (datos) {
  // datos.forEach((element) => {
  //   var evento_fes = {
  //     title: element.localName,
  //     backgroundColor: "#0074e4",
  //     start: element.date,
  //     allDay: true,
  //     editable: false,
  //   };
  //   eventos.push(evento_fes);
  // });
  var selectedRange = null;
  var selectedDay = null;

  var calendar = new FullCalendar.Calendar(calendarEl, {
    // Establece el idioma en español
    locale: "es",

    initialView: "listYear",

    headerToolbar: header_config,

    footerToolbar: {
      right: "botonasig",
    },

    views: {
      timeGrid: {
        dayHeaders: true, // Mostrar encabezados de día
      },
    },

    // eventRender: function (info) {
    //   // Oculta eventos con el color azul en la vista "listYear"
    //   if (calendar.view.type === "listYear" && info.event.backgroundColor === "#0074e4") {
    //     return false; // No muestra el evento
    //   }
    // },

    customButtons: {
      botonasig: {
        text: "Reservar ambiente",
        click: inser_reserva_form_da,
      },

      // eventOrder: ["-backgroundColor", "-start"],
      // listYearButton: {
      //   text: "Fechas reservadas",
      //   click: function () {
      //     calendar.changeView("listYear");
      //   },
      // },
    },

    noEventsContent: "No hay reservas en este ambiente",

    aspectRatio: 1.5,

    navLinks: true,

    editable: editable_config,

    eventClick: function (info) {
      actuali_reserva_ambie(info);
    },

    selectable: true,

    select: function (selectionInfo) {
      var eventos = calendar.getEvents();

      var eventosSuperpuestos = eventos.filter(function (evento) {
        return (
          evento.backgroundColor == "#D71313" && // Cambia el color a verificar aquí
          evento.start < selectionInfo.end &&
          evento.end > selectionInfo.start
        );
      });

      if (eventosSuperpuestos.length > 0) {
        alert("Ambiente ya reservado para esta fecha.");
        return;
      }
      if (calendar.view.type === "timeGridWeek") {
        // En la vista de semana, solo permite la selección de días
        selectedDay = selectionInfo.start;
        selectedRange = {
          start: selectionInfo.start,
          end: selectionInfo.end,
        };
      } else {
        // En otras vistas, permite la selección de horas y días
        // Verifica si es una selección de rango de horas o de días
        if (
          selectionInfo.start.getHours() !== 0 ||
          selectionInfo.end.getHours() !== 0
        ) {
          // Se seleccionó un rango de horas
          selectedRange = {
            start: selectionInfo.start,
            end: selectionInfo.end,
          };

          var fechaActu = new Date();
          if (
            selectionInfo.start <= fechaActu ||
            selectionInfo.end <= fechaActu
          ) {
            alert(
              "No puedes reservar ambientes con una fecha igual o anterior a la actual."
            );
            return;
          }
          var horaInicioSeleccionada = selectionInfo.start.getHours();
          var horaFinSeleccionada = selectionInfo.end.getHours();

          // Verifica si la hora de inicio está fuera del rango de 5:30 AM a 11:30 PM
          if (
            horaInicioSeleccionada < 5 ||
            (horaInicioSeleccionada === 5 &&
              selectionInfo.start.getMinutes() < 30) ||
            horaInicioSeleccionada >= 23
          ) {
            alert(
              "La hora de inicio seleccionada está fuera del rango permitido (5:30 AM - 11:30 PM)."
            );
          } else if (
            horaFinSeleccionada < 5 ||
            (horaFinSeleccionada === 5 &&
              selectionInfo.end.getMinutes() < 30) ||
            horaFinSeleccionada >= 23
          ) {
            alert(
              "La hora de finalización seleccionada está fuera del rango permitido (5:30 AM - 11:30 PM)."
            );
          } else {
            selectedDay = null;
            // Aquí colocas el código para manejar las reservas dentro del rango de horas permitido
            var hora_inicialForm = selectionInfo.start.toLocaleTimeString([], {
              hour: "2-digit",
              minute: "2-digit",
            });
            var hora_finalForm = selectionInfo.end.toLocaleTimeString([], {
              hour: "2-digit",
              minute: "2-digit",
            });
            var diaForm = selectionInfo.start.toISOString().split("T")[0];
            inser_reserva_form_da(
              hora_inicialForm,
              hora_finalForm,
              diaForm,
              null,
              null,
              null
            );
          }
        } else {
          // Se seleccionó un día o un rango de días
          selectedDay = selectionInfo.start;
          selectedRange = {
            start: selectionInfo.start,
            end: selectionInfo.end,
          };
          var fechaActu = new Date();
          if (
            selectionInfo.start <= fechaActu ||
            selectionInfo.end <= fechaActu
          ) {
            alert(
              "No puedes reservar ambientes con una hora atras de la actual."
            );
            return;
          }
          if (
            selectionInfo.start.toDateString() ===
            selectionInfo.end.toDateString()
          ) {
            // Si se selecciona solo un día, muestra un mensaje adecuado
            diaForm = selectionInfo.start.toISOString().split("T")[0];
            inser_reserva_form_da(null, null, null, diaForm);
          } else {
            var dia_Inicial = selectionInfo.start.toISOString().split("T")[0];
            var dia_final = selectionInfo.end.toISOString().split("T")[0];
            inser_reserva_form_da(
              null,
              null,
              null,
              null,
              dia_Inicial,
              dia_final
            );
          }
        }
      }
    },

    buttonText: {
      listYear: "Fechas reservadas",
      today: "Hoy",
      month: "Mes",
      week: "Semana",
      day: "Día",
    },

    // Deshabilita la fila "all-day"
    allDaySlot: false,

    // Personaliza el formato de las etiquetas de ranura
    slotLabelContent: function (arg) {
      return arg.date.toLocaleTimeString([], {
        hour: "2-digit",
        hour12: true,
      });
    },

    events: eventos,
  });
  calendar.render();
  //   },
  //   error: function (xhr, status, error) {
  //     console.error(error);
  //   },
  // });
}

function abrir_ven_form_da() {
  $(".boton-abrir-menu-da").css("display", "none");
  $(".form-asig-ambi").addClass("mostrar-form-asig-ambi");
  $("#calendar-asig").addClass("ocultar-cal-da");
}

function inser_reserva_form_da(
  horai,
  horaf,
  diahora,
  dia_solo,
  dia_Inicial,
  dia_final
) {
  abrir_ven_form_da();
  $(".input-enviar-form").val("");
  $(
    "#form-da-fechaf, #form-da-fechai, #form-da-jornada, #form-da-horai, #form-da-horaf"
  ).css("border-color", "#bdc7d8");
  $(".acciones-actua-reser-da").css("display", "none");
  $(".insertar-form-da").removeClass("oculta-cont-input-form");
  $(".form-da").removeClass("mostra-opcion-form-da");
  const contenedor_ru = document.querySelector(".cont-form-edit-da");
  const idRol = contenedor_ru.getAttribute("data-rol_usua");
  if (idRol == 1) {
    $("#form-da-usua").removeClass("mostra-opcion-form-da");
    $(".actuali-form-da").addClass("oculta-cont-input-form");
    $(".insertar-form-da").removeClass("oculta-cont-input-form");
    llenar_usuarios_formDa();
  } else {
    $(".cont-form-da-usua").remove();
  }
  $(".texto-form-header-da").text("¡Reserva este ambiente!");
  $(".form-da").removeClass("mostra-opcion-form-da");
  $(".form-edit-da").addClass("mostra-opcion-form-da");
  if (horai && horaf && diahora) {
    $(".cont-input-nomF-numF").addClass("oculta-cont-input-form");
    $(".cont-input-horas").removeClass("oculta-cont-input-form");
    $(".cont-input-motivo").removeClass("oculta-cont-input-form");

    $("#form-da-Tocu").val("reunion-corta");
    $("#form-da-jornada").val("otra_jorna");
    $("#form-da-horai").val(horai);
    $("#form-da-horaf").val(horaf);
    $("#form-da-fechai").val(diahora);
    $("#form-da-fechaf").val(diahora);
    mostrarEstadoReser_form();
  } else if (dia_solo) {
    $(".cont-input-horas").addClass("oculta-cont-input-form");
    $(".cont-input-nomF-numF").addClass("oculta-cont-input-form");

    $("#form-da-jornada").val("1");
    $("#form-da-Tocu").val("formacion");
    $("#form-da-fechai").val(dia_solo);
    $("#form-da-fechaf").val(dia_solo);
    $(".cont-input-motivo").addClass("oculta-cont-input-form");
    mostrarEstadoReser_form();
  } else if (dia_Inicial && dia_final) {
    $(".cont-input-horas").addClass("oculta-cont-input-form");
    $(".cont-input-nomF-numF").addClass("oculta-cont-input-form");

    $("#form-da-jornada").val("1");
    $("#form-da-Tocu").val("formacion");
    $(".cont-input-nomF-numF").removeClass("oculta-cont-input-form");
    $("#form-da-fechai").val(dia_Inicial);
    $("#form-da-fechaf").val(dia_final);
    $(".cont-input-motivo").addClass("oculta-cont-input-form");
    mostrarEstadoReser_form();
  } else {
    $(".cont-input-horas").removeClass("oculta-cont-input-form");
    $(".cont-input-nomF-numF").addClass("oculta-cont-input-form");
    $("#form-da-jornada").val("otra_jorna");
    $("#form-da-Tocu").val("reunion-corta");
    $(".cont-input-motivo").removeClass("oculta-cont-input-form");
  }
  document
    .querySelector("#form-da-Tocu")
    .removeEventListener("change", mostrarOpcionTasig);
  document
    .querySelector("#form-da-jornada")
    .removeEventListener("change", mostrarOpcionjornada);

  document
    .querySelector("#form-da-fechai")
    .removeEventListener("input", mostrarEstadoReser_form);
  document
    .querySelector("#form-da-fechaf")
    .removeEventListener("input", mostrarEstadoReser_form);
  document
    .querySelector("#form-da-horai")
    .removeEventListener("input", mostrarEstadoReser_form);
  document
    .querySelector("#form-da-horaf")
    .removeEventListener("input", mostrarEstadoReser_form);
  document
    .querySelector("#form-da-numF")
    .removeEventListener("input", mostrarProgramas);

  document
    .querySelector(".insertar-form-da")
    .removeEventListener("click", insertar_reserva);

  document
    .querySelector("#form-da-numF")
    .removeEventListener("blur", oculContProRaDa);

  document
    .querySelector(".insertar-form-da")
    .addEventListener("click", insertar_reserva);

  document
    .querySelector("#form-da-Tocu")
    .addEventListener("change", mostrarOpcionTasig);
  document
    .querySelector("#form-da-jornada")
    .addEventListener("change", mostrarOpcionjornada);

  document
    .querySelector("#form-da-fechai")
    .addEventListener("input", mostrarEstadoReser_form);
  document
    .querySelector("#form-da-fechaf")
    .addEventListener("input", mostrarEstadoReser_form);
  document
    .querySelector("#form-da-horai")
    .addEventListener("input", mostrarEstadoReser_form);
  document
    .querySelector("#form-da-horaf")
    .addEventListener("input", mostrarEstadoReser_form);
  document
    .querySelector("#form-da-numF")
    .addEventListener("input", mostrarProgramas);
  document
    .querySelector("#form-da-numF")
    .addEventListener("blur", oculContProRaDa);
}

function oculContProRaDa() {
  $(".cont-pro-ra-da").removeClass("most-cont-pro-ra-da");
}

function mostrarProgramas() {
  var self = this;
  if ($(self)) {
    $(self).addClass("animated-input-cargando");
  }

  var valorFicha = $("#form-da-numF").val();

  if (valorFicha.length < 4) {
    if ($(self)) {
      $(self).removeClass("animated-input-cargando");
    }
    $(".cont-pro-ra-da").removeClass("most-cont-pro-ra-da");
    return;
  }
  $.ajax({
    url: "php/buscarProgramas.php",
    type: "POST",
    dataType: "json",
    data: {
      valorFicha: valorFicha,
    },
    success: function (programas) {
      if ($(self)) {
        $(self).removeClass("animated-input-cargando");
      }
      $(".cont-pro-ra-da").addClass("most-cont-pro-ra-da");
      $(".lis-pro-ra-da").remove();
      $(".no-pro-ra-da").remove();
      if (!programas.noexiste) {
        programas.forEach((programa) => {
          $(".cont-pro-ra-da").append(
            '<button class="lis-pro-ra-da" data-ficha_pro_da="' +
              programa.ficha +
              '"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path></svg><p>' +
              programa.nombreprograma +
              "</p></button>"
          );
        });

        var lisProRaDas = document.querySelectorAll(".lis-pro-ra-da");

        lisProRaDas.forEach((lisProRaDa) => {
          var valorAntFicha = null;
          var valorAntForm = null;
          var hizoClick = false;

          lisProRaDa.addEventListener("mouseenter", function () {
            valorAntFicha = $("#form-da-numF").val();
            valorAntForm = $("#form-da-nomF").val();
            lisProRaDa.classList.add("hover-lis-pro-ra-da");
            valorNueFicha = $(this).attr("data-ficha_pro_da");
            valorNueForm = $(this).text();
            $("#form-da-numF").val(valorNueFicha);
            $("#form-da-nomF").val(valorNueForm);
          });

          lisProRaDa.addEventListener("mousedown", function () {
            hizoClick = true;
          });

          lisProRaDa.addEventListener("mouseleave", () => {
            if (!hizoClick) {
              lisProRaDa.classList.remove("hover-lis-pro-ra-da");
              $("#form-da-numF").val(valorAntFicha);
              $("#form-da-nomF").val(valorAntForm);
            }
            hizoClick = false;
          });
        });
      } else {
        $(".cont-pro-ra-da").append(
          '<span class="no-pro-ra-da">:( No se encuentra la formación</span>'
        );
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function mostrarEstadoReser_form() {
  var self = this;
  if ($(self)) {
    $(self).addClass("animated-input-cargando");
  }
  var contenedor_ru = document.querySelector(".menu-inve-ambi");
  var id_ambiente = contenedor_ru.getAttribute("data-id_ambiente");
  var horaI = null;
  var horaf = null;
  var formDaFechaf = $("#form-da-fechaf");
  var formDaFechai = $("#form-da-fechai");
  var formDaJornada = $("#form-da-jornada");
  var formDaHorai = $("#form-da-horai");
  var formDaHoraf = $("#form-da-horaf");
  var color_horaForm = null;
  var color_fechaForm = $("#form-da-fechai, #form-da-fechaf");

  $(
    "#form-da-fechaf, #form-da-fechai, #form-da-jornada, #form-da-horai, #form-da-horaf"
  ).css("border-color", "#bdc7d8");

  var contInputHoras = document.querySelector(".cont-input-horas");
  if (contInputHoras.classList.contains("oculta-cont-input-form")) {
    valor_jor = formDaJornada.val();
    if (valor_jor == 1) {
      horaI = "06:00:00";
      horaf = "12:00:00";
    } else if (valor_jor == 2) {
      horaI = "12:00:00";
      horaf = "18:00:00";
    } else if (valor_jor == 3) {
      horaI = "18:00:00";
      horaf = "22:00:00";
    }
    color_horaForm = formDaJornada;
  } else {
    horaI = formDaHorai.val();
    horaf = formDaHoraf.val();
    color_horaForm = $("#form-da-horai, #form-da-horaf");
  }
  var fechaI = formDaFechai.val();
  var fechaf = formDaFechaf.val();

  $.ajax({
    url: "php/mostrar_estado_formDa.php",
    type: "POST",
    dataType: "json",
    data: {
      id_ambiente: id_ambiente,
      horaI: horaI,
      horaf: horaf,
      fechaI: fechaI,
      fechaf: fechaf,
    },
    success: function (estado) {
      if ($(self)) {
        $(self).removeClass("animated-input-cargando");
      }
      if (estado.estado_fecha == "ocu") {
        color_fechaForm.css("border-color", "#D71313");
      } else if (estado.estado_fecha == "dis") {
        color_fechaForm.css("border-color", "#54b435");
      } else if (estado.estado_fecha == "pen") {
        color_fechaForm.css("border-color", "#FFC436");
      } else if (estado.estado_fecha == "ant") {
        toastr.warning(
          "No puedes reservar un ambiente para una fecha anterior de la actual."
        );
      } else if (estado.estado_fecha == "nocon") {
        toastr.warning("Las fechas no tienen un orden.");
      } else if (estado.estado_fecha == "fechamastri") {
        toastr.error("No se permite reservar ambientes mayor a un trimeste.");
      }
      if (estado.estado_hora == "ocu") {
        color_horaForm.css("border-color", "#D71313");
      } else if (estado.estado_hora == "dis") {
        color_horaForm.css("border-color", "#54b435");
      } else if (estado.estado_hora == "pen") {
        color_horaForm.css("border-color", "#FFC436");
      } else if (estado.estado_hora == "ant") {
        toastr.warning(
          "No puedes reservar un ambiente para una hora anterior de la actual."
        );
      } else if (estado.estado_hora == "alc") {
        toastr.warning(
          "La hora seleccionada está fuera del rango permitido (5:00 AM - 10:00 PM)."
        );
      } else if (estado.estado_hora == "nocon") {
        toastr.warning("Las horas no tienen un orden.");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function llenar_usuarios_formDa() {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");
  $.ajax({
    url: "php/llenar_usuarios_formDa.php",
    type: "POST",
    dataType: "json",
    success: function (datos_fomrDa) {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");
      $(".admin_usua-formDa").remove();
      var option = null;
      datos_fomrDa.forEach((dato_fomrDa) => {
        if (datos_fomrDa == null) {
          $("#form-da-usua").append(
            '<option class="admin_usua-formDa" value="">No existen usuarios</option>'
          );
        } else {
          option = $(
            '<option class="admin_usua-formDa" value="' +
              dato_fomrDa.idusuario +
              '">' +
              dato_fomrDa.nombre_usuario +
              " " +
              dato_fomrDa.apellido +
              "  // " +
              dato_fomrDa.nombre_rol +
              "</option>"
          );
          $("#form-da-usua").append(option);
        }
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function actuali_reserva_ambie(info) {
  if (info.event.backgroundColor == "#54b435") {
    return;
  }
  inser_reserva_form_da();
  document
    .querySelector(".estado-reserva-da")
    .classList.remove("cambiar_estado_actua_reser");
  id_usu_ingresado = $("#estado-ambi").attr("data-id_usuario");
  if (info.event.title == "Reunion corta") {
    if (info.event.classNames == id_usu_ingresado) {
      $(".texto-form-header-da").text("Tu reserva: " + info.event.title);
      $(".texto-form-header-da").attr(
        "title",
        "Tu reserva: " + info.event.title
      );
    } else {
      $(".texto-form-header-da").text("Reserva: " + info.event.title);
      $(".texto-form-header-da").attr("title", "Reserva: " + info.event.title);
    }
  } else {
    if (info.event.classNames == id_usu_ingresado) {
      $(".texto-form-header-da").text(
        "Tu reserva de la formacion: " + info.event.title
      );
      $(".texto-form-header-da").attr(
        "title",
        "Tu reserva de la formacion: " + info.event.title
      );
    } else {
      $(".texto-form-header-da").text(
        "Reserva de la formacion: " + info.event.title
      );
      $(".texto-form-header-da").attr(
        "title",
        "Reserva de la formacion: " + info.event.title
      );
    }
  }
  var contenedor_ru = document.querySelector(".cont-form-edit-da");
  var idRol = contenedor_ru.getAttribute("data-rol_usua");
  $(".form-da").removeClass("mostra-opcion-form-da");
  if (idRol == 1) {
    $(".insertar-form-da").addClass("oculta-cont-input-form");
    $(".actuali-form-da").removeClass("oculta-cont-input-form");
    $(".form-edit-da").addClass("mostra-opcion-form-da");
    mostrasReserva_actuali(info.event.id, idRol);
  } else {
    $(".insertar-form-da").addClass("oculta-cont-input-form");
    $(".actuali-form-da").remove();
    $(".mostrar-reserva-usua").addClass("mostra-opcion-form-da");
    mostrasReserva_actuali(info.event.id, idRol);
  }
  $(".dis-reserva-da > button").attr("data-reserva_dis", info.event.id);
}

function mostrar_horas_dis_reser(event) {
  if (event.value == "otra_hora") {
    $(".horas_dis_reser").removeClass(" oculta-cont-input-form");
  } else {
    $(".horas_dis_reser").addClass(" oculta-cont-input-form");
  }
}

function mostrar_dispo_reser(event) {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");

  $("#form-da-fechai-reser-dis").val("");
  $("#form-da-fechaf-reser-dis").val("");
  $("#form-da-motivo-reser-dis").val("");
  $("#form-da-jornada-reser-dis").val("1");
  $("#form-da-horai-reser-dis").val("");
  $("#form-da-horaf-reser-dis").val("");
  $(".form-edit-da").removeClass("mostra-opcion-form-da");
  $(".mostrar-reserva-usua").removeClass("mostra-opcion-form-da");
  $(".dias_reserva_dispo").addClass("mostra-opcion-form-da");
  event.classList.add("mostrar_presionado-reserva-dis");
  $(".acciones-form-edit-da").addClass("oculta-cont-input-form");
  $(".cont-form-edit-da").css("height", "93%");
  var id_reserva = $(".dis-reserva-da > button").attr("data-reserva_dis");

  $.ajax({
    url: "php/reserva_dis.php",
    type: "POST",
    data: { id_reserva: id_reserva },
    dataType: "json",
    success: function (res) {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");

      $(".lista-reser-dispo").remove();

      document
        .querySelector(".liberal_dias_reser")
        .removeEventListener("click", liberal_dias_reser);
      document
        .querySelector(".liberal_dias_reser")
        .addEventListener("click", liberal_dias_reser);

      if (res == "") {
        $(".fechas_reser_disponi").addClass("oculta-cont-input-form");
        $(".no_existe_reser_dis").removeClass("oculta-cont-input-form");
        return;
      }
      var contenedor_ru = document.querySelector(".cont-form-edit-da");
      var idRol = contenedor_ru.getAttribute("data-rol_usua");
      if (idRol != 1) {
        $(".agg-reserva-dispo").remove();
      }

      res.forEach((element) => {
        const lista_dispo_reser = $(
          "<li class='lista-reser-dispo'><b>Fechas libres: </b> De <b>" +
            element.fecha_inicio_reporte +
            " </b> a <b>" +
            element.fecha_fin_reporte +
            "</b>, Motivo: <i></i>" +
            element.motivo +
            ".</li>"
        );
        $(".fechas_reser_disponi").append(lista_dispo_reser);
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function liberal_dias_reser() {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");

  var horas_dis_reser = document.querySelector(".horas_dis_reser");
  var datos = {};
  var camposLlenos_reser_dis = true;

  $(".input-reser-dis").each(function () {
    var input = $(this);
    var inputId = input.attr("id");
    var inputValue = input.val();

    if (
      inputId == "form-da-horai-reser-dis" ||
      inputId == "form-da-horaf-reser-dis"
    ) {
      if (horas_dis_reser.classList.contains("oculta-cont-input-form")) {
        return;
      }
    } else if (inputValue == "otra_hora") {
      return;
    }

    if (inputValue.trim() === "") {
      camposLlenos_reser_dis = false;
      return false;
    }

    datos[inputId] = inputValue;
  });

  if (!camposLlenos_reser_dis) {
    alert("¡Completa todos los campos.!");
    $(".cargando-da").removeClass("mostrar-contenedor-op");
    $(".cargando-da").css("z-index", "0");
    return;
  }
  var id_reserva = $(".dis-reserva-da > button").attr("data-reserva_dis");
  var id_usu_ingresado = $("#estado-ambi").attr("data-id_usuario");
  $.ajax({
    url: "php/liberar_reser_dis.php",
    type: "POST",
    data: {
      datos: datos,
      id_reserva: id_reserva,
      id_usu_ingresado: id_usu_ingresado,
    },
    dataType: "json",
    success: function (res) {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");

      if (!res.res) {
        if (res.estado_fecha == "fuera_reser") {
          toastr.error("Los dias salen del rango de los dias de la reserva.");
        } else if (res.estado_fecha == "nocon") {
          toastr.warning("Las fechas no tienen un orden.");
        } else if (res.estado_hora == "nocon") {
          toastr.warning("Las horas no tienen un orden.");
        }
        if (res.estado_hora == "fuera_reser") {
          toastr.error("Las horas salen del rango de las horas de la reserva.");
        }
      } else {
        toastr.success("Dias liberados con exito.");
        asig_ambi();
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function mostrasReserva_actuali(id_reserva, idRol) {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");
  $(".estado-reserva-da").attr("data-id_rer", id_reserva);
  $(".acciones-actua-reser-da").css("display", "flex");
  $.ajax({
    url: "php/info_usu.php",
    type: "POST",
    data: { id_reserva: id_reserva, actuali: true },
    dataType: "json",
    success: function (res) {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");

      if (res.disponibilidad) {
        $(".dis-reserva-da>p").text(
          "Reserva libre para las fechas: " + res.disponibilidad
        );
      }

      if (res.datos_reserva.estado_ambiente == "2") {
        $(".estado-reserva-da").css("background-color", "#D71313");
        $(".estado-reserva-da").attr("title", "Ocupado");
        $(".estado-reserva-da").attr("id", 2);
      } else {
        $(".estado-reserva-da").css("background-color", "#FFC436");
        $(".estado-reserva-da").attr("title", "Pendiente");
        $(".estado-reserva-da").attr("id", 1);
      }

      var fechaHoraObjetoi = new Date(res.datos_reserva.fecha_inicio);

      var fechai = fechaHoraObjetoi.toISOString().slice(0, 10);
      var horai = fechaHoraObjetoi.toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
      });

      var fechaHoraObjetof = new Date(res.datos_reserva.fecha_fin);

      var fechaf = fechaHoraObjetof.toISOString().slice(0, 10);
      var horaf = fechaHoraObjetof.toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
      });
      if (idRol == 1) {
        if (!res.disponibilidad) {
          $(".dis-reserva-da>p").css("display", "none");
        } else {
          $(".dis-reserva-da>p").css("display", "flex");
        }
        if (res.datos_reserva.numero_ficha == 1) {
          $("#form-da-motivo").val(res.datos_reserva.motivo);
          $("#form-da-Tocu").val("reunion-corta");
          $(".cont-input-nomF-numF").addClass("oculta-cont-input-form");
          $(".cont-input-motivo").removeClass("oculta-cont-input-form");

          if (res.datos_reserva.jornada == 1) {
            $("#form-da-jornada").val("otra_jorna");
            $("#form-da-horai").val(horai);
            $(".cont-input-horas").removeClass("oculta-cont-input-form");
            $("#form-da-horaf").val(horaf);
          } else {
            $("#form-da-jornada").val(res.datos_reserva.jornada);
            $(".cont-input-horas").addClass("oculta-cont-input-form");
          }
        } else {
          $("#form-da-Tocu").val("formacion");
          $("#form-da-numF").val(res.datos_reserva.numero_ficha);
          $("#form-da-nomF").val(res.datos_reserva.formacion);
          $(".cont-input-nomF-numF").removeClass("oculta-cont-input-form");
          $(".cont-input-motivo").addClass("oculta-cont-input-form");
          $("#form-da-jornada").val(res.datos_reserva.jornada);
          $(".cont-input-horas").addClass("oculta-cont-input-form");
        }

        $("#form-da-fechai").val(fechai);
        $("#form-da-fechaf").val(fechaf);
        $("#form-da-usua").val(res.datos_reserva.idusuario);
        document
          .querySelector(".actuali-form-da")
          .removeEventListener("click", insertar_reserva);
        document
          .querySelector(".actuali-form-da")
          .addEventListener("click", insertar_reserva);
        document
          .querySelector(".estado-reserva-da")
          .removeEventListener("click", cambiar_estado_actua_reser);
        document
          .querySelector(".estado-reserva-da")
          .addEventListener("click", cambiar_estado_actua_reser);
      } else {
        if (!res.disponibilidad) {
          $(".dis-reserva-da").css("display", "none");
        } else {
          $(".dis-reserva-da").css("display", "flex");
        }
        if (res.datos_reserva.numero_ficha == 1) {
          $("#form-da-motivo-usu>p").text(res.datos_reserva.motivo);
          $("#form-da-Tocu-usu").text("Reunion corta");
          $(".cont-input-nomF-numF").addClass("oculta-cont-input-form");
          $(".cont-input-motivo").removeClass("oculta-cont-input-form");

          if (res.datos_reserva.jornada == 1) {
            $("#form-da-jornada-usu").text("Otra jornada");
            $("#form-da-horai-usu").text(horai);
            $(".cont-input-horas").removeClass("oculta-cont-input-form");
            $("#form-da-horaf-usu").text(horaf);
          } else {
            var jornadaUsu = null;
            if (res.datos_reserva.jornada == 1) {
              jornadaUsu = "Mañana";
            } else if (res.datos_reserva.jornada == 2) {
              jornadaUsu = "Tarde";
            } else if (res.datos_reserva.jornada == 3) {
              jornadaUsu = "Noche";
            }
            $("#form-da-jornada-usu").val(jornadaUsu);
            $(".cont-input-horas").addClass("oculta-cont-input-form");
          }
        } else {
          var jornadaUsu = null;
          if (res.datos_reserva.jornada == 1) {
            jornadaUsu = "Mañana";
          } else if (res.datos_reserva.jornada == 2) {
            jornadaUsu = "Tarde";
          } else if (res.datos_reserva.jornada == 3) {
            jornadaUsu = "Noche";
          }

          $("#form-da-Tocu-usu").text("Formación");
          $("#form-da-numF-usu").text(res.datos_reserva.numero_ficha);
          $("#form-da-nomF-usu>p").text(res.datos_reserva.formacion);
          $(".cont-input-nomF-numF").removeClass("oculta-cont-input-form");
          $(".cont-input-motivo").addClass("oculta-cont-input-form");
          $("#form-da-jornada-usu").text(jornadaUsu);
          $(".cont-input-horas").addClass("oculta-cont-input-form");
        }

        $("#form-da-fechai-usu").text(fechai);
        $("#form-da-fechaf-usu").text(fechaf);
        $("#form-da-usua-usu").text("" + res.datos_reserva.idusuario + "");
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function cambiar_estado_actua_reser() {
  if (this.style.backgroundColor == "rgb(255, 196, 54)") {
    return;
  } else {
    this.classList.toggle("cambiar_estado_actua_reser");
    if (this.classList.contains("cambiar_estado_actua_reser")) {
      this.setAttribute("id", 3);
      this.setAttribute("title", "Disponible");
    } else {
      this.setAttribute("id", 2);
      this.setAttribute("title", "Ocupado");
    }
  }
}

function mostrarOpcionTasig() {
  valor = $(this).val();
  if (valor == "formacion") {
    $(".cont-input-nomF-numF").removeClass("oculta-cont-input-form");
    $(".cont-input-motivo").addClass("oculta-cont-input-form");
  } else {
    $(".cont-input-nomF-numF").addClass("oculta-cont-input-form");
    $("#form-da-jornada").val("otra_jorna");
    $(".cont-input-horas").removeClass("oculta-cont-input-form");
    $(".cont-input-motivo").removeClass("oculta-cont-input-form");
  }
}

function mostrarOpcionjornada() {
  valor = $(this).val();
  if (valor == "otra_jorna") {
    $(".cont-input-horas").removeClass("oculta-cont-input-form");
  } else {
    $(".cont-input-horas").addClass("oculta-cont-input-form");
  }
  mostrarEstadoReser_form();
}

function insertar_reserva() {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");
  var clase_boton = this.classList;
  var editar_reser = null;
  var id_reserva = null;
  if (clase_boton.contains("actuali-form-da")) {
    editar_reser = document.querySelector(".estado-reserva-da").id;
    id_reserva = $(".estado-reserva-da").attr("data-id_rer");
  }
  var contenedor_ru = document.querySelector(".cont-form-edit-da");
  var idRol = contenedor_ru.getAttribute("data-rol_usua");
  var contInputNomFNumF = document.querySelector(".cont-input-nomF-numF");
  var contInputHoras = document.querySelector(".cont-input-horas");
  var contFormDaMotivo = document.querySelector(".cont-input-motivo");
  var contenedor_ru = document.querySelector(".menu-inve-ambi");
  var id_ambiente = contenedor_ru.getAttribute("data-id_ambiente");

  if (idRol == 3) {
    $(".cargando-da").removeClass("mostrar-contenedor-op");
    $(".cargando-da").css("z-index", "0");
    toastr.warning("El celador no puede reservar un ambiente.");
    return;
  }

  var datos = {};
  var camposLlenos = true;

  $(".input-enviar-form").each(function () {
    var input = $(this);
    var inputId = input.attr("id");
    var inputValue = input.val();

    if (inputId == "form-da-numF" || inputId == "form-da-nomF") {
      if (contInputNomFNumF.classList.contains("oculta-cont-input-form")) {
        return;
      }
    } else if (inputId == "form-da-horai" || inputId == "form-da-horaf") {
      if (contInputHoras.classList.contains("oculta-cont-input-form")) {
        return;
      }
    } else if (inputId == "form-da-motivo") {
      if (contFormDaMotivo.classList.contains("oculta-cont-input-form")) {
        datos[inputId] = "Formación";
        camposLlenos = true;
        return;
      }
    } else if (inputId == "form-da-usua") {
      if (idRol != 1) {
        datos[inputId] = idRol;
        return;
      }
    } else if (inputValue == "otra_jorna") {
      return;
    }

    if (inputValue.trim() === "") {
      camposLlenos = false;
      return false;
    }

    datos[inputId] = inputValue;
  });

  if (!camposLlenos) {
    alert("¡Completa todos los campos.!");
    $(".cargando-da").removeClass("mostrar-contenedor-op");
    $(".cargando-da").css("z-index", "0");
    return;
  }
  $.ajax({
    url: "php/agregar_reserva.php",
    type: "POST",
    data: {
      id_ambiente: id_ambiente,
      datos: datos,
      editar_reser: editar_reser,
      id_reserva: id_reserva,
    },
    dataType: "json",
    success: function (res) {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");
      if (!res.res) {
        if (res.editar_reser) {
          toastr.success("Reserva actualizada con exito.");
          asig_ambi();
        }
        if (res.estado_fecha == "ocu") {
          toastr.error("Ambiente ocupado para estas fechas.");
        } else if (res.estado_fecha == "ant") {
          toastr.warning(
            "No puedes reservar un ambiente para una fecha anterior de la actual."
          );
        } else if (res.estado_fecha == "nocon") {
          toastr.warning("Las fechas no tienen un orden.");
        } else if (res.estado_fecha == "fechamastri") {
          toastr.error("No se permite reservar ambientes mayor a un trimeste.");
        } else if (res.estado_fecha == "igualfechausua") {
          toastr.error("No puedes resevar dos veces para una misma fecha.");
        }
        if (res.estado_hora == "ocu") {
          toastr.error("Ambiente ocupado para estas horas.");
        } else if (res.estado_hora == "ant") {
          toastr.warning(
            "No puedes reservar un ambiente para una hora anterior de la actual."
          );
        } else if (res.estado_hora == "alc") {
          toastr.warning(
            "La hora seleccionada está fuera del rango permitido (5:00 AM - 10:00 PM)."
          );
        } else if (res.estado_hora == "nocon") {
          toastr.warning("Las horas no tienen un orden.");
        }
        if (res.inac) {
          toastr.error("Usuarios inactivo, no puedes reservar ambientes.");
        }
      } else {
        toastr.success("Ambiente reservado con exito.");
        asig_ambi();
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function inve_ambi() {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");
  elementosInve = document.querySelectorAll(".inve-celdas");
  elementosInve.forEach((element, index) => {
    element.style.boxShadow = "none";
  });
  $(".boton-fun-inve").removeClass("activar-acciones-inve");
  $(".reset-aia>svg").css("fill", "rgba(0, 0, 0, 1)");
  var contenedor = document.querySelector(".menu-inve-ambi");
  const idAmbiente = contenedor.getAttribute("data-id_ambiente");

  $.ajax({
    url: "php/inve_ambie.php",
    type: "POST",
    data: { idAmbiente: idAmbiente },
    dataType: "json",
    success: function (datos_inve_ambie) {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");
      mostrarDatosInve_ambi(datos_inve_ambie);
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function mostrarDatosInve_ambi(datos) {
  $(".cont-fun-agg-inve").css("display", "none");
  $(".form-inve-celdas").remove();
  if (
    datos.aire_acondicionado != 0 ||
    datos.computador != 0 ||
    datos.mesa != 0 ||
    datos.silla != 0 ||
    datos.tv != 0
  ) {
    elementosInve = document.querySelectorAll(".inve-celdas");
    botonFunInve = document.querySelectorAll(".boton-fun-inve");
    $(".no_existe-inve").addClass("elim-inve-celdas");
    elementosInve.forEach((element, index) => {
      if (index !== elementosInve.length - 1) {
        element.classList.remove("elim-inve-celdas");
      }
    });
    botonFunInve.forEach((element, index) => {
      element.classList.remove("elim-inve-celdas");
    });
    var validacion_agg_inve = false;
    $(".agg-aia>option").remove();
    $(".agg-aia").append("<option value=' '>AGREGAR ELEMENTOS</option>");
    if (datos.aire_acondicionado != 0) {
      $(".inve-aire-a").text(datos.aire_acondicionado);
    } else {
      $(".inve-aire-a").text(datos.aire_acondicionado);
      $(".cont-aire-a").addClass("elim-inve-celdas");
      optionAireInve = $(
        "<option value='inve-aire-a'>Aires acondicionados</option>"
      );
      $(".agg-aia").append(optionAireInve);
      validacion_agg_inve = true;
    }
    if (datos.computador != 0) {
      $(".inve-pc").text(datos.computador);
    } else {
      $(".inve-pc").text(datos.computador);
      $(".cont-pc").addClass("elim-inve-celdas");
      optionAireInve = $("<option value='inve-pc'>Computadoras</option>");
      $(".agg-aia").append(optionAireInve);
      validacion_agg_inve = true;
    }
    if (datos.mesa != 0) {
      $(".inve-mesas").text(datos.mesa);
    } else {
      $(".inve-mesas").text(datos.mesa);
      $(".cont-mesas").addClass("elim-inve-celdas");
      optionAireInve = $("<option value='inve-mesas'>Mesas</option>");
      $(".agg-aia").append(optionAireInve);
      validacion_agg_inve = true;
    }
    if (datos.silla != 0) {
      $(".inve-sillas").text(datos.silla);
    } else {
      $(".inve-sillas").text(datos.silla);
      $(".cont-sillas").addClass("elim-inve-celdas");
      optionAireInve = $("<option value='inve-sillas'>Sillas</option>");
      $(".agg-aia").append(optionAireInve);
      validacion_agg_inve = true;
    }
    if (datos.tv != 0) {
      $(".inve-tv").text(datos.tv);
    } else {
      $(".inve-tv").text(datos.tv);
      $(".cont-tv").addClass("elim-inve-celdas");
      optionAireInve = $("<option value='inve-tv'>Televisores</option>");
      $(".agg-aia").append(optionAireInve);
      validacion_agg_inve = true;
    }
    if (!validacion_agg_inve) {
      $(".agg-aia").addClass("elim-inve-celdas");
    }
    fun_elemen_inve();
  } else {
    elementosInve = document.querySelectorAll(".inve-celdas");
    botonFunInve = document.querySelectorAll(".boton-fun-inve");
    $(".no_existe-inve").removeClass("elim-inve-celdas");
    elementosInve.forEach((element, index) => {
      if (index !== elementosInve.length - 1) {
        element.classList.add("elim-inve-celdas");
      }
    });
    botonFunInve.forEach((element, index) => {
      element.classList.add("elim-inve-celdas");
    });
  }
}

function fun_elemen_inve() {
  // Elimina los event listeners anteriores
  var aumeCantInve = document.querySelectorAll(".aume-cant-inve");
  aumeCantInve.forEach((aumentar) => {
    aumentar.removeEventListener("click", aumentarCantidad);
    aumentar.addEventListener("click", aumentarCantidad);
  });

  var dismiCantInve = document.querySelectorAll(".dismi-cant-inve");
  dismiCantInve.forEach((disminuir) => {
    disminuir.removeEventListener("click", disminuirCantidad);
    disminuir.addEventListener("click", disminuirCantidad);
  });

  resetAia = document.querySelector(".reset-aia");
  resetAia.removeEventListener("click", resetearInve);
  resetAia.addEventListener("click", resetearInve);

  actuAia = document.querySelector(".actu-aia");
  actuAia.removeEventListener("click", actuaInve);
  actuAia.addEventListener("click", actuaInve);

  aggAia = document.querySelector(".agg-aia");
  aggAia.removeEventListener("change", aggElemInve);
  aggAia.addEventListener("change", aggElemInve);
}

function aumentarCantidad() {
  var contenedor = this.parentElement.parentElement.parentElement;
  contenedor.style.boxShadow = "0px 0px 5px 0px rgb(0 0 0 / 30%)";
  const pElement = this.parentElement.parentElement.querySelector("p");
  const texto = pElement.textContent;
  const cantidad = parseInt(texto) + 1;
  pElement.textContent = cantidad;
  $(".boton-fun-inve").addClass("activar-acciones-inve");
  $(".reset-aia>svg").css("fill", "#ffffff");
}

function disminuirCantidad() {
  var contenedor = this.parentElement.parentElement.parentElement;
  contenedor.style.boxShadow = "0px 0px 5px 0px rgb(0 0 0 / 30%)";
  const pElement = this.parentElement.parentElement.querySelector("p");
  const texto = pElement.textContent;

  if (texto == 1) {
    contenedor_borrar = this.parentElement.parentElement.parentElement;
    contenedor_borrar.classList.add("elim-inve-celdas");
  }

  const cantidad = parseInt(texto) - 1;
  pElement.textContent = cantidad;
  $(".boton-fun-inve").addClass("activar-acciones-inve");
  $(".reset-aia>svg").css("fill", "#ffffff");
}

function resetearInve() {
  var existe = document.querySelector(".activar-acciones-inve");
  if (existe) {
    inve_ambi();
  }
}

function actuaInve() {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");
  var existe = document.querySelector(".activar-acciones-inve");
  if (!existe) {
    $(".cargando-da").removeClass("mostrar-contenedor-op");
    $(".cargando-da").css("z-index", "0");
    return;
  }
  pregunta = confirm("¿Estás seguro de actualizar el inventario?.");
  if (!pregunta) {
    $(".cargando-da").removeClass("mostrar-contenedor-op");
    $(".cargando-da").css("z-index", "0");
    return;
  }
  datos_nuevos = [];
  var cantidInve = document.querySelectorAll(".inve-celdas>span>p");
  cantidInve.forEach((element) => {
    datos_nuevos.push(element.textContent);
  });

  var contenedor = document.querySelector(".menu-inve-ambi");
  const idAmbiente = contenedor.getAttribute("data-id_ambiente");

  $.ajax({
    url: "php/act_inve_ambie.php",
    type: "POST",
    data: {
      idAmbiente: idAmbiente,
      sillas: datos_nuevos[0],
      mesas: datos_nuevos[1],
      tv: datos_nuevos[2],
      aire_a: datos_nuevos[3],
      pc: datos_nuevos[4],
    },
    success: function () {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");
      inve_ambi();
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}

function aggElemInve() {
  valor = this.value;
  elementoInve = null;
  svgInve = null;

  if (valor == "inve-aire-a") {
    elementoInve = "Aires acondicionados";
    svgInve =
      '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M13 5.5C13 3.57 11.43 2 9.5 2 7.466 2 6.25 3.525 6.25 5h2c0-.415.388-1 1.25-1 .827 0 1.5.673 1.5 1.5S10.327 7 9.5 7H2v2h7.5C11.43 9 13 7.43 13 5.5zm2.5 9.5H8v2h7.5c.827 0 1.5.673 1.5 1.5s-.673 1.5-1.5 1.5c-.862 0-1.25-.585-1.25-1h-2c0 1.475 1.216 3 3.25 3 1.93 0 3.5-1.57 3.5-3.5S17.43 15 15.5 15z"></path><path d="M18 5c-2.206 0-4 1.794-4 4h2c0-1.103.897-2 2-2s2 .897 2 2-.897 2-2 2H2v2h16c2.206 0 4-1.794 4-4s-1.794-4-4-4zM2 15h4v2H2z"></path></svg>';
  } else if (valor == "inve-pc") {
    elementoInve = "Computadoras";
    svgInve =
      '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M20 17.722c.595-.347 1-.985 1-1.722V5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2v11c0 .736.405 1.375 1 1.722V18H2v2h20v-2h-2v-.278zM5 16V5h14l.002 11H5z"></path></svg>';
  } else if (valor == "inve-mesas") {
    elementoInve = "Mesas";
    svgInve =
      '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M4 21h15.893c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zm0-2v-5h4v5H4zM14 7v5h-4V7h4zM8 7v5H4V7h4zm2 12v-5h4v5h-4zm6 0v-5h3.894v5H16zm3.893-7H16V7h3.893v5z"></path></svg>';
  } else if (valor == "inve-sillas") {
    elementoInve = "Sillas";
    svgInve =
      '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M19 13V4c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2v9a1 1 0 0 0-1 1v8h2v-5h12v5h2v-8a1 1 0 0 0-1-1zm-2-9v9h-2V4h2zm-4 0v9h-2V4h2zM7 4h2v9H7V4z"></path></svg>';
  } else if (valor == "inve-tv") {
    elementoInve = "Televisores";
    svgInve =
      '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M20 6h-5.586l2.293-2.293-1.414-1.414L12 5.586 8.707 2.293 7.293 3.707 9.586 6H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0-2-.897-2-2V8c0-1.103-.897-2-2-2z"></path></svg>';
  } else if (valor == " ") {
    alert("¡Escoge un elemento a agregar!");
    return;
  }

  contFormInve = $(
    '<span class="form-inve-celdas"><h3 class="nom-inve">' +
      elementoInve +
      "</h3> <span><span>" +
      svgInve +
      '</span>  <input type="number" min="1" max="100" id="input-agg-inve"></span></span>'
  );
  $(".cont-inve").append(contFormInve);
  $(".agg-aia").addClass("elim-inve-celdas");
  $("#input-agg-inve").focus();
  $(".cont-fun-agg-inve").css("display", "flex");

  var inputAggInve = document.querySelector("#input-agg-inve");
  inputAggInve.removeEventListener("input", validar_ing_num_agg_inve);
  inputAggInve.addEventListener("input", validar_ing_num_agg_inve);
}

function validar_ing_num_agg_inve() {
  var valor = $(this).val();

  var numero = parseInt(valor, 10);

  if (isNaN(numero) || numero < 1 || numero > 100) {
    $(this).val("");
  }
}

function cancelar_agg_inve() {
  $(".cont-fun-agg-inve").css("display", "none");
  $(".form-inve-celdas").remove();
  $(".agg-aia").removeClass("elim-inve-celdas");
}

function agregarElemAInve() {
  $(".cargando-da").addClass("mostrar-contenedor-op");
  $(".cargando-da").css("z-index", "3");
  var inputAggInve = $("#input-agg-inve").val();
  if (inputAggInve == "") {
    $(".cargando-da").removeClass("mostrar-contenedor-op");
    $(".cargando-da").css("z-index", "0");
    alert("¡Ingresa un valor en el elemento!");
    return;
  }
  valor = $(".agg-aia").val();
  datos_nuevos = [];
  cantidInve = document.querySelectorAll(".inve-celdas>span>p");
  cantidInve.forEach((element) => {
    clasePInve = element.classList;
    if (valor == clasePInve) {
      datos_nuevos.push(inputAggInve);
      return;
    }
    datos_nuevos.push(element.textContent);
  });

  var contenedor = document.querySelector(".menu-inve-ambi");
  const idAmbiente = contenedor.getAttribute("data-id_ambiente");

  $.ajax({
    url: "php/act_inve_ambie.php",
    type: "POST",
    data: {
      idAmbiente: idAmbiente,
      sillas: datos_nuevos[0],
      mesas: datos_nuevos[1],
      tv: datos_nuevos[2],
      aire_a: datos_nuevos[3],
      pc: datos_nuevos[4],
    },
    success: function () {
      $(".cargando-da").removeClass("mostrar-contenedor-op");
      $(".cargando-da").css("z-index", "0");
      inve_ambi();
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}
