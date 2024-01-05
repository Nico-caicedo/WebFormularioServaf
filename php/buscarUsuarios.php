<?php
require_once 'Conexion.php';

function obtenerDatosUsuario($conexion, $IdUser) {
    $consulta = $conexion->query("SELECT * FROM users WHERE IdUser = $IdUser");

    if ($consulta->num_rows > 0) {
        $persona = $consulta->fetch_assoc();
        $IdCargo = $persona['IdCargo'];

        $dato = $conexion->query("SELECT * FROM cargos WHERE IdCargo = $IdCargo");
        $cargo = $dato->fetch_assoc();
        $Cargoname = $cargo['Cargo'];

        $imagen = $persona['FotoPerfil'];
        if ($imagen === "") {
            $imagen = "sin_foto.png";
        }

        $estado = $persona['Estado'];
        $estados = ($estado == 1) ? "activo" : "inactivo";
        $state = ($estado == 1) ? "Activo" : "Inactivo";

        $modificarRuta = "./imgusuario/$imagen";

        $consult = $conexion->query("SELECT * FROM evaluados WHERE IdUser = $IdUser");
        $row = $consult->fetch_assoc();
        $IdEvaluados = $row['IdEvaluado'];

        return array(
            'nombre' => $persona['Nombre1'] . ' ' . $persona['Nombre2'] . ' ' . $persona['Apellido1'] . ' ' . $persona['Apellido2'],
            'cargo' => $Cargoname,
            'correo' => $persona['correo'],
            'telefono' => $persona['telefono'],
            'imagen' => $modificarRuta,
            'estado' => $state,
            'idEvaluados' => $IdEvaluados,
            'idUsuario' => $IdUser
        );
    } else {
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchTerm = $_POST['searchTerm'];

    $consulta = $conexion->query("SELECT * FROM users WHERE Nombre1 LIKE '%$searchTerm%' OR Nombre2 LIKE '%$searchTerm%' OR Apellido1 LIKE '%$searchTerm%' OR Apellido2 LIKE '%$searchTerm%'");

    $resultados = array();

    if ($consulta->num_rows > 0) {
        while ($persona = $consulta->fetch_assoc()) {
            $resultados[] = obtenerDatosUsuario($conexion, $persona['IdUser']);
        }
    } else {
        $resultados[] = array(
            'mensaje' => 'Lo siento, no hay usuarios que coincidan con esa información.'
        );
    }

    echo json_encode($resultados);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $consulta = $conexion->query("SELECT * FROM users");

    $resultados = array();

    if ($consulta->num_rows > 0) {
        while ($persona = $consulta->fetch_assoc()) {
            $resultados[] = obtenerDatosUsuario($conexion, $persona['IdUser']);
        }
    } else {
        $resultados[] = array(
            'mensaje' => 'Lo siento, no hay usuarios que coincidan con esa información.'
        );
    }

    echo json_encode($resultados);
}
?>
