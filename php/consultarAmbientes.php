<?php
// inicia session start para sacar valores
session_start();
$idrol = $_SESSION['rol'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'Conexion.php';
    date_default_timezone_set('America/Bogota');
    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");
    $piso = mysqli_real_escape_string($conexion, $_POST['piso_id']);
    $resul = mysqli_query($conexion, "SELECT * FROM ambiente WHERE piso_ambiente = '$piso'");



    if (mysqli_num_rows($resul) > 0) {
        echo '<section class="filtro" style="width: 100%;color: var(--resalt); margin: 5px 0px 5px 2px;">';
        echo '<div style="display: flex; justify-content: space-between;   align-items: center;">';

        echo '<select name="estados" id="estatuto" style="height: 2rem; width: 20%;">
                 <option value="mostrar">Mostrar todos los ambiente</option>
                 <option value="Disponible">Disponibles</option>
                 <option value="Ocupado">Ocupados</option>
            </select>';

        echo '<p id="" style="cursor:pointer; text-transform: uppercase;" onclick="vaciarPisos()">PISO / ' . $piso . '</p>';

        echo '
        
        <div class="formm">
            <label for="search">
                <input required="" autocomplete="off" placeholder="Buscar instructor" id="busquedaNombre" type="search">
                <div class="icon">
                    <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="swap-on">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                    <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="swap-off">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </div>

            </label>
        </div> 
        ';
        echo '</div>';
        echo '</section>';

        echo '<section class="espaciador" id="reemplazar" style="width: 100%;">';

        while ($fila = mysqli_fetch_assoc($resul)) {
            $idambiente = $fila["idambiente"];
            $piso_ambiente = $fila["piso_ambiente"];
            $imgA = $fila["img"];
            $imagenAmbiente = 'imgambientes/' . $imgA;
            $imgUsuarioGlo = null;
            $formacionGlo = null;
            $fichaGlo = null;
            $motivoGlo = null;
            $telefono = null;
            $imgAngu = $fila["imgangular"];
            $imagenAmbienteAngular = 'imgambientes/' . $imgAngu;
            $estado = null;
            $usuario = null;
            $rol = 0;
            $id_reserva = null;
            $fondo = null;
            $piso_ambie[$piso_ambiente][] = $idambiente;
            $resul2 = mysqli_query($conexion, "SELECT * FROM asignacion INNER JOIN usuario ON  asignacion.idusuario = usuario.idusuario INNER JOIN rol_usuario ON  usuario.idrol = rol_usuario.idrol WHERE idambiente = '$idambiente'");

            if (mysqli_num_rows($resul2)) {
                while ($fila2 = mysqli_fetch_assoc($resul2)) {
                    $estado_ambiente = $fila2["estado_ambiente"];
                    $usuario = $fila2["nombre_usuario"] . " " . $fila2['apellido'];
                    $rol = $fila2["nombre_rol"];
                    $imgUsuarioGlo = $fila2["imagen"];


                    $formacionGlo = $fila2["formacion"];
                    $fichaGlo = $fila2["numero_ficha"];
                    $telefono = $fila2["telefono"];
                    $motivoGlo = $fila2["motivo"];
                    $fecha_inicio = $fila2["fecha_inicio"];
                    $fecha_fin = $fila2["fecha_fin"];

                    $parts_inicio = explode(" ", $fecha_inicio);
                    $parts_fin = explode(" ", $fecha_fin);

                    $fecha_inici = $parts_inicio[0];
                    $hora_inicio = $parts_inicio[1];

                    $fecha_fi = $parts_fin[0];
                    $hora_fin = $parts_fin[1];

                    $fecha_inicio_times = strtotime($fecha_inici);
                    $fecha_fin_timestamp = strtotime($fecha_fi);
                    $hora_inicio_timestamp = strtotime($hora_inicio);
                    $hora_fin_timestamp = strtotime($hora_fin);
                    $fecha_actual_times = strtotime($fecha_actual);
                    $hora_actual_times = strtotime($hora_actual);
                    $fecha_inicio_timestamp = strtotime($fecha_inicio);
                    $fecha_actual_timestamp = strtotime($fecha_actual . ' ' . $hora_actual);

                    if ($fecha_actual_times >= $fecha_inicio_times && $fecha_actual_times <= $fecha_fin_timestamp) {
                        if ($hora_actual_times >= $hora_inicio_timestamp && $hora_actual_times <= $hora_fin_timestamp) {
                            if ($estado_ambiente == 1) {
                                if ($fecha_actual_timestamp < $fecha_inicio_timestamp) {
                                    $fondo = '#FFC436';
                                    $estado = "Pendiente";
                                } else {
                                    $fondo = '#54b435';
                                    $estado = "Disponible";
                                }
                            } elseif ($estado_ambiente == 2) {
                                $fondo = '#D71313';
                                $estado = "Ocupado";
                            } elseif ($estado_ambiente == 3) {
                                $fondo = '#54b435';
                                $estado = "Disponible";
                            }
                            $id_reserva = $fila2["idsolicitud"];
                            // $fechaI = new DateTime($fila2["fecha_inicio"]);
                            // $fechaF = new DateTime($fila2["fecha_fin"]);

                            $resul5 = mysqli_query($conexion, "SELECT * FROM reporteactual_ambiente WHERE idreserva = '$id_reserva'");
                            if (mysqli_num_rows($resul5) > 0) {
                                while ($fila5 = mysqli_fetch_assoc($resul5)) {
                                    $fechaI_reporte_actu = new DateTime($fila5["fecha_inicio_reporte"]);
                                    $fechaF_reporte_actu = new DateTime($fila5["fecha_fin_reporte"]);
                                    while ($fechaI_reporte_actu <= $fechaF_reporte_actu) {
                                        $fecha_actual_bd_times = strtotime($fechaI_reporte_actu->format("Y-m-d"));
                                        if ($fecha_actual_times == $fecha_actual_bd_times) {
                                            if ($fila5["estado_reporte"] == 1) {
                                                $fondo = '#FFC436';
                                                $estado = "Pendiente";
                                            } elseif ($fila5["estado_reporte"] == 2) {
                                                $fondo = '#D71313';
                                                $estado = "Ocupado";
                                            } elseif ($fila5["estado_reporte"] == 3) {
                                                $fondo = '#54b435';
                                                $estado = "Disponible";
                                            }
                                        }
                                        $fechaI_reporte_actu->add(new DateInterval('P1D'));
                                    }
                                }
                            }
                            break;
                        } else {
                            $fondo = '#54b435';
                            $estado = "Disponible";
                        }
                    } else {
                        $fondo = '#54b435';
                        $estado = "Disponible";
                    }
                }
            } else {
                $fondo = '#54b435';
                $estado = "Disponible";
            }
?>


            <!-- Validacion por si esta ocupado el ambiente -->
            <!-- <?php
                    if ($estado == "Ocupado") {

                    ?>
                <i>
                    <?php echo $usuario; ?>
                </i>
                <p>
                    <?php echo $rol; ?>
                </p>
                <?php
                    }
                ?>
 -->

            <!-- new tarjeta -->
            <article class="cardAmbiente" data-estado="<?php echo $estado; ?>" data-piso="<?php echo $piso; ?>" data-ocupante="<?php echo $usuario; ?>" <?php if ($estado === 'Ocupado') {
                                                                                                                                                        ?> style="box-shadow: 0px 1px 2px 0px <?php echo $fondo ?>;" <?php
                                                                                                                                                                                                                    } ?>>

                <figure class="contenedorImagenAmbienteAngularNormal">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"> <img src="<?php echo $imagenAmbiente ?>" alt="" class="cardAmbiente_img imagenZoom" ondblclick="mostrarImagenAmpliada(this)" onclick="cerrarImagen(this)" />
                            </div>
                            <div class="swiper-slide"> <img src="<?php echo $imagenAmbienteAngular ?>" alt="" class="cardAmbiente_img imagenZoom" ondblclick="mostrarImagenAmpliada(this)" onclick="cerrarImagen(this)" /></div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                        <div class="autoplay-progress">
                            <svg viewBox="0 0 48 48">
                                <circle cx="24" cy="24" r="20"></circle>
                            </svg>
                            <span></span>
                        </div>
                    </div>
                </figure>






                <span class="cardAmbiente_span">
                    <aside class="column">
                        <span class="infoAmbiente">
                            <h3 title="<?php echo $fila['nombre_ambiente']; ?>">
                                <?php echo $fila['nombre_ambiente']; ?>
                            </h3>
                            <h3>
                                <?php $num_ambie = ($fila['numero_ambiente'] == 0) ? "" : $fila['numero_ambiente'];
                                echo $num_ambie; ?>


                                <span style="display: flex; flex-direction: column;">
                                    <p style="color:<?php echo $fondo; ?>;">
                                        <?php echo $estado; ?>
                                    </p>
                                    <?php
                                    if ($estado === 'Ocupado') {

                                    ?>
                                        <p style="font-size: 12px; text-transform: capitalize; color: #363636;">
                                            <?php echo strtolower($usuario); ?>
                                        </p>
                                        <p style="font-size: 11.5px; color: #363636;">
                                            <?php echo $rol; ?>
                                        </p>
                                    <?php
                                    }

                                    ?>


                                </span>
                            </h3>
                        </span>




                        <button class="botonesCardAmbiente verInfo" onclick="mostrar_detalles(<?php echo $idambiente ?>,<?php echo $fila['numero_ambiente']; ?>,this,'<?php echo $id_reserva; ?>','<?php echo $estado; ?>','<?php echo $imagenAmbienteAngular; ?>')">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                            <p>Ver detalles</p>
                        </button>






                    </aside>
                </span>
            </article>
        <?php
        }
        echo '</section>';
        ?>
        <section class="cont-ven-da">
            <div class="ven-da">
                <span class="cerrar-da" onclick="cerrar_detalles()">
                    <svg class="salir" aria-label="Cerrar" color="#1c1e21" fill="#1c1e21" height="14" role="img" viewBox="0 0 24 24" width="14">
                        <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                        <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
                    </svg>
                </span>
                <span class="boton-abrir-menu-da" onclick="abri_menu_da()">
                    <svg focusable="false" height="18" width="18" viewBox="0 0 24 24">
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
                    </svg>
                </span>
                <aside class="nav-da">
                    <div class="info-da">
                        <img src="" class="img-da" alt="" ondblclick="mostrarImagenAmpliada(this)" onclick="cerrarImagen(this)">
                        <h3 class="num_ambiente"></h3>
                    </div>
                    <div class="cont-menu-da">
                        <button class="menu-asig-ambi op-menu selec-op-menu" onclick="mostrar_sec_da('asig-ambi',this)">
                            <span class="selec-op-span">
                                <svg xmlns="http://www.w3.org/2000/svg" class="selec-op-svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="M19 4h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-1 15h-6v-6h6v6zm1-10H5V7h14v2z">
                                    </path>
                                </svg>
                            </span>
                            <p>Asignaciones por fechas</p>
                        </button>
                        <?php

                        if (isset($idrol)) {
                            echo '
                    <button class="menu-inve-ambi op-menu" onclick="mostrar_sec_da(\'inve-ambi\', this)">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);">
                                <path
                                    d="M17 2H7a2 2 0 0 0-2 2v17a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2zm-6 14H8v-2h3v2zm0-4H8v-2h3v2zm0-4H8V6h3v2zm5 8h-3v-2h3v2zm0-4h-3v-2h3v2zm0-4h-3V6h3v2z">
                                </path>
                            </svg>
                        </span>
                        <p>Inventario del ambiente</p>
                    </button>
                   
                ';
                        }

                        if ($idrol == 1 or $idrol == 3) {


                            echo ' <button  class="ocultar menu-estado-ambi op-menu" onclick="mostrar_sec_da(\'estado-ambi\', this)">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);">
                                    <path
                                        d="M10 11H7.101l.001-.009a4.956 4.956 0 0 1 .752-1.787 5.054 5.054 0 0 1 2.2-1.811c.302-.128.617-.226.938-.291a5.078 5.078 0 0 1 2.018 0 4.978 4.978 0 0 1 2.525 1.361l1.416-1.412a7.036 7.036 0 0 0-2.224-1.501 6.921 6.921 0 0 0-1.315-.408 7.079 7.079 0 0 0-2.819 0 6.94 6.94 0 0 0-1.316.409 7.04 7.04 0 0 0-3.08 2.534 6.978 6.978 0 0 0-1.054 2.505c-.028.135-.043.273-.063.41H2l4 4 4-4zm4 2h2.899l-.001.008a4.976 4.976 0 0 1-2.103 3.138 4.943 4.943 0 0 1-1.787.752 5.073 5.073 0 0 1-2.017 0 4.956 4.956 0 0 1-1.787-.752 5.072 5.072 0 0 1-.74-.61L7.05 16.95a7.032 7.032 0 0 0 2.225 1.5c.424.18.867.317 1.315.408a7.07 7.07 0 0 0 2.818 0 7.031 7.031 0 0 0 4.395-2.945 6.974 6.974 0 0 0 1.053-2.503c.027-.135.043-.273.063-.41H22l-4-4-4 4z">
                                    </path>
                                </svg>
                            </span>
                            <p>Cambiar estado actual</p>
                        </button>';
                        }
                        ?>

                        <div class="info-usua remove-info-usua">
                            <div>
                                <h4>Actualmente Ocupado por:</h4>
                                <div class="usuario">
                                    <i>Usuario:</i>
                                    <span>
                                        <div>
                                            <img class="img-usua" src="" alt="">
                                            <h4 class="nom-usua"></h4>
                                        </div>
                                        <span>
                                            <p class="rol_usua-da">
                                            </p>
                                            <p class="tele_usua-da">
                                            </p>
                                        </span>
                                    </span>
                                </div>
                                <div class="formacion">
                                    <i class="titulo-info_usua-da"></i>
                                    <span>
                                        <i class="ficha-da"></i>
                                        <h4 class="nom-usua">
                                        </h4>
                                    </span>
                                    <p class="motivo-da">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <article class="contenedio-da">
                    <section class="contenedor-op cargando-da">
                        <div class="cont-spinner-da">
                            <span class="spinner-da"></span>
                        </div>
                    </section>
                    <section id="asig-ambi" class="contenedor-op">
                        <article class="vents-asig-ambi">
                            <div id="calendar-asig"></div>
                            <div class="form-asig-ambi">
                                <section class="header-form-da">
                                    <span class="boton-regresar-da no-responsive-btn-regre" onclick="atras_calen_da()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                            <path d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                            </path>
                                        </svg>
                                    </span>
                                    <p class="texto-form-header-da"></p>
                                    <div class="acciones-actua-reser-da">
                                        <section class="dis-reserva-da">
                                            <button onclick="mostrar_dispo_reser(this)">
                                                Disponibilidad
                                            </button>
                                            <p></p>
                                        </section>
                                        <button class="estado-reserva-da"></button>
                                    </div>
                                </section>
                                <section class="cont-form-edit-da" <?php if (isset($_SESSION['rol'])) { ?> data-rol_usua="<?php echo $_SESSION['rol']; ?>" <?php } ?>>
                                    <div class="form-edit-da form-da">
                                        <div class="cont-input-select_Tocu cont-form-input">
                                            <section class="cont-form-da-Tocu cont-input-flex">
                                                <p>Tipo de asignación</p>
                                                <select id="form-da-Tocu" class="form-input">
                                                    <option value="reunion-corta">Reunion corta</option>
                                                    <option value="formacion">Formación</option>
                                                </select>
                                            </section>
                                        </div>
                                        <div class="cont-input-nomF-numF cont-form-input">
                                            <section class="cont-form-da-numF cont-input-flex">
                                                <input type="number" class="form-input input-enviar-form" id="form-da-numF" placeholder="Numero de ficha">
                                                <div class="cont-pro-ra-da">
                                                </div>
                                            </section>
                                            <section class="cont-form-da-nomF cont-input-flex">
                                                <input type="text" class="form-input input-enviar-form" id="form-da-nomF" placeholder="Nombre de formación">
                                            </section>
                                        </div>
                                        <div class="cont-input-motivo cont-form-input">
                                            <section class="cont-form-da-motivo cont-input-flex">
                                                <p>Ingresa un motivo corto</p>
                                                <textarea id="form-da-motivo" class="form-input input-enviar-form" placeholder="Motivo de asignación"></textarea>
                                            </section>
                                        </div>
                                        <div class="cont-input-fechas cont-form-input">
                                            <section class="cont-form-da-fechai cont-input-flex">
                                                <p>Fecha de inicio</p>
                                                <input type="date" placeholder="Fecha de inicio" class="form-input input-enviar-form" id="form-da-fechai">
                                            </section>
                                            <section class="cont-form-da-fechaf cont-input-flex">
                                                <p>Fecha de fin</p>
                                                <input type="date" placeholder="Fecha de fin" class="form-input input-enviar-form" id="form-da-fechaf">
                                            </section>
                                        </div>
                                        <div class="cont-input-jornadas-usuario cont-form-input">
                                            <section class="cont-form-da-jornada cont-input-flex">
                                                <p>Selecciona el horario para tu reserva</p>
                                                <select id="form-da-jornada" class="form-input input-enviar-form">
                                                    <option value="1">Mañana</option>
                                                    <option value="2">Tarde</option>
                                                    <option value="3">Noche</option>
                                                    <option value="otra_jorna">Otro horario</option>
                                                </select>
                                            </section>
                                            <section class="cont-form-da-usua cont-input-flex">
                                                <p>Selecciona el usuario a que le quieres dar la reserva</p>
                                                <select id="form-da-usua" class="form-input input-enviar-form"></select>
                                            </section>
                                        </div>
                                        <div class="cont-input-horas cont-form-input">
                                            <section class="cont-form-da-horai cont-input-flex">
                                                <p>Hora de inicio</p>
                                                <input type="time" class="form-input input-enviar-form" placeholder="Hora a iniciar" id="form-da-horai">
                                            </section>
                                            <section class="cont-form-da-horaf cont-input-flex">
                                                <p>Hora de fin</p>
                                                <input type="time" class="form-input input-enviar-form" placeholder="Hora a finalizar" id="form-da-horaf">
                                            </section>
                                        </div>
                                    </div>
                                    <div class="mostrar-reserva-usua form-da">
                                        <div class="cont-form-input">
                                            <section class="cont-form-da-Tocu-usu cont-input-flex">
                                                <p>Tipo de asignación</p>
                                                <button id="form-da-Tocu-usu" class="form-input form-input-usu"></button>
                                            </section>
                                        </div>
                                        <div class="cont-form-input cont-input-nomF-numF">
                                            <section class="cont-form-da-numF-usu cont-input-flex">
                                                <p>Ficha de formación</p>
                                                <button class="form-input form-input-usu" id="form-da-numF-usu"></button>
                                            </section>
                                            <section class="cont-form-da-nomF-usu cont-input-flex">
                                                <p>Nombre de formación</p>
                                                <button class="form-input form-input-usu" id="form-da-nomF-usu">
                                                    <p></p>
                                                </button>
                                            </section>
                                        </div>
                                        <div class="cont-form-input cont-input-motivo">
                                            <section class="cont-form-da-motivo-usu cont-input-flex">
                                                <p>Motivo</p>
                                                <button class="form-input form-input-usu" id="form-da-motivo-usu">
                                                    <p></p>
                                                </button>
                                            </section>
                                        </div>
                                        <div class="cont-form-input">
                                            <section class="cont-form-da-fechai-usu cont-input-flex">
                                                <p>Fecha de inicio</p>
                                                <button class="form-input form-input-usu" id="form-da-fechai-usu"> </button>
                                            </section>
                                            <section class="cont-form-da-fechaf-usu cont-input-flex">
                                                <p>Fecha de fin</p>
                                                <button class="form-input form-input-usu" id="form-da-fechaf-usu"></button>
                                            </section>
                                        </div>
                                        <div class="cont-form-input">
                                            <section class="cont-form-da-jornada-usu cont-input-flex">
                                                <p>Horario de la reserva</p>
                                                <button class="form-input form-input-usu" id="form-da-jornada-usu"></button>
                                            </section>
                                        </div>
                                        <div class="cont-form-input cont-input-horas">
                                            <section class="cont-form-da-horai-usu cont-input-flex">
                                                <p>Hora de inicio</p>
                                                <button class="form-input form-input-usu" id="form-da-horai-usu"></button>
                                            </section>
                                            <section class="cont-form-da-horaf-usu cont-input-flex">
                                                <p>Hora de fin</p>
                                                <button class="form-input form-input-usu" id="form-da-horaf-usu"></button>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="dias_reserva_dispo form-da">
                                        <article class="cont-reserva-dispon">
                                            <section class="agg-reserva-dispo dispo-reser">
                                                <h4>Liberar días de la reserva</h4>
                                                <div class="cont-form-input">
                                                    <section class="cont-input-flex">
                                                        <p>Fecha de inicio</p>
                                                        <input type="date" placeholder="Fecha de inicio" class="form-input input-reser-dis" id="form-da-fechai-reser-dis">
                                                    </section>
                                                    <section class="cont-input-flex">
                                                        <p>Fecha de fin</p>
                                                        <input type="date" placeholder="Fecha de fin" class="form-input input-reser-dis" id="form-da-fechaf-reser-dis">
                                                    </section>
                                                </div>
                                                <div class="cont-form-input">
                                                    <section class="cont-input-flex">
                                                        <p>Ingresa un motivo corto</p>
                                                        <textarea id="form-da-motivo-reser-dis" class="form-input input-reser-dis"></textarea>
                                                    </section>
                                                </div>
                                                <div class="cont-form-input">
                                                    <section class="cont-input-flex">
                                                        <p>Selecciona el horario para la disponibilidad de esta reserva</p>
                                                        <select id="form-da-jornada-reser-dis" class="form-input input-reser-dis" onclick="mostrar_horas_dis_reser(this)">
                                                            <option value="1">Toda la reserva del día</option>
                                                            <option value="otra_hora">Otro horario</option>
                                                        </select>
                                                    </section>
                                                </div>
                                                <div class="cont-form-input horas_dis_reser oculta-cont-input-form">
                                                    <section class="cont-input-flex">
                                                        <p>Hora de inicio</p>
                                                        <input type="time" class="form-input input-reser-dis" placeholder="Hora a iniciar" id="form-da-horai-reser-dis">
                                                    </section>
                                                    <section class="cont-input-flex">
                                                        <p>Hora de fin</p>
                                                        <input type="time" class="form-input input-reser-dis" placeholder="Hora a finalizar" id="form-da-horaf-reser-dis">
                                                    </section>
                                                </div>
                                                <div class="cont-form-input">
                                                    <button class="liberal_dias_reser btn-edit-form-da">Liberar días</button>
                                                </div>
                                            </section>
                                            <section class="reserva-dispo dispo-reser">
                                                <h4>Días libres de la reserva: </h4>
                                                <div class="no_existe_reser_dis oculta-cont-input-form">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(215, 19, 19);">
                                                            <path d="M16 2H8C4.691 2 2 4.691 2 8v13a1 1 0 0 0 1 1h13c3.309 0 6-2.691 6-6V8c0-3.309-2.691-6-6-6zm.706 13.293-1.414 1.414L12 13.415l-3.292 3.292-1.414-1.414 3.292-3.292-3.292-3.292 1.414-1.414L12 10.587l3.292-3.292 1.414 1.414-3.292 3.292 3.292 3.292z"></path>
                                                        </svg>
                                                        <h5>No existen días libres de la reserva</h5>
                                                    </span>
                                                </div>
                                                <ul class="fechas_reser_disponi">
                                                </ul>
                                            </section>
                                        </article>
                                    </div>
                                </section>
                                <section class="acciones-form-edit-da">
                                    <button class="actuali-form-da btn-edit-form-da oculta-cont-input-form">Guardar cambios</button>
                                    <button class="insertar-form-da btn-edit-form-da">Guardar
                                        reserva</button>
                                </section>
                            </div>
                        </article>
                    </section>
                    <section id="inve-ambi" class="contenedor-op">
                        <div class="cont-inve">
                            <span class="inve-celdas cont-sillas">
                                <h3 class="nom-inve">Sillas</h3>
                                <span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                            <path d="M19 13V4c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2v9a1 1 0 0 0-1 1v8h2v-5h12v5h2v-8a1 1 0 0 0-1-1zm-2-9v9h-2V4h2zm-4 0v9h-2V4h2zM7 4h2v9H7V4z">
                                            </path>
                                        </svg>
                                    </span>
                                    <p class="inve-sillas"></p>
                                    <div class="cambiar-num-inve">
                                        <span class="aume-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19z">
                                                </path>
                                            </svg>
                                        </span>
                                        <p></p>
                                        <span class="dismi-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                </span>
                            </span>
                            <span class="inve-celdas cont-mesas">
                                <h3 class="nom-inve">Mesas</h3>
                                <span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                            <path d="M4 21h15.893c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zm0-2v-5h4v5H4zM14 7v5h-4V7h4zM8 7v5H4V7h4zm2 12v-5h4v5h-4zm6 0v-5h3.894v5H16zm3.893-7H16V7h3.893v5z">
                                            </path>
                                        </svg>
                                    </span>
                                    <p class="inve-mesas"></p>
                                    <div class="cambiar-num-inve">
                                        <span class="aume-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19z">
                                                </path>
                                            </svg>
                                        </span>
                                        <p></p>
                                        <span class="dismi-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                </span>
                            </span>
                            <span class="inve-celdas cont-tv">
                                <h3 class="nom-inve">Televisores</h3>
                                <span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                            <path d="M20 6h-5.586l2.293-2.293-1.414-1.414L12 5.586 8.707 2.293 7.293 3.707 9.586 6H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2z">
                                            </path>
                                        </svg>
                                    </span>
                                    <p class="inve-tv"></p>
                                    <div class="cambiar-num-inve">
                                        <span class="aume-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19z">
                                                </path>
                                            </svg>
                                        </span>
                                        <p></p>
                                        <span class="dismi-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                </span>
                            </span>
                            <span class="inve-celdas cont-aire-a">
                                <h3 class="nom-inve">Aires acondicionados</h3>
                                <span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                            <path d="M13 5.5C13 3.57 11.43 2 9.5 2 7.466 2 6.25 3.525 6.25 5h2c0-.415.388-1 1.25-1 .827 0 1.5.673 1.5 1.5S10.327 7 9.5 7H2v2h7.5C11.43 9 13 7.43 13 5.5zm2.5 9.5H8v2h7.5c.827 0 1.5.673 1.5 1.5s-.673 1.5-1.5 1.5c-.862 0-1.25-.585-1.25-1h-2c0 1.475 1.216 3 3.25 3 1.93 0 3.5-1.57 3.5-3.5S17.43 15 15.5 15z">
                                            </path>
                                            <path d="M18 5c-2.206 0-4 1.794-4 4h2c0-1.103.897-2 2-2s2 .897 2 2-.897 2-2 2H2v2h16c2.206 0 4-1.794 4-4s-1.794-4-4-4zM2 15h4v2H2z">
                                            </path>
                                        </svg>
                                    </span>
                                    <p class="inve-aire-a"></p>
                                    <div class="cambiar-num-inve">
                                        <span class="aume-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19z">
                                                </path>
                                            </svg>
                                        </span>
                                        <p></p>
                                        <span class="dismi-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                </span>
                            </span>
                            <span class="inve-celdas cont-pc">
                                <h3 class="nom-inve">Computadoras</h3>
                                <span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                            <path d="M20 17.722c.595-.347 1-.985 1-1.722V5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2v11c0 .736.405 1.375 1 1.722V18H2v2h20v-2h-2v-.278zM5 16V5h14l.002 11H5z">
                                            </path>
                                        </svg>
                                    </span>
                                    <p class="inve-pc"></p>
                                    <div class="cambiar-num-inve">
                                        <span class="aume-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M3 19h18a1.002 1.002 0 0 0 .823-1.569l-9-13c-.373-.539-1.271-.539-1.645 0l-9 13A.999.999 0 0 0 3 19z">
                                                </path>
                                            </svg>
                                        </span>
                                        <p></p>
                                        <span class="dismi-cant-inve">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                                <path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>

                                </span>
                            </span>
                            <span class="inve-celdas no_existe-inve">
                                <h3 class="nom-inve">No hay elementos en este ambiente</h3>
                                <span class="con-x_existe-inve">
                                    <svg class="x_existe-inve" aria-label="Cerrar" color="#1c1e21" fill="#1c1e21" height="28" role="img" viewBox="0 0 24 24" width="28">
                                        <polyline fill="none" points="20.643 3.357 12 12 3.353 20.647" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></polyline>
                                        <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" x1="20.649" x2="3.354" y1="20.649" y2="3.354"></line>
                                    </svg>
                                </span>
                            </span>
                        </div>
                        <div class="acciones-inve-da">
                            <button class="reset-aia boton-fun-inve" title="Resetear">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="M12 16c1.671 0 3-1.331 3-3s-1.329-3-3-3-3 1.331-3 3 1.329 3 3 3z"></path>
                                    <path d="M20.817 11.186a8.94 8.94 0 0 0-1.355-3.219 9.053 9.053 0 0 0-2.43-2.43 8.95 8.95 0 0 0-3.219-1.355 9.028 9.028 0 0 0-1.838-.18V2L8 5l3.975 3V6.002c.484-.002.968.044 1.435.14a6.961 6.961 0 0 1 2.502 1.053 7.005 7.005 0 0 1 1.892 1.892A6.967 6.967 0 0 1 19 13a7.032 7.032 0 0 1-.55 2.725 7.11 7.11 0 0 1-.644 1.188 7.2 7.2 0 0 1-.858 1.039 7.028 7.028 0 0 1-3.536 1.907 7.13 7.13 0 0 1-2.822 0 6.961 6.961 0 0 1-2.503-1.054 7.002 7.002 0 0 1-1.89-1.89A6.996 6.996 0 0 1 5 13H3a9.02 9.02 0 0 0 1.539 5.034 9.096 9.096 0 0 0 2.428 2.428A8.95 8.95 0 0 0 12 22a9.09 9.09 0 0 0 1.814-.183 9.014 9.014 0 0 0 3.218-1.355 8.886 8.886 0 0 0 1.331-1.099 9.228 9.228 0 0 0 1.1-1.332A8.952 8.952 0 0 0 21 13a9.09 9.09 0 0 0-.183-1.814z">
                                    </path>
                                </svg>
                            </button>
                            <div>
                                <section class="cont-fun-agg-inve">
                                    <button class="can-agg-ia" onclick="cancelar_agg_inve()">
                                        Cancelar
                                    </button>
                                    <button class="agg-agg-ia" onclick="agregarElemAInve()" title="Agregar elemento al inventario">
                                        Agregar
                                    </button>
                                </section>
                                <select class="agg-aia boton-fun-inve" title="Agregar elementos al inventario"></select>
                                <button class="actu-aia boton-fun-inve" title="Actualizar inventario">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </section>
                    <section id="estado-ambi" <?php if ($_SESSION['id']) { ?> data-id_usuario="<?php echo $_SESSION['id']; ?>" <?php } ?> class="contenedor-op contenedorAmbi">
                        <div class="container my-container">

                            <h1 class="my-heading">Estado del Ambiente</h1>
                            <p class="my-paragraph">Estado a cambiar:</p>
                            <p class="disponible">DISPONIBLE</p>
                            <!-- <select id="estadoSelect" class="my-select" style="
                            width: 100%;
                            outline: none;
                            padding: 10px;
                            border: none;
                            box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;
                            outline: none;
                            border-radius: .2em;
                            padding: .8em .8em;
                            
                            "> 

                                <option value="3">disponible</option>
                            </select> -->
                            <select name="" id="motivo" style="
                              width: 100%;
                            outline: none;
                            padding: 10px;
                            border: none;
                            box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;
                            outline: none;
                            border-radius: .2em;
                            padding: .8em .8em;
                            ">
                                <option value="Inasistencia de Personal">Inasistencia de Personal
                                </option>
                                <option value="Inasistencia de Instructor">Inasistencia de
                                    Instructor</option>
                                <option value="Inasistencia de Aprendiz">Inasistencia de Aprendiz
                                </option>
                                <option value="Ambiente Inhabilitado">Ambiente Inhabilitado
                                </option>
                                <option value="otros">Otros</option>
                            </select>
                            <input type="text" name="" id="descripcionMotivo" class="motivo" placeholder="motivo" style="
                            width: 100%;
                            outline: none;
                            padding: 10px;
                            margin-bottom: 20px;
                            border: none;
                            box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;
                            outline: none;
                            border-radius: .2em;
                            padding: .8em .8em;
                            ">


                            <button id="notificarBtn" class="my-button" onclick="ActualizarEstadoAsigacion()">Cambiar</button>
                        </div>

                    </section>
                </article>
            </div>
        </section>


<?php

    } else {
        echo '<p>No existen ambientes en este piso</p>';
    }
}
?>