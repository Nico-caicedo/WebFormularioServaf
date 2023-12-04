<?php
include('Conexion.php');


if (isset($_POST["valor"])) {
   $query = "SELECT * FROM asignacion 
   INNER JOIN ambiente ON asignacion.idambiente = ambiente.idambiente
   INNER JOIN jornadas ON asignacion.jornada = jornadas.id_jornada
   INNER JOIN usuario ON asignacion.idusuario = usuario.idusuario
   WHERE asignacion.estado_ambiente='1'";

} else {
   $fecha = $_POST['fecha'];
   $jornada = $_POST['jornada'];
   $piso = $_POST['piso'];

   $query = "SELECT * FROM asignacion 
          INNER JOIN ambiente ON asignacion.idambiente = ambiente.idambiente
          INNER JOIN jornadas ON asignacion.jornada = jornadas.id_jornada
          INNER JOIN usuario ON asignacion.idusuario = usuario.idusuario
          WHERE asignacion.estado_ambiente='1'";

if ($fecha != "") {
   $query .= " AND (
       (asignacion.fecha_inicio >= '$fecha 00:00:00' AND asignacion.fecha_inicio <= '$fecha 23:59:59') OR
       (asignacion.fecha_fin >= '$fecha 00:00:00' AND asignacion.fecha_fin <= '$fecha 23:59:59') OR
       (asignacion.fecha_inicio <= '$fecha 00:00:00' AND asignacion.fecha_fin >= '$fecha 23:59:59')
   )";
}


   if ($jornada != "#") {
      $query .= " AND asignacion.jornada = $jornada";
   }

   if ($piso != "#") {
      $query .= " AND ambiente.piso_ambiente = $piso";
   }
}
$resultado = $conexion->query($query);

if ($resultado) {
   if (mysqli_num_rows($resultado) > 0) {
      while ($solicitud = mysqli_fetch_assoc($resultado)) {
         ?>
         <section class="card-storage solicitud" id="card-storage" data-id="<?php echo $solicitud['idsolicitud']; ?>">
                    <section class="card-contenido">
                        <section class="estade">
                            <div>NUEVO</div>
                        </section>
                        <section class="card-titulo">
                            <h3>
                                <?php echo $solicitud['nombre_ambiente']; ?>
                            </h3>
                            <p>
                                <?php echo $solicitud['numero_ambiente']; ?>
                            </p>
                        </section>
                        <section class="card-info">
                            <div>
                                <i class='bx bx-user'></i>
                                <?php echo $solicitud['nombre_usuario']; ?>

                            </div>
                            <div>
                                <i class='bx bxl-gmail'></i>
                                <?php echo "<p class='correo'>" . $solicitud['correo'] . "</p>" ?>
                            </div>
                            <div class="red">
                                <button class="enviar-card" id="miboton">Ver mas..</button>
                            </div>
                        </section>
                        <section class="card-img">
                            <div class="content-card">
                                <img src="<?php echo "imgambientes/".$solicitud["img"] ?>" alt="">
                            </div>
                        </section>
                    </section>
                </section>
         <?php
      }
   } else {
      echo "<h1>No hay solicitudes que coincidan con los filtros seleccionados</h1><br>";
   }
} else {
   echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos si es necesario
mysqli_close($conexion);
?>

<script>
   $(document).ready(function () {
        $(".enviar-card").click(function () {

            var dataId = $(this).closest(".solicitud").data("id");

            $.ajax({
                type: "POST", 
                url: "php/ventana-detalles.php",
                data: { id: dataId },
                success: function (response) {
                    document.getElementById('cetaba-cares').style.display= "flex";
                    $('#cetaba-cares').html(response)
                },
                error: function (error) {
                    console.error("Error en la solicitud AJAX: " + error);
                }
            });
        });
    });




</script>