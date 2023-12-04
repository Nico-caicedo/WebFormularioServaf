<?php
session_start();
error_reporting(0);

if (isset($_SESSION['correoHash'])) {
    unset($_SESSION['correoHash']);
}
if (isset($_SESSION['idusaurioCambio'])) {
    unset($_SESSION['idusaurioCambio']);
}
if (isset($_SESSION['envioUnico'])) {
    unset($_SESSION['envioUnico']);
}
include('./php/conexion.php');


// Verificar si el usuario ya ha iniciado sesión
if($_SESSION['rol']) {
	header("Location: admin.php");

};

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="./css/styles.css">
	<link rel="Website Icon" type="png" href="../asset/img/login.svg">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="https://www.servaf.com/wp-content/uploads/2021/03/gota_favicon.png"
	 type="image/x-icon">
	<title>Login</title>


</head>

<body>
	<div class="sombra">
		.
	</div>
	<img class="servaf_title" src="./img/title_servaf.png" alt="">
	<hr>
	</h2>
	
	<div class="container" id="container">

		<div class="form-container sign-in-container">
			<form action="" method="POST">
				<!-- titulo del contenedor -->
				<h1>Iniciar sesión</h1>

				<input type="number" name="id" placeholder="Documento" min="0" maxlength="12" />
				<input type="password" name="password" placeholder="Contraseña" />
				<!-- <a href="#">Olvidaste tu contraseña?</a> -->
				<input class="sesion" type="submit" name="sesion" value="Iniciar Sesion">
				<a href="recuperar.php">Olvide mi contraseña</a>
			</form>

		</div>
		<div class="overlay">
			<img class="img" src="./img/ServafPerfil.jpg">

	</div>


	<?php
	include('php/acceso.php');
	?>

</body>

</html>