<?php
include("./php/Conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el valor de la dependencia seleccionada
    $idJefe = $_POST['jefe'];
    
    // Verificar si se seleccionó alguna dependencia
    if (!empty($idJefe) && isset($_POST['usuarios'])) {
        $idEvaluadores = $_POST['usuarios'];

        foreach ($idEvaluadores as $idUsuario) {
            // Actualizar la tabla de Evaluados con el IdUser y IdEvaluador seleccionados
            $query = "INSERT INTO Evaluados (IdUser, IdEvaluador) VALUES ('$idUsuario', '$idJefe')";
            mysqli_query($conexion, $query);

            $queryUpdate = "UPDATE users SET Asignado = 1 WHERE IdUser = '$idUsuario'";
            mysqli_query($conexion, $queryUpdate);
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
    <title>jefes</title>

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
    <h1>Asignar Evaluados a Evaluadores</h1>

    <form action="" method="post">
        <label for="">Jefes Evaluadores</label>

        <?php
        $jefes = mysqli_query($conexion, "SELECT * FROM evaluadores");
        if (mysqli_num_rows($jefes) > 0) {
            echo "<select name='jefe'>";
            while ($rows = mysqli_fetch_array($jefes)) {
                $IdJefe = $rows['IdUser'];
                $consulta = mysqli_query($conexion, "SELECT * FROM users WHERE Estado = 1 AND IdUser = {$rows['IdUser']} ");

                if (mysqli_num_rows($consulta) > 0) {
                    while ($row = mysqli_fetch_array($consulta)) {
                        echo "<option value='{$rows['IdEvaluadores']}'>{$row['Nombre1']} {$row['Nombre2']} {$row['Apellido1']} {$row['Apellido2']}</option>";
                    }
                }
            }
            echo "</select>";
        }
        ?>

        <div class="scroll">
            <?php
            $usuarios = mysqli_query($conexion, "SELECT * FROM users WHERE Asignado = 0 ORDER BY Nombre1, Nombre2, Apellido1, Apellido2");
            if (mysqli_num_rows($usuarios) > 0) {
                while ($row = mysqli_fetch_array($usuarios)) {
                    echo "<div><input type='checkbox' name='usuarios[]' value='{$row['IdUser']}'>
                          <label>{$row['Nombre1']} {$row['Nombre2']} {$row['Apellido1']} {$row['Apellido2']}</label></div>";
                }
            }
            ?>
        </div>

        <input type="submit" value="Enviar" name="cargar" class="enviar">
    </form>
</body>

</html>
