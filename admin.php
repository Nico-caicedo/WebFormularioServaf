<?php




session_start();
#Validacion de rol
include('./php/Conexion.php');
$rol = (isset($_SESSION['rol'])) ? $_SESSION['rol'] : null;


if (!isset($_SESSION['rol'])) {
  echo "<script>window.location.href = './index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/admin.css" />
  <link rel="stylesheet" href="./css/slider.css" />
  <link rel="stylesheet" href="./css/ventana.css" />
  <link rel="stylesheet" href="./css/evadesempeno.css" />
  <script src="https://kit.fontawesome.com/0015840e45.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- alertas toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link rel="shortcut icon" href="https://www.servaf.com/wp-content/uploads/2021/03/gota_favicon.png"
    type="image/x-icon">
  <?php


  if ($rol == 0 or $rol == 3 or $rol == 4) {
    echo " <style> 
    .cambiar-num-inve{
      display:none;
    }

    .acciones-inve-da{
      display:none;
    }
    </style>";
  }
  ?>




  <title>Panel administrador</title>
</head>

<body>
  <!-- <article class="cont_cargando_inicio">
    <section class="cargando_inicio">
      <img src="img/Rlogo.png" alt="Logo de asignación de ambientes">
      <h1>Room assigner</h1>
    </section>
  </article>
  <div class="" id="carga">
    <div class="custom-loader"></div>
  </div> -->

  <div id="menuResponsive">
    <h2><img src="img/sena.png" alt="" class="sena"> Asignación ambiente</h2>
    <div id="iconoMenu">
      <div id="desplegarMenu" class="">
        <i class="fa-solid fa-bars"></i>
      </div>

      <div id="cerrarMenu" class="">
        <i class="fa-solid fa-x"></i>
      </div>

    </div>
  </div>


  <!-- Ventana editar perfil -->
  <!-- EL PROPIO PROGRAMACONSUEÑOINADOR -->
  <?php
  if (isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE IdUser = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $nombre_usuario = $row["Nombre1"];
      $apellido = $row["Apellido1"];
      $documento = $row["Document"];
      $password_usuario = $row["Pasword"];
      $correo = $row["correo"];
      $telefono = $row["telefono"];
      $imagen = $row["FotoPerfil"];
    }
  }
  ?>

  <div id="modal" class="modal">
    <div class="content-form">

      <form class="formularo-edit" action="php/actualizar_ints_ap.php" method="POST" enctype="multipart/form-data">
        <span class="closeProfile" onclick="ocultarUserCard()">&times;</span>
        <h1 class="card-title">Editar Perfil</h1>
        <div class="campos-data">
          <div class="label-input">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="dato" value="<?php echo $nombre_usuario; ?>">
          </div>
          <div class="label-input">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="dato" value="<?php echo $apellido; ?>">
          </div>

        </div>
        <div class="campos-data">
          <div class="label-input">
            <label for="documento">Documento:</label>
            <input type="text" name="documento" id="documento" class="dato" value="<?php echo $documento; ?>">
          </div>
          <div class="label-input">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="dato" value="<?php echo $password_usuario; ?>">
          </div>

        </div>
        <div class="campos-data">
          <div class="label-input">
            <label for="correo">Correo:</label>

            <input type="text" name="correo" id="correo" class="dato" value="<?php echo $correo; ?>">
          </div>
          <div class="label-input"><label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="dato" value="<?php echo $telefono; ?>">
          </div>
        </div>
        <div class="imgaa">
          <label for="imagen">Imagen Actual:</label>
          <img src="imgusuario/<?php echo $imagen; ?>" alt="Imagen Actual" class="imga"
            ondblclick="mostrarImagenAmpliada(this)" onclick="cerrarImagen(this)">
        </div>
        <div class="imgaa">
          <label for="new-imagen" class="btn-img">Subir nueva imagen</label>
          <input type="file" name="imagen" id="new-imagen" class="filenew">
        </div>
        <button type="submit" class="btn-cargar-novedad">Actualizar</button>
      </form>
    </div>
  </div>


  <aside id="aside">
    <section class="logo">


      <img src="imgusuario/<?php echo $_SESSION['img']; ?>" alt="" />

      <span class="name_rol">

        <?php

        $sconsult = mysqli_query($conexion, "SELECT * FROM rol_usuario WHERE idrol = $rol");
        $row = mysqli_fetch_assoc($sconsult);
        echo '<p>';
        echo $_SESSION['nombre'];
        echo '</p>';
        echo '<p>';
        echo $row['nombre_rol'];
        echo '</p>';
        ?>
      </span>

      <article class="BtnEditarPerfil" onclick="mostrarUserCard()" title='Editar perfil'>
        <i class="fa-solid fa-pen-to-square"></i>
      </article>
      <?php
      if ($rol == 0) {
        echo "<article class='BtnCargueAsignacion' onclick='mostrarCargueAsignacion()' title='Cargar asignaciones'>
        <i class='fa-solid fa-upload'></i>
      </article>
      
         <button class='Btninforme' id='abrirModalInforme' title='Generar informe'>
         <i class='fa-solid fa-file-export'></i>
        </button> ";
      }


      ?>
    </section>



    <section id="modalCargueAsignaciones" class="ventana">
      <section class="product">
        <div class="cerrarbutton">


          <a href="descargarPlantillaAsignacion.pdf" download="descargarPlantillaAsignacion.pdf"><button
              class="btnexcel">Descargar Guia</button>
          </a>
          <h6 class="titleExcel">Cargar Asignaciones con excel</h6>
          <span class="cerrar" onclick="cerrarCargueAsignacion()">&times;</span>
        </div>

        <div id="cargarDatos">
          <div class="formsExcel">
            <a href="php/descargarPlantillaAsignacion.php"><button name="asignacion" class="btnexcel">Descarga tu
                plantilla</button>
            </a>
          </div>
          <div class="formsExcel">
            <form action="" method="post" enctype="multipart/form-data" class="formsExcel" id="cargarExcelAsignacion">
              <input type="file" name="csvfile" id="datosAsignacion">
              <button type="submit" name="guardarDatosAsignacion" class="btnexcelI">Importar datos</button>
            </form>
          </div>
        </div>
      </section>

    </section>

    <!-- Anuncios sena mi papa -->
    <div id="anuncios">

      <?php
      if ($rol == 0) {
        echo '
  <button title="Gestionar noticias" id="EditarCarrusel" onclick="mostrarContenedor(\'carruselNoticias\', this)">
    <p></p>
    <i class="fa-solid fa-ellipsis"></i>
  </button>
  ';
      }
      ?>

      <div class="swiper mySwiper">
        <div class="swiper-wrapper">

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

      <p id="textoAnuncio"></p>

    </div>


    <nav id="contenedor-botones">
      <button class="botones pri" id="11" onclick="mostrarContenedor('Ambientes',this)">
        <i class="fas fa-building pri"></i>
        <p class="pri">Desempeño Laboral</p>
      </button>

      <!-- DE AQUI HACIA ABAJO MEJIA -->
      <?php
      if ($rol == 0) {
        // ME PUSIERON ESTO A ULTIMA HORA MALDITOS DESGRACIADOS (CON TODO RESPETO)
        ?>

        <button class="botones" id="22" onclick="mostrarContenedor('descubre_asig',this)">
          <i class="fa-solid fa-play"></i>
          <p class="pri">Descubre la Página</p>
        </button>
        <button class='botones' id='3' onclick="mostrarContenedor('verSolicitudes',this)">
          <i class='fas fa-clipboard-list'></i>
          <p>proximamente</p>
        </button>
        <?php
      }
      ?>

      <!-- DE AQUI HACIA ARRIBA MEJIA  -->
      <?php
      // if ($rol == 3) {
      //   echo '<button class="botones pri btn-open" onclick="mostrarFormularioN()">
      //   <i class="fas fa-building pri"></i>
      //   <p class="pri  ">Generar Novedad</p>
      // </button>';
      // }
      ?>
      <?php
      if ($rol == 0) {
        echo "
      <button class='botones' id='44' onclick='mostrarContenedor(\"crearAmbiente\", this)'>
        <i class='fas fa-plus-circle'></i>
        <p>Crear Ambiente</p>

      </button>
      
   
     
      <button class='botones' id='5' onclick='mostrarContenedor(\"crearUsuario\", this)'>
        <i class='fas fa-plus-circle'></i>
        <p>Crear Usuario</p>
      </button>
      <button class='botones' id='6' onclick='mostrarContenedor('Solicitudes',this)'>
      <?php require_once 'php/num_solicutudes_nueva.php'; ?>
      <i class='fas fa-clipboard-list'></i>
      <p>Solicitudes</p>
    </button>
      ";
      }
      ?>


      <?php
      if ($rol == 1) {
        ?>


        <button class='botones' id='7' onclick='mostrarContenedor("Usuarios",this)'>
          <i class='fas fa-users'></i>

          <p>Usuarios</p>
        </button>
        <?php
      }
      ?>

      <button class="botones" id="8" onclick="cerrarSesion()">
        <i class="fas fa-sign-out-alt"></i>
        <p>Cerrar sesión</p>
      </button>
    </nav>
  </aside>

  <main id="main">
    <section class="pages" id="Inicio"  style="display= flex;">
      <div  class="inicio_modif">
      <img src="./img/ServafPerfil.jpg" alt="">
      </div>
    </section>

    <section class="pages" id="Solicitudes">
      ss
    </section>

    <section class="pages" id="Ambientes">
      <div class="evaluacion_laboral">

        <div class="first_line">
          <h1>Evaluación Desempeño Laboral </h1>
        </div>
        <div class="second_line">
          <!-- evaluacion -->
          <div class="boton_Eva" onclick="desplegar()">
            <p>Evaluar</p>
          </div>
        </div>
        <div onclick="closes()" id="dark">

        </div>

        <div id="ventana_evalu">
          <div id="close" onclick="closes()">
            <img src="./img/close.svg" alt="">
          </div>


          <h1 class="title_evaluando">Evaluación</h1>

          <div class="evaluando">
            <!-- identidad de evaluando -->
            <p class="title_eva">
              Empleado a evaluar

            </p>
            <div class="mauso">

              <input type="text" name="" id="Empleado" placeholder="Numero Documento" class="mauso-texto">
              <input type="hidden" name="medico" id="MedicoFinal" class="mauso-texto" autocomplete="off" value="">
              <section id="medicosResult" class="mauso-resultados scrall">
                <!-- Aparecen dinamicamente los resultados de las busqueda del diagnostico AgregarMedicamentoVenatana.js(Linea 41 - 76) -->
              </section>
            </div>

          </div>

          <!-- Periodos a evaluar -->
          <div class="periodo_evaluar">
            <p class="title_eva">Periodo a evaluar</p>
            <div class="fecha_container">
              <div class="fecha">
                <p>Del</p>
                <input type="date" id="date1" class="date">
              </div>
              <div class="fecha">
                <p>Al</p>
                <input type="date" id="date2" class="date">
              </div>
            </div>

          </div>
          <div class="boton">
            <input type="submit" id="Boton" name="iniciar" value="Iniciar evaluación">
          </div>
        </div>

        <div class="third_line">


          <?php




          // id del usuario como evaluador
          
          $id_evaluador = $_SESSION['id_evaluador'];


          $user_evaluado = mysqli_query($conexion, "SELECT * FROM evaluados WHERE IdEvaluador = $id_evaluador");

          if (mysqli_num_rows($user_evaluado) > 0) {
            while ($row = mysqli_fetch_assoc($user_evaluado)) {
              $id_evaluado = $row["IdUser"];
              $IdEvaluado = $row['IdEvaluado'];
              $show = mysqli_query($conexion, "SELECT * FROM users WHERE IdUser = $id_evaluado AND Estado = 1");

              if (mysqli_num_rows($show) > 0) {
                $datos = mysqli_fetch_assoc($show);
                $name = $datos['Nombre1'];
                $apellido = $datos['Apellido1'];
                $documento = $datos['Document'];

                $id_cargo = $datos['IdCargo'];
                $cargos = mysqli_query($conexion, "SELECT * FROM cargos where IdCargo = $id_cargo ");
                $cargo = mysqli_fetch_assoc($cargos);
                $name_cargo = $cargo["Cargo"];



                echo "<div class='user_line' onclick='AbrirVentanaV(this)' data-eva='$IdEvaluado'  data-infoUser='$id_evaluado'  >
                <div class='name TextU'>
                    $name $apellido
                </div>
                <div class='document TextU'>
                   $documento
                </div>
                <div  class='cargo TextU'>
                   $name_cargo
                </div>
            </div>";
              }
            }
          }else{
            echo '<div class="UserEva">
            <img  src="./img/users.png">
            <p>Actualmente, no tienes usuarios asignados para evaluar.</p>
            </div>';
          }
          ?>


          <div id='ContainerCardInfo' onclick="CerrarV()">
          
          </div>


          <div id='CardInfo'>
            <div class="UserInfo">


            </div>
            <div class="Evaluaciones_user">

              <h3>Evaluaciones</h3>
              <div class="Evas_container">


              </div>
            </div>
          </div>


        </div>

        <!-- hacer que se carguen los id de todos los factores para usarlos -->
        <!-- valores de id temporales para trabajar con JS  -->
        <!-- contenido sobre factores factores -->
        <?php



        // $dato_factor = mysqli_query($conexion, "SELECT * FROM factores where IdFactor = $factor1");
        
        // if(mysqli_num_rows($dato_factor) > 0){
        //   echo "hola mundo";
        // }
        
        $factor0 = 0;
        $factor1 = 1;
        $factor2 = 2;
        $factor3 = 3;
        $factor4 = 4;
        $factor5 = 5;

        ?>

      </div>

      <div class="evaluacion_ventana">
        <div id="return" onclick="abrirVentana()">
          <p>Cancelar</p>
        </div>

        <div id="VentanaAlerta">
          <div id="VentanaConfirm">
            <h2>¿Está seguro?</h2>
            <p class="text_delete">Si decides cancelar la evaluación, el progreso que hayas realizado se eliminará.</p>
            <div class="botos">
              <p class="continue" onclick="continuar()">Continuar Evaluación</p>

              <p class="cancel" id="Cancelar">Cancelar Evaluación</p>
            </div>
          </div>
        </div>

        <h2 class="title_ventana">Evaluacion Desempeño Laboral </h2>

        <form class="modulos_eva" method="post" id="form_eva" action="./php/setEvaluacion.php">
          <!-- modulo 1 -->

          <div class="modulo" data-id="<?php echo $factor0 ?>">
            <div class="number_mod">0</div>
            <div>
              DATOS PERSONALES
            </div>
            <div class="check2  radio">
              <p>L</p>
            </div>
          </div>



          <div class="table" data-factor="<?php echo $factor0 ?>">


            <div class="datos">
              <h3 class="title_datos">Evaluado</h3>
              <!-- fechas -->
              <div class="fechas">
                <div class="fechaD">
                  <p>Fecha de diligenciamiento</p>
                  <p class="fechaF"></p>
                </div>

                <div class="fechasDA">
                  <p>Periodo Evaluado</p>
                  <p class="fechaF"></p>
                </div>
              </div>

              <!-- nombre y identificacion -->
              <div class="datosP">
                <div>
                  <input type="hidden" id="IdEvaluacion" value="">
                  <input type="hidden" id="number999" name="number999" value="">
                  <input type="hidden" id="IdEvaluado" name="IdEvaluado" value="">
                  <p>Nombres</p>
                  <div class="nombres">
                    <input type="text" id="nombre1" name="nombre1" value="">
                    <input type="text" id="nombre2" name="nombre2" value="">
                  </div>
                </div>
                <div>
                  <p>
                    Apellidos
                  </p>
                  <div>
                    <input type="text" id="apellido1" name="apellido1" id="" value="">
                    <input type="text" id="apellido2" name="apellido2" id="" value="">
                  </div>
                </div>
                <div>
                  <p>Docmuento</p>
                  <input type="text" ID="dni" name="documento" value="">
                </div>
              </div>


              <div class="">
                <p>Dependencia</p>

                <div class="dependencias">
                  <input type="radio" name="dependencia" value="1" id="1">
                  <label for="1">Gerencia</label>
                  <input type="radio" name="dependencia" value="2" id="2">
                  <label for="2">Subgerencia comercial y del servicio al cliente</label>
                  <input type="radio" name="dependencia" value="3" id="3">
                  <label for="3">Subgerencia Corporativa </label>
                  <input type="radio" name="dependencia" value="4" id="4">
                  <label for="4">Subgerencia Ingeniería</label>
                </div>

              </div>
              <!-- cargo y tiempo de servicio -->
              <div class="cargoT">
                <div>
                  <p>Cargo</p>
                  <select name="IdCargo" id="cargo">

                    <?php
                    $cargos = mysqli_query($conexion, "SELECT * FROM cargos ");
                    if (mysqli_num_rows($cargos) > 0) {
                      while ($row = mysqli_fetch_array($cargos)) {
                        echo "<option value='{$row['IdCargo']}'>
                          <label>{$row['Cargo']}</label></div>
                          </option>
                          ";
                      }
                    }
                    ?>




                  </select>
                </div>

                <div>
                  <p>Antiguedad</p>
                  <input type="text" name="Antiguedad" id="Antiguedad" value="">
                </div>

                <div>
                  <p>Tiempo de servicio en el cargo</p>
                  <input type="text" name="TiempoServicio" id="TiempoServicio" value="">
                </div>


              </div>
            </div>
          </div>


          <div class="modulo" data-id="<?php echo $factor1 ?>">
            <div class="number_mod">1</div>
            <div>
              FACTOR DE CALIDAD
            </div>
            <div id="list1" class="check2 radio">
              <p>L</p>
            </div>
            <?php
            include './php/Conexion.php';
            $dato_factor = mysqli_query($conexion, "SELECT * FROM factor where IdFactor = $factor1");

            if (mysqli_num_rows($dato_factor) > 0) {
              $row = mysqli_fetch_assoc($dato_factor);
              $nombre_factor1 = $row['NombreFactor'];
            }

            $factor_pregunta = mysqli_query($conexion, "SELECT * FROM pregunta where IdFactor = $factor1");
            $descripciones1 = array(); // Inicializa el array
            
            if (mysqli_num_rows($factor_pregunta) > 0) {
              while ($row = mysqli_fetch_assoc($factor_pregunta)) {
                $descripciones1[] = $row["Descripcion"];
              }
            }

            // Accede a las descripciones individuales mediante índices
            $descripcion1 = $descripciones1[0];
            $descripcion2 = $descripciones1[1];
            $descripcion3 = $descripciones1[2];
            ?>





          </div>
          <div class="table" data-factor="<?php echo $factor1 ?>">



            <?php



            $idFactorSeleccionado = 1;

            $inner = mysqli_query($conexion, "SELECT r.IdRango, r.IdFactor, r.IdPregunta, r.Minimo, r.Maximo, r.Estado,
                f.IdFactor, f.NombreFactor, f.Estado,
                p.IdPregunta, p.IdFactor, p.Descripcion, p.Estado
            FROM rangocalificacion r
            INNER JOIN factor f ON r.IdFactor = f.IdFactor
            INNER JOIN pregunta p ON r.IdPregunta = p.IdPregunta
            where f.IdFactor = $idFactorSeleccionado and p.IdPregunta = 2");


            $resultados = array(); // Inicializamos un array para almacenar los resultados
            
            while ($row = mysqli_fetch_assoc($inner)) {

              $minimo = $row["Minimo"];
              $maximo = $row["Maximo"];

              // Almacenamos los datos en el array asociativo usando el IdPregunta como clave
              $resultados[] = array(
                "Minimo" => $minimo,
                "Maximo" => $maximo
              );
            }


            ?>


            <div class="table_title">
              <p class="title_name factor">
                <?php

                echo $nombre_factor1
                  ?>
              </p>

              <p class="title_name califi">
                Muy Inferior
              </p>
              <p class="title_name califi">
                Inferior
              </p>


              <p class="title_name califi">
                Sactisfactorio

              </p>

              <p class="title_name califi">
                Sobresaliente
              </p>

              <p class="title_name califi"> Excelente</p>

              <p class="title_name total">Total </p>

            </div>
            <div class="table_body">
              <div class="rangos_calificacion">
                <div class="enblanco ">

                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>

                <div class="enblanco2">
                  <!-- <input type="text"> -->
                </div>
              </div>



              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="1" name="P1">
                  <p>
                    <?php echo $descripcion1 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val1" id="val1" step="0.01">
                </div>
              </div>

              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="2" name="P2">
                  <p>
                    <?php echo $descripcion2 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" id="val2" name="Val2" step="0.01">
                </div>
              </div>

              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="3" name="P3">
                  <p>

                    <?php echo $descripcion3 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val3" step="0.01">
                </div>
              </div>
              <?php
              //  echo $min;
              //  echo $max;
              



              //  while ($row = $inner->fetch_assoc() ) {
              //      echo "<p>" . $row['Minimo'] . "</p>";
              //      echo "<p>" . $row['Maximo'] . "</p>";
              
              //  }
              ?>



            </div>

            <div class="observacion">
              <div class="cubeO">
                <p>
                  Subtotal Factor de Calidad
                </p>
                <p>
                  Observaciones
                </p>
                <textarea class="cuadro"  name="Observacion1" id=""></textarea>
              </div>
            </div>
          </div>

          <!-- modulo dos -->
          <div class="modulo" data-id="<?php echo $factor2 ?>">
            <div class="number_mod">2</div>
            <div>
              FACTOR DE EFICIENCIA Y RENDIMIENTO
            </div>
            <div class="check2 radio">
              <img
                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAA/ZJREFUaEO9WMlqFVEQPdVrhezdC35FIOQZMH6A4LAPuvBPXCiSpQPkM1yFQBCyzGeIGYhx80r69nSnulW332t79Xhd06k6VbduExZ+CADP8mHTbKXCx+nJyv4bm4vJ/CRfoak4TAFkspW4U/ybQVbgkIooAtjE9iaA/UAtMQgU6s1YLPiim6S+6KtMaUB6XwFgVp8qSkk+MvF4FRDezhshS+DJDJsu9//t2aTQJd0KAAQCl6YsZD5WuFFaMKZWlU/lmNCjNPeVrV4Bhcy2LWeFDkWVsMSzXA+YR6qcjcoppCYk4Tcz7xDRb4umJBPb0I+DUGJ2BZj5DYBPAFZEzfmclY2ZXwA4ZmDVEP1sm9ENiYqMzALQB/+lL8ktwLtEzUWFX/TBn0w2cEBEZ1N+00zngJUPskxEzPwEwGWX8VH9moH9Lov6w7x+BdD3SPIXgEdEdC9aKJ/EuuNBgpmPAHyONK4A7BGRV4mUEl3m+QQgv/p3gKvAqWXy+H6FMarP4CwIxhUoBjH1fkSboYhj8PYUTpKzemBQXzMfkatEQCevElMi2uAZOCHHu1F+fvC9aROAUlmDSkw4Ajolme8ycA/Giho6DfM5tarl1BcBWJXb2yev/Z4YUTgQAB4DGKbNEOs9A4cN0Q8rbba0zMnumPltfy74QjcAHkZafwE8o2zwlhbe0kGWg8LM7wF8KGS1HZGHbfCWUCVqiVPIWs5ULmhWCURAG5+i+bXJ69KhLbZ1DpSACmdE17R99ucnqtU0UUgpsPDaNTMlB1wfr2tuhUJyq0o7kmmMxpzL7STM/A7AxzC7fAPQA3/nAPAHwPOkieuaYnRTDUBoXmG14D2A2t3pG4DG0zXQyYZIAGCnkGUvYuaXAohVu/84YJZ4E5l219rgsQQ/mBdARKuE5T5gamIdFfP6CKBwI+2XuYboIvd9OA+C7wBym6jsVS5PUIFMhaaLlvdSzDxjjxp/nQ5Dak2sEzq56XQHxkFpL5LAVVPIXWgYlxH5rgHsk/lCw68BfI2mk36hyaAoA5DmfXcf9q6U2A0vMrl8hcYmOnED0G1/oTkzN3TvwgMgHyLJhb3bQL1LPZ0nIRumSg+i/TDwNFc9g4mNp1D4WcVfcPQ54CSY1ztEjfppZgKjTSEL7FJHad9EevvFgVFRzrQHJAfGjC4jZhyjlp1nmQAjqxUscN82tKpXVDTaCWzWi1JKX1WfA1KVLKH6MtLv/Bg1USjt7urKLM3BDA5TBSzZnWJfcAqYAOiEtPVxHeqszTz9tXNA2DfKdLJEuy2ZdEEc/6lrLFshancbs1WPqYqOJXO2C5U5OPPcLtzI9LB1iRGWRdTbLgufgRJo/wAJ+MRCxPfMPAAAAABJRU5ErkJggg==" />
            </div>

            <?php
            $dato_factor = mysqli_query($conexion, "SELECT * FROM factor where IdFactor = $factor2");

            if (mysqli_num_rows($dato_factor) > 0) {
              $row = mysqli_fetch_assoc($dato_factor);
              $nombre_factor2 = $row['NombreFactor'];
            }

            $factor_pregunta = mysqli_query($conexion, "SELECT * FROM pregunta where IdFactor = $factor2");
            $descripciones2 = array(); // Inicializa el array
            
            if (mysqli_num_rows($factor_pregunta) > 0) {
              while ($row = mysqli_fetch_assoc($factor_pregunta)) {
                $descripciones2[] = $row["Descripcion"];
              }
            }

            // Accede a las descripciones individuales mediante índices
            $descripcion1 = $descripciones2[0];
            $descripcion2 = $descripciones2[1];
            $descripcion3 = $descripciones2[2];
            ?>



          </div>

          <div class="table" data-factor="<?php echo $factor2 ?>">

            <?php



            $idFactorSeleccionado = 2;

            $inner = mysqli_query($conexion, "SELECT r.IdRango, r.IdFactor, r.IdPregunta, r.Minimo, r.Maximo, r.Estado,
            f.IdFactor, f.NombreFactor, f.Estado,
            p.IdPregunta, p.IdFactor, p.Descripcion, p.Estado
            FROM rangocalificacion r
            INNER JOIN factor f ON r.IdFactor = f.IdFactor
            INNER JOIN pregunta p ON r.IdPregunta = p.IdPregunta
            where f.IdFactor = $idFactorSeleccionado and p.IdPregunta = 2");


            $resultados = array(); // Inicializamos un array para almacenar los resultados
            
            while ($row = mysqli_fetch_assoc($inner)) {

              $minimo = $row["Minimo"];
              $maximo = $row["Maximo"];

              // Almacenamos los datos en el array asociativo usando el IdPregunta como clave
              $resultados[] = array(
                "Minimo" => $minimo,
                "Maximo" => $maximo
              );
            }






            ?>



            <div class="table_title">
              <p class="title_name factor">
                <?php

                echo $nombre_factor2
                  ?>
              </p>

              <p class="title_name califi">
                Muy Inferior
              </p>
              <p class="title_name califi">
                Inferior
              </p>


              <p class="title_name califi">
                Sactisfactorio

              </p>

              <p class="title_name califi">
                Sobresaliente
              </p>

              <p class="title_name califi"> Excelente</p>

              <p class="title_name total">Total </p>

            </div>
            <div class="table_body">
              <div class="rangos_calificacion">
                <div class="enblanco ">

                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>

                <div class="enblanco2">
                  <!-- <input type="text"> -->
                </div>
              </div>



              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="4" name="P4">
                  <p>
                    <?php echo $descripcion1 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2"> 
                  <input type="number" name="Val4"  step="0.01" >
                </div>
              </div>

              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="5" name="P5" >
                  <p>
                    <?php echo $descripcion2 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val5" step="0.01">
                </div>
              </div>

              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="6" name="P6">
                  <p>
                    <?php echo $descripcion3 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val6" step="0.01">
                </div>
              </div>
              <?php
              //  echo $min;
              //  echo $max;
              



              //  while ($row = $inner->fetch_assoc() ) {
              //      echo "<p>" . $row['Minimo'] . "</p>";
              //      echo "<p>" . $row['Maximo'] . "</p>";
              
              //  }
              ?>



            </div>

            <div class="observacion">
              <div class="cubeO">
                <p>
                  Subtotal Factor de Eficiencia y Redimiento
                </p>
                <p>
                  Observaciones
                </p>
                <textarea class="cuadro"  name="Observacion2" id=""></textarea>
              </div>
            </div>
          </div>

          <!-- modulo tres -->
          <div class="modulo " data-id=<?php echo $factor3 ?>>
            <div class="number_mod">3</div>
            <div>
              FACTOR DE RESPONSABILIDAD
            </div>
            <div class="check2 radio">
              <p>L</p>
            </div>

            <?php
            $dato_factor = mysqli_query($conexion, "SELECT * FROM factor where IdFactor = $factor3");

            if (mysqli_num_rows($dato_factor) > 0) {
              $row = mysqli_fetch_assoc($dato_factor);
              $nombre_factor3 = $row['NombreFactor'];
            }

            $factor_pregunta = mysqli_query($conexion, "SELECT * FROM pregunta where IdFactor = $factor3");
            $descripciones2 = array(); // Inicializa el array
            
            if (mysqli_num_rows($factor_pregunta) > 0) {
              while ($row = mysqli_fetch_assoc($factor_pregunta)) {
                $descripciones3[] = $row["Descripcion"];
              }
            }

            // Accede a las descripciones individuales mediante índices
            $descripcion1 = $descripciones3[0];
            $descripcion2 = $descripciones3[1];
            $descripcion3 = $descripciones3[2];
            ?>


          </div>

          <div class="table " data-factor="<?php echo $factor3 ?>">

            <?php



            $idFactorSeleccionado = 1;

            $inner = mysqli_query($conexion, "SELECT r.IdRango, r.IdFactor, r.IdPregunta, r.Minimo, r.Maximo, r.Estado,
            f.IdFactor, f.NombreFactor, f.Estado,
            p.IdPregunta, p.IdFactor, p.Descripcion, p.Estado
            FROM rangocalificacion r
            INNER JOIN factor f ON r.IdFactor = f.IdFactor
            INNER JOIN pregunta p ON r.IdPregunta = p.IdPregunta
            where f.IdFactor = $idFactorSeleccionado and p.IdPregunta = 2");



            $resultados = array(); // Inicializamos un array para almacenar los resultados
            
            while ($row = mysqli_fetch_assoc($inner)) {

              $minimo = $row["Minimo"];
              $maximo = $row["Maximo"];

              // Almacenamos los datos en el array asociativo usando el IdPregunta como clave
              $resultados[] = array(
                "Minimo" => $minimo,
                "Maximo" => $maximo
              );
            }






            ?>



            <div class="table_title">
              <p class="title_name factor">
                <?php

                echo $nombre_factor3
                  ?>
              </p>

              <p class="title_name califi">
                Muy Inferior
              </p>
              <p class="title_name califi">
                Inferior
              </p>


              <p class="title_name califi">
                Sactisfactorio

              </p>

              <p class="title_name califi">
                Sobresaliente
              </p>

              <p class="title_name califi"> Excelente</p>

              <p class="title_name total">Total </p>

            </div>
            <div class="table_body">
              <div class="rangos_calificacion">
                <div class="enblanco ">

                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>

                <div class="enblanco2">
                  <!-- <input type="text"> -->
                </div>
              </div>



              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="7" name="P7">
                  <p>
                    <?php echo $descripcion1 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val7" step="0.01">
                </div>
              </div>

              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="8" name="P8">
                  <p>
                    <?php echo $descripcion2 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val8" step="0.01">
                </div>
              </div>

              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="9" name="P9">
                  <p>
                    <?php echo $descripcion3 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val9" step="0.01">
                </div>
              </div>
              <?php
              //  echo $min;
              //  echo $max;
              



              //  while ($row = $inner->fetch_assoc() ) {
              //      echo "<p>" . $row['Minimo'] . "</p>";
              //      echo "<p>" . $row['Maximo'] . "</p>";
              
              //  }
              ?>



            </div>

            <div class="observacion">
              <div class="cubeO">
                <p>
                  Subtotal Factor de Responsabilidad
                </p>
                <p>
                  Observaciones
                </p>
                <textarea class="cuadro"  name="Observacion3" id=""></textarea>
              </div>
            </div>
          </div>
          <!-- modulo cuatro -->
          <div class="modulo " data-id="<?php echo $factor4 ?>">
            <div class="number_mod">4</div>
            <div>
              FACTOR ORGANIZACIÓN DEL TRABAJO
            </div>
            <div id="radio4" class="check2">
              <p>L</p>
            </div>
            <?php
            $dato_factor = mysqli_query($conexion, "SELECT * FROM factor where IdFactor = $factor4");

            if (mysqli_num_rows($dato_factor) > 0) {
              $row = mysqli_fetch_assoc($dato_factor);
              $nombre_factor4 = $row['NombreFactor'];
            }

            $factor_pregunta = mysqli_query($conexion, "SELECT * FROM pregunta where IdFactor = $factor4");
            $descripciones2 = array(); // Inicializa el array
            
            if (mysqli_num_rows($factor_pregunta) > 0) {
              while ($row = mysqli_fetch_assoc($factor_pregunta)) {
                $descripciones4[] = $row["Descripcion"];
              }
            }

            // Accede a las descripciones individuales mediante índices
            $descripcion1 = $descripciones4[0];
            $descripcion2 = $descripciones4[1];
            $descripcion3 = $descripciones4[2];
            ?>
          </div>

          <div class="table " data-factor="<?php echo $factor4 ?>">

            <?php



            $idFactorSeleccionado = 1;

            $inner = mysqli_query($conexion, "SELECT r.IdRango, r.IdFactor, r.IdPregunta, r.Minimo, r.Maximo, r.Estado,
            f.IdFactor, f.NombreFactor, f.Estado,
            p.IdPregunta, p.IdFactor, p.Descripcion, p.Estado
            FROM rangocalificacion r
            INNER JOIN factor f ON r.IdFactor = f.IdFactor
            INNER JOIN pregunta p ON r.IdPregunta = p.IdPregunta
            where f.IdFactor = $idFactorSeleccionado and p.IdPregunta = 2");


            $resultados = array(); // Inicializamos un array para almacenar los resultados
            
            while ($row = mysqli_fetch_assoc($inner)) {

              $minimo = $row["Minimo"];
              $maximo = $row["Maximo"];

              // Almacenamos los datos en el array asociativo usando el IdPregunta como clave
              $resultados[] = array(
                "Minimo" => $minimo,
                "Maximo" => $maximo
              );
            }






            ?>



            <div class="table_title">
              <p class="title_name factor">
                <?php

                echo $nombre_factor4
                  ?>
              </p>

              <p class="title_name califi">
                Muy Inferior
              </p>
              <p class="title_name califi">
                Inferior
              </p>


              <p class="title_name califi">
                Sactisfactorio

              </p>

              <p class="title_name califi">
                Sobresaliente
              </p>

              <p class="title_name califi"> Excelente</p>

              <p class="title_name total">Total </p>

            </div>
            <div class="table_body">
              <div class="rangos_calificacion">
                <div class="enblanco ">

                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>
                <div class="rangos">
                  <p>Min.</p>
                  <p>Max.</p>
                </div>

                <div class="enblanco2">
                  <!-- <input type="text"> -->
                </div>
              </div>



              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="22" name="P10">
                  <p>
                    <?php echo $descripcion1 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val10" id="input1" step="0.01" onblur="validarInputs()">
                </div>
              </div>

              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="23" name="P11">
                  <p>
                    <?php echo $descripcion2 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val11" id="input2"  step="0.01" onblur="validarInputs()">
                </div>
              </div>

              <div class="first_question">
                <div class="pregunta">
                  <input type="hidden" value="24" name="P12">
                  <p>
                    <?php echo $descripcion3 ?>
                  </p>
                </div>
                <div class="notas">
                  <p>16.6</p>
                  <p>31</p>
                </div>
                <div class="notas">
                  <p>31.1</p>
                  <p>49.91</p>
                </div>
                <div class="notas">
                  <p>50</p>
                  <p>64.92</p>
                </div>
                <div class="notas">
                  <p>65</p>
                  <p>79.91</p>
                </div>
                <div class="notas">
                  <p>80</p>
                  <p>83.3</p>

                </div>

                <div class="enblanco2">
                  <input type="number" name="Val12" id="input3" step="0.01" onblur="validarInputs()">
                </div>
              </div>
              <?php
              //  echo $min;
              //  echo $max;
              



              //  while ($row = $inner->fetch_assoc() ) {
              //      echo "<p>" . $row['Minimo'] . "</p>";
              //      echo "<p>" . $row['Maximo'] . "</p>";
              
              //  }
              ?>



            </div>

            <div class="observacion">
              <div class="cubeO">
                <p>
                  Subtotal Factor de Orgaización del trabajo
                </p>
                <p>
                  Observaciones
                </p>
                <textarea class="cuadro"  name="Observacion4" id=""></textarea>
              </div>
            </div>



          </div>

          <!-- modulo de observaciones -->
          <div class="modulo " data-id="<?php echo $factor5 ?>">
            <div class="number_mod">5</div>
            <div>
              OBSERVACIONES
            </div>
            <div class="check2 radio">
              <p>L</p>
            </div>
          </div>

          <div class="table" data-factor="<?php echo $factor5 ?>">
            <div class="tablaTotal">
              <p>Subtotal Factor de Organización</p>
              <div class="totalEva">
                <p class="NameTotal">Calificación Evaluado</p>
                <p class="nota">M.I Hasta 250</p>
                <p class="nota">I. Hasta 450</p>
                <p class="nota">Sa. Hasta 650</p>
                <p class="nota">So. Hasta 850</p>
                <p class="nota">E. Hasta 1000</p>
                <p class="nota" id="NotaTotal"></p>
              </div>
            </div>

            <div class="tablasMejoras">
              <h2>Plan de mejoramiento</h2>


              <div class="tablaMejora">
                <p>Acuerdos en el trabajo Cotidiano:</p>
                <textarea name="Acuerdo" id="" cols="90" rows="7">

                </textarea>
              </div>

              <div class="tablaMejora">
                <p>Capacitacion:</p>
                <textarea name="Capacitacion" id="" cols="90" rows="7">
                
                </textarea>
              </div>


            </div>



            <input type="submit" class="enviar" name="cargar" value="enviar">
          </div>






        </form>
      </div>
    </section>
    <section class="pages" id="descubre_asig">
      hh
    </section>
    <!-- CUALQUIER ERROR DE AQUI HACIA ABAJO -->

    <?php

    if ($rol == 0) {

      ?>

      <section class="pages" id="crearNovedad">
        sss


      </section>
      <section class="pages" id="verSolicitudes">
        sssss
      </section>
      <?php

    }

    ?>




    <!-- CUALQUIER ERROR SALE DE AQUI V: HACIA ARRIBA -->




    <section class="pages" id="crearAmbiente">
      lll
    </section>

    <section class="pages" id="crearUsuario">
      uu

    </section>


    <section class="pages" id="Usuarios">
      <div class="opciones_user">
        <input type="text" id="searchInput" placeholder="Nombre" >

        <div>
        <img id="add" src="./img/add.png" alt="">

        </div>
      </div>
      <div id="addUser">
        <form action="">
            <div>
              <p>Primer nombre</p>
              <input type="text" name="Name1">
            </div>

            <div>
              <p>Segundo nombre</p>
              <input type="text" name="Name2">
            </div>

            <div>
              <p>Primer Apellido</p>
              <input type="text" name="Apellido1">
            </div>
            <div>
              <p>Segundo Apellido</p>
              <input type="text" name="Apellido2">
            </div>

            <div>
              <p>TIpo de Documento</p>
              <select name="tipoDocuento" id="">
                <option value="">Documento identidad</option>
                <option value="">Tarjeta de identidad</option>
              </select>

              <input type="number" name="numeroDni">
            </div>


          <input type="submit" name="" value="Enviar" id="">
        </form>
      </div>
      <div id="Users">
      <?php 
      
      include './php/listarUsuarios.php'
      
      ?>
      </div>
  



          <div id='Containershow' onclick="CerrarS()">
          
          </div>


          <div id='ShowInfo'>
            <div class="UserInfo">


            </div>
            <div class="Evaluaciones_user">

              <h3>Evaluaciones</h3>
              <div class="Evas_container">


              </div>
            </div>
          </div>

       
          
    </section>

    <form method="post" enctype="multipart/form-data" class="pages" id="carruselNoticias">

      <header id="headerCarrusel">
        <h3>Lista de imagenes del carrusel de noticias</h3>
        <div>
          <label for="T100">Digite alguna información <br> importante Máximo 100 caracteres</label>
          <textarea name="textoNoticia" id="T100" cols="30" rows="10"></textarea>
          <input type="hidden" name="textoActual" id="T1000">
        </div>
      </header>

      <!--Cards dinamicas  -->
      <main id="mainCarrusel">
      </main>

      <!-- Input file de imagenes -->
      <label for="inputs" class="c-button c-button--gooey"> Subir imagenes
        <div class="c-button__blobs">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </label>
      <input type="file" name="imagenes[]" id="inputs" accept="image/*" multiple>


      <div class="controlsCarrusel">
        <button type="submit" class="bbutton"> Guardar</button>
      </div>

    </form>


    <section class="novedad_celador" id="novedad" onclick="cerrarFormularioN()">
      uu
    </section>


  </main>

  <script src="js/info_ambie_pisos.js"></script>
  <script src="js/admin.js"></script>
  <script src="js/ampliarImagen.js"></script>
  <script src="js/consultaAmbientes.js"></script>
  <!-- <script src="js/estadoUsuario.js"></script> -->
  <script src="js/crearUsuario.js"></script>
  <script src="js/crearAmbiente.js"></script>
  <script src="js/cargarExcelUsuarios.js"></script>
  <script src="js/cargarExcelAmbientes.js"></script>
  <script src="js/cargarExcelAsignacion.js"></script>
  <!-- <script src="js/mostrarimg.js"></script> -->
  <script src="archivos_calendario/index.global.js"></script>
  <script src="archivos_calendario/index.global.min.js"></script>
  <script src="archivos_calendario/es.global.js"></script>
  <script src="js/detalles_ambie.js"></script>
  <!-- <script src="js/slider.js"></script> -->
  <script src="js/cerrar.js"></script>
  <!-- <script src="js/CargarSlider.js"></script> -->
  <script src="js/menuResponsive.js"></script>
  <script src="js/modal1.js"></script>
  <script src="js/ventana.js"></script>
  <!-- <script src="js/novedad.js"></script> -->
  <!-- <script src="js/informeAsignacion.js"></script> -->
  <script src="js/EstadoAmbi.js"></script>
  <!-- <script src="js/validarVinculacion.js"></script> -->
  <script src="js/abrirDescrip.js"></script>
  <!-- <script src="js/call_ambientes.js"></script> -->
  <!-- <script src="js/descargarPlantillaUsuarios.js"></script> -->

  <!-- function the evaluacion  -->
  <script src="js/ventana_evaluado.js"></script>
  <script src="js/InfoUser.js"></script>
  <script src="js/Users.js"></script>


</body>

</html>