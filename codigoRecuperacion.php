<?php
if(!isset($_GET['email'])){
    echo "<script>window.location.href='recuperar.php'</script>";
}
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/Rlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/codigoRecuperacion.css">
    <title>Codigo verificación</title>
</head>

<body>
    <div class="sombra">
        .
    </div>
    <form class="form" method="post" action="">
        <div class="title">Ingresa el código</div>
        <div class="title">Verification Code</div>
        <p class="message">We have sent a verification code to your mobile number</p>
        <div class="inputs"> <input id="input1" type="text" maxlength="1" name="numero1"> <input id="input2" type="text"
                name="numero2" maxlength="1">
            <input id="input3" name="numero3" type="text" maxlength="1"> <input id="input4" type="text" name="numero4"
                maxlength="1">
        </div> <button class="action" type="submit" name="validarCodigo">verify me</button>
    </form>
    <?php


    if (isset($_POST['validarCodigo'])) {

        $codigoSesion = $_SESSION['codigoSeguridad'];
        $nu1 = $_POST['numero1'];
        $nu2 = $_POST['numero2'];
        $nu3 = $_POST['numero3'];
        $nu4 = $_POST['numero4'];

        $codigoCompleto = $nu1 . $nu2 . $nu3 . $nu4;

        if ($codigoCompleto === $codigoSesion) {
            echo '<script>window.location.href="cambiarContraseña.php"</script>';

        } else {
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>

                Swal.fire(
                    {

                        icon: 'warning',
                        html: 'CÓDIGO INCORRECTO',
                        backdrop: false,
                        toast: true,
                        timer: 3000,
                        background: 'white',
                        padding: '1rem',
                        position: 'bottom',
                        customClass: {
                            popup: 'my-popup-class',
                            icon: 'icon',
                        },
                        showConfirmButton: false,

                    }
                )


            </script>

            <?php
        }

    } elseif (!isset($_GET['email'])) {
        echo '<script>window.location.href="recuperar.php"</script>';
    } else{

        if (!isset($_SESSION['envioUnico'])) {


            $hash = $_GET['email'];
            $correo = $_SESSION['correoHash'];


            if (password_verify($correo, $hash)) {

                
                $id = $_SESSION['idUsuariogeneraradoCorreo'];
                $_SESSION['idusaurioCambio'] = $id;
                $_SESSION['envioUnico'] = true;

            } 


            function generarCodigo()
            {
                $codigo = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                return $codigo;
            }

            $codigoGenerado = generarCodigo();
            $_SESSION['codigoSeguridad'] = $codigoGenerado;

            require_once 'php/enviarCodigo.php';



        }


    }



    ?>
</body>

</html>