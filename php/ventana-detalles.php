<?php
include "Conexion.php";
setlocale(LC_TIME, 'es_ES.UTF-8');
$id = $_POST["id"];
$query = "SELECT * FROM asignacion 
    INNER JOIN ambiente ON asignacion.idambiente = ambiente.idambiente
    INNER JOIN jornadas ON asignacion.jornada = jornadas.id_jornada
    INNER JOIN inventario_ambiente ON asignacion.idambiente = inventario_ambiente.idambiente
    INNER JOIN usuario ON asignacion.idusuario = usuario.idusuario
    WHERE idsolicitud='$id'";
$resultado = $conexion->query($query);
$t = mysqli_fetch_assoc($resultado);
?>
<section class="contendor-cares" data-id="<?php echo $id ?>" id="forech">
        <section class="fecha-fer">
                <h2>Detalles de solicitud</h2>
                <div class="x">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAzElEQVRIS+1T2w2DMBCDDToKbEBHYANGYKMyQjfoCh2FEbAlqCDcC6GoP0G6D5LIPvt8dZX5qzPjV4XAdfjvFg1ocTLafOCuQ721N5YCgr9QX1QrABD8g2pQvUZiEewBUpL07gmCWVLhzUAiCYOT0CPgmxSQZ7SFqtTONzURgpSE/yHwqAKNQBr8aQwRBZZFLolHIA2UXW7x1CL8U3IlpvuBWhE+2BRdNCkttxeNnYyoSVuiNcKdtsVXUiQtaejMG3IIxHpUCFwLs1u0AGgKLRkwP5Q0AAAAAElFTkSuQmCC"
                                alt="">
                </div>
        </section>
        <header>
                <section class="img-cares">
                        <img src="<?php echo "imgambientes/" . $t['img']; ?>" alt="">
                </section>
                <section class="text-cares">
                        <h2>
                                <?php echo $t['nombre_ambiente']; ?>
                        </h2>
                        <div class="dives-ca">
                                <div>
                                        <h4>Numero</h4>
                                        <p>
                                                <?php echo $t['numero_ambiente']; ?>
                                        </p>
                                </div>
                                <div>
                                        <h4>Capacidad maxima</h4>
                                        <p>
                                                <?php echo $t['silla']; ?>
                                        </p>
                                </div>
                                <div>
                                        <h4>Estado</h4>
                                        <p>Solicitado</p>
                                </div>
                        </div>
                </section>
        </header>
        <section class="cuerpo-senturia">
                <section class="solicitante-conso">
                        <h2>Solicitante</h2>
                        <section class="curpos">
                                <div class="racu">
                                        <div>
                                                <i class='bx bx-user'></i>
                                        </div>
                                        <p>
                                                <?php echo $t['nombre_usuario']; ?>
                                        </p>
                                </div>
                                <div class="racu">
                                        <div>
                                                <i class='bx bxl-gmail'></i>
                                        </div>
                                        <p>
                                                <?php echo $t['correo']; ?>
                                        </p>
                                </div>
                                <div class="racu">
                                        <div>
                                                <i class='bx bx-face'></i>
                                        </div>
                                        <p>
                                                <?php $rol = $t['idrol'];
                                                $user = $t['nombre_usuario'];
                                                ;
                                                $re = mysqli_query($conexion, "SELECT * FROM usuario
                                                INNER JOIN rol_usuario ON usuario.idrol= rol_usuario.idrol        
                                                WHERE nombre_usuario='$user'");
                                                $f = mysqli_fetch_assoc($re);
                                                echo $f["nombre_rol"]
                                                        ?>
                                        </p>
                                </div>
                        </section>
                </section>
                <section class="datos-conso">
                        <h2>Detalles</h2>
                        <section class="estarte-conso">
                                <div class="fichas-conso">
                                        <div class="f1">
                                                <h3>Ficha</h3>
                                                <p>
                                                        <?php echo $t['numero_ficha']; ?>
                                                </p>
                                        </div>
                                        <div class="f2">
                                                <h3>Nombre</h3>
                                                <p>
                                                        <?php echo $t['formacion']; ?>
                                                </p>
                                        </div>
                                </div>
                                <div class="dater-conso">
                                        <div>
                                                <h3>Jornada</h3>
                                                <p>
                                                        <?php echo $t['jornada']; ?>
                                                </p>
                                        </div>
                                        <?php
                                        $fechaInicio = $t['fecha_inicio'];

                                        // Fecha de finalización en el formato "2023-09-17 23:59:17"
                                        $fechaFinal = $t['fecha_fin'];

                                        // Formatear las fechas en español
                                        $fechaInicioFormateada = strftime("%e de %B del %Y", strtotime($fechaInicio));
                                        $fechaFinalFormateada = strftime("%e de %B del %Y", strtotime($fechaFinal));
                                        ?>
                                        <div>
                                                <h3>Fecha inicio</h3>
                                                <p>
                                                        <?php echo $fechaInicioFormateada ?>
                                                </p>
                                        </div>
                                        <div>
                                                <h3>Fecha final</h3>
                                                <p>
                                                        <?php echo $fechaFinalFormateada ?>
                                                </p>
                                        </div>
                                </div>
                                <div class="motivo-conso">
                                        <h3>Motivo principal</h3>
                                        <article class="">
                                                <?php echo $t['motivo']; ?>
                                                
                                        </article>
                                </div>
                        </section>
                </section>
        </section>
        <section class="botones-card">
                <button class="rechazarSolicitud-btn">Rechazar Solicitud</button>
                <button class="ver-detalles-btn">Aceptar Solicitud</button>
        </section>
</section>



<section class="alerta-ac" id="alerta-dene">
        <header>
                <h3>Confirmar Rechazar</h3>
        </header>
        <section class="cuerpo-alertaf">
                <div class="texto-alerta">
                        <div>Motivo de rechazo</div>
                        <textarea id="miTextarea" cols="30" rows="10"></textarea>
                        <!-- ¿Seguro de su decisión?, tenga en cuenta que en el momento que decida Rechazar la solicitud se le informara al remitente
               de su decision. -->
                </div>
                <div class="botones-alerta">
                        <button class="buuton-canel" id="cancel-rechazar">Cancelar</button>
                        <button class="button-aceptl" id="confirm-rechazar">Rechazar</button>
                </div>
        </section>
</section>
<section class="alerta-ac" id="alerta-ac">
        <header>
                <h3>Confirmar Aceptar</h3>

        </header>
        <section class="cuerpo-alertaf">
                <div class="texto-alerta">
                        ¿Seguro de su decisión?, tenga en cuenta que en el momento que decida aceptar la solicitud se le
                        informara
                        al remitente
                        de su decision.
                </div>
                <div class="botones-alerta">
                        <button class="buuton-canel" id="cancel-accept">Cancelar</button>
                        <button class="button-aceptl" id="confirm-accept">Aceptar</button>
                </div>
        </section>
</section>

<script>
        function hacerDoshes() {
                // JavaScript para manejar los eventos
                var contenedores = document.querySelectorAll(".contendor-cares");
                const desaparecer_contendor = document.getElementById("forech");
                const modal = document.getElementById("alerta-ac");
                const modal2 = document.getElementById("alerta-dene");
                const confirmAcceptBtn = document.getElementById("confirm-accept");
                const cancelAcceptBtn = document.getElementById("cancel-accept");
                const rechazarAcceptBtn = document.getElementById("confirm-rechazar");
                const cancel = document.getElementById("cancel-rechazar");

                var x = document.querySelector('.x');

                x.addEventListener('click', () => {
                        document.getElementById('cetaba-cares').style.display = "none";
                });

                contenedores.forEach((contenedor) => {
                        const verDetallesBtn = contenedor.querySelector(".ver-detalles-btn");
                        verDetallesBtn.addEventListener("click", function () {
                                const idConcurret = contenedor.getAttribute("data-id");
                                modal.setAttribute("data-id", idConcurret); // Almacenar el ID en el modal
                                desaparecer_contendor.classList.add('quitar-f');
                                modal.classList.add("agregar-f")
                        });
                });



                confirmAcceptBtn.addEventListener("click", function () {
                        const id = modal.getAttribute("data-id");
                        aceptarSolicitud(id);
                        document.getElementById('cetaba-cares').style.display = "none";
                        modal.style.display = "none";
                });

                cancelAcceptBtn.addEventListener("click", function () {
                        desaparecer_contendor.classList.remove('quitar-f');
                        modal.classList.remove("agregar-f")
                });


                function aceptarSolicitud(id) {
                        const overlay = document.getElementById("overlay");
                        overlay.classList.add("active");
                        const data = new URLSearchParams();
                        data.append("id_soli", id);


                        fetch("php/ambientes.php", {
                                method: "POST",
                                headers: {
                                        "Content-Type": "application/x-www-form-urlencoded",
                                },
                                body: data,
                        })
                                .then((response) => response.text())
                                .then(function (responseText) {
                                        overlay.classList.remove("active");
                                        alert("Ambiente asignado con exito");
                                        contenedores.forEach((contenedor) => {
                                                const idConcurret = contenedor.getAttribute("data-id");
                                                if (idConcurret == id) {
                                                        const contenedorPadre = contenedor.parentNode;
                                                        const contenidoActual = parseInt($(".asig_nuevas").text(), 10);
                                                        if (contenidoActual == 1) {
                                                                window.location.reload();
                                                                return;
                                                        }
                                                        if (!isNaN(contenidoActual)) {
                                                                const nuevoContenido = contenidoActual - 1;
                                                                $(".asig_nuevas").text(nuevoContenido);
                                                        }
                                                }
                                        });
                                })
                                .catch(function (error) {
                                        console.error("Error:", error);
                                });
                }

                contenedores.forEach((contenedor) => {
                        const verDetallesBtn2 = contenedor.querySelector(".rechazarSolicitud-btn");
                        verDetallesBtn2.addEventListener("click", function () {
                                const idConcurret2 = contenedor.getAttribute("data-id");
                                modal2.setAttribute("data-id", idConcurret2); // Almacenar el ID en el modal
                                desaparecer_contendor.classList.add('quitar-f');
                                modal2.style.display = "block";
                        });
                });


                rechazarAcceptBtn.addEventListener("click", function () {
                        const id = modal2.getAttribute("data-id");
                        const textareaContent = document.getElementById("miTextarea").value;
                        rechazarSolicitud(id, textareaContent);
                        document.getElementById('cetaba-cares').style.display = "none";
                        modal2.style.display = "none";
                });

                cancel.addEventListener("click", function () {
                        desaparecer_contendor.classList.remove('quitar-f');
                        modal2.style.display = "none";
                });

                function rechazarSolicitud(id, textareaContent) {
                        const overlay = document.getElementById("overlay");
                        overlay.classList.add("active");
                        const data = new URLSearchParams();
                        data.append("solici_r", id);
                        data.append("text", textareaContent)

                        fetch("php/ambientes.php", {
                                method: "POST",
                                headers: {
                                        "Content-Type": "application/x-www-form-urlencoded",
                                },
                                body: data,
                        })
                                .then((response) => response.text())
                                .then(function (responseText) {
                                        overlay.classList.remove("active");
                                        alert("Solicitud rechazada con exito.");
                                        contenedores.forEach((contenedor) => {
                                                const idConcurret = contenedor.getAttribute("data-id");
                                                if (idConcurret == id) {
                                                        const contenedorPadre = contenedor.parentNode;
                                                        const contenidoActual = parseInt($(".asig_nuevas").text(), 10);
                                                        if (contenidoActual == 1) {
                                                                window.location.reload();
                                                                return;
                                                        }
                                                        if (!isNaN(contenidoActual)) {
                                                                const nuevoContenido = contenidoActual - 1;
                                                                $(".asig_nuevas").text(nuevoContenido);
                                                        }
                                                }
                                        });
                                })
                                .catch(function (error) {
                                        console.error("Error:", error);
                                });
                }
        }

        hacerDoshes();
</script>