<?php
// Nombre del archivo CSV
$filename = "plantillaCargueAsignacion.csv";
// Cabeceras para la descarga del archivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
// Abre la salida de flujo para el archivo CSV
$output = fopen('php://output', 'w');
// Escribe la fila de encabezado en el archivo CSV
$csvHeader = ['numero_ficha',  'motivo', 'fecha_inicio', 'fecha_fin', 'jornada', 'documento', 'ambiente'];
fputcsv($output, $csvHeader, ';');
// Escribe una fila en blanco con los campos de fecha formateados
$blankRow = ['', '',  date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), '', '', ''];
fputcsv($output, $blankRow, ';');
// Cierra la salida de flujo
fclose($output);
?>

