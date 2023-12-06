<?php
require_once 'Conexion.php';

$consulta = $conexion->query("SELECT * FROM users   ");
if ($consulta->num_rows > 0) {
  while ($persona = $consulta->fetch_assoc()) {
    $IdCargo = $persona['IdCargo'];

    $dato = mysqli_query($conexion, "SELECT * FROM cargos where IdCargo = $IdCargo");
    $cargo = mysqli_fetch_assoc($dato);

    $Cargoname = $cargo['Cargo'];

    $imagen = $persona['FotoPerfil'];
    if ($imagen === "") {
      $imagen = "sin_foto.png";
    }

    $estado = $persona['Estado'];

    if ($estado == 1) {
      $estados = "activo";
      $state = "Activo";
    } else if ($estado == 2) {
      $estados = "inactivo";
      $state = "Inactivo";
    }


    // Modificar la ruta de la imagen si es necesario
    $modificarRuta = "./imgusuario/$imagen";

    $Iduser = $persona['IdUser'];

    $consult = mysqli_query($conexion, "SELECT * FROM evaluados where IdUser = $Iduser");
    $row = mysqli_fetch_assoc($consult);

    $IdEvaluados = $row['IdEvaluado'];

    echo '
        <div class="itemProfileview">
            <div class="profileAbout">
              <img src=" ' . $modificarRuta . ' " alt="" />
              <span>
                <b>' . $persona['Nombre1'] . ' ' . $persona['Nombre2'] . ' ' . $persona['Apellido1'] . ' ' . $persona['Apellido2'] . '</b>
                <p>' . $Cargoname . '</p>
              </span>
            </div>

        


            <div class="profileDocument">
              <b>Correo</b>
              <p>' . $persona['correo'] . '</p>
            </div>
            <div class="profileDocument">
              <b>teléfono</b>
              <p>' . $persona['telefono'] . '</p>
            </div>

            <div class="show" onclick="AbrirVentanaS(this)"  data-eva="' . $IdEvaluados .'"  data-infoUser="' . $Iduser .'">
              sss
             </div>
                <div class="estados ' . $estados . '">
                    <input type="hidden" id="" class="Estado" name="" value="' . $persona['IdUser'] . '" >
                  
                    <p class="NameState">' . $state . '</p>
                </div>
                <div class="edit">
                    <input type="hidden" id="inactivo-' . $persona['IdUser'] . '" name="estadoCliente[' . $persona['Estado'] . ']" value="2" ' . ($persona['Estado'] == '0' ? 'checked' : '') . '>
                    <p>Editar</p>
                </div>
                
        
            
          </div>';
  }






} else {
  echo "
  <img src='./imgusuario/no_user.svg'>
  <p id='notUsers'>Sin usuarios en el momento.</p>";
}
?>