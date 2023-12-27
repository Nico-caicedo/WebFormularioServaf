<?php
//conexion a base de datos
include('php/Conexion.php');

if (isset($_POST['sesion'])) {

    // date_default_timezone_set('America/Bogota');
    // // Obtener la fecha actual
    // $fecha_actual = date("Y-m-d");
    // $fecha_actual_times = strtotime($fecha_actual);
    // Consulta SQL para obtener los registros con fecha de finalización menor o igual a la fecha actual
    $sql = "SELECT * FROM users";

    $resultado = $conexion->query($sql);



    //valida si los inputs estan vacios
    if (empty($_POST['id']) && empty($_POST['password'])) {
        echo "<script>
                Swal.fire(
                    {

                        icon:'warning',
                        html: '<p>INGRESE NOMBRE Y CLAVE<p>',
                        backdrop: false,
                        color:'black',
                        toast: true,
                        timer:3000,
                        background: '#ffffff',
                        padding: '1rem',
                        position:'bottom',
                        customClass: {
                            popup: 'my-popup-class',
                            icon: 'icon',
                        },
                        showConfirmButton: false,

                    }
                )
                </script>";

    } else if (!is_numeric($_POST['id'])) {
        echo "<script>
        Swal.fire(
            {
    
                icon:'warning',
                html: '<p>documento tipo texto<p>',
                backdrop: false,
                color:'black',
                toast: true,
                timer:3000,
                background: '#ffffff',
                padding: '1rem',
                position:'bottom',
                customClass: {
                    popup: 'my-popup-class',
                    icon: 'icon',
                },
                showConfirmButton: false,
    
            }
        )
        </script>";

    } else if (empty($_POST['id'])) {
        echo "<script>
                Swal.fire(
                    {

                        icon:'info',
                        html: 'INGRESE USUARIO',
                        backdrop: false,
                        toast: true,
                        timer:3000,
                        background: ' #f1f1f1',
                        padding: '1rem',
                        position:'bottom',
                        customClass: {
                            popup: 'my-popup-class',
                            icon: 'icon',
                        },
                        showConfirmButton: false,

                    }
                )
                </script>";
    } elseif (empty($_POST['password'])) {
        echo "<script>
                Swal.fire(
                    {

                        icon:'info',
                        html: 'INGRESE CLAVE',
                        backdrop: false,
                        toast: true,
                        timer:3000,
                        background: ' #f1f1f1',
                        padding: '1rem',
                        position:'bottom',
                        customClass: {
                            popup: 'my-popup-class',
                            icon: 'icon',
                        },
                        showConfirmButton: false,

                    }
                )
                </script>";


        //valida que los datos fueron enviados
    } else if (isset($_POST['id']) && isset($_POST['password'])) {
        //los datos recibidos los vuelve variables
        $id = $_POST['id'];
        $clave = $_POST['password'];

        $consulta = "SELECT * FROM users WHERE Document = '$id' and Pasword = '$clave' and Estado = 1 and Jefe = 1 ";
        $result = mysqli_query($conexion, $consulta );

        if (mysqli_num_rows($result) > 0) {
            // Obtener la información del usuario de la base de datos
            $row = mysqli_fetch_assoc($result);


            if ($row['Estado'] == 1) {

        
                $_SESSION['nombre'] = $row['Nombre1'];
                $_SESSION['apellido1'] = $row['Apellido1'];
                $_SESSION['apellido2'] = $row['Apellido2'];
                 $_SESSION['telefono'] = $row['telefono'];
                $_SESSION['id'] = $row['IdUser'];
                $_SESSION['rol'] = $row['IdRol'];
                $_SESSION['cedula'] = $row['Document'];
                $IdUser = $row['IdUser'];
                $usuario = mysqli_query($conexion, "SELECT * FROM evaluadores WHERE IdUser = $IdUser");
                $evaluador = mysqli_fetch_assoc($usuario);
                $_SESSION['id_evaluador'] = $evaluador['IdEvaluadores'];

                 $_SESSION['email'] = $row['correo'];
                 $_SESSION['img'] = $row['FotoPerfil'];
                echo "<script>window.location.href='./admin.php'</script>";
                //    echo "<script>window.location.href='./php/admin_vista.php'</script>";
            } else if ($row['Estado'] == 2) {
                echo "
                <script>
                Swal.fire(
                    {
    
                        icon:'warning',
                        html: 'USUARIO INACTIVO',
                        backdrop: false,
                        toast: true,
                        timer:3000,
                        background: 'white',
                        padding: '1rem',
                        position:'bottom',
                        customClass: {
                            popup: 'my-popup-class',
                            icon: 'icon',
                        },
                        showConfirmButton: false,
    
                    }
                )
                </script>";
            }
        } else if (mysqli_num_rows($result) == 0) {
            echo "<script>
            Swal.fire(
                {

                    icon:'error',
                    html: 'USUARIO INCORRECTO',
                    backdrop: false,
                    toast: true,
                    timer:3000,
                    background: 'white',
                    padding: '1rem',
                    position:'bottom',
                    customClass: {
                        popup: 'my-popup-class',
                        icon: 'icon',
                    },
                    showConfirmButton: false,

                }
            )
            </script>";

        }


    }

}

?>