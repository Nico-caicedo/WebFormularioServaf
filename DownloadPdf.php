<?php





session_start();
include_once '../PDF/TCPDF-main/tcpdf.php';


date_default_timezone_set('America/Bogota');
//Librerias para generar PDF






$IdEvas = isset($_GET['IdEva']) ? $_GET['IdEva'] : '';
$infoUser = isset($_GET['infoUser']) ? $_GET['infoUser'] : '';

$IdEva = $IdEvas;
$IdEvaluadors = $_SESSION['id_evaluador'];
$IdEvaluado = $infoUser;

$NombrePDF = "";

$Observacion1 = "";
$Observacion2 = "";
$Observacion3 = "";
$Observacion4 = "";
$Acuerdo = "";
$Capacitacion = "";




function miFuncion()
{
	global $suma1;
	global $suma2;
	global $suma3;
	global $idevaluacion;

}



class MYPDF extends TCPDF
{


	public function Header()
	{
		$path = dirname(__FILE__);
		$logo = $path . '../img/sena.png';

		/**Logo Derecha */
		$bMargin = $this->getBreakMargin();
		$auto_page_break = $this->AutoPageBreak;
		$this->SetAutoPageBreak(false, 0);
		// $img_file = '/img/logo.png';
		$img_file = __DIR__ . '/../img/EncabezadoSERVAF.jpg';

		$this->Image($img_file, 10, 5, 100, 25, '', '', '', false, 30, '', false, false, 0);
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		$this->setPageMark();

		$this->Ln(1);
		/**Logo Izquierdo  $this->Image('src imagen', Eje X, Eje Y, Tamaño de la Imagen );*/
		$this->Image($logo, 180, 12, 15);

		$this->Ln(1);
		$this->Image($logo, 180, 12, 15);
		$this->Ln(1);
		$this->SetFont('helvetica', 'B', 18);
		$this->Cell(30);
		$this->Cell(115, 30, 'Evaluación De Desempeño Laboral', 0, 0, 'C');

	}



