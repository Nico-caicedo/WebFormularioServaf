<?php
include('conexion.php');

// Obtén el ID del piso seleccionado desde el frontend (select1)
$idSeleccionado = $_GET['id_Amb'] ;

// Prepara la consulta SQL para obtener los ambientes ocupados en el piso seleccionado
$sql = "SELECT ambiente.idambiente, ambiente.nombre_ambiente, asignacion.idsolicitud
        FROM ambiente
        INNER JOIN asignacion ON ambiente.idambiente = asignacion.idambiente
        WHERE ambiente.piso_ambiente = $idSeleccionado
        AND asignacion.estado_ambiente = 2 ";

$result = $conexion->query($sql);

// Si hay resultados, crea un array de opciones en formato JSON
$options = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[] = [
            'id' => $row['idambiente'],
            'nombre' => $row['nombre_ambiente'],
            'id_asignacion' => $row['idsolicitud']
        ];
    }
} else {
    // Si no hay resultados, crea un mensaje de error en formato JSON
    $options = [
        'error' => 'No se encontraron ambientes ocupados en este piso.'
    ];
}

// Devuelve las opciones (ya sea datos o mensaje de error) en formato JSON
header('Content-Type: application/json');
echo json_encode($options);

// Cierra la conexión a la base de datos
$conexion->close();
?>
