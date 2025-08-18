-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2025 at 07:30 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u518021603_sali`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloquelectivo`
--

CREATE TABLE `bloquelectivo` (
  `idBloqueLectivo` int(11) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Final` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dialectivo`
--

CREATE TABLE `dialectivo` (
  `idDiaLectivo` int(11) NOT NULL,
  `nombreDiaLectivo` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dialectivo`
--

INSERT INTO `dialectivo` (`idDiaLectivo`, `nombreDiaLectivo`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes');

-- --------------------------------------------------------

--
-- Table structure for table `especialidad`
--

CREATE TABLE `especialidad` (
  `idEspecialidad` int(11) NOT NULL,
  `nombreEspecialidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `especialidad`
--

INSERT INTO `especialidad` (`idEspecialidad`, `nombreEspecialidad`) VALUES
(1, 'Administrador'),
(37, 'Accounting'),
(38, 'Bilingual Secretary'),
(39, 'Contabilidad y Finanzas'),
(40, 'Departamento de Inglés'),
(41, 'Desarrollo Web'),
(42, 'Dibujo Técnico'),
(43, 'Dibujo y Modelado de Edificaciones'),
(44, 'Diseño Publicitario'),
(45, 'Ejecutivo Comercial y de Servicio al Cliente'),
(46, 'Electromecánica / Mantenimiento Industrial'),
(47, 'Electrónica en Telecomunicaciones'),
(48, 'Electrónica Industrial'),
(49, 'Emprendimiento'),
(50, 'Mecánica de Precisión'),
(51, 'Reparación de los Sistemas de Vehículos Livianos'),
(52, 'Coordinación Académica'),
(53, 'Coordinación con la Empresa'),
(54, 'Sudirección');

-- --------------------------------------------------------

--
-- Table structure for table `estadoadmision`
--

CREATE TABLE `estadoadmision` (
  `idEstadoAdmision` int(11) NOT NULL,
  `estadoAdmision` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estadoadmision`
--

INSERT INTO `estadoadmision` (`idEstadoAdmision`, `estadoAdmision`) VALUES
(1, 'Aceptado'),
(2, 'Pendiente'),
(3, 'Rechazado');

-- --------------------------------------------------------

--
-- Table structure for table `estadosolicitud`
--

CREATE TABLE `estadosolicitud` (
  `idEstadoSolicitud` int(11) NOT NULL,
  `estadoSolicitud` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estadosolicitud`
--

INSERT INTO `estadosolicitud` (`idEstadoSolicitud`, `estadoSolicitud`) VALUES
(1, 'Admitido'),
(2, 'Pendiente'),
(3, 'Rechazado');

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `id_row_sh` int(99) NOT NULL,
  `cedulaProfesor` int(11) NOT NULL,
  `idEspecialidad` int(11) NOT NULL,
  `diaLectivo` enum('Lunes','Martes','Miercoles','Jueves','Viernes') NOT NULL,
  `bloqueLectivo` int(11) NOT NULL,
  `idSubarea` int(11) NOT NULL,
  `numeroLlave` int(11) NOT NULL,
  `Grupo` varchar(100) NOT NULL,
  `last_sch_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `llave`
--

CREATE TABLE `llave` (
  `numeroLlave` int(11) NOT NULL,
  `Ocupada` tinyint(4) NOT NULL,
  `nombreAula` varchar(200) NOT NULL,
  `razonOcupada` varchar(200) NOT NULL,
  `cedulaProfesor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `llave`
--

INSERT INTO `llave` (`numeroLlave`, `Ocupada`, `nombreAula`, `razonOcupada`, `cedulaProfesor`) VALUES
(1, 0, 'Circuitos 1', 'Sin razón', NULL),
(2, 0, 'Circuitos 2', 'Sin razón', NULL),
(3, 0, 'Redes', 'Sin razón', NULL),
(4, 0, 'Automatización y Control Eléctrico', 'Sin razón', NULL),
(5, 0, 'Aula Industrial 03 ', 'Sin razón', NULL),
(6, 0, 'Aula Industrial 02', 'Sin razón', NULL),
(7, 0, 'Neumática, Hidráulica y Refrigeración', 'Sin razón', NULL),
(8, 0, 'Aula Industrial 01', 'Sin razón', NULL),
(9, 0, 'Laboratorio de Cómputo 1', 'Sin razón', NULL),
(10, 0, 'Laboratorio de Cómputo 2', 'Sin razón', NULL),
(11, 0, 'Mecánica de Precisión', 'Sin razón', NULL),
(12, 0, 'Laboratorio de Simulación', 'Sin razón', NULL),
(13, 0, 'Mecánica Automotriz', 'Sin razón', NULL),
(14, 0, 'Autotrónica', 'Sin razón', NULL),
(15, 0, 'Laboratorio E-3', 'Sin razón', NULL),
(16, 0, 'Laboratorio E-2', 'Sin razón', NULL),
(17, 0, 'E1 Aula DT', 'Sin razón', NULL),
(18, 0, 'D1', 'Sin razón', NULL),
(19, 0, 'Fotografía', 'Sin razón', NULL),
(20, 0, 'D2', 'Sin razón', NULL),
(21, 0, 'D3', 'Sin razón', NULL),
(22, 0, 'Laboratorio MAC', 'Sin razón', NULL),
(23, 0, 'Laboratorio Diseño Digital PC-1', 'Sin razón', NULL),
(24, 0, 'Laboratorio PC-2', 'Sin razón', NULL),
(25, 0, 'Diseño Manual', 'Sin razón', NULL),
(26, 0, 'Laboratorio B-06', 'Sin razón', NULL),
(27, 0, 'Laboratorio B-07', 'Sin razón', NULL),
(28, 0, 'Laboratorio B-08', 'Sin razón', NULL),
(29, 0, 'Laboratorio B-09', 'Sin razón', NULL),
(30, 0, 'Laboratorio B-10', 'Sin razón', NULL),
(31, 0, 'Laboratorio A-1', 'Sin razón', NULL),
(32, 0, 'Etiqueta y Protocolo', 'Sin razón', NULL),
(33, 0, 'Bodega de Instalaciones Eléctricas', 'Sin razón', NULL),
(34, 0, 'Taller de Procesos', 'Sin razón', NULL),
(35, 0, 'Laboratorio C-3', 'Sin razón', NULL),
(999, 0, 'Sin asignación', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registro_actividad`
--

CREATE TABLE `registro_actividad` (
  `idActividad` int(11) NOT NULL,
  `codigo_tipo_actividad` int(3) NOT NULL,
  `cedulaProfesor` int(11) NOT NULL,
  `fecha_actividad` date NOT NULL,
  `hora_inicio_actividad` time NOT NULL,
  `numeroLlave1_ryd` int(11) DEFAULT NULL,
  `numeroLlave2_ryd` int(11) DEFAULT NULL,
  `numeroLlave3_ryd` int(11) DEFAULT NULL,
  `numeroLlave4_ryd` int(11) DEFAULT NULL,
  `numeroLlave5_ryd` int(11) DEFAULT NULL,
  `numeroLlave6_ryd` int(11) DEFAULT NULL,
  `numeroLlave7_ryd` int(11) DEFAULT NULL,
  `numeroLlave8_ryd` int(11) DEFAULT NULL,
  `numeroLlave9_ryd` int(11) DEFAULT NULL,
  `numeroLlave_solicitada` int(11) DEFAULT NULL,
  `fecha_uso_llave_solicitada` date DEFAULT NULL,
  `cod_estado_solicitud` int(11) DEFAULT NULL,
  `bitacora_devolucion` varchar(250) DEFAULT 'n/a',
  `cod_gravedad_devolucion` int(11) DEFAULT NULL,
  `hora_inicio_llave_solicitada` time DEFAULT NULL,
  `hora_final_llave_solicitada` time DEFAULT NULL,
  `razon_uso_llave_solicitada` varchar(300) DEFAULT NULL,
  `razon_devolucion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retiro_llave_access_code_mfa`
--

CREATE TABLE `retiro_llave_access_code_mfa` (
  `idretiro_llave_access_code_mfa` int(11) NOT NULL,
  `retiro_llave_access_code_mfa` varchar(2) NOT NULL,
  `datetime_act` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retiro_llave_access_code_mfa`
--

INSERT INTO `retiro_llave_access_code_mfa` (`idretiro_llave_access_code_mfa`, `retiro_llave_access_code_mfa`, `datetime_act`) VALUES
(1, '12', '2025-08-14 18:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Profesor');

-- --------------------------------------------------------

--
-- Table structure for table `solicitudllave`
--

CREATE TABLE `solicitudllave` (
  `idSolicitudLlave` int(11) NOT NULL,
  `fechaEmision` date NOT NULL,
  `horaEmision` time NOT NULL,
  `fechaUtilizacion` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFinal` time NOT NULL,
  `numeroLlave` int(11) NOT NULL,
  `cedulaUsuario` int(11) NOT NULL,
  `idEstadoSolicitud` int(11) NOT NULL,
  `razonUso` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subarea`
--

CREATE TABLE `subarea` (
  `idSubarea` int(11) NOT NULL,
  `nombreSubarea` varchar(100) NOT NULL,
  `idEspecialidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subarea`
--

INSERT INTO `subarea` (`idSubarea`, `nombreSubarea`, `idEspecialidad`) VALUES
(1, 'Sin asignar', NULL),
(83, 'Accounting Decision Tools', 37),
(84, 'Accounting Management', 37),
(85, 'Business Management', 37),
(86, 'Gestión de Tecnologías Digitales Contables', 37),
(87, 'Gestión Tributaria', 37),
(88, 'Manufacturing Management', 37),
(89, 'Normativa Legal Contable', 37),
(90, 'Business Communication', 38),
(91, 'Business Management', 38),
(92, 'Composition', 38),
(93, 'Computer Skills', 38),
(95, 'Gestión Empresarial', 38),
(96, 'Gestión Empresarial', 39),
(97, 'Gestión Empresarial para Financistas', 39),
(98, 'Gestión en Costos', 39),
(99, 'Contabilidad Financiera', 39),
(100, 'Diseño de Software', 41),
(101, 'Emprendimiento e Innovación', 41),
(102, 'Programación Para Web', 41),
(103, 'Soporte de TI', 41),
(104, 'Tecnologías de la Información', 41),
(105, 'Dibujo Técnico DP', 42),
(106, 'Dibujo Técnico ETEL', 42),
(107, 'Dibujo y Diseño Arquitectónico y Urbanístico', 43),
(108, 'Emprendimiento e Innovación', 43),
(109, 'Modelado Arquitectónico Asistido por Computadora', 43),
(110, 'Técnicas de Presentación y Modelos', 43),
(111, 'Diseño Publicitario', 44),
(112, 'Fotografía', 44),
(113, 'Destrezas Digitales', 45),
(114, 'Emprendimiento e Innovación', 45),
(115, 'Gestión Comercial', 45),
(116, 'Gestión Comercial y Comunicación para el Servicio al Cliente', 45),
(117, 'Admón. Para Mantenimiento Industrial', 46),
(118, 'Instalaciones Eléctricas', 46),
(119, 'Máquinas y Sistemas Electromecánicos', 46),
(120, 'Procesos metalmecánicos', 46),
(121, 'Sistemas de Automatización y Control', 46),
(122, 'Sistemas de Vapor y Fluidos', 46),
(123, 'Sistemas Electromecánicos III', 46),
(124, 'Tecnologías de la Información', 46),
(125, 'Circuitos lineales', 47),
(126, 'Electrónica Digital', 47),
(127, 'Electrónica Digital II', 47),
(128, 'Telecomunicaciones', 47),
(129, 'Automatismo', 48),
(130, 'Control Industrial', 48),
(131, 'Electrónica Analógica', 48),
(132, 'Electrónica Digital', 48),
(133, 'Emprendimiento e Innovación', 48),
(134, 'Fundamentos de Electrónica', 48),
(135, 'Instalaciones Eléctricas', 48),
(136, 'Tecnologías de la Información', 48),
(137, 'Diseño y Manufactura Asistida por Computadora', 50),
(138, 'Emprendimiento e Innovación', 50),
(139, 'Mecanizado con Máquinas y Herramientas', 50),
(140, 'Operaciones en Equipo de Banco y Metrología Dimensional', 50),
(141, 'Tecnologías de la Información', 50),
(142, 'Autotrónica', 51),
(143, 'Emprendimiento e Innovación', 51),
(144, 'Mecánica de Motores', 51),
(145, 'Mecánica de Motores de Vehículos Livianos', 51),
(146, 'Operaciones de Estructura Vehicular', 51),
(147, 'Operaciones en Equipo de Banco', 51),
(148, 'Tecnologías de la Información', 51),
(149, 'Inglés', 40),
(150, 'Comité de Apoyo Educativo', 49),
(151, 'Oral Communication', 38),
(152, 'Emprendimiento', 49),
(153, 'Accounting', 37),
(154, 'Diseño Digital', 44),
(155, 'Sistemas de Impresión', 44),
(156, 'Diagnóstico Técnico Vehicular', 51);

-- --------------------------------------------------------

--
-- Table structure for table `sys_config`
--

CREATE TABLE `sys_config` (
  `idsys_config` int(11) NOT NULL,
  `namesys_config` varchar(12) NOT NULL,
  `valsys_config` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sys_config`
--

INSERT INTO `sys_config` (`idsys_config`, `namesys_config`, `valsys_config`) VALUES
(1, 'location_req', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_actividad`
--

CREATE TABLE `tipo_actividad` (
  `idTipo_Actividad` int(11) NOT NULL,
  `tipo_actividad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_actividad`
--

INSERT INTO `tipo_actividad` (`idTipo_Actividad`, `tipo_actividad`) VALUES
(1, 'Retiro de Llave'),
(2, 'Devolución de Llave'),
(3, 'Solicitud de Llave');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `cedulaUsuario` int(11) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL,
  `correoInstitucional` varchar(200) NOT NULL,
  `contraseñaCorreoInstitucional` varchar(200) NOT NULL,
  `numeroContacto` int(11) DEFAULT NULL,
  `correoContacto` varchar(200) DEFAULT NULL,
  `linkFotoPerfil` varchar(300) NOT NULL,
  `idRol` int(11) NOT NULL,
  `idEstadoAdmision` int(11) NOT NULL,
  `usuarioLogeado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`cedulaUsuario`, `nombreCompleto`, `correoInstitucional`, `contraseñaCorreoInstitucional`, `numeroContacto`, `correoContacto`, `linkFotoPerfil`, `idRol`, `idEstadoAdmision`, `usuarioLogeado`) VALUES
(101110111, 'administrador', 'admin@covao.ed.cr', '$2y$10$ZjQ9wkoeh/4/w9RjCjoOjeL5mpPgtGq1YnNynDJx8mm5nO3ZWlV4i', 0, 'n/a', './public/assets/images/fotos_perfil/default.webp', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloquelectivo`
--
ALTER TABLE `bloquelectivo`
  ADD PRIMARY KEY (`idBloqueLectivo`);

--
-- Indexes for table `dialectivo`
--
ALTER TABLE `dialectivo`
  ADD PRIMARY KEY (`idDiaLectivo`);

--
-- Indexes for table `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`idEspecialidad`);

--
-- Indexes for table `estadoadmision`
--
ALTER TABLE `estadoadmision`
  ADD PRIMARY KEY (`idEstadoAdmision`);

--
-- Indexes for table `estadosolicitud`
--
ALTER TABLE `estadosolicitud`
  ADD PRIMARY KEY (`idEstadoSolicitud`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_row_sh`),
  ADD KEY `idSubarea` (`idSubarea`),
  ADD KEY `numLlave` (`numeroLlave`),
  ADD KEY `cedulaProfesor` (`cedulaProfesor`),
  ADD KEY `idEspecialidad` (`idEspecialidad`);

--
-- Indexes for table `llave`
--
ALTER TABLE `llave`
  ADD PRIMARY KEY (`numeroLlave`),
  ADD KEY `cedulaProfesor` (`cedulaProfesor`);

--
-- Indexes for table `registro_actividad`
--
ALTER TABLE `registro_actividad`
  ADD PRIMARY KEY (`idActividad`),
  ADD KEY `cedular_profesor` (`cedulaProfesor`),
  ADD KEY `llave_solicitud` (`numeroLlave_solicitada`),
  ADD KEY `codigo_tipo_actividad` (`codigo_tipo_actividad`);

--
-- Indexes for table `retiro_llave_access_code_mfa`
--
ALTER TABLE `retiro_llave_access_code_mfa`
  ADD PRIMARY KEY (`idretiro_llave_access_code_mfa`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indexes for table `solicitudllave`
--
ALTER TABLE `solicitudllave`
  ADD PRIMARY KEY (`idSolicitudLlave`),
  ADD KEY `idEstadoSolicitud` (`idEstadoSolicitud`),
  ADD KEY `númeroLlave` (`numeroLlave`),
  ADD KEY `cedulaUsuario` (`cedulaUsuario`);

--
-- Indexes for table `subarea`
--
ALTER TABLE `subarea`
  ADD PRIMARY KEY (`idSubarea`),
  ADD KEY `idEspecialidad` (`idEspecialidad`);

--
-- Indexes for table `sys_config`
--
ALTER TABLE `sys_config`
  ADD PRIMARY KEY (`idsys_config`);

--
-- Indexes for table `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  ADD PRIMARY KEY (`idTipo_Actividad`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedulaUsuario`),
  ADD KEY `idEstadoAdmision` (`idEstadoAdmision`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloquelectivo`
--
ALTER TABLE `bloquelectivo`
  MODIFY `idBloqueLectivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idEspecialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
  MODIFY `id_row_sh` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9351;

--
-- AUTO_INCREMENT for table `registro_actividad`
--
ALTER TABLE `registro_actividad`
  MODIFY `idActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3046;

--
-- AUTO_INCREMENT for table `solicitudllave`
--
ALTER TABLE `solicitudllave`
  MODIFY `idSolicitudLlave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `subarea`
--
ALTER TABLE `subarea`
  MODIFY `idSubarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `idEspecialidad` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidad` (`idEspecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idSubarea` FOREIGN KEY (`idSubarea`) REFERENCES `subarea` (`idSubarea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `numLlave` FOREIGN KEY (`numeroLlave`) REFERENCES `llave` (`numeroLlave`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `llave`
--
ALTER TABLE `llave`
  ADD CONSTRAINT `cedulaProfesor` FOREIGN KEY (`cedulaProfesor`) REFERENCES `usuario` (`cedulaUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `registro_actividad`
--
ALTER TABLE `registro_actividad`
  ADD CONSTRAINT `cedular_profesor` FOREIGN KEY (`cedulaProfesor`) REFERENCES `usuario` (`cedulaUsuario`),
  ADD CONSTRAINT `codigo_tipo_actividad` FOREIGN KEY (`codigo_tipo_actividad`) REFERENCES `tipo_actividad` (`idTipo_Actividad`),
  ADD CONSTRAINT `llave_solicitud` FOREIGN KEY (`numeroLlave_solicitada`) REFERENCES `llave` (`numeroLlave`);

--
-- Constraints for table `solicitudllave`
--
ALTER TABLE `solicitudllave`
  ADD CONSTRAINT `solicitudllave_ibfk_1` FOREIGN KEY (`idEstadoSolicitud`) REFERENCES `estadosolicitud` (`idEstadoSolicitud`),
  ADD CONSTRAINT `solicitudllave_ibfk_2` FOREIGN KEY (`numeroLlave`) REFERENCES `llave` (`numeroLlave`),
  ADD CONSTRAINT `solicitudllave_ibfk_3` FOREIGN KEY (`cedulaUsuario`) REFERENCES `usuario` (`cedulaUsuario`);

--
-- Constraints for table `subarea`
--
ALTER TABLE `subarea`
  ADD CONSTRAINT `subarea_ibfk_1` FOREIGN KEY (`idEspecialidad`) REFERENCES `especialidad` (`idEspecialidad`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idEstadoAdmision`) REFERENCES `estadoadmision` (`idEstadoAdmision`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
