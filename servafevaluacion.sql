-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2023 a las 13:49:07
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servafevaluacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `IdCalificacion` int(11) NOT NULL,
  `IdEvaluado` int(11) NOT NULL,
  `IdPregunta` int(11) NOT NULL,
  `IdEvaluacion` int(11) NOT NULL,
  `Calificacion` varchar(200) NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`IdCalificacion`, `IdEvaluado`, `IdPregunta`, `IdEvaluacion`, `Calificacion`, `Estado`) VALUES
(447, 124, 1, 322, '83.3', 1),
(448, 124, 2, 322, '83.3', 1),
(449, 124, 3, 322, '83.3', 1),
(450, 124, 4, 322, '83.3', 1),
(451, 124, 5, 322, '83.3', 1),
(452, 124, 6, 322, '83.3', 1),
(453, 124, 7, 322, '83.3', 1),
(454, 124, 8, 322, '83.3', 1),
(455, 124, 9, 322, '83.3', 1),
(456, 124, 22, 322, '83.3', 1),
(457, 124, 23, 322, '83.3', 1),
(458, 124, 24, 322, '83.3', 1),
(615, 22, 1, 329, '80', 1),
(616, 22, 2, 329, '82', 1),
(617, 22, 3, 329, '79', 1),
(618, 22, 4, 329, '70', 1),
(619, 22, 5, 329, '80', 1),
(620, 22, 6, 329, '80', 1),
(621, 22, 7, 329, '80', 1),
(622, 22, 8, 329, '80', 1),
(623, 22, 9, 329, '80', 1),
(624, 22, 22, 329, '80', 1),
(625, 22, 23, 329, '80', 1),
(626, 22, 24, 329, '80', 1),
(687, 27, 1, 355, '83.3', 1),
(688, 27, 2, 355, '83.3', 1),
(689, 27, 3, 355, '83.3', 1),
(690, 27, 4, 355, '83.3', 1),
(691, 27, 5, 355, '83.3', 1),
(692, 27, 6, 355, '83.3', 1),
(693, 27, 7, 355, '83.3', 1),
(694, 27, 8, 355, '83.3', 1),
(695, 27, 9, 355, '83.3', 1),
(696, 27, 22, 355, '83.3', 1),
(697, 27, 23, 355, '83.3', 1),
(698, 27, 24, 355, '83.3', 1),
(699, 27, 1, 356, '83.3', 1),
(700, 27, 2, 356, '83.3', 1),
(701, 27, 3, 356, '83.3', 1),
(702, 27, 4, 356, '', 1),
(703, 27, 5, 356, '', 1),
(704, 27, 6, 356, '', 1),
(705, 27, 7, 356, '', 1),
(706, 27, 8, 356, '', 1),
(707, 27, 9, 356, '', 1),
(708, 27, 22, 356, '', 1),
(709, 27, 23, 356, '', 1),
(710, 27, 24, 356, '', 1),
(711, 55, 1, 358, '83.3', 1),
(712, 55, 2, 358, '83.3', 1),
(713, 55, 3, 358, '83.3', 1),
(714, 55, 4, 358, '83.3', 1),
(715, 55, 5, 358, '83.3', 1),
(716, 55, 6, 358, '83.3', 1),
(717, 55, 7, 358, '83.3', 1),
(718, 55, 8, 358, '83.3', 1),
(719, 55, 9, 358, '83.3', 1),
(720, 55, 22, 358, '80.0', 1),
(721, 55, 23, 358, '80.0', 1),
(722, 55, 24, 358, '83.3', 1),
(723, 55, 1, 359, '82.0', 1),
(724, 55, 2, 359, '82.0', 1),
(725, 55, 3, 359, '82.0', 1),
(726, 55, 4, 359, '', 1),
(727, 55, 5, 359, '', 1),
(728, 55, 6, 359, '', 1),
(729, 55, 7, 359, '', 1),
(730, 55, 8, 359, '', 1),
(731, 55, 9, 359, '', 1),
(732, 55, 22, 359, '', 1),
(733, 55, 23, 359, '', 1),
(734, 55, 24, 359, '', 1),
(735, 55, 1, 360, '82.0', 1),
(736, 55, 2, 360, '82.0', 1),
(737, 55, 3, 360, '82.0', 1),
(738, 55, 4, 360, '83.3', 1),
(739, 55, 5, 360, '83.3', 1),
(740, 55, 6, 360, '83.3', 1),
(741, 55, 7, 360, '83.3', 1),
(742, 55, 8, 360, '83.3', 1),
(743, 55, 9, 360, '83.3', 1),
(744, 55, 22, 360, '82.0', 1),
(745, 55, 23, 360, '82.0', 1),
(746, 55, 24, 360, '82.0', 1),
(747, 53, 1, 362, '70.0', 1),
(748, 53, 2, 362, '70.0', 1),
(749, 53, 3, 362, '80.0', 1),
(750, 53, 4, 362, '80.0', 1),
(751, 53, 5, 362, '80.0', 1),
(752, 53, 6, 362, '80.0', 1),
(753, 53, 7, 362, '80.0', 1),
(754, 53, 8, 362, '83.3', 1),
(755, 53, 9, 362, '83.3', 1),
(756, 53, 22, 362, '80.0', 1),
(757, 53, 23, 362, '80.0', 1),
(758, 53, 24, 362, '80.0', 1),
(759, 52, 1, 363, '82.0', 1),
(760, 52, 2, 363, '82.0', 1),
(761, 52, 3, 363, '83.3', 1),
(762, 52, 4, 363, '83.3', 1),
(763, 52, 5, 363, '83.3', 1),
(764, 52, 6, 363, '83.3', 1),
(765, 52, 7, 363, '82.0', 1),
(766, 52, 8, 363, '83.3', 1),
(767, 52, 9, 363, '83.3', 1),
(768, 52, 22, 363, '82.0', 1),
(769, 52, 23, 363, '82.0', 1),
(770, 52, 24, 363, '83.0', 1),
(771, 52, 1, 364, '82.0', 1),
(772, 52, 2, 364, '82.0', 1),
(773, 52, 3, 364, '82.0', 1),
(774, 52, 4, 364, '83.3', 1),
(775, 52, 5, 364, '83.3', 1),
(776, 52, 6, 364, '83.3', 1),
(777, 52, 7, 364, '82.0', 1),
(778, 52, 8, 364, '83.3', 1),
(779, 52, 9, 364, '83.3', 1),
(780, 52, 22, 364, '82.0', 1),
(781, 52, 23, 364, '82.0', 1),
(782, 52, 24, 364, '82.0', 1),
(783, 45, 1, 365, '80.0', 1),
(784, 45, 2, 365, '80.0', 1),
(785, 45, 3, 365, '80.0', 1),
(786, 45, 4, 365, '80.0', 1),
(787, 45, 5, 365, '80.0', 1),
(788, 45, 6, 365, '80.0', 1),
(789, 45, 7, 365, '75.5', 1),
(790, 45, 8, 365, '75.5', 1),
(791, 45, 9, 365, '83.3', 1),
(792, 45, 22, 365, '80.0', 1),
(793, 45, 23, 365, '80.0', 1),
(794, 45, 24, 365, '80.0', 1),
(795, 45, 1, 366, '80.0', 1),
(796, 45, 2, 366, '80.0', 1),
(797, 45, 3, 366, '80.0', 1),
(798, 45, 4, 366, '80.0', 1),
(799, 45, 5, 366, '80.0', 1),
(800, 45, 6, 366, '80.0', 1),
(801, 45, 7, 366, '75.5', 1),
(802, 45, 8, 366, '75.5', 1),
(803, 45, 9, 366, '80.0', 1),
(804, 45, 22, 366, '80.0', 1),
(805, 45, 23, 366, '80.0', 1),
(806, 45, 24, 366, '80.0', 1),
(807, 38, 1, 367, '65.0', 1),
(808, 38, 2, 367, '65.0', 1),
(809, 38, 3, 367, '65.0', 1),
(810, 38, 4, 367, '70.0', 1),
(811, 38, 5, 367, '70.0', 1),
(812, 38, 6, 367, '70.0', 1),
(813, 38, 7, 367, '70.0', 1),
(814, 38, 8, 367, '80.0', 1),
(815, 38, 9, 367, '80.0', 1),
(816, 38, 22, 367, '70.0', 1),
(817, 38, 23, 367, '70', 1),
(818, 38, 24, 367, '', 1),
(819, 50, 1, 368, '70', 1),
(820, 50, 2, 368, '70', 1),
(821, 50, 3, 368, '80', 1),
(822, 50, 4, 368, '70', 1),
(823, 50, 5, 368, '60', 1),
(824, 50, 6, 368, '70', 1),
(825, 50, 7, 368, '80.0', 1),
(826, 50, 8, 368, '80.0', 1),
(827, 50, 9, 368, '80.0', 1),
(828, 50, 22, 368, '80.0', 1),
(829, 50, 23, 368, '70.0', 1),
(830, 50, 24, 368, '75.0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `IdCargo` int(11) NOT NULL,
  `Cargo` varchar(200) NOT NULL,
  `Descripcion` text NOT NULL,
  `IdDependencia` int(11) NOT NULL,
  `Asignado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`IdCargo`, `Cargo`, `Descripcion`, `IdDependencia`, `Asignado`) VALUES
(1, 'OPERADOR Y MONITOREO', 'Velar por la operación, mantenimiento y seguridad de las válvulas para la regulación del servicio de acueducto en el municipio de Florencia.', 4, 1),
(2, 'AUXILIAR PTAP       ', 'Apoyar las actividades de operación, mantenimiento y seguridad de la planta de tratamiento que se le asigne.', 4, 1),
(3, 'COORDINADOR ALMACÉN ', 'Mantener y controlar, bajo su custodia todos los activos de la sociedad que forman parte del patrimonio de la Empresa.', 3, 1),
(4, 'AUXILIAR OPERATIVO  ', 'Realizar el mantenimiento de todos los componentes de los sistemas de acueducto y alcantarillado de acuerdo a las instrucciones recibidas.', 4, 1),
(5, 'ANALISTA COMERCIAL  ', 'Apoyar las actividades del área comercial contribuyendo al logro de los objetivos del proceso', 2, 1),
(6, 'OFICIAL OPERATIVO   ', 'Instalar, reparar las redes de acueducto y alcantarillado del municipio de Florencia', 4, 1),
(7, 'OPERADOR BOCATOMA   ', 'Velar por la operación, mantenimiento y seguridad de los sistemas de captación que se le asignen.', 4, 1),
(8, 'SERVICIO AL CLIENTE ', 'Gestionar, dirigir, coordinar, supervisar, cumplir y hacer cumplir desde su área, los procesos y procedimientos establecidos para la ejecución de los planes, programas y proyectos dirigidos a ofrecer servicios públicos de excelente calidad, que logren satisfacer las necesidades y expectativas de los usuarios.', 2, 1),
(9, 'CONDUCTOR 1         ', 'Conducir la volqueta asignada, revisar su estado y estar pendiente de su mantenimiento oportuno y adecuado; así como responder con eficiencia y eficacia en el desarrollo de sus funciones, ayudando a velar por la seguridad e integridad al personal de la Empresa que en el momento esté prestando el servicio.', 4, 1),
(10, 'DIRECTOR TECNOLOGÍAS', 'Dirigir, asesorar y velar por la implementación de actividades y estrategias en los sistemas de información de la Empresa, buscando la manera más eficiente de llevar a cabo las tareas, optimizando el uso de los recursos disponibles, como tiempo y tecnología.', 3, 1),
(11, 'OPERADOR PTAP       ', 'Velar por la operación, mantenimiento y seguridad de la planta de tratamiento que se le asigne.', 4, 1),
(12, 'ELECTROMECÁNICO     ', 'Realizar el mantenimiento preventivo y correctivo de los equipos de la Estación Torasso y sede Administrativa.', 4, 1),
(13, 'CONDUCTOR 2         ', 'Conducir el vehículo que le sea asignado, revisar su estado y estar pendiente de su mantenimiento oportuno y adecuado; así como responder con eficiencia y eficacia en el desarrollo de sus funciones, ayudando a velar por la seguridad e integridad al personal de la Empresa que en el momento esté prestando el servicio.', 4, 1),
(14, 'AUXILIAR FUGAS      ', 'Responsable de la ejecución de los programas de control de fugas.', 4, 1),
(15, 'DIRECTOR PLANEACIÃ“N ', 'Desarrollar programas, políticas, planes y proyectos tendientes a fortalecer la planeación estratégica de la empresa y liderar nuevos negocios buscando generar mayores ingresos empresariales.', 1, 1),
(16, 'COORDINADOR CALIDAD ', 'Controlar permanentemente que la producción del agua se realice con base en las especificaciones pertinentes y estar atento a los procedimientos, operacionalidad y mantenimiento de las plantas de tratamiento y bocatomas.', 4, 1),
(17, 'CONDUCTOR 3         ', 'Responder por las actividades correspondientes a la operación y mantenimiento del vehículo y equipo de lavado y succión de lodos.', 4, 1),
(18, 'CONTROL INTERNO     ', 'Garantizar la efectividad del Sistema de Control Interno de la empresa a través de la evaluación y seguimiento a la gestión institucional, la asesoría y acompañamiento, el fomento de la cultura de control, la relación con los organismos externos y la valoración del riesgo para coadyuvar al cumplimiento de la gestión institucional de acuerdo a la normatividad vigente y las políticas organizacionales', 1, 1),
(19, 'SUPERVISOR ZONA     ', 'Responsable por la construcción, ampliación, reposición y mantenimiento de las redes de acueducto y alcantarillado.', 4, 1),
(20, 'COORDINADOR COMUNICA', 'Desarrollar las actividades necesarias para difundir a través de los diferentes canales de comunicación todas las actividades planeadas, desarrolladas y ejecutadas por la Empresa con el propósito de mantener informado a los usuarios y conservar la buena imagen corporativa.', 1, 1),
(21, 'ASISTENTE SUBGERENCI', 'Apoyar a los Subgerentes en la ejecución de las labores inherentes a su cargo.', 4, 1),
(22, 'ELECTROMECANICO PLAN', 'Realizar el mantenimiento preventivo y correctivo de las estructuras, equipos, instalaciones eléctricas y accesorios hidráulicos de las plantas de tratamiento de agua potable, Plantas de tratamiento de aguas residuales y bocatomas.', 4, 1),
(23, 'GESTOR FUGAS        ', 'Responsable por el manejo del programa de control de fugas.', 2, 1),
(24, 'DIRECTOR FINANCIERO ', 'Planificar las actividades contables controlando y verificando los procesos de registro, clasificación y contabilización del movimiento contable, a fin de garantizar que los Estados Financieros sean confiables y oportunos, orientando, supervisando y organizando además el proceso contable de acuerdo con las normas contables y tributarias vigentes.', 3, 1),
(25, 'MANTENIMIENTOS LOCAT', 'Apoyar las actividades de mantenimiento a los sistemas que se le asignen.', 4, 1),
(26, 'ASISTENTE AMBIENTAL ', 'Apoyar la Dirección Ambiental y Social en la ejecución de los objetivos ambientales.', 4, 1),
(27, 'SUBGERENTE INGENIERÍA', 'Gestionar, dirigir, coordinar, supervisar, cumplir y hacer cumplir desde su área, los procesos y procedimientos establecidos para la ejecución de los planes, programas y proyectos dirigidos a ofrecer servicios públicos de acueducto y alcantarillado de excelente calidad, que logren satisfacer las necesidades y expectativas de los usuarios en el municipio de Florencia, teniendo en cuenta los aspectos ambientales.', 4, 1),
(28, 'DIRECTOR ALCANTARILLADO', 'Planear, gestionar y garantizar la operación del servicio público domiciliario de alcantarillado de forma continua y oportuna bajo los parámetros de calidad, cantidad, continuidad, eficiencia y oportunidad mediante una planificación de actividades que permitan mejorar la gestión en la prestación de los servicios públicos en el municipio de Florencia.', 4, 1),
(29, 'COORDINADOR TESORERIA', 'Planear, organizar, supervisar y controlar todas las operaciones de tesorería, ejecutando eficazmente los recursos disponibles.', 3, 1),
(30, 'AUXILIAR DE SISTEMAS', 'Apoyo en soporte técnico a las dependencias de la Empresa.', 3, 1),
(31, 'SUGERENTE COMERCIAL ', 'Gestionar, dirigir, coordinar, supervisar, cumplir y hacer cumplir desde su área, los procesos y procedimientos establecidos para la ejecución de los planes, programas y proyectos dirigidos a ofrecer servicios públicos de excelente calidad, que logren satisfacer las necesidades y expectativas de los usuarios.', 2, 1),
(32, 'AUXILIAR COMERCIAL  ', 'Efectuar labores de apoyo en cuanto a revisiones a los usuarios, análisis de datos, control, seguimiento y demás demandadas por el área comercial.', 2, 1),
(33, 'APRENDIZ SENA       ', 'pasante', 3, 1),
(34, 'AUXILIAR SERVICIOS G', 'Prestar los servicios de aseo y cafetería conservando las normas de higiene y seguridad industrial.', 3, 1),
(35, 'COORDINADOR GESTION ', 'Dirigir, coordinar y controlar las actividades relacionadas con el talento humano de la Empresa.', 3, 1),
(36, 'ASISTENTE GESTIÓN DOCUMENTAL', 'Apoyar las actividades relacionadas con la administración de las comunicaciones oficiales y el proceso de organización del archivo central e histórico de la Empresa.', 2, 1),
(37, 'COORDINADOR LABORATO', 'Planeación, coordinación y control de todos procesos y actividades del Laboratorio de Medidores de agua.', 1, 1),
(38, 'PRESUPUESTO         ', 'Coordinar, ejecutar y controlar los procedimientos y procesos relacionados con la gestión presupuestal de la entidad.', 3, 1),
(39, 'DIRECTOR ACUEDUCTO  ', 'Planear, gestionar y garantizar la operación del servicio público domiciliario de acueducto de forma continua y oportuna bajo los parámetros de calidad, cantidad, continuidad, eficiencia y oportunidad mediante una planificación de actividades que permitan mejorar la gestión en la prestación de los servicios públicos en el municipio de Florencia.', 4, 1),
(40, 'COORDINADOR CONTABIL', 'Contribuir con sus conocimientos profesionales en las actividades de contabilidad, mediante la validación de la aplicación de las Políticas Contables con relación a la depreciación, Deterioro, Propiedad, Planta y Equipo, Costo Amortizados y otros relevantes establecidas en el proceso de Regulación Contable y costos.', 3, 1),
(41, 'GESTION DOCUMENTAL  ', 'Apoyar la gestión documental, la organización y conservación de los archivos, y el manejo de la ventanilla única de la Empresa.', 3, 1),
(42, 'DIRECTOR GESTION PER', 'Dirigir, asesorar y ejecutar las políticas, actividades y estrategias dentro de un programa, para reducir el índice de agua no contabilizada.', 2, 1),
(43, 'SUBGERENTE CORPORATI', 'Dirigir los procesos relacionados con el manejo del recurso humano, recursos físicos, recursos financieros y servicios generales de la Empresa para el logro de la misión institucional.', 3, 1),
(44, 'VIVERISTA           ', 'Producir material vegetal, para los diferentes programas ambientales y sociales.', 4, 1),
(45, 'GERENTE             ', 'Dirigir la gestión administrativa, financiera, comercial, técnica y operativa de acuerdo a los lineamientos de la Asamblea General de Accionistas y directrices de la Junta Directiva.', 1, 1),
(46, 'GESTOR COMERCIAL    ', 'Responsable por las actividades técnicas comerciales sobre las redes.', 2, 1),
(47, 'COORDINADOR ATENCION', 'Recibir, atender, tramitar y responder las peticiones, quejas y recursos verbales o escritos que presentan los usuarios, los suscriptores actuales o los potenciales con relación a los servicios de acueducto y alcantarillado.', 2, 1),
(48, 'COORDINADOR SEGURIDA', 'Dirigir, coordinar, asesorar, capacitar, diseñar, ejecutar y controlar las actividades relacionadas con el Sistema de Gestión de Seguridad industrial y Salud en el trabajo acorde a las normas y leyes vigentes.', 1, 1),
(49, 'COORDINADOR SCADA   ', 'Dirigir, coordinar, instalar, controlar y responder por las actividades correspondientes al sistema de telemetría y telecontrol SCADA.', 4, 1),
(50, 'ASISTENTE GESTOR PER', 'Responsable del manejo de los programas de la Unidad de Control de Perdidas.', 2, 1),
(51, 'COORDINADOR CATASTRO', 'Coordinar, asesorar y velar por la implementación y actualización del catastro de redes y las actividades y estrategias en el sistema de información Geográfico (SIG).', 4, 1),
(52, 'DIRECTOR COMERCIAL  ', 'Dirigir, controlar, ejecutar y evaluar las operaciones comerciales de la Empresa.', 2, 1),
(53, 'METROLOGO           ', 'Realizar y verificar la calibración de medidores conforme a las normas vigentes.', 1, 1),
(54, 'ASISTENTE SCADA     ', 'Responder por las actividades correspondientes al mantenimiento del sistema de telemetría y telecontrol SCADA.', 4, 1),
(55, 'MICROMEDICION       ', 'Responsable del manejo del programa de micromedición.', 2, 1),
(56, 'DIRECTOR AMBIENTAL Y', 'Direccionar la implementación de proyectos y programas ambientales y sociales en la Empresa.', 4, 1),
(57, 'DIGITADOR REDES     ', 'Actualizar permanentemente los sistemas de información de catastro de usuarios y catastro de Redes.', 4, 1),
(58, 'COORDINADOR SISTEMAS', 'Coordinar, asesorar y velar por el mantenimiento y operación de infraestructura tecnológica de la Empresa.', 3, 1),
(59, 'ASISTENTE DE GERENCI', 'Servir de enlace entre el Gerente y los empleados de la sociedad, propender por el sostenimiento de relaciones adecuadas con los directivos, empleados, particulares; atender el manejo de la agenda de compromisos y guardar confidencia en el desarrollo de sus labores.', 1, 1),
(60, 'AUXILIAR ELECTROMECÁNICO', 'Realizar labores de mantenimientos preventivos y correctivos de los equipos de la Empresa.', 4, 1),
(61, 'DIRECTOR PRODUCCÓN ', 'Mantener en buen funcionamiento el manejo de las bocatomas, desarenadores, operación de las plantas de tratamiento, administración y mantenimiento en cada una de los procesos necesarios para la producción y calidad de agua tratada de conformidad con las normas de calidad vigente.', 4, 1),
(62, 'COORDINADOR FACTURAC', 'Analizar, verificar, controlar y dirigir el proceso de facturación, cobros, tarifas y consumos a los usuarios del servicio.', 2, 1),
(63, 'DIRECTOR JURIDICO Y ', 'Dirigir, coordinar y controlar la parte Jurídica y de contratación de la Empresa, teniendo en cuenta las constantes variaciones y/o modificaciones normativas al respecto.', 1, 1),
(64, 'ANALISTA DE AGUA    ', 'Realizar ensayos fisicoquímicos y Microbiológicos, implementar prácticas de laboratorio, registrar y analizar los datos generados en los ensayos y en el proceso analítico, aplicando aseguramiento de la calidad analítica, con el fin de garantizar confianza, exactitud, trazabilidad e imparcialidad.\r\n. Aplicar todos los lineamientos establecidos por el Laboratorio, para dar cumplimiento con la normatividad legal, contractual vigentes y los sistemas de gestión de calidad implementados en Laboratorio.\r\n. Emplear conceptos básicos de buenas prácticas de laboratorio, salud ocupacional, uso y manejo de elementos de protección personal', 1, 1),
(65, 'ALMACENISTA         ', 'Apoyar en el manejo y control del almacén y los inventarios de los bienes muebles e inmuebles de la entidad, garantizando la disponibilidad de los recursos necesarios para el funcionamiento de la empresa', 3, 1),
(66, 'GESTOR PERDIDAS     ', 'Supervisar y monitorear los sistemas de telemetría y telecontrol y reducir las pérdidas comerciales.', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

CREATE TABLE `dependencias` (
  `IdDependencia` int(11) NOT NULL,
  `Dependencia` varchar(200) NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dependencias`
--

INSERT INTO `dependencias` (`IdDependencia`, `Dependencia`, `Estado`) VALUES
(1, 'Gerencia', 1),
(2, 'Subgerencia comercial y del servicio al cliente', 1),
(3, 'Subgerencia Corporativa ', 1),
(4, 'Subgerencia Ingenieria', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `IdEvaluacion` int(11) NOT NULL,
  `IdEvaluador` int(11) NOT NULL,
  `Fecha_Evaluacion` date NOT NULL,
  `Perido_Del` date NOT NULL,
  `Periodo_Al` date NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Observacion1` text NOT NULL,
  `Observacion2` text NOT NULL,
  `Observacion3` text NOT NULL,
  `Observacion4` text NOT NULL,
  `Acuerdos` text NOT NULL,
  `Capacitacion` text NOT NULL,
  `Estado` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`IdEvaluacion`, `IdEvaluador`, `Fecha_Evaluacion`, `Perido_Del`, `Periodo_Al`, `Nombre`, `Observacion1`, `Observacion2`, `Observacion3`, `Observacion4`, `Acuerdos`, `Capacitacion`, `Estado`) VALUES
(322, 1, '2023-12-06', '2022-10-01', '2023-09-30', 'Eva_20231206_100925', 'Resaltar en Marly Pascuas Sabogal su conocimiento, su dedicación y don de servicio. ', '', '', '', '\r\n                ', '                \r\n                ', 1),
(326, 1, '2023-12-12', '2023-01-12', '2023-12-12', 'Eva_20231212_105958', '', '', '', '', '', '', 1),
(327, 1, '2023-12-12', '2022-10-01', '2023-09-30', 'Eva_20231212_112711', '', '', '', '', '\r\n                No hay plan de mejoramiento', '\r\n                Manejo  adecuado de químicos para realizar el aseo. ', 1),
(329, 1, '2023-12-12', '2023-12-27', '2023-12-20', 'Eva_20231212_145620', '', '', '', '', '\r\n                ', '\r\n                Manejo adecuado para realaizar el aseo ', 1),
(330, 1, '2023-12-12', '2023-10-01', '2023-09-30', 'Eva_20231212_150142', '', '', '', '', '', '', 1),
(331, 1, '2023-12-12', '2022-11-23', '2023-09-30', 'Eva_20231212_150302', '', '', '', '', '\r\n                ', '\r\n                Trabajo en equipo', 1),
(332, 1, '2023-12-12', '2022-11-23', '2023-09-30', 'Eva_20231212_150958', '', '', '', '', '', '', 1),
(333, 1, '2023-12-12', '2022-11-23', '2023-09-30', 'Eva_20231212_151218', '', '', '', '', '', '', 1),
(337, 1, '2023-12-12', '2023-11-29', '2024-01-01', 'Eva_20231212_152535', '', '', '', '', '', '', 1),
(343, 1, '2023-12-12', '2022-11-23', '2023-09-30', 'Eva_20231212_153358', '', '', '', '', '', '', 1),
(344, 1, '2023-12-12', '2023-09-30', '2023-09-30', 'Eva_20231212_153434', '', '', '', '', '', '', 1),
(345, 1, '2023-12-12', '2022-11-23', '2023-09-30', 'Eva_20231212_153553', '', '', '', '', '', '', 1),
(347, 1, '2023-12-12', '2022-11-23', '2023-09-30', 'Eva_20231212_153825', '', '', '', '', '', '', 1),
(348, 1, '2023-12-12', '2022-11-23', '2023-09-30', 'Eva_20231212_154030', '', '', '', '', '', '', 1),
(350, 1, '2023-12-12', '2023-11-23', '2023-09-30', 'Eva_20231212_154219', '', '', '', '', '', '', 1),
(351, 1, '2023-12-12', '2023-07-11', '2023-12-05', 'Eva_20231212_154351', '', '', '', '', '', '', 1),
(353, 1, '2023-12-12', '2023-08-14', '2023-12-19', 'Eva_20231212_154446', '', '', '', '', '', '', 1),
(354, 2, '2023-12-20', '2022-10-01', '2023-09-30', 'Eva_20231220_070359', '', '', '', '', '', '', 1),
(355, 2, '2023-12-20', '2022-10-01', '2023-09-30', 'Eva_20231220_105521', '', '', '', '', '\r\n                ', '\r\n                ', 1),
(356, 2, '2023-12-20', '2022-10-01', '2023-09-30', 'Eva_20231220_110836', '', '', '', '', '\r\n                ', '\r\n                ', 1),
(357, 22, '2023-12-20', '2022-10-01', '2023-09-30', 'Eva_20231220_140842', '', '', '', '', '', '', 1),
(358, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_063304', 'El trabajador tiene la capacidad para cumplir sus funciones, cumpliendo con la ley 142 de 1994', 'El trabajar es eficiente y cumple con sus funciones ayudando a mejorar los procesos', 'El trabajador tiene disposición laboral ya que en nuestro proceso de facturación se requiere trabajar de corrido, además el nivel de compromiso es excelente.', '', '\r\n                ', '\r\n                ', 1),
(359, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_064322', 'El trabajador tiene la capacidad para cumplir sus funciones, cumpliendo con la ley 142 de 1994. Se requiere más capacitación. \r\n', '', '', '', '\r\n                ', '\r\n                ', 1),
(360, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_064647', 'El trabajador tiene la capacidad para cumplir sus funciones, cumpliendo con la ley 142 de 1994. Se requiere más capacitación para tener conocimiento teórico ', 'El trabajador es eficiente y cumple con sus funciones ayudando a mejorar los procesos. En el cual se evidencia interés y disposición para el cumplimiento de sus funciones y tareas asignadas en los tiempos establecidos.', 'El trabajador tiene disposición laboral ya que en nuestro proceso de facturación se requiere trabajar de corrido, además el nivel de compromiso es excelente. De igual manera ejecuta sus funciones diarias de manera adecuada, igualmente atiende recomendaciones o directrices impartidas, lo anterior hace que los resultados de su labor estén enfocados en la responsabilidad  hacia los procesos que desarrolla la empresa.', 'Ejecuta sus funciones estableciendo prioridades, teniendo capacidad de participar activamente para mejorar los procesos con la mayor disciplina. ', 'Seguir mejorando en el proceso de revisión. ', 'Capacitaciones en los decretos, normas y ley 142 de 1994 para tener mejor conocimiento.', 1),
(361, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_070003', '', '', '', '', '', '', 1),
(362, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_070634', 'Se requiere más capacitación para tener conocimiento teórico.', 'El trabajador es eficiente y cumple con sus funciones. ', 'El trabajador tiene disposición laboral ya que en nuestro proceso de facturación se requiere trabajar de corrido.', 'Ejecuta sus funciones estableciendo prioridades, teniendo capacidad de participar activamente para mejorar los procesos con la mayor disciplina.', '- Mejorar en los procesos de revisiones previas\r\n', '\r\n Capacitaciones en los decretos, normas y ley 142 de 1994 para tener mejor conocimiento', 1),
(363, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_071638', 'El trabajador tiene la capacidad para cumplir sus funciones, cumpliendo con la ley 142 de 1994.                                                                                       Se requiere más capacitación para tener conocimiento teórico ', 'El trabajador es eficiente y cumple con sus funciones ayudando a mejorar los procesos.                                                                                                   \r\nEn el cual se evidencia interés y disposición para el cumplimiento de sus funciones                                                                                                           y tareas asignadas en los tiempos establecidos.', 'El trabajador ejecuta sus funciones diarias de manera adecuada, igualmente atiende recomendaciones o directrices impartidas, lo anterior hace que los resultados de su labor estén enfocados en la responsabilidad  hacia los procesos que desarrolla la empresa.', 'Ejecuta sus funciones estableciendo prioridades, teniendo capacidad de participar activamente para mejorar los procesos con la mayor disciplina.', '\r\n                Seguir mejorando en los procesos de facturación', '\r\n                Capacitaciones en los decretos, normas y ley 142 de 1994 para tener mejor conocimiento.', 1),
(364, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_072318', 'El trabajador tiene la capacidad para cumplir sus funciones, cumpliendo con la ley 142 de 1994.', 'El trabajador es eficiente y cumple con sus funciones ayudando a mejorar los procesos.', 'El trabajador ejecuta sus funciones diarias de manera adecuada, igualmente atiende recomendaciones o directrices impartidas.', 'Ejecuta sus funciones estableciendo prioridades, teniendo capacidad de participar activamente para mejorar los procesos con la mayor disciplina.', '\r\n                Seguir mejorando el proceso de facturación', '\r\n                Capacitaciones en los decretos, normas y ley 142 de 1994 para tener mejor conocimiento.', 1),
(365, 19, '2023-12-22', '2023-10-01', '2023-09-30', 'Eva_20231222_073025', 'El trabajador tiene la capacidad para cumplir sus funciones, cumpliendo con la ley 142 de 1994. ', 'El trabajador es eficiente y cumple con sus funciones.', 'El trabajador tiene disposición laboral atendiendo a nuestros usuarios ', 'Ejecuta sus funciones estableciendo prioridades con la mayor disciplina.', '\r\n               Brindando un servicio eficiente a nuestros usuarios', '\r\n                Capacitaciones en los decretos, normas y ley 142 de 1994 para tener mejor conocimiento.', 1),
(366, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_074254', 'El trabajador tiene la capacidad para cumplir sus funciones, cumpliendo con la ley 142 de 1994. ', 'El trabajador es eficiente y cumple con sus funciones.', 'El trabajador tiene disposición laboral atendiendo a nuestros usuarios ', 'Ejecuta sus funciones estableciendo prioridades con la mayor disciplina.', '\r\n      Brindando un servicio eficiente a nuestros usuarios          ', '\r\n               Capacitaciones en los decretos, normas y ley 142 de 1994 para tener mejor conocimiento. ', 1),
(367, 19, '2023-12-22', '2022-10-01', '2023-09-30', 'Eva_20231222_074905', 'La trabajadora requiere mejor teoría y practica', 'Se requiere mayor iniciativa en los procesos', 'Tiene disposición laboral atendiendo a nuestros usuarios ', '', '\r\n                ', '\r\n                ', 1),
(368, 17, '2023-12-22', '2023-06-10', '2023-12-22', 'Eva_20231222_161843', '', '- Mejor comunicación y desempeño en el trabajo en equipo y agilidad para los procesos.', '', '- mas unificación en el trabajo  ', '\r\n  - se compromete a ser mas comunicativa y colaboradora con el trabajo y las tareas a realizar                          \r\n\r\n\r\n', '\r\n  - socialización y comprensión de las labores.  ', 1),
(371, 19, '2023-12-22', '2023-12-22', '2023-12-22', 'Eva_20231222_173838', '', '', '', '', '', '', 1),
(372, 19, '2023-12-22', '2023-12-22', '2023-12-22', 'Eva_20231222_174252', '', '', '', '', '', '', 1),
(373, 19, '2023-12-22', '2023-12-22', '2023-12-22', 'Eva_20231222_175013', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluadores`
--

CREATE TABLE `evaluadores` (
  `IdEvaluadores` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evaluadores`
--

INSERT INTO `evaluadores` (`IdEvaluadores`, `IdUser`, `Estado`) VALUES
(1, 72, 1),
(2, 3, 1),
(3, 14, 1),
(4, 17, 1),
(5, 26, 1),
(6, 44, 1),
(7, 55, 1),
(8, 59, 1),
(9, 67, 1),
(10, 75, 1),
(11, 77, 1),
(12, 85, 1),
(13, 86, 1),
(14, 87, 1),
(15, 88, 1),
(16, 99, 1),
(17, 101, 1),
(18, 106, 1),
(19, 109, 1),
(20, 116, 1),
(21, 118, 1),
(22, 131, 1),
(23, 132, 1),
(24, 135, 1),
(26, 104, 1),
(27, 91, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluados`
--

CREATE TABLE `evaluados` (
  `IdEvaluado` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdEvaluador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evaluados`
--

INSERT INTO `evaluados` (`IdEvaluado`, `IdUser`, `IdEvaluador`) VALUES
(21, 71, 1),
(22, 152, 1),
(23, 146, 1),
(24, 80, 1),
(25, 101, 1),
(26, 70, 1),
(27, 142, 2),
(28, 63, 3),
(29, 126, 3),
(30, 130, 4),
(31, 44, 14),
(32, 133, 14),
(33, 3, 14),
(34, 14, 14),
(35, 72, 14),
(36, 141, 10),
(37, 136, 10),
(38, 78, 19),
(39, 79, 19),
(40, 20, 19),
(41, 143, 19),
(42, 100, 19),
(43, 68, 19),
(44, 81, 19),
(45, 10, 19),
(46, 74, 19),
(47, 120, 19),
(48, 111, 15),
(49, 31, 17),
(50, 73, 17),
(51, 112, 18),
(52, 132, 19),
(53, 6, 19),
(54, 99, 19),
(55, 150, 19),
(56, 7, 20),
(57, 89, 20),
(58, 54, 20),
(59, 129, 20),
(60, 123, 20),
(61, 128, 20),
(62, 144, 20),
(63, 36, 20),
(64, 39, 20),
(65, 60, 5),
(66, 140, 5),
(67, 93, 5),
(68, 97, 5),
(69, 98, 5),
(70, 49, 5),
(71, 12, 5),
(72, 92, 5),
(73, 46, 5),
(74, 21, 5),
(75, 65, 5),
(76, 48, 12),
(77, 29, 12),
(78, 16, 12),
(79, 4, 12),
(80, 13, 12),
(81, 84, 12),
(82, 9, 12),
(83, 137, 12),
(84, 53, 12),
(85, 94, 12),
(86, 28, 12),
(87, 57, 11),
(88, 56, 11),
(89, 1, 11),
(90, 155, 11),
(91, 124, 11),
(92, 17, 11),
(93, 62, 22),
(94, 23, 22),
(95, 149, 22),
(96, 125, 22),
(97, 50, 22),
(98, 113, 22),
(99, 2, 22),
(100, 110, 22),
(101, 8, 22),
(102, 43, 22),
(103, 40, 22),
(104, 139, 22),
(105, 115, 22),
(106, 34, 22),
(107, 96, 22),
(108, 121, 22),
(109, 145, 22),
(110, 32, 22),
(111, 35, 22),
(112, 117, 22),
(113, 18, 22),
(114, 134, 22),
(115, 64, 22),
(116, 52, 21),
(117, 107, 13),
(118, 153, 13),
(119, 37, 13),
(120, 77, 7),
(121, 131, 7),
(122, 118, 7),
(123, 59, 7),
(124, 83, 1),
(125, 42, 19),
(126, 51, 22),
(127, 45, 22),
(128, 15, 22),
(129, 151, 22),
(130, 109, 9),
(131, 86, 9),
(132, 27, 21),
(133, 90, 21),
(134, 116, 11),
(135, 85, 11),
(136, 108, 11),
(137, 26, 11),
(138, 33, 7),
(139, 11, 7),
(140, 38, 7),
(141, 82, 6),
(142, 61, 6),
(143, 76, 6),
(144, 47, 12),
(145, 24, 7),
(146, 66, 11),
(147, 55, 18),
(148, 102, 18),
(149, 127, 18),
(150, 22, 18),
(151, 19, 18),
(152, 25, 18),
(153, 88, 18),
(154, 87, 18),
(155, 75, 18),
(156, 67, 18),
(157, 103, 20),
(158, 69, 7),
(159, 30, 18),
(160, 135, 18),
(161, 138, 20),
(162, 138, 20),
(163, 154, 19),
(164, 41, 20),
(165, 95, 19),
(166, 58, 7),
(167, 122, 11),
(168, 104, 1),
(169, 147, 17),
(170, 119, 11),
(171, 5, 12),
(172, 106, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factor`
--

CREATE TABLE `factor` (
  `IdFactor` int(11) NOT NULL,
  `NombreFactor` varchar(200) NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factor`
--

INSERT INTO `factor` (`IdFactor`, `NombreFactor`, `Estado`) VALUES
(1, 'FACTOR DE CALIDAD', 1),
(2, 'FACTOR DE EFICIENCIA Y RENDIMIENTO', 1),
(3, 'FACTOR DE RESPONSABILIDAD', 1),
(4, 'FACTOR DE ORGANIZACIÓN DEL TRABAJO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `IdPregunta` int(11) NOT NULL,
  `IdFactor` int(11) NOT NULL,
  `Descripcion` text NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`IdPregunta`, `IdFactor`, `Descripcion`, `Estado`) VALUES
(1, 1, 'Conocimiento teórico y técnico. ', 1),
(2, 1, 'Capacidad de análisis y aplicación.', 1),
(3, 1, 'Forma de cumplir función.', 1),
(4, 2, 'Cantidad o volumen', 1),
(5, 2, 'Iniciativa y recursividad', 1),
(6, 2, 'Cumplimiento', 1),
(7, 3, 'Nivel de compromiso.', 1),
(8, 3, 'Disposición laboral.', 1),
(9, 3, 'Confidencialidad y lealtad', 1),
(22, 4, 'Establecer prioridades.', 1),
(23, 4, 'Trabajo en equipo y habilidades sociales.', 1),
(24, 4, 'Hábitos de trabajo y disciplina', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rangocalificacion`
--

CREATE TABLE `rangocalificacion` (
  `IdRango` int(11) NOT NULL,
  `IdFactor` int(11) NOT NULL,
  `IdPregunta` int(11) NOT NULL,
  `Minimo` double NOT NULL,
  `Maximo` float NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rangocalificacion`
--

INSERT INTO `rangocalificacion` (`IdRango`, `IdFactor`, `IdPregunta`, `Minimo`, `Maximo`, `Estado`) VALUES
(1, 1, 1, 17.6, 31, 1),
(2, 1, 1, 31.1, 49.91, 1),
(3, 1, 1, 50, 64.92, 1),
(4, 1, 1, 65, 79.91, 1),
(5, 1, 1, 80, 83.3, 1),
(6, 1, 2, 17.6, 31, 1),
(7, 1, 2, 31.1, 49.91, 1),
(8, 1, 2, 50, 64.92, 1),
(9, 1, 2, 65, 79.91, 1),
(10, 1, 2, 80, 83.3, 1),
(11, 1, 3, 17.6, 31, 1),
(12, 1, 3, 31.1, 49.91, 1),
(13, 1, 3, 50, 64.92, 1),
(14, 1, 3, 65, 79.91, 1),
(15, 1, 3, 80, 83.3, 1),
(16, 2, 4, 17.6, 31, 1),
(17, 2, 4, 31.1, 49.91, 1),
(18, 2, 4, 50, 64.92, 1),
(19, 2, 4, 65, 79.91, 1),
(20, 2, 4, 80, 83.3, 1),
(21, 2, 5, 17.6, 31, 1),
(22, 2, 5, 31.1, 49.91, 1),
(23, 2, 5, 50, 64.92, 1),
(24, 2, 5, 65, 79.91, 1),
(25, 2, 5, 80, 83.3, 1),
(26, 2, 6, 17.6, 31, 1),
(27, 2, 6, 31.1, 49.91, 1),
(28, 2, 6, 50, 64.92, 1),
(29, 2, 6, 65, 79.91, 1),
(30, 2, 6, 80, 83.3, 1),
(31, 3, 7, 17.6, 31, 1),
(32, 3, 7, 31.1, 49.91, 1),
(33, 3, 7, 50, 64.92, 1),
(34, 3, 7, 65, 79.91, 1),
(35, 3, 7, 80, 83.3, 1),
(36, 3, 8, 17.6, 31, 1),
(37, 3, 8, 31.1, 49.91, 1),
(38, 3, 8, 50, 64.92, 1),
(39, 3, 8, 65, 79.91, 1),
(40, 3, 8, 80, 83.3, 1),
(41, 3, 9, 17.6, 31, 1),
(42, 3, 9, 31.1, 49.91, 1),
(43, 3, 9, 50, 64.92, 1),
(44, 3, 9, 65, 79.91, 1),
(45, 3, 9, 80, 83.3, 1),
(46, 4, 22, 17.6, 31, 1),
(47, 4, 22, 31.1, 49.91, 1),
(48, 4, 22, 50, 64.92, 1),
(49, 4, 22, 65, 79.91, 1),
(50, 4, 22, 80, 83.3, 1),
(51, 4, 23, 17.6, 31, 1),
(52, 4, 23, 31.1, 49.91, 1),
(53, 4, 23, 50, 64.92, 1),
(54, 4, 23, 65, 79.91, 1),
(55, 4, 23, 80, 83.3, 1),
(56, 4, 24, 17.6, 31, 1),
(57, 4, 24, 31.1, 49.91, 1),
(58, 4, 24, 50, 64.92, 1),
(59, 4, 24, 65, 79.91, 1),
(60, 4, 24, 80, 83.3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `idrol` int(11) NOT NULL,
  `nombre_rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`idrol`, `nombre_rol`) VALUES
(1, 'Admin'),
(2, 'Jefe'),
(3, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `IdUser` int(11) NOT NULL,
  `IdCargo` int(11) NOT NULL,
  `Nombre1` varchar(200) NOT NULL,
  `Nombre2` varchar(200) NOT NULL,
  `Apellido1` varchar(200) NOT NULL,
  `Apellido2` varchar(200) NOT NULL,
  `TypeDocument` varchar(10) NOT NULL,
  `Document` varchar(15) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `Pasword` varchar(50) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `FotoPerfil` text NOT NULL,
  `Antiguedad` varchar(200) NOT NULL,
  `TiempoServicio` varchar(200) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Jefe` int(11) NOT NULL,
  `Asignado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`IdUser`, `IdCargo`, `Nombre1`, `Nombre2`, `Apellido1`, `Apellido2`, `TypeDocument`, `Document`, `correo`, `Pasword`, `telefono`, `FotoPerfil`, `Antiguedad`, `TiempoServicio`, `IdRol`, `Estado`, `Jefe`, `Asignado`) VALUES
(1, 1, 'GUILLERMO', '', 'OSORIO', 'GUEVARA', 'CC', '6802402', 'prueba@gmail.com\r\n', '6802402', '311586621\r\n', '', '', '', 3, 1, 0, 1),
(2, 2, 'JON', '', 'ALBERT', 'BENAVIDES', 'CC', '6805293', 'prueba@gmail.com', '6805293', '311586621', '', '', '', 3, 1, 0, 1),
(3, 3, 'CESAR', 'ENRIQUE', 'ROBLES', 'REYES', 'CC', '7169872', 'prueba@gmail.com', '7169872', '311586621', '', '25 años', '11 años', 2, 1, 1, 1),
(4, 4, 'ILDER', 'MARIA', 'VALENCIA', 'ALEMEZA', 'CC', '10591110', 'prueba@gmail.com', '10591110', '311586621', '', '', '', 3, 1, 0, 1),
(5, 2, 'JAVIER', '', 'OTALORA', 'SILVA', 'CC', '11429914', 'prueba@gmail.com', '11429914', '311586621', '', '', '', 3, 1, 0, 1),
(6, 5, 'JOSE', 'MISAEL', 'CARDENAS', 'ESTRADA', 'CC', '12123213', 'prueba@gmail.com', '12123213', '311586621', '', '1 año y 7 meses', '6 meses', 3, 1, 0, 1),
(7, 6, 'AUDENCIO', '', 'BERMEO', 'GUAÑARITA', 'CC', '12150163', 'prueba@gmail.com', '12150163', '311586621', '', '', '', 3, 1, 0, 1),
(8, 7, 'JOSE', '', 'HERNEY', 'FAJARDO', 'CC', '12155084', 'prueba@gmail.com', '12155084', '311586621', '', '', '', 3, 1, 0, 1),
(9, 6, 'JHON', 'WILLIAR', 'GOMEZ', 'GOMEZ', 'CC', '12199033', 'prueba@gmail.com', '12199033', '311586621', '', '', '', 3, 1, 0, 1),
(10, 8, 'NICOLAI', '', 'VARGAS', 'SILVA', 'CC', '12203787', 'prueba@gmail.com', '12203787', '311586621', '', '6 años', '2 años', 3, 1, 0, 1),
(11, 9, 'RAUL', '', 'CALDERON', '', 'CC', '12206424', 'prueba@gmail.com', '12206424', '311586621', '', '', '', 3, 1, 0, 1),
(12, 4, 'HUMBERTO', '', 'BERMEO', 'GUAÑARITA', 'CC', '12233776', 'prueba@gmail.com', '12233776', '311586621', '', '', '', 3, 1, 0, 1),
(13, 4, 'JHON', 'JAIRO', 'GIL', 'ARTEAGA', 'CC', '15381332', 'prueba@gmail.com', '15381332', '311586621', '', '', '', 3, 1, 0, 1),
(14, 10, 'OSCAR', 'MAURICIO', 'RIVERA', 'SALGADO', 'CC', '16185322', 'prueba@gmail.com', '16185322', '123456789', 'oscar.jpeg', '15 años', '1 año', 1, 1, 1, 1),
(15, 11, 'JAIRO', '', 'HERNANDEZ', 'VEGA', 'CC', '16185777', 'prueba@gmail.com', '16185777', '311586621', '', '', '', 3, 1, 0, 1),
(16, 6, 'HUGO', 'FERNANDO', 'PEREZ', 'ACEVEDO', 'CC', '16186182', 'prueba@gmail.com', '16186182', '311586621', '', '', '', 3, 1, 0, 1),
(17, 12, 'RAMIRO', '', 'CHARRY', 'CHAUX', 'CC', '16187031', 'prueba@gmail.com', '16187031', '311586621', '', '15 años', '11 años', 2, 1, 1, 1),
(18, 11, 'YAMIT', '', 'DIAZ', 'SANTANILLA', 'CC', '16188075', 'prueba@gmail.com', '16188075', '311586621', '', '', '', 3, 1, 0, 1),
(19, 13, 'CESAR', 'AUGUSTO', 'OVIEDO', 'NAVEROS', 'CC', '16188168', 'prueba@gmail.com', '16188168', '311586621', '', '', '', 3, 1, 0, 1),
(20, 8, 'EDERNILSON', '', 'TRUJILLO', 'LOSADA', 'CC', '16189115', 'prueba@gmail.com', '16189115', '311586621', '', '', '', 3, 1, 0, 1),
(21, 14, 'MILTON', '', 'BAHOS', 'TRUJILLO', 'CC', '16189133', 'prueba@gmail.com', '16189133', '311586621', '', '', '', 3, 1, 0, 1),
(22, 15, 'CARLOS', '', 'ALBAN', 'ASTUDILLO', 'CC', '16783695', 'prueba@gmail.com', '16783695', '311586621', '', '', '', 3, 1, 0, 1),
(23, 16, 'EDUARDO', '', 'HERNANDEZ', 'ESCOBAR', 'CC', '17317781', 'prueba@gmail.com', '17317781', '311586621', '', '', '', 3, 1, 0, 1),
(24, 17, 'MARINO', '', 'MURCIA', 'CARMONA', 'CC', '17615591', 'prueba@gmail.com', '17615591', '311586621', '', '', '', 3, 1, 0, 1),
(25, 18, 'JORGE', 'ENRIQUE', 'BENAVIDES', 'AGUILERA', 'CC', '17629493', 'prueba@gmail.com', '17629493', '311586621', '', '', '', 3, 1, 0, 1),
(26, 19, 'RICAURTE', '', 'ROJAS', 'ROJAS', 'CC', '17629784', 'prueba@gmail.com', '17629784', '311586621', '', '31 años', '11 años', 2, 1, 1, 1),
(27, 4, 'JOSE', 'ADELMO', 'ROJAS', 'TORRES', 'CC', '17631400', 'prueba@gmail.com', '17631400', '311586621', '', '', '', 3, 1, 0, 1),
(28, 4, 'RODRIGO', '', 'PINTO', 'ESPAÑA', 'CC', '17632720', 'prueba@gmail.com', '17632720', '311586621', '', '', '', 3, 1, 0, 1),
(29, 6, 'FRUCTUOSO', '', 'CUMBRE', '', 'CC', '17632855', 'prueba@gmail.com', '17632855', '311586621', '', '', '', 3, 1, 0, 1),
(30, 20, 'NORBERTO', '', 'HURTADO', 'CEDEÑO', 'CC', '17633326', 'prueba@gmail.com', '17633326', '311586621', '', '', '', 3, 1, 0, 1),
(31, 21, 'JOSE', 'EDILSON', 'TORRES', 'LOSADA', 'CC', '17634497', 'prueba@gmail.com', '17634497', '311586621', '', '', '', 3, 1, 0, 1),
(32, 7, 'REINALDO', '', 'VARGAS', 'OME', 'CC', '17634801', 'prueba@gmail.com', '17634801', '311586621', '', '', '', 3, 1, 0, 1),
(33, 13, 'FABIO', '', 'GUEVARA', 'VEGA', 'CC', '17635354', 'prueba@gmail.com', '17635354', '311586621', '', '', '', 3, 1, 0, 1),
(34, 7, 'MOISES', '', 'OBREGON', 'CASTRO', 'CC', '17635574', 'prueba@gmail.com', '17635574', '311586621', '', '', '', 3, 1, 0, 1),
(35, 23, 'REYNALDO', '', 'SANCHEZ', '', 'CC', '17636065', 'prueba@gmail.com', '17636065', '311586621', '', '', '', 3, 1, 0, 1),
(36, 4, 'LUIS', 'CARLOS', 'CUELLAR', 'CEDEÑO', 'CC', '17636378', 'prueba@gmail.com', '17636378', '311586621', '', '', '', 3, 1, 0, 1),
(37, 23, 'SAMUEL', '', 'GORRON', 'CASTRO', 'CC', '17636597', 'prueba@gmail.com', '17636597', '311586621', '', '', '', 3, 1, 0, 1),
(38, 13, 'WILIAM', '', 'GARCIA', '', 'CC', '17637129', 'prueba@gmail.com', '17637129', '311586621', '', '', '', 3, 1, 0, 1),
(39, 6, 'LUIS', 'CARLOS', 'LOSADA', '', 'CC', '17637214', 'prueba@gmail.com', '17637214', '311586621', '', '', '', 3, 1, 0, 1),
(40, 7, 'LUIS', 'ANTONIO', 'LIZARAZO', 'MUÑOZ', 'CC', '17638269', 'prueba@gmail.com', '17638269', '311586621', '', '', '', 3, 1, 0, 1),
(41, 4, 'GUILLERMO', '', 'TIBAQUIRA', 'MELO', 'CC', '17638340', 'prueba@gmail.com', '17638340', '311586621', '', '', '', 3, 1, 0, 1),
(42, 4, 'ALVARO', '', 'CUELLAR', 'GAITAN', 'CC', '17639772', 'prueba@gmail.com', '17639772', '311586621', '', '', '', 3, 1, 0, 1),
(43, 11, 'JOSE', 'FERNEY', 'OSPINA', 'BONOMO', 'CC', '17641701', 'prueba@gmail.com', '17641701', '311586621', '', '', '', 3, 1, 0, 1),
(44, 24, 'ANTONIO', 'JOSE', 'VICTORIA', 'TAMAYO', 'CC', '17642005', 'prueba@gmail.com', '17642005', '311586621', '', '29 años', '11 años', 2, 1, 1, 1),
(45, 2, 'EUCLIDES', '', 'CERQUERA', 'MORA', 'CC', '17642397', 'prueba@gmail.com', '17642397', '311586621', '', '', '', 3, 1, 0, 1),
(46, 6, 'JHON', 'JAIRO', 'SERNA', 'PEREZ', 'CC', '17642850', 'prueba@gmail.com', '17642850', '311586621', '', '', '', 3, 1, 0, 1),
(47, 6, 'OLIMPO', '', 'ALVAREZ', 'ESPAÑA', 'CC', '17643084', 'prueba@gmail.com', '17643084', '311586621', '', '', '', 3, 1, 0, 1),
(48, 14, 'CARLOS', 'ALBERTO', 'SILVA', 'VARGAS', 'CC', '17645007', 'prueba@gmail.com', '17645007', '311586621', '', '', '', 3, 1, 0, 1),
(49, 6, 'HERNANDO', '', 'CAICEDO', 'YAGUE', 'CC', '17648270', 'prueba@gmail.com', '17648270', '311586621', '', '', '', 3, 1, 0, 1),
(50, 25, 'JHON', 'GILBERT', 'CHAVARRO', 'BAHOS', 'CC', '17649715', 'prueba@gmail.com', '17649715', '311586621', '', '', '', 3, 1, 0, 1),
(51, 11, 'CARLOS', 'EDUARDO', 'HEREDIA', 'LEMUS', 'CC', '17650793', 'prueba@gmail.com', '17650793', '311586621', '', '', '', 3, 1, 0, 1),
(52, 26, 'MARLON', 'JAVIER', 'MEJIA', 'GUZMÁN', 'CC', '17651150', 'prueba@gmail.com', '17651150', '311586621', '', '', '', 3, 1, 0, 1),
(53, 4, 'JORGE', '', 'ROJAS', 'BERMEO', 'CC', '17652265', 'prueba@gmail.com', '17652265', '311586621', '', '', '', 3, 1, 0, 1),
(54, 4, 'EIDER', '', 'LOSADA', 'SOLORZANO', 'CC', '17653954', 'prueba@gmail.com', '17653954', '311586621', '', '', '', 3, 1, 0, 1),
(55, 27, 'ALDEMAR', '', 'TRUJILLO', 'MONTERO', 'CC', '17654403', 'prueba@gmail.com', '17654403', '311586621', '', '1 año', '1 año', 2, 1, 1, 1),
(56, 1, 'GUILLERMO', '', 'MACIAS', 'VARGAS', 'CC', '17656878', 'prueba@gmail.com', '17656878', '311586621', '', '', '', 3, 1, 0, 1),
(57, 1, 'CARLOS', 'ALBERTO', 'ROJAS', 'VERA', 'CC', '17657941', 'prueba@gmail.com', '17657941', '311586621', '', '', '', 3, 1, 0, 1),
(58, 21, 'JUAN', 'CARLOS', 'TRIANA', 'MURCIA', 'CC', '17658381', 'prueba@gmail.com', '17658381', '311586621', '', '', '', 3, 1, 0, 1),
(59, 28, 'GUSTAVO', 'ADOLFO', 'HERMIDA', 'ECHEVERRI', 'CC', '17658945', 'prueba@gmail.com', '17658945', '311586621', '', '7 años', '7 años', 2, 1, 1, 1),
(60, 6, 'BENJAMIN', '', 'ARTUNDUAGA', 'ARTUNDUAGA', 'CC', '17659504', 'prueba@gmail.com', '17659504', '311586621', '', '', '', 3, 1, 0, 1),
(61, 29, 'JOSE', 'LIZARDO', 'BARRERA', 'COLLAZOS', 'CC', '17681153', 'prueba@gmail.com', '17681153', '311586621', '', '', '', 3, 1, 0, 1),
(62, 7, 'ANGEL', 'MIGUEL', 'FLOREZ', '', 'CC', '17689465', 'prueba@gmail.com', '17689465', '311586621', '', '', '', 3, 1, 0, 1),
(63, 30, 'JULIO', 'CESAR', 'PEREZ', 'BERNAL', 'CC', '17690534', 'prueba@gmail.com', '17690534', '311586621', '', '12 meses', '12 meses', 3, 1, 0, 1),
(64, 11, 'YODMAN', '', 'LIZCANO', 'YAÑEZ', 'CC', '17691224', 'prueba@gmail.com', '17691224', '311586621', '', '', '', 3, 1, 0, 1),
(65, 6, 'MODESTO', '', 'DIAZ', 'GRANJA', 'CC', '17700537', 'prueba@gmail.com', '17700537', '311586621', '', '', '', 3, 1, 0, 1),
(66, 14, 'LIBARDO', '', 'HERNANDEZ', 'MORENO', 'CC', '17706065', 'prueba@gmail.com', '17706065', '311586621', '', '', '', 3, 1, 0, 1),
(67, 31, 'WILLIAM', '', 'BAHOS', 'MELO', 'CC', '19429504', 'prueba@gmail.com', '19429504', '311586621', '', '', '', 2, 1, 1, 1),
(68, 32, 'LUDIVIA', '', 'SANCHEZ', 'CARDENAS', 'CC', '26649715', 'prueba@gmail.com', '26649715', '311586621', '', '', '', 3, 1, 0, 1),
(69, 33, 'LUZ', 'NILSA', 'PEÑA', 'MACIAS', 'CC', '30507983', 'prueba@gmail.com', '30507983', '311586621', '', '', '', 3, 1, 0, 1),
(70, 34, 'SANDRA', '', 'CARABALI', 'VARGAS', 'CC', '30509032', 'prueba@gmail.com', '30509032', '311586621', '', '', '', 3, 1, 0, 1),
(71, 34, 'CLAUDIA', 'LILIANA', 'ESCOBAR', 'ROMERO', 'CC', '34612481', 'prueba@gmail.com', '34612481', '311586621', '', '', '', 3, 1, 0, 1),
(72, 35, 'UNIBIA', '', 'GUZMAN', 'GONZALEZ', 'CC', '40078651', 'prueba@gmail.com', '40078651', '311586621', 'univia.jpeg', '13 años', '4 años', 1, 1, 1, 1),
(73, 36, 'ROSMIRA', '', 'VALENCIA', 'HURTADO', 'CC', '40086921', 'prueba@gmail.com', '40086921', '311586621', '', '10 MESES - 12 DIAS', '10 MESES - 12 DIAS', 3, 1, 0, 1),
(74, 8, 'YENNY', 'FERLESIA', 'GOMEZ', 'QUINTERO', 'CC', '40612472', 'prueba@gmail.com', '40612472', '311586621', '', '', '', 3, 1, 0, 1),
(75, 37, 'NUVIA', 'STELLA', 'CUELLAR', 'MEDINA', 'CC', '40612529', 'prueba@gmail.com', '40612529', '311586621', '', '4 años', '1 año', 2, 1, 1, 1),
(76, 38, 'LILIBETH', '', 'TIRADO', 'TORRES', 'CC', '40614344', 'prueba@gmail.com', '40614344', '311586621', '', '', '', 3, 1, 0, 1),
(77, 39, 'EDNA', 'CAROLINA', 'ORTEGA', 'BONILLA', 'CC', '40614915', 'prueba@gmail.com', '40614915', '311586621', '', '1 año', '1 año', 2, 1, 1, 1),
(78, 8, 'ANA', 'DEYSI', 'MONJE', 'LOZADA', 'CC', '40740153', 'prueba@gmail.com', '40740153', '311586621', '', '', '', 3, 1, 0, 1),
(79, 8, 'BLANCA', 'DOLLY', 'GARCIA', 'VIDARTE', 'CC', '40760596', 'prueba@gmail.com', '40760596', '311586621', '', '', '', 3, 1, 0, 1),
(80, 34, 'NERY', '', 'MOTTA', 'CHAGUALA', 'CC', '40773240', 'prueba@gmail.com', '40773240', '311586621', '', '', '', 3, 1, 0, 1),
(81, 8, 'LUZ', 'DARY', 'PLAZA', '', 'CC', '40775785', 'prueba@gmail.com', '40775785', '311586621', '', '', '', 3, 1, 0, 1),
(82, 40, 'CARMEN', 'ELENA', 'CHAUX', 'ARTUNDUAGA', 'CC', '40778445', 'prueba@gmail.com', '40778445', '311586621', '', '', '', 3, 1, 0, 1),
(83, 41, 'MARLY', '', 'PASCUAS', 'SABOGAL', 'CC', '40781580', 'prueba@gmail.com', '40781580', '311586621', '', '16 años', ' 6 años', 3, 1, 0, 1),
(84, 6, 'JHON', 'JAIRO', 'ZAPATA', 'ORTIZ', 'CC', '70852933', 'prueba@gmail.com', '70852933', '311586621', '', '', '', 3, 1, 0, 1),
(85, 19, 'CAMILO', '', 'CARDOZO', 'HERNANDEZ', 'CC', '79394868', 'prueba@gmail.com', '79394868', '311586621', '', '17 años', '11 años', 2, 1, 1, 1),
(86, 42, 'OSCAR', 'MAURICIO', 'GARCES', 'CEDEÑO', 'CC', '79596618', 'prueba@gmail.com', '79596618', '311586621', '', '25 años', '1 año', 2, 1, 1, 1),
(87, 43, 'MIGUEL', 'JAVIER', 'PASTRANA', 'MOLINA', 'CC', '79642582', 'prueba@gmail.com', '79642582', '311586621', '', '25 años', '1 año', 2, 1, 1, 1),
(88, 37, 'LUIS', 'HERNAN', 'DURAN', 'GARCIA', 'CC', '79778304', 'prueba@gmail.com', '79778304', '311586621', '', '17 años', '11 años', 2, 1, 1, 1),
(89, 6, 'CALIXTO', '', 'TRIVIÑO', '', 'CC', '83230270', 'prueba@gmail.com', '83230270', '311586621', '', '', '', 3, 1, 0, 1),
(90, 44, 'LUIS', 'GILBERTO', 'GONZALEZ', '', 'CC', '87095017', 'prueba@gmail.com', '87095017', '311586621', '', '', '', 3, 1, 0, 1),
(91, 45, 'JOSE', 'DAVID', 'GARZON', 'RIVEROS', 'CC', '96329707', 'prueba@gmail.com', '96329707', '311586621', '', '13 años', '2 años', 2, 1, 1, 0),
(92, 6, 'JAIME', '', 'SALCEDO', 'MEDINA', 'CC', '96330315', 'prueba@gmail.com', '96330315', '311586621', '', '', '', 3, 1, 0, 1),
(93, 6, 'DANIEL', '', 'PILLIMUE', 'PLAZA', 'CC', '96331179', 'prueba@gmail.com', '96331179', '311586621', '', '', '', 3, 1, 0, 1),
(94, 4, 'JUAN', 'CARLOS', 'CHICUE', 'LOZANO', 'CC', '96333848', 'prueba@gmail.com', '96333848', '311586621', '', '', '', 3, 1, 0, 1),
(95, 46, 'EVER', '', 'RIVERA', 'SALGADO', 'CC', '96340180', 'prueba@gmail.com', '96340180', '311586621', '', '', '', 3, 1, 0, 1),
(96, 7, 'ORLANDO', '', 'CALDERON', '', 'CC', '96340247', 'prueba@gmail.com', '96340247', '311586621', '', '', '', 3, 1, 0, 1),
(97, 6, 'EVER', '', 'GOMEZ', 'VARGAS', 'CC', '96340972', 'prueba@gmail.com', '96340972', '311586621', '', '', '', 3, 1, 0, 1),
(98, 4, 'HEINER', '', 'ROJAS', 'GIRALDO', 'CC', '97448242', 'prueba@gmail.com', '97448242', '311586621', '', '', '', 3, 1, 0, 1),
(99, 47, 'NICOLE', 'MICHELLE', 'PARRA', 'STRAUB', 'CC', '1005839092', 'prueba@gmail.com', '1005839092', '311586621', '', '4 años', '1 año', 2, 1, 1, 1),
(100, 8, 'JUAN', 'DAVID', 'PALACIOS', 'RUIZ', 'CC', '1006505160', 'prueba@gmail.com', '1006505160', '311586621', '', '', '', 3, 1, 0, 1),
(101, 41, 'PAULA', 'KATHERINE', 'RUBIO', 'RUIZ', 'CC', '1006505472', 'prueba@gmail.com', '1006505472', '311586621', '', '2 años', '1 año', 2, 1, 1, 1),
(102, 48, 'ALEJANDRA', '', 'SANCHEZ', 'PARRA', 'CC', '1006515901', 'prueba@gmail.com', '1006515901', '311586621', '', '', '', 3, 1, 0, 1),
(103, 14, 'HECTOR', 'JAIME', 'CASAS', 'CLAROS', 'CC', '1006527984', 'prueba@gmail.com', '1006527984', '311586621', '', '', '', 3, 1, 0, 1),
(104, 33, 'NICOLAS', '', 'CAICEDO', 'PEREZ', 'CC', '1006537933', 'prueba@gmail.com', '1006537933', '311586621', 'Nicolas.jpg', '2 meses, 44 días', '2 meses 44', 2, 1, 1, 1),
(105, 33, 'LAURA', 'CAMILA', 'AGUIRRE', 'LEIVA', 'CC', '1006549569', 'prueba@gmail.com', '1006549569', '311586621', '', '', '', 3, 1, 0, 0),
(106, 49, 'DAVID', 'ALFONSO', 'GARZON', 'SICACHA', 'CC', '1010163217', 'prueba@gmail.com', '1010163217', '311586621', '', '6 años', '1 año', 2, 1, 1, 1),
(107, 50, 'JUAN', 'DAVID', 'GUTIERREZ', 'MORENO', 'CC', '1014302196', 'prueba@gmail.com', '1014302196', '311586621', '', '', '', 3, 1, 0, 1),
(108, 51, 'CARLOS', 'ANDRES', 'MENDOZA', 'SANCHEZ', 'CC', '1018420776', 'prueba@gmail.com', '1018420776', '311586621', '', '', '', 3, 1, 0, 1),
(109, 52, 'KAROL', 'TATIANA', 'GORRON', 'RIVERA', 'CC', '1018486094', 'prueba@gmail.com', '1018486094', '311586621', '', '2 años', '2 años', 2, 1, 1, 1),
(110, 11, 'JORGE', 'ENRIQUE', 'MENDEZ', 'SANCHEZ', 'CC', '1030585555', 'prueba@gmail.com', '1030585555', '311586621', '', '', '', 3, 1, 0, 1),
(111, 53, 'FABIO', 'ARTURO', 'ZAMBRANO', 'ICO', 'CC', '1051657456', 'prueba@gmail.com', '1051657456', '311586621', '', '', '', 3, 1, 0, 1),
(112, 54, 'ANYELO', 'ERLEY', 'DUARTE', 'PEÑA', 'CC', '1071986213', 'prueba@gmail.com', '1071986213', '311586621', '', '', '', 3, 1, 0, 1),
(113, 11, 'JHORDI', '', 'DIAZ', 'CERON', 'CC', '1077866641', 'prueba@gmail.com', '1077866641', '311586621', '', '', '', 3, 1, 0, 1),
(114, 55, 'RANJI', 'JUSETP', 'DEVIA', 'OVIEDO', 'CC', '1106786011', 'prueba@gmail.com', '1106786011', '311586621', '', '', '', 3, 1, 0, 0),
(115, 7, 'MIGUEL', 'ANGEL', 'VALENZUELA', 'VARGAS', 'CC', '1115791426', 'prueba@gmail.com', '1115791426', '311586621', '', '', '', 3, 1, 0, 1),
(116, 19, 'ARLINSON', '', 'RUIZ', 'ESPAÑA', 'CC', '1115794212', 'prueba@gmail.com', '1115794212', '311586621', '', '1 año', '1 año', 2, 1, 1, 1),
(117, 7, 'WILSON', 'DAMIAN', 'SABI', 'MORENO', 'CC', '1115794662', 'prueba@gmail.com', '1115794662', '311586621', '', '', '', 3, 1, 0, 1),
(118, 56, 'FRAISON', '', 'GARCIA', 'VEGA', 'CC', '1115949051', 'prueba@gmail.com', '1115949051', '311586621', '', '3 años', '3 años', 2, 1, 1, 1),
(119, 13, 'CRISTIAN', 'LEONARDO', 'ARTUNDUAGA', 'ESPAÑA', 'CC', '1117487475', 'prueba@gmail.com', '1117487475', '311586621', '', '', '', 3, 1, 0, 1),
(120, 8, 'YOR', 'JASBLEIDY', 'SANTOS', 'TORRES', 'CC', '1117494681', 'prueba@gmail.com', '1117494681', '311586621', '', '', '', 3, 1, 0, 1),
(121, 11, 'ORLEY', 'OSWALDO', 'QUINA', 'TIERRADENTRO', 'CC', '1117495072', 'prueba@gmail.com', '1117495072', '311586621', '', '', '', 3, 1, 0, 1),
(122, 57, 'JACKSON', '', 'APRAEZ', 'SOTO', 'CC', '1117498564', 'prueba@gmail.com', '1117498564', '311586621', '', '', '', 3, 1, 0, 1),
(123, 6, 'FERNANDO', '', 'CASTRO', 'MORENO', 'CC', '1117498599', 'prueba@gmail.com', '1117498599', '311586621', '', '', '', 3, 1, 0, 1),
(124, 1, 'LISANDRO', '', 'CAMPO', 'GARCIA', 'CC', '1117503003', 'prueba@gmail.com', '1117503003', '311586621', '', '', '', 3, 1, 0, 1),
(125, 2, 'JHON', '', 'JAIRO', 'ARTUNDUAGA', 'CC', '1117507947', 'prueba@gmail.com', '1117507947', '311586621', '', '', '', 3, 1, 0, 1),
(126, 58, 'MARILY', '', 'MELO', 'BECERRA', 'CC', '1117509111', 'prueba@gmail.com', '1117509111', '311586621', '', '45', '45', 3, 1, 0, 1),
(127, 59, 'ANGIE', 'STEPHANCE', 'CORREA', 'ALVARADO', 'CC', '1117514075', 'prueba@gmail.com', '1117514075', '311586621', '', '', '', 3, 1, 0, 1),
(128, 6, 'HERNEDIS', '', 'AREVALO', 'MUÑOZ', 'CC', '1117514078', 'prueba@gmail.com', '1117514078', '311586621', '', '', '', 3, 1, 0, 1),
(129, 4, 'ELKIN', 'ALFONSO', 'TRUJILLO', 'ALVIS', 'CC', '1117514266', 'prueba@gmail.com', '1117514266', '311586621', '', '', '', 3, 1, 0, 1),
(130, 60, 'YEFERSON', '', 'ESPINOSA', 'QUINTERO', 'CC', '1117516529', 'prueba@gmail.com', '1117516529', '311586621', '', '', '', 3, 1, 0, 1),
(131, 61, 'ERIKA', 'VANESSA', 'ARCILA', 'LOPEZ', 'CC', '1117521136', 'prueba@gmail.com', '1117521136', '311586621', '', '1 año', '1 año', 2, 1, 1, 1),
(132, 62, 'DIEGO', 'FERNANDO', 'HERNANDEZ', 'SANCHEZ', 'CC', '1117522218', 'prueba@gmail.com', '1117522218', '311586621', '', '1 año y 7 meses', '1 año y 7 meses', 2, 1, 1, 1),
(133, 36, 'CAMILO', 'ANDRES', 'ROJAS', 'MELO', 'CC', '1117525280', 'prueba@gmail.com', '1117525280', '311586621', '', '', '', 3, 1, 0, 1),
(134, 11, 'YEFFERSON', 'FABIAN', 'YAGUE', 'VALENZUELA', 'CC', '1117527407', 'prueba@gmail.com', '1117527407', '311586621', '', '', '', 3, 1, 0, 1),
(135, 63, 'LORENS', 'LIZBETH', 'MUÑOZ', 'CLAROS', 'CC', '1117530968', 'prueba@gmail.com', '1117530968', '311586621', '', '', '', 2, 1, 1, 1),
(136, 64, 'LEIDY', 'JOHANNA', 'PEREZ', 'CORTES', 'CC', '1117534529', 'prueba@gmail.com', '1117534529', '311586621', '', '', '', 3, 1, 0, 1),
(137, 6, 'JOHAN', 'SEBASTIAN', 'PERDOMO', 'CARVAJAL', 'CC', '1117534918', 'prueba@gmail.com', '1117534918', '311586621', '', '', '', 3, 1, 0, 1),
(138, 6, 'SANTIAGO', 'ANDRES', 'SANCHEZ', 'AGREDO', 'CC', '1117540285', 'prueba@gmail.com', '1117540285', '311586621', '', '', '', 3, 1, 0, 1),
(139, 11, 'MICHEL', 'RICARDO', 'CARRANZA', 'TOTENA', 'CC', '1117541998', 'prueba@gmail.com', '1117541998', '311586621', '', '', '', 3, 1, 0, 1),
(140, 4, 'BRAYAN', 'STIVEN', 'OLIVEROS', 'CAUTIVO', 'CC', '1117543234', 'prueba@gmail.com', '1117543234', '311586621', '', '', '', 3, 1, 0, 1),
(141, 64, 'DIEGO', 'ARNULFO', 'JOVEN', 'MURCIA', 'CC', '1117543338', 'prueba@gmail.com', '1117543338', '311586621', '', '', '', 3, 1, 0, 1),
(142, 65, 'JHON', 'JANER', 'RUIZ', 'CHILITO', 'CC', '1117543757', 'prueba@gmail.com', '1117543757', '311586621', '', '19 MESES', '19 MESES', 3, 1, 0, 1),
(143, 8, 'GISELLA', '', 'CUELLAR', 'MONJE', 'CC', '1117546034', 'prueba@gmail.com', '1117546034', '311586621', '', '', '', 3, 1, 0, 1),
(144, 4, 'JUNIOR', 'HERSAN', 'ALDANA', 'DUARTE', 'CC', '1117548364', 'prueba@gmail.com', '1117548364', '311586621', '', '', '', 3, 1, 0, 1),
(145, 11, 'OSCAR', 'FERNANDO', 'SERNA', 'PEREZ', 'CC', '1117553975', 'prueba@gmail.com', '1117553975', '311586621', '', '', '', 3, 1, 0, 1),
(146, 34, 'NELCY', '', 'MANJARREZ', 'ALDANA', 'CC', '1117804545', 'prueba@gmail.com', '1117804545', '311586621', '', '1 AÑO', '1 AÑO', 3, 1, 0, 1),
(147, 33, 'CRISTIAN', 'FELIPE', 'MARTINEZ', 'SANCHEZ', 'CC', '1117805341', 'prueba@gmail.com', '1117805341', '311586621', '', '', '', 3, 1, 0, 1),
(148, 33, 'SANTIAGO', '', 'VILLEGAS', 'SILVA', 'CC', '1117930659', 'prueba@gmail.com', '1117930659', '311586621', '', '', '', 3, 1, 0, 0),
(149, 2, 'JAMES', '', 'CORREA', 'BURGOS', 'CC', '1118025254', 'prueba@gmail.com', '1118025254', '311586621', '', '', '', 3, 1, 0, 1),
(150, 5, 'WILFREDO', '', 'MENDEZ', 'ORDOÑEZ', 'CC', '1119211290', 'prueba@gmail.com', '1119211290', '311586621', '', '6 años', '2 años y 7 meses', 3, 1, 0, 1),
(151, 2, 'SERGIO', '', 'QUIROZ', 'CAMACHO', 'CC', '1119216496', 'prueba@gmail.com', '1119216496', '311586621', '', '', '', 3, 1, 0, 1),
(152, 34, 'FRANCY', 'YOHANNA', 'POLANCO', 'REINA', 'CC', '1119581428', 'prueba@gmail.com', '1119581428', '311586621', '', '2 años', '2 años', 3, 1, 0, 1),
(153, 66, 'MAURICIO', '', 'CLAROS', 'MURCIA', 'CC', '1125181169', 'prueba@gmail.com', '1125181169', '311586621', '', '', '', 3, 1, 0, 1),
(154, 8, 'YURI', 'VANESSA', 'ALMANZA', 'ARTUNDUAGA', 'CC', '1126597380', 'prueba@gmail.com', '1126597380', '311586621', '', '', '', 3, 1, 0, 1),
(155, 1, 'GUILLERMO', '', 'OSORIO', 'GUEVARA', 'CC', '6802402', 'prueba@gmail.com', '6802402', '311586621', '', '', '', 3, 1, 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`IdCalificacion`),
  ADD KEY `IdEvaluado` (`IdEvaluado`),
  ADD KEY `IdPregunta` (`IdPregunta`),
  ADD KEY `IdEvaluacion` (`IdEvaluacion`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`IdCargo`),
  ADD KEY `Dependencia` (`IdDependencia`);

--
-- Indices de la tabla `dependencias`
--
ALTER TABLE `dependencias`
  ADD PRIMARY KEY (`IdDependencia`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`IdEvaluacion`),
  ADD KEY `evaluaciones_ibfk_1` (`IdEvaluador`);

--
-- Indices de la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  ADD PRIMARY KEY (`IdEvaluadores`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Indices de la tabla `evaluados`
--
ALTER TABLE `evaluados`
  ADD PRIMARY KEY (`IdEvaluado`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdEvaluador` (`IdEvaluador`);

--
-- Indices de la tabla `factor`
--
ALTER TABLE `factor`
  ADD PRIMARY KEY (`IdFactor`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`IdPregunta`),
  ADD KEY `IdFactor` (`IdFactor`);

--
-- Indices de la tabla `rangocalificacion`
--
ALTER TABLE `rangocalificacion`
  ADD PRIMARY KEY (`IdRango`),
  ADD KEY `IdPregunta` (`IdPregunta`),
  ADD KEY `IdFactor` (`IdFactor`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`),
  ADD KEY `IdCargo` (`IdCargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `IdCalificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=831;
--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `IdCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT de la tabla `dependencias`
--
ALTER TABLE `dependencias`
  MODIFY `IdDependencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `IdEvaluacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;
--
-- AUTO_INCREMENT de la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  MODIFY `IdEvaluadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `evaluados`
--
ALTER TABLE `evaluados`
  MODIFY `IdEvaluado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT de la tabla `factor`
--
ALTER TABLE `factor`
  MODIFY `IdFactor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `IdPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `rangocalificacion`
--
ALTER TABLE `rangocalificacion`
  MODIFY `IdRango` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`IdEvaluado`) REFERENCES `evaluados` (`IdEvaluado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`IdPregunta`) REFERENCES `pregunta` (`IdPregunta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calificacion_ibfk_3` FOREIGN KEY (`IdEvaluacion`) REFERENCES `evaluaciones` (`IdEvaluacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_ibfk_1` FOREIGN KEY (`IdEvaluador`) REFERENCES `evaluadores` (`IdEvaluadores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  ADD CONSTRAINT `evaluadores_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`);

--
-- Filtros para la tabla `evaluados`
--
ALTER TABLE `evaluados`
  ADD CONSTRAINT `evaluados_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `evaluados_ibfk_2` FOREIGN KEY (`IdEvaluador`) REFERENCES `evaluadores` (`IdEvaluadores`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`IdFactor`) REFERENCES `factor` (`IdFactor`);

--
-- Filtros para la tabla `rangocalificacion`
--
ALTER TABLE `rangocalificacion`
  ADD CONSTRAINT `rangocalificacion_ibfk_1` FOREIGN KEY (`IdPregunta`) REFERENCES `pregunta` (`IdPregunta`),
  ADD CONSTRAINT `rangocalificacion_ibfk_2` FOREIGN KEY (`IdFactor`) REFERENCES `factor` (`IdFactor`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`IdCargo`) REFERENCES `cargos` (`IdCargo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
