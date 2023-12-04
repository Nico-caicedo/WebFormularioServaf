<?php

//conexion a base de datos


include './php/Conexion.php';

if (isset($_POST['acceder'])) {

    //valida que los datos fueron enviados
    if (isset($_POST['id']) && isset($_POST['clave'])) {
        //los datos recibidos los vuelve variables
        $id = $_POST['id'];
        $clave = $_POST['clave'];


        $consulta = "SELECT * FROM usuario WHERE documento = '$id' and password_usuario = '$clave' ";
        $result = mysqli_query($conexion, $consulta, );


        if (mysqli_num_rows($result) == 1) {
            // Obtener la información del usuario de la base de datos
            $row = mysqli_fetch_assoc($result);
            $valorname = $row['nombre_usuario'];
            $_SESSION['nombre'] = $row['nombre_usuario'];
            $_SESSION['apellidos'] = $row['apellido'];
            $_SESSION['rol'] = $row['idrol'];
            $_SESSION['id'] = $row['idusuario'];
            $_SESSION['cedula'] = $row['documento'];
            // $_SESSION['foto'] = $row['foto'];
            if (isset($row['nombre_usuario'])) {
              echo "<script>window.location.href = 'admin.php'</script>";
            
            }


        } else if (mysqli_num_rows($result) == 0) {
            echo "<script>
            Swal.fire(
                {

                    icon:'error',
                    html: 'Usuario incorrecto',
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





    //valida si los inputs estan vacios

    if (empty($_POST['id']) && empty($_POST['clave'])) {
        echo "<script>
                Swal.fire(
                    {

                        icon:'warning',
                        html: '<p>Ingrese cédula y clave<p>',
                        backdrop: false,
                        color:'black',
                        toast: true,
                        timer:3000,
                        background: 'rgba(128, 126, 0, 0.493)',
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
                        html: 'ingrese usario',
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
    } elseif (empty($_POST['clave'])) {
        echo "<script>
                Swal.fire(
                    {

                        icon:'info',
                        html: 'Ingrese Clave',
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



    }




    // if($result){
    //     echo "<script>
    //             Swal.fire(
    //                 {

    //                     icon:'question',
    //                     html: 'INGRESA SU NÚMERO DE DOCUMENTO',
    //                     backdrop: false,
    //                     toast: true,
    //                     timer:3000,
    //                     background: 'red',
    //                     padding: '1rem',
    //                     position:'bottom',
    //                     customClass: {
    //                         popup: 'my-popup-class',
    //                         icon: 'icon',
    //                       },
    //                     showConfirmButton: false,

    //                 }
    //             )
    //             </script>";
    // }else{
    //     echo "algo fallo verfica";
    // }

}

?>