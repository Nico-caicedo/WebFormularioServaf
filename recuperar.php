<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/Rlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/recuperarContrasea.css">
    <title>Recuperar contraseña</title>
</head>

<body>
    <div class="" id="carga">
        <div class="custom-loader"></div>
        <h3 style="color: #f0f2f5;">Cargando...</h3>
    </div>
    <div class="sombra">
        .
    </div>
    <div class="popup">
        <form class="form" method="post">
            <div class="icon">
                <img src="img/candado.svg" alt="" width="100%">
            </div>
            <div class="note">
                <label class="title">Recuperar mi contraseña</label>
                <span class="subtitle">Para recuperar tu contraseña, te enviaremos un código a tu correo dentro del
                    sistema.</span>
            </div>
            <input placeholder="Ingresa tu correo personal" title="Ingresa tu correo personal" name="email" type="email"
                class="input_field" required>
            <button class="submit" name="validar">Validar</button>
            <a href="index.php" style="text-decoration: none; font-size: 16px;">Volver</a>
        </form>
    </div>
    <?php

    if (isset($_POST['validar'])) {


        $correoRecuperacion = $_POST['email'];
        require_once 'php/consultarUsuarioCorreo.php';
        $id = consultarUsuarioCorreo($correoRecuperacion);

        if ($id != null) {



            $token = password_hash($correoRecuperacion, PASSWORD_DEFAULT);
            $_SESSION['correoHash'] = $correoRecuperacion;
            $_SESSION['idUsuariogeneraradoCorreo'] = $id;
            echo ' <style>
            #carga {
                display: grid;
            }
        </style>';
            ?>
            <script>
                window.location.href = "codigoRecuperacion.php?email=<?php echo $token; ?>";
            </script>
            <?php

        } else {
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>

                Swal.fire(
                    {

                        icon: 'warning',
                        html: 'El  CORREO NO EXISTE',
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

    }


    ?>
</body>

</html>