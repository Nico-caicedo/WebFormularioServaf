function recibirDatos() {
  $.ajax({
    url: "php/info_ambie_pisos.php",
    type: "POST",
    dataType: "json",
    success: function (datos) {
      mostrarDatos(datos);
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
}
recibirDatos();

function mostrarDatos(datos) {
    $(".pisos>span>div>.pen").remove();
    $(".pisos>span>div>.ocu").remove();
    $(".pisos>span>div>.dis").empty();
    for (let piso = 1; piso <= 3; piso++) {
        var pen = null;
        var ocu = null;
        for (let estado = 1; estado <= 3; estado++) {
            let cantidad = datos.asignados[piso][estado - 1];
            if(cantidad > 0){
                $(".pi"+ piso +">span>div").css("display","flex");
                if(estado == 1){
                    pen = $("<p class='semaforo pen' title='Pendientes'>"+ cantidad +"</p>");
                }else if(estado == 2){
                    ocu = $("<p class='semaforo ocu' title='Ocupados'>"+ cantidad +"</p>");
                }else if(estado == 3){
                    $(".dis"+ piso +"").addClass("aggDis");
                    $(".pi"+ piso +">span>div>.dis").append(cantidad);
                }
            }
        }
        $(".pi"+ piso +">span>div").append(pen,ocu);
    }
    for (let piso in datos.noAsignados) {
        if (datos.noAsignados.hasOwnProperty(piso)) {
            let cantidadAmbientes = datos.noAsignados[piso].length;
            if(cantidadAmbientes>0){
                $(".dis" + piso + "").addClass("aggDis");
                let disContainer = $(".pi" + piso + ">span>div>.dis");
                $(".pi"+ piso +">span>div").css("display","flex");
                // Obtener la cantidad actual en la etiqueta y sumar la nueva cantidad
                let cantidadActual = parseInt(disContainer.text()) || 0;
                disContainer.text(cantidadActual + cantidadAmbientes);
            }
        }
    }
    for (let piso in datos.piso_ambie) {
        if (datos.piso_ambie.hasOwnProperty(piso)) {
            let cantidadAmbientes = datos.piso_ambie[piso].length;
            let disContainer = $(".pi" + piso + ">span>i");
            disContainer.empty();
            if(cantidadAmbientes>0){
                disContainer.text("Ambientes: "+cantidadAmbientes);
            }else{
                disContainer.text("Piso sin ambientes");
            }
        }
    }
}
