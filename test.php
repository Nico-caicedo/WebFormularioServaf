<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Clases</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<form action="./php/ReportePdf.php" method="post" >

<?php 
$IdEva = 208;
$IdEvaluadors = 3;
$IdEvaluado = 104;

?>
numero de evaluacion
<input type="number" name="evaluacion">
evaluador
<input type="number" name="evaluador">
evaluado
<input type="number" name="evaluado">

<input type="submit" value="enviar" name="enviar">

</form>

</body>
</html>
