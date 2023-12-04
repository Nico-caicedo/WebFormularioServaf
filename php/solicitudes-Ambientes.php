<?php
include('Conexion.php');
date_default_timezone_set('America/Bogota');
$fecha_actual = date("Y-m-d");
$hora_actual = date("H:i:s");
$query = "SELECT * FROM asignacion 
    INNER JOIN ambiente ON asignacion.idambiente = ambiente.idambiente
    INNER JOIN jornadas ON asignacion.jornada = jornadas.id_jornada
    INNER JOIN usuario ON asignacion.idusuario = usuario.idusuario
    WHERE asignacion.estado_ambiente='1'";
$resultado = $conexion->query($query);

$nuevas_solicitudes = array();
$sin_responder_solicitudes = array();
$existen_nue = false;
$existen_sin = false;
if ($resultado) {
    if (mysqli_num_rows($resultado) > 0) {
        while ($solicitud = mysqli_fetch_assoc($resultado)) {
            $fecha_inicio = $solicitud["fecha_inicio"];
            $imgA = $solicitud["img"];
            $imagenAmbiente = 'imgambientes/' . $imgA;

            $fecha_inicio_timestamp = strtotime($fecha_inicio);
            $fecha_actual_timestamp = strtotime($fecha_actual . ' ' . $hora_actual);

            if ($fecha_actual_timestamp < $fecha_inicio_timestamp) {
                $nuevas_solicitudes[] = $solicitud;
                $existen_nue = true;
            } else {
                $existen_sin = true;
                $sin_responder_solicitudes[] = $solicitud;
            }
        }
        if ($existen_nue) {
            ?>
            <?php
            foreach ($nuevas_solicitudes as $solicitud) {
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
                                <img src="<?php echo $imagenAmbiente ?>" alt="">
                            </div>
                        </section>
                    </section>
                </section>
                <!-- <div class="solicitudes">
                    <div class="solicitud" data-id="<?php echo $solicitud['idsolicitud']; ?>">
                        <h2>Ambiente:
                            <?php echo $solicitud['nombre_ambiente']; ?>
                        </h2>
                        <p><strong>Formacion:</strong>
                            <?php echo $solicitud['formacion']; ?>
                        </p>
                        <p><strong>Jornada:</strong>
                            <?php echo $solicitud['jornada']; ?>
                        </p>
                        <p><strong>Ficha:</strong>
                            <?php echo $solicitud['numero_ficha']; ?>
                        </p>
                        <p><strong>Fecha y hora para cuando lo quieren:</strong>
                            <?php echo $solicitud['fecha_inicio']; ?>
                        </p>

                        <div class="razon-rechazo" style="display: none;">
                            <label for="razon">Razón de Rechazo:</label>
                            <textarea id="razon" rows="4"></textarea>
                            <button class="enviar-razon-btn">Enviar Razón</button>
                        </div>
                        <div class="afi">
                            <button class="ver-detalles-btn si">Aceptar Solicitud</button>
                            <button class="rechazarSolicitud-btn no">Rechazar Solicitud</button>
                        </div>
                    </div>
                    <div class="contenedor-perfil">
                        <img class="imagen" src="<?php echo $imagenAmbiente ?>" ondblclick="mostrarImagenAmpliada(this)"
                                    onclick="cerrarImagen(this)">
                        <div class="datos">
                            <p><strong>Nombre:</strong>
                                <?php echo $solicitud['nombre_usuario']; ?>
                            </p>
                            <p><strong>Rol:</strong>
                                <?php echo $solicitud['nombre_ambiente']; ?>
                            </p>
                            <p><strong>Correo:</strong>
                                <?php echo "<p class='correo'>" . $solicitud['correo'] . "</p>" ?>
                            </p>
                        </div>
                    </div>
                </div> -->
                <?php
            }
        } else {
            ?>
            <div class="ACTUA">
                <h1>No hay solicitudes nuevas</h1><br>
            </div>
            <?php
        }
        if ($existen_sin) {
            ?>
            <section class="responderSIN" id="responderSIN">
                <header>
                    <div>
                        <h2>Solicitudes sin responder</h2>
                    </div>
                    <div id="x">
                        X
                    </div>
                </header>
                <br><br>
                <section class="scroll2">
                    <?php
                    foreach ($sin_responder_solicitudes as $solicitud) {
                        ?>
                        <div class="solicitudespush">
                            <div class="solicitud_sin">
                                <h2>Ambiente:
                                    <?php echo $solicitud['nombre_ambiente']; ?>
                                </h2>
                                <p><strong>Formacion:</strong>
                                    <?php echo $solicitud['formacion']; ?>
                                </p>
                                <p><strong>Jornada:</strong>
                                    <?php echo $solicitud['jornada']; ?>
                                </p>
                                <p><strong>Ficha:</strong>
                                    <?php echo $solicitud['numero_ficha']; ?>
                                </p>
                                <p><strong>Fecha y hora para cuando lo quieren:</strong>
                                    <?php echo $solicitud['fecha_inicio']; ?>
                                </p>

                            </div>
                            <div class="contenedor-perfil">
                                <img class="imagen" src="<?php echo $imagenAmbiente ?>" ondblclick="mostrarImagenAmpliada(this)"
                                    onclick="cerrarImagen(this)">
                                <div class="datos">
                                    <p><strong>Nombre:</strong>
                                        <?php echo $solicitud['nombre_usuario']; ?>
                                    </p>
                                    <p><strong>Rol:</strong>
                                        <?php echo $solicitud['nombre_ambiente']; ?>
                                    </p>
                                    <p><strong>Correo:</strong>
                                        <?php echo "<p class='correo'>" . $solicitud['correo'] . "</p>" ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </section>
            </section>
            <?php
        }
    } else {
        echo "Actualmente no existen solcitudes pendientes por atender en el sistema";
    }

}
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
                    document.getElementById('cetaba-cares').style.display = "flex";
                    $('#cetaba-cares').html(response)
                },
                error: function (error) {
                    console.error("Error en la solicitud AJAX: " + error);
                }
            });
        });
    });




    $(document).ready(function () {
        $('#fecha, #jornadas, #pisos').on('change', function () {
            var fecha = $('#fecha').val();
            var jornada = $('#jornadas').val();
            var piso = $('#pisos').val();

            $.ajax({
                url: 'php/filtrarSolicitudes.php',
                method: 'POST',
                data: { fecha: fecha, jornada: jornada, piso: piso },
                success: function (response) {
                    $('#cases').html(response);
                },
                error: function () {
                    alert('Error al cargar las solicitudes filtradas');
                }
            });
        });
        // $('#limpiarFiltros').on('click', function () {
        //     // Limpiar los valores de los filtros
        //     $('#fecha').val('');
        //     $('#jornadas').val('#');
        //     $('#pisos').val('#');

        //     // Eliminar las solicitudes filtradas
        //     $('#cases').empty();
        // });
    });


    $(document).ready(function () {
        // Guardar los valores por defecto de los campos de entrada
        var fechaPorDefecto = $('#fecha').val();
        var jornadaPorDefecto = $('#jornadas').val();
        var pisoPorDefecto = $('#pisos').val();

        $('#limpiarFiltros').on('click', function () {
            var valor = $('#valorNulo').val();
            // Restablecer los valores de los campos de entrada a sus valores por defecto
            $('#fecha').val(fechaPorDefecto);
            $('#jornadas').val(jornadaPorDefecto);
            $('#pisos').val(pisoPorDefecto);

            $.ajax({
                url: 'php/filtrarSolicitudes.php', // Reemplaza con la URL correcta de tu archivo PHP de filtrado
                method: 'POST',
                data: { valor: valor },
                success: function (response) {
                    $('#cases').html(response);
                },
                error: function () {
                    alert('Error al cargar todas las solicitudes');
                }
            });
        });
    });

</script>