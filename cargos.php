<?php
include("./php/conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el valor de la dependencia seleccionada
    $idDependencia = isset($_POST['dependencia']) ? $_POST['dependencia'] : '';

    // Verificar si se seleccionó alguna dependencia
    if (!empty($idDependencia)) {
        // Obtener los valores de los checkbox seleccionados
        if (!empty($_POST['cargos']) && is_array($_POST['cargos'])) {
            foreach ($_POST['cargos'] as $idCargo) {
                // Utilizar consultas preparadas para prevenir inyecciones SQL
                $query = "UPDATE cargos SET IdDependencia = ?, Asignado = 1 WHERE IdCargo = ?";
                $stmt = mysqli_prepare($conexion, $query);
                mysqli_stmt_bind_param($stmt, 'ii', $idDependencia, $idCargo);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.servaf.com/wp-content/uploads/2021/03/gota_favicon.png" type="image/x-icon">
    <title>Cargos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 20px;
            height: 85vh;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 80%;
        }

        .scroll {
            overflow: auto;
            height: 90%;
        }

        label {
            margin-bottom: 8px;
        }

        select,
        input[type="checkbox"] {
            margin-bottom: 16px;
        }

        input[type="checkbox"] {
            margin-right: 8px;
        }

        .enviar {
            position: fixed;
            right: 10%;
            top: 300px;
            height: 50px;
            width: 150px;
            background-color: #00FF00;
            border: none;
            font-size: 1.9em;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Asignar cargos a dependencias</h1>

    <form action="" method="post">
        <label for="dependencia">Dependencias</label>

        <?php
        $consulta = mysqli_query($conexion, "SELECT * FROM dependencias WHERE Estado = 1");
        if (mysqli_num_rows($consulta) > 0) {
            echo "<select name='dependencia' id='dependencia'>";
            while ($row = mysqli_fetch_array($consulta)) {
                echo "<option value='{$row['IdDependencia']}'>{$row['Dependencia']}</option>";
            }
            echo "</select>";
        }
        ?>

        <div class="scroll">
        <?php
            $cargos = mysqli_query($conexion, "SELECT * FROM cargos WHERE Asignado = 0");
            if (mysqli_num_rows($cargos) > 0) {
                while ($row = mysqli_fetch_array($cargos)) {
                    echo "<div><input type='checkbox' name='cargos[]' value='{$row['IdCargo']}'>
                          <label>{$row['Cargo']}</label></div>";
                }
            }
            ?>
        </div>

        <input type="submit" value="Enviar" name="cargar" class="enviar">

    </form>
</body>

</html>