	// Agrega una función para la sección de evaluación de desempeño
	public function EvaluacionDesempenoSection()
	{
		include_once './Conexion.php';
		global $suma1;
		global $IdEva;
		global $IdEvaluadors;
		global $IdEvaluado;
		global $NombrePDF;
		global $Observacion1;
		global $Observacion2;
		global $Observacion3;
		global $Observacion4;
		global $Acuerdo;
		global $Capacitacion;
		// info de evaluador 

		$evaluador = $IdEvaluadors;


		$datos_evaluador = mysqli_query($conexion, "SELECT * FROM evaluadores where IdEvaluadores = $evaluador");

		if (mysqli_num_rows($datos_evaluador) > 0) {
			$datos = mysqli_fetch_assoc($datos_evaluador);

			$id_evaluador = $datos["IdUser"];

		}

		$id_evaluador;
		$Nombre1 = "";
		$Nombre2 = "";


		$info_evaluador = mysqli_query($conexion, "SELECT * FROM users where IdUser = $id_evaluador");
		if (mysqli_num_rows($info_evaluador) > 0) {
			$info = mysqli_fetch_assoc($info_evaluador);

			$Nombre1 = $info["Nombre1"];
			$Nombre2 = $info["Nombre2"];

			$Apellido1 = $info["Apellido1"];
			$Apellido2 = $info["Apellido2"];

			$Documento = $info["Document"];
			$IdCargo = $info["IdCargo"];
			$antiguedad = $info['Antiguedad'];
			$timpoServicio = $info['TiempoServicio'];


		}

		$info_cargo = mysqli_query($conexion, "SELECT * FROM cargos where IdCargo = $IdCargo");
		if (mysqli_num_rows($info_cargo) > 0) {
			$row = mysqli_fetch_assoc($info_cargo);
			$TipoCargo = $row["Cargo"];

		}






		// info de evaluado 
		$Evaluado = $IdEvaluado;
		$datos_evaluado = mysqli_query($conexion, "SELECT * FROM evaluados where IdEvaluado = $Evaluado");

		if (mysqli_num_rows($datos_evaluado) > 0) {
			$datoss = mysqli_fetch_assoc($datos_evaluado);

			$id_evaluado = $datoss["IdUser"];

		}


		$info_evaluado = mysqli_query($conexion, "SELECT * FROM users where IdUser = $id_evaluado");
		if (mysqli_num_rows($info_evaluado) > 0) {
			$info_evaluado = mysqli_fetch_assoc($info_evaluado);

			$Name_evaluado1 = $info_evaluado["Nombre1"];
			$Name_evaluado2 = $info_evaluado["Nombre2"];

			$Apellido_evaluado1 = $info_evaluado["Apellido1"];
			$Apellido_evaluado2 = $info_evaluado["Apellido2"];

			$Documento_evaluado = $info_evaluado["Document"];
			$IdCargo_evaluado = $info_evaluado["IdCargo"];
			$antiguedadEvaluado = $info_evaluado['Antiguedad'];
			$timpoServicioEvaluado = $info_evaluado['TiempoServicio'];

		}

		$info_cargos = mysqli_query($conexion, "SELECT * FROM cargos where IdCargo = $IdCargo_evaluado");
		if (mysqli_num_rows($info_cargos) > 0) {
			$rows = mysqli_fetch_assoc($info_cargos);
			$TipoCargos = $rows["Cargo"];
			$ObjetivoCargo = $rows['Descripcion'];
			$IdDependencia = $rows['IdDependencia'];
		}

		$consult = mysqli_query($conexion, "SELECT * FROM dependencias where IdDependencia = $IdDependencia");
		$Dependencia = mysqli_fetch_assoc($consult);
		$NombreDepen = $Dependencia['Dependencia'];

		// Suponiendo que ya tienes una conexión a la base de datos, la conexión está en la variable $conexion
// Reemplaza 'tu_tabla' con el nombre real de tu tabla y ajusta la consulta según tu esquema de base de datos

		$idevaluacion = $IdEva; // Cambia esto por el valor que necesites

		// Inicializar un array para almacenar las calificaciones
		$calificaciones = array();

		// Consulta SQL para seleccionar todas las calificaciones con el mismo idevaluacion
		$sql = "SELECT * FROM calificacion WHERE IdEvaluacion = $idevaluacion";




		$resultado = mysqli_query($conexion, $sql);
		if ($resultado) {
			// Iterar sobre los resultados y almacenar las calificaciones en el array
			while ($fila = mysqli_fetch_assoc($resultado)) {
				$calificaciones[] = $fila['Calificacion'];
			}

			// Liberar el resultado
			mysqli_free_result($resultado);
		} else {
			// Manejar el caso de error en la consulta
			echo "Error en la consulta: " . mysqli_error($conexion);
		}


		$DatosEva = mysqli_query($conexion, "SELECT * FROM evaluaciones where IdEvaluacion = $idevaluacion");

		$RowEva = mysqli_fetch_assoc($DatosEva);
		$FechaCreacion = $RowEva['Fecha_Evaluacion'];
		$FechaDel = $RowEva['Perido_Del'];
		$FechaAl = $RowEva['Periodo_Al'];
		$Nombrepdf = $RowEva['Nombre'];
		$NombrePDF = $Nombrepdf;
		$Observacion1 = $RowEva['Observacion1'];
		$Observacion2 = $RowEva['Observacion2'];
		$Observacion3 = $RowEva['Observacion3'];
		$Observacion4 = $RowEva['Observacion4'];
		$Acuerdo = $RowEva['Acuerdos'];
		$Capacitacion = $RowEva['Capacitacion'];



		// fecha de creacion 
		$componentes = explode("-", $FechaCreacion);

		$anio = $componentes[0];
		$mes = $componentes[1];
		$dia = $componentes[2];


		// fecha del 

		$componentes2 = explode("-", $FechaDel);

		$anio2 = $componentes2[0];
		$mes2 = $componentes2[1];
		$dia2 = $componentes2[2];


		// Fecha Al 

		$componentes3 = explode("-", $FechaAl);

		$anio3 = $componentes3[0];
		$mes3 = $componentes3[1];
		$dia3 = $componentes3[2];




		$nombresMeses = [
			1 => 'Enero',
			2 => 'Febrero',
			3 => 'Marzo',
			4 => 'Abril',
			5 => 'Mayo',
			6 => 'Junio',
			7 => 'Julio',
			8 => 'Agosto',
			9 => 'Septiembre',
			10 => 'Octubre',
			11 => 'Noviembre',
			12 => 'Diciembre'
		];


		$NameMes1 = $nombresMeses[$mes];
		$NameMes2 = $nombresMeses[$mes2];
		$NameMes3 = $nombresMeses[$mes3];

		$FechaCreacions = $dia . " de " . $NameMes1 . " del " . $anio;
		$PeriodoDel = $dia2 . " de " . $NameMes2 . " del " . $anio2;
		$PeriodoAl = $dia3 . " de " . $NameMes3 . " del " . $anio3;

		$this->Ln(10); // Salto de Línea
		$this->Ln(1); // Salto de Línea
		$this->SetFont('helvetica', 'I', 9);
		$this->Cell(1);
		$this->MultiCell(25, 35, 'Fecha de diligenciamiento');
		$this->SetY($this->GetY() - 33);
		$this->SetX(50);
		$this->SetLineWidth(0.1);
		$this->Cell(40, 5, $FechaCreacions, 1, 0, 'C');
		$this->SetY($this->GetY() - 1.5);
		$this->SetX(90);
		$this->MultiCell(25, 8, 'Periodo evaluado', 0);
		$this->SetY($this->GetY() - 6);
		$this->SetX(110);
		$this->Cell(8, 5, 'Del', 1, 0, 'C');
		$this->Cell(40, 5, $PeriodoDel, 1, 0, 'C');
		$this->Cell(8, 5, 'Al', 1, 0, 'C');
		$this->Cell(40, 5, $PeriodoAl, 1, 0, 'C');



		$this->Ln(35); // Salto de Línea

		$this->StartTransform();

		$this->Rotate(90); // Girar 90 grados en sentido antihorario

		// Código que debe estar girado

		$this->Cell(25, 10, 'EVALUADO', 1, 1, 'C');
		$this->StopTransform();
		$this->SetY($this->GetY() - 35);
		$this->SetX(25);
		$this->Cell(58, 2, 'Nombres', 'LTR', 0, 'C');
		$this->Cell(58, 2, 'Apellidos', 'LTR', 0, 'C');
		$this->Cell(59, 2, 'Documento Identidad', 'LTR', 0, 'C');
		$this->SetY($this->GetY() + 4);
		$this->SetX(25);
		$this->Cell(58, 2, $Name_evaluado1 . " " . $Name_evaluado2, 'BRL', 0, 'C');
		$this->SetY($this->GetY() + 0);
		$this->SetX(83);
		$this->Cell(58, 2, $Apellido_evaluado1 . " " . $Apellido_evaluado2, 'BRL', 0, 'C');
		$this->Cell(59, 2, $Documento_evaluado, 'BRL', 0, 'C');
		$this->SetY($this->GetY() + 4);
		$this->SetX(25);

		$this->Cell(175, 2, 'Dependencia', 'LTR', 1, 'L');
		$this->SetY($this->GetY() + 35);
		$this->SetX(80);
		$this->SetY($this->GetY() - 35);
		$this->SetX(25);
		$this->Cell(175, 2, $NombreDepen, 'BRL', 1, 'L');
		$this->SetY($this->GetY() + 0);
		$this->SetX(25);
		$this->Cell(25, 9, 'Cargo', 1, 0, 'C');
		$this->Cell(50, 9, $TipoCargos, 1, 0, 'C');
		$this->Cell(50, 5, 'Antiguedad', 'LTR', 0, 'C');
		$this->Cell(50, 5, 'Tiempo de servicio en el cargo', 'LTR', 0, 'C');
		$this->SetY($this->GetY() + 5);
		$this->SetX(100);
		$this->Cell(50, 4, $antiguedadEvaluado, 'BRL', 0, 'C');
		$this->Cell(50, 4, $timpoServicioEvaluado, 'BRL', 0, 'C');



		$this->Ln(29); // Salto de Línea

		$this->StartTransform();

		$this->Rotate(90); // Girar 90 grados en sentido antihorario

		// Código que debe estar girado
		$this->Cell(25, 10, 'EVALUADOR', 1, 1, 'C');
		$this->StopTransform();
		$this->SetY($this->GetY() - 35);
		$this->SetX(25);
		$this->Cell(57, 2, 'Nombres', 'LTR', 0, 'C');
		$this->Cell(57, 2, 'Apellidos', 'LTR', 0, 'C');
		$this->Cell(61, 2, 'Documento Identidad', 'LTR', 0, 'C');
		$this->SetY($this->GetY() + 4);
		$this->SetX(25);
		$this->Cell(57, 2, $Nombre1 . "  " . $Nombre2, 'BRL', 0, 'C');
		$this->SetY($this->GetY() + 0);
		$this->SetX(82);
		$this->Cell(57, 2, $Apellido1 . "  " . $Apellido2, 'BRL', 0, 'C');
		$this->Cell(61, 2, $Documento, 'BRL', 0, 'C');
		$this->SetY($this->GetY() + 4);
		$this->SetX(25);


		$this->Cell(25, 17, 'Cargo', 1, 0, 'C');
		$this->Cell(50, 17, $TipoCargo, 1, 0, 'C');
		$this->Cell(50, 10, 'Antigüeda', 'LTR', 0, 'C');
		$this->Cell(50, 10, 'Tiempo de servicio en el cargo', 'LTR', 0, 'C');
		$this->SetY($this->GetY() + 5);
		$this->SetX(100);
		$this->Cell(50, 12, $antiguedad, 'BRL', 0, 'C');
		$this->Cell(50, 12, $timpoServicio, 'BRL', 0, 'C');







		$this->Ln(15); // Salto de Línea
		$this->SetFont('helvetica', 'I', 10);
		$this->Cell(0, 5, 'OBJETIVO DEL CARGO:', 0, 0, 'L');
		$this->Ln(6); // Salto de Línea
		$this->MultiCell(0, 5, $ObjetivoCargo, 1, 0);


		$this->Ln(8); // Salto de Línea


		// Agregar la tabla con 7 columnas y 6 filas
		$this->SetFont('helvetica', '', 10);


		$this->Cell(40, 8, 'FACTOR DE CALIDAD ', 1, 0, 'L');

		$this->Cell(25, 8, 'Muy inferior', 1, 0, 'C');
		$this->Cell(25, 8, 'Inferior ', 1, 0, 'C');
		$this->Cell(25, 8, 'sactifactorio ', 1, 0, 'C');
		$this->Cell(25, 8, 'Sobresaliente ', 1, 0, 'C');
		$this->Cell(25, 8, 'Excelente', 1, 0, 'C');
		$this->Cell(20, 8, 'Total factor ', 1, 0, 'C');



		$this->Ln(8); // Salto de Línea

		$this->Cell(40, 8, '', 1, 0, 'L');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(20, 8, '', 1, 0, 'C');


		$this->Ln(8); // Salto de Línea
		$this->SetFont('helvetica', '', 10);
		$this->MultiCell(40, 8, 'Conocmiento teórico y tecnico', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);



		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[0], 1, 0, 'C');
		$this->Ln(9); // Salto de Línea

