<?php
// Conexion a la base de datos
include('php/Conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inserción</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
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
    <div class="card">
    <a href="admin.php">Volver al menu principal</a>

        <h1 class="text-center">Formulario de Inserción en la tabla 'asignacion'</h1>
        <form action="php/insertarAsignacion.php" method="POST" autocomplete="off" action="php/">
            <div class="form-group">
                <label for="numero_ficha">Número de Ficha:</label>
                <input type="text" class="form-control" id="numero_ficha" name="numero_ficha" required>
            </div>

            <div class="form-group">
                <label for="formacion">Formación:</label>
                <input type="text" class="form-control" id="formacion" name="formacion" required>
            </div>

            <div class="form-group">
                <label for="motivo">Motivo:</label>
                <input type="text" class="form-control" id="motivo" name="motivo" required>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>

            <div class="form-group">
                <label for="jornada">Jornada:</label>
                <select class="form-control" name="jornada">
                    <option value="1">Mañana</option>
                    <option value="2">Tarde</option>
                    <option value="3">Noche</option>
                </select>
            </div>

            <div class="form-group">
                <label for="idambiente">Ambiente:</label>
                <select class="form-control" name="idambiente" id="idambiente">
                    <?php
                    $ambientes = $conexion->query("SELECT idambiente, nombre_ambiente FROM ambiente");
                    if ($ambientes->num_rows > 0) {
                        while ($amb = $ambientes->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $amb['idambiente'] ?>"><?php echo $amb['nombre_ambiente'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Insertar Registro</button>
        </form>
    </div>

    <!-- Scripts de Bootstrap (jQuery y Popper.js) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
