<?php
    // Nombre del archivo CSV
    $filename = "plantillaCargueUsuarios.csv";
    // Cabeceras para la descarga del archivo CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    // Abre la salida de flujo para el archivo CSV
    $output = fopen('php://output', 'w');
    // Escribe la fila de encabezado en el archivo CSV
    $csvHeader = ['nombre','apellido','documento','password_usuario','correo','telefono','rol','fechainiciocontrato','fechafincontrato','tipo vinculacion'];
    fputcsv($output, $csvHeader, ';');
    // Escribe una fila en blanco con los campos de fecha formateados
    $blankRow = ['', '', '','','','','', date('Y-m-d'), date('Y-m-d'), ''];
    fputcsv($output, $blankRow, ';');
    // Cierra la salida de flujo
    fclose($output);
?>