		$this->MultiCell(40, 8, 'Capacidad de ánalisis y aplicación', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);

		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[1], 1, 0, 'C');
		$this->Ln(9); // Salto de Línea



		$this->MultiCell(40, 8, 'Forma de cumplir la función', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);

		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[2], 1, 0, 'C');

		$this->Ln(9); // Salto de Línea

		$sumas1 = $calificaciones[0] + $calificaciones[1] + $calificaciones[2];
		$S1 = $sumas1;


		$this->Cell(40, 9, '', 1, 0, 'C');
		$this->Cell(125, 9, 'Subtotal Factor de Calidad', 1, 0, 'C');
		$this->Cell(20, 9, $sumas1, 1, 0, 'C');



		$this->Ln(20); // Salto de Línea

		// Agregar la tabla con 7 columnas y 6 filas




		// comineza el siguiente cuadro
		$this->SetFont('helvetica', '', 8);
		$this->MultiCell(40, 8, 'FACTOR DE EFICIENCIA Y RENDIMIENTO ', 1, 0);
		$this->SetY($this->GetY() - 8);
		$this->SetX(55);
		$this->SetFont('helvetica', '', 10);
		$this->Cell(25, 8, 'Muy inferior', 1, 0, 'C');
		$this->Cell(25, 8, 'Inferior ', 1, 0, 'C');
		$this->Cell(25, 8, 'sactifactorio ', 1, 0, 'C');
		$this->Cell(25, 8, 'Sobresaliente ', 1, 0, 'C');
		$this->Cell(25, 8, 'Excelente', 1, 0, 'C');
		$this->Cell(20, 8, 'Total factor ', 1, 0, 'C');



		$this->Ln(8); // Salto de Línea

		$this->Cell(40, 8, '', 1, 0, 'L');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(20, 8, '', 1, 0, 'C');


		$this->Ln(8); // Salto de Línea
		$this->SetFont('helvetica', '', 10);
		$this->MultiCell(40, 9, 'Cantidad o volumen', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);



		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[3], 1, 0, 'C');
		$this->Ln(9); // Salto de Línea

		$this->MultiCell(40, 9, 'Iniciativa y recursividad', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);

		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[4], 1, 0, 'C');


		$this->Ln(9); // Salto de Línea

		$this->MultiCell(40, 9, 'Cumplimiento', 1, 0);
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);
		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[5], 1, 0, 'C');


		$suma2 = $calificaciones[3] + $calificaciones[4] + $calificaciones[5];
		$S2 = $suma2;
		$this->Ln(9); // Salto de Línea
		$this->Cell(40, 9, '', 1, 0, 'C');
		$this->Cell(125, 9, 'Subtotal Factor de Eficiencia y Rendimiento', 1, 0, 'C');
		$this->Cell(20, 9, $suma2, 1, 0, 'C');

		// devuelvo un valor a la variable para usar ese valor en la siguiente funcion
		$St = $S1 + $S2;
		$suma1 = $St;
		return $suma1;

	}



	public function EvaluacionDesempenoSection2()
	{
		include './Conexion.php';
		global $suma1;
		global $IdEva;
		global $Observacion1;
		$idevaluacion = $IdEva; // Cambia esto por el valor que necesites

		// Inicializar un array para almacenar las calificaciones
		$calificaciones = array();

		// Consulta SQL para seleccionar todas las calificaciones con el mismo idevaluacion
		$sql = "SELECT * FROM calificacion WHERE IdEvaluacion = $idevaluacion";

		$resultado = mysqli_query($conexion, $sql);

		if ($resultado) {
			// Iterar sobre los resultados y almacenar las calificaciones en el array
			while ($fila = mysqli_fetch_assoc($resultado)) {
				$calificaciones[] = $fila['Calificacion'];
			}

			// Liberar el resultado
			mysqli_free_result($resultado);
		} else {
			// Manejar el caso de error en la consulta
			echo "Error en la consulta: " . mysqli_error($conexion);
		}




		$this->Ln(10); // Salto de Línea 


		// comineza el siguiente cuadro
		$this->SetFont('helvetica', '', 8);
		$this->MultiCell(40, 8, 'FACTOR DE RESPONSABILIDAD', 1, 0);
		$this->SetY($this->GetY() - 8);
		$this->SetX(55);
		$this->SetFont('helvetica', '', 10);
		$this->Cell(25, 8, 'Muy inferior', 1, 0, 'C');
		$this->Cell(25, 8, 'Inferior ', 1, 0, 'C');
		$this->Cell(25, 8, 'sactifactorio ', 1, 0, 'C');
		$this->Cell(25, 8, 'Sobresaliente ', 1, 0, 'C');
		$this->Cell(25, 8, 'Excelente', 1, 0, 'C');
		$this->Cell(20, 8, 'Total factor ', 1, 0, 'C');



		$this->Ln(8); // Salto de Línea

		$this->Cell(40, 8, '', 1, 0, 'L');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(20, 8, '', 1, 0, 'C');


		$this->Ln(8); // Salto de Línea
		$this->SetFont('helvetica', '', 10);
		$this->MultiCell(40, 9, 'Nivel de compromiso', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);



		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[6], 1, 0, 'C');
		$this->Ln(9); // Salto de Línea

		$this->MultiCell(40, 9, 'Disposición laboral', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);

		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[7], 1, 0, 'C');


		$this->Ln(9); // Salto de Línea

		$this->MultiCell(40, 9, 'Confidencialidad', 1, 0);
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);
		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[8], 1, 0, 'C');

		$suma3 = $calificaciones[6] + $calificaciones[7] + $calificaciones[8];


		$this->Ln(9); // Salto de Línea
		$this->Cell(40, 9, '', 1, 0, 'C');
		$this->Cell(125, 9, 'Subtotal Factor de Responsabilidad', 1, 0, 'C');
		$this->Cell(20, 9, $suma3, 1, 0, 'C');



		$this->Ln(15); // Salto de Línea 


		// comineza el siguiente cuadro
		$this->SetFont('helvetica', '', 8);
		$this->MultiCell(40, 8, 'FACTOR DE ORGANIZACION DEL TRABAJO', 1, 0);
		$this->SetY($this->GetY() - 11);
		$this->SetX(55);
		$this->SetFont('helvetica', '', 10);
		$this->Cell(25, 11, 'Muy inferior', 1, 0, 'C');
		$this->Cell(25, 11, 'Inferior ', 1, 0, 'C');
		$this->Cell(25, 11, 'sactifactorio ', 1, 0, 'C');
		$this->Cell(25, 11, 'Sobresaliente ', 1, 0, 'C');
		$this->Cell(25, 11, 'Excelente', 1, 0, 'C');
		$this->Cell(20, 11, 'Total factor ', 1, 0, 'C');



		$this->Ln(11); // Salto de Línea

		$this->Cell(40, 8, '', 1, 0, 'L');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Min.', 1, 0, 'C');
		$this->Cell(12.5, 8, 'Max.', 1, 0, 'C');

		$this->Cell(20, 8, '', 1, 0, 'C');


		$this->Ln(8); // Salto de Línea
		$this->SetFont('helvetica', '', 10);
		$this->MultiCell(40, 9, 'Establecer Prioridades', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);



		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[9], 1, 0, 'C');
		$this->Ln(9); // Salto de Línea

		$this->MultiCell(40, 9, 'Trabajo en equipo y habilidades sociales', 1, 0, );
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);

		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[10], 1, 0, 'C');


		$this->Ln(9); // Salto de Línea

		$this->MultiCell(40, 9, 'Habitos del trabajo y disciplina', 1, 0);
		$this->SetY($this->GetY() - 9);
		$this->SetX(55);
		$this->Cell(12.5, 9, '16.6', 1, 0, 'C');
		$this->Cell(12.5, 9, '31', 1, 0, 'C');

		$this->Cell(12.5, 9, '31.1', 1, 0, 'C');
		$this->Cell(12.5, 9, '49.91', 1, 0, 'C');

		$this->Cell(12.5, 9, '50', 1, 0, 'C');
		$this->Cell(12.5, 9, '64.92', 1, 0, 'C');

		$this->Cell(12.5, 9, '65', 1, 0, 'C');
		$this->Cell(12.5, 9, '79.92', 1, 0, 'C');
		$this->Cell(12.5, 9, '80', 1, 0, 'C');
		$this->Cell(12.5, 9, '83.3', 1, 0, 'C');

		$this->Cell(20, 9, $calificaciones[11], 1, 0, 'C');

		$suma4 = $calificaciones[9] + $calificaciones[10] + $calificaciones[11];


		$this->Ln(9); // Salto de Línea
		$this->Cell(40, 9, '', 1, 0, 'C');
		$this->Cell(125, 9, 'Subtotal Factor de Organización del Trabajo', 1, 0, 'C');
		$this->Cell(20, 9, $suma4, 1, 0, 'C');



		$this->Ln(18); // Salto de Línea
		$total = $suma1 + $suma3 + $suma4;
		$this->Cell(185, 9, 'Subtotal Factor de Organización del Trabajo', 1, 1, 'C');
		$this->Cell(40, 9, 'Calificación Evaluado', 1, 0, 'C');
		$this->Cell(25, 9, 'M.I hasta 250', 1, 0, 'C');
		$this->Cell(25, 9, 'I. hasta 450', 1, 0, 'C');
		$this->Cell(25, 9, 'Sa. Hasta 650', 1, 0, 'C');
		$this->Cell(25, 9, 'So. Hasta 850', 1, 0, 'C');
		$this->Cell(25, 9, 'E. 1000', 1, 0, 'C');
		$this->Cell(20, 9, $total, 1, 0, 'C');


		$this->Ln(18); // Salto de Línea

		$this->Cell(185, 5, 'Subtotal Factor Calidad', 1, 1, 'C');
		$this->Cell(185, 5, 'Observaciones', 1, 1, 'C');
		$this->Cell(185, 40, $Observacion1 , 1, 1, 'L');
	}

	public function EvaluacionDesempenoSection3()
	{

		global $Observacion2;
		global $Observacion3;
		global $Observacion4;
		global $Acuerdo;
		global $Capacitacion;

		$this->Ln(10); // Salto de Línea

		$this->Cell(185, 5, 'Subtotal Factor Calidad', 1, 1, 'C');
		$this->Cell(185, 5, 'Observaciones', 1, 1, 'C');
		$this->Cell(185, 35, $Observacion2 , 1, 1, 'L');

		$this->Ln(8); // Salto de Línea

		$this->Cell(185, 5, 'Subtotal Factor Calidad', 1, 1, 'C');
		$this->Cell(185, 5, 'Observaciones', 1, 1, 'C');
		$this->Cell(185, 35, $Observacion3 , 1, 1, 'L');
		$this->Ln(5); // Salto de Línea

		$this->Cell(185, 5, 'PLAN DE MEJORAMIENTO', 0, 1, 'C');
		$this->Ln(5); // Salto de Línea
		$this->Cell(185, 5, 'Acuerdos en el trabajo cotidiano:', 1, 1, 'L');
		$this->Cell(185, 25, $Acuerdo , 1, 1, 'L');

		$this->Ln(10); // Salto de Línea
		$this->Cell(185, 5, 'Capacitación:', 1, 1, 'L');
		$this->Cell(185, 25, $Capacitacion , 1, 1, 'L');

		$this->Ln(10); // Salto de Línea

		// $this->SetXY(50, 1);
		$this->MultiCell(48, 11, 'FIRMA DEL EVALUADOR', 1);
		$this->SetY($this->GetY() - 11);
		$this->SetX(63);
		$this->Cell(45, 11, '', 1, 0, 'C');
		$this->MultiCell(48, 11, 'FIRMA DEL EVALUADO', 1, 'C');
		$this->SetY($this->GetY() - 11);
		$this->SetX(156);
		$this->Cell(45, 11, '', 1, 0, 'C');


	}

	public function Footer()
	{

		$this->SetY(-15);
		$this->SetFont('helvetica', '', 8);

		// Agregar la imagen en el footer
		$img_file_footer = __DIR__ . '/../img/PiePaginaSERVAF.jpg';
		$this->Image($img_file_footer, 10, $this->getPageHeight() - 34, 190, 15, '', '', '', false, 30, '', false, false, 0);



	}
}




//CREANDO NUEVO DOCUMNETO PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//establecer margenes
$pdf->SetMargins(15, 35, 20);
$pdf->SetHeaderMargin(20);
$pdf->setPrintFooter(true); //Defino el estado del footer
$pdf->setPrintHeader(true); //Defino el estado del Header
$pdf->SetAutoPageBreak(false);

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);




// add a page
$pdf->AddPage();


$pdf->EvaluacionDesempenoSection();

$pdf->AddPage();

$pdf->EvaluacionDesempenoSection2();

$pdf->AddPage();

$pdf->EvaluacionDesempenoSection3();

$tipoVista = 'D';

$pdf->Output($NombrePDF . '.pdf', $tipoVista);