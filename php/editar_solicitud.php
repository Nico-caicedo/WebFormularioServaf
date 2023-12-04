<?php
session_start();
require_once "Conexion.php";

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_solicitud = $_GET['id'];
    
    // Obtener datos de la solicitud
    $sql = "SELECT * FROM asignacion WHERE idsolicitud = $id_solicitud";
    $result = $conexion->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $numero_ficha = $row['numero_ficha'];
        $formacion = $row['formacion'];
        $motivo = $row['motivo'];
    } else {
        echo "No se encontró la solicitud.";
        exit();
    }

    // Procesar el formulario de actualización
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $numero_ficha = $_POST['numero_ficha'];
        $formacion = $_POST['formacion'];
        $motivo = $_POST['motivo'];

        // Validar y actualizar la base de datos
        // (Asegúrate de hacer las validaciones necesarias y de evitar inyecciones de SQL)
        $sql_update = "UPDATE asignacion SET numero_ficha='$numero_ficha', formacion='$formacion', motivo='$motivo' WHERE idsolicitud = $id_solicitud";

        if ($conexion->query($sql_update) === TRUE) {
            echo '<script type="text/javascript">
            alert("¡Solicitud actualizada correctamente!");
            window.location.href = "../admin.php";
        </script>';
        } else {
            echo "Error al actualizar la solicitud: " . $conexion->error;
        }
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "ID de solicitud no válido.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Solicitud</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo para centrar el contenido verticalmente */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Estilo para la tarjeta */
        .card {
            width: 80%;
            padding: 20px;
            overflow: auto;
            height: 80%;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
<?php
if ($numero_ficha == 1) {
    echo '<div class="card">
        <h1 class="text-center">Formulario de edicion en la tabla \'asignacion\'</h1>
        <form method="POST" autocomplete="off">
                <input type="hidden" class="form-control" id="numero_ficha" name="numero_ficha" value="1"><br>
            <div class="form-group">
                <label for="motivo">Motivo:</label>
                <input type="text" id="motivo" class="form-control" name="motivo" value="' . $motivo . '">
            </div>
            <input type="submit" class="btn btn-primary" value="Actualizar">
        </form>
    </div>';
} else {
    echo '<div class="card">
        <h1 class="text-center">Formulario de edicion en la tabla \'asignacion\'</h1>
        <form method="POST" autocomplete="off">
            <div class="form-group">
                <label for="numero_ficha">Número de Ficha:</label>
                <input type="text" class="form-control" id="numero_ficha" name="numero_ficha" value="' . $numero_ficha . '"><br>
            </div>

            <div class="form-group">
                <label for="formacion">Formación:</label>
                <input type="text" class="form-control" id="formacion" name="formacion" value="' . $formacion . '"><br>
            </div>
            <input type="submit" class="btn btn-primary" value="Actualizar">
        </form>
    </div>';
}
?>

    <!-- Scripts de Bootstrap (jQuery y Popper.js) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
