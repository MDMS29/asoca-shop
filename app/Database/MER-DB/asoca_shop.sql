-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2023 a las 07:24:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asoca_shop`
--
CREATE DATABASE IF NOT EXISTS `asoca_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `asoca_shop`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_acciones`
--

CREATE TABLE `tbl_acciones` (
  `id_accion` smallint(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_acciones`
--

INSERT INTO `tbl_acciones` (`id_accion`, `nombre`, `descripcion`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 'Ver Base de Datos', 'Esta accion permite la previsualizacion de la informacion de la base de datos en el sistema.', 'A', '2023-06-30 00:48:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compra_det`
--

CREATE TABLE `tbl_compra_det` (
  `id_compra_det` smallint(2) NOT NULL,
  `id_compra_enc` smallint(2) NOT NULL,
  `id_producto` smallint(2) NOT NULL,
  `cantidad` tinyint(4) NOT NULL,
  `precio` tinyint(4) NOT NULL,
  `subtotal` tinyint(4) NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_correos`
--

CREATE TABLE `tbl_correos` (
  `id_correo` smallint(2) NOT NULL,
  `id_usuario` smallint(2) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `prioridad_crr` smallint(2) NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_img_producto`
--

CREATE TABLE `tbl_img_producto` (
  `id_img` smallint(2) NOT NULL,
  `item` char(1) NOT NULL,
  `nombre_img` varchar(100) NOT NULL,
  `id_producto` smallint(2) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_img_producto`
--

INSERT INTO `tbl_img_producto` (`id_img`, `item`, `nombre_img`, `id_producto`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, '1', '0icon.ico', 1, 'A', '2023-07-17 10:12:40', 3),
(2, '2', '0icon_1.ico', 1, 'A', '2023-07-17 10:12:40', 3),
(3, '3', '0icon_2.ico', 1, 'A', '2023-07-17 10:12:40', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_modulos`
--

CREATE TABLE `tbl_modulos` (
  `id_modulo` smallint(2) NOT NULL,
  `modulo` varchar(30) NOT NULL,
  `url` varchar(15) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `id_rol` smallint(2) NOT NULL,
  `id_accion` smallint(2) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_modulos`
--

INSERT INTO `tbl_modulos` (`id_modulo`, `modulo`, `url`, `icon`, `id_rol`, `id_accion`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 'Usuarios', 'usuarios', 'bi bi-people-fill', 1, 1, 'A', '2023-07-15 03:18:01', 3),
(2, 'Clientes', 'clientes', 'bi bi-person-lines-fill', 1, 2, 'A', '2023-07-15 03:18:28', 3),
(3, 'Administrar Productos', 'adminProduc', 'bi bi-box-seam-fill', 1, 3, 'A', '2023-07-15 03:19:12', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_param_det`
--

CREATE TABLE `tbl_param_det` (
  `id_param_det` smallint(2) NOT NULL,
  `id_param_enc` smallint(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `resumen` varchar(5) NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_param_det`
--

INSERT INTO `tbl_param_det` (`id_param_det`, `id_param_enc`, `nombre`, `resumen`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 1, 'Cédula de Ciudadanía', 'CC', 'A', '2023-06-30 00:01:47', 1),
(2, 1, 'Cedula Extranjera', 'CE', 'A', '2023-07-15 03:11:51', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_param_enc`
--

CREATE TABLE `tbl_param_enc` (
  `id_param_enc` smallint(2) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_param_enc`
--

INSERT INTO `tbl_param_enc` (`id_param_enc`, `nombre`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 'Tipo Documento', 'A', '2023-06-30 00:01:00', 1),
(2, 'Tipo Usuario', 'A', '2023-07-15 03:10:54', 3),
(3, 'Tipo Telefono', 'A', '2023-07-15 03:10:54', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id_producto` smallint(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad_actual` smallint(4) NOT NULL,
  `cantidad_vendida` smallint(4) NOT NULL,
  `precio` tinyint(4) NOT NULL,
  `fecha_public` date NOT NULL,
  `valoracion` tinyint(4) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`id_producto`, `nombre`, `descripcion`, `cantidad_actual`, `cantidad_vendida`, `precio`, `fecha_public`, `valoracion`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 'Prueba de js', 'sjsjsjsjjs', 3, 0, 33, '2023-07-17', 0, 'A', '2023-07-17 10:12:40', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id_rol` smallint(2) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`id_rol`, `nombre`, `descripcion`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 'Super Administrador', 'Este rol permitirá hacer cambios en la base de datos desde el sistema', 'A', '2023-06-29 23:59:16', 1),
(2, 'Cliente', 'Este rol permitira realizar las acciones de los clientes', 'A', '2023-07-15 03:13:20', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_telefonos`
--

CREATE TABLE `tbl_telefonos` (
  `id_telefono` smallint(2) NOT NULL,
  `id_usuario` smallint(2) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `tipo_tel` smallint(2) NOT NULL,
  `prioridad_tel` smallint(2) NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuario` smallint(2) NOT NULL,
  `id_rol` smallint(2) NOT NULL,
  `tipo_user` smallint(2) NOT NULL,
  `nombre_p` varchar(45) NOT NULL,
  `nombre_s` varchar(45) DEFAULT NULL,
  `apellido_p` varchar(45) NOT NULL,
  `apellido_s` varchar(45) NOT NULL,
  `n_documento` varchar(10) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `contrasena` varchar(200) NOT NULL,
  `duracion` varchar(15) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL,
  `tipo_documento` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `id_rol`, `tipo_user`, `nombre_p`, `nombre_s`, `apellido_p`, `apellido_s`, `n_documento`, `foto`, `contrasena`, `duracion`, `estado`, `fecha_crea`, `usuario_crea`, `tipo_documento`) VALUES
(3, 1, 2, 'Root', NULL, 'Asoca', 'Shop', '123123', NULL, '$2y$10$XgmUvwdPcAvmjGrswIGvnuZ8r7guFRBiV.IRJqn16VfsPvySNHuMy', '0', 'A', '2023-07-15 17:55:10', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tlb_compras_enc`
--

CREATE TABLE `tlb_compras_enc` (
  `id_compra_enc` smallint(2) NOT NULL,
  `usuario_comprador` smallint(2) NOT NULL,
  `metodo_pago` smallint(2) NOT NULL,
  `subtotal` tinyint(4) NOT NULL,
  `fecha_compra` date NOT NULL,
  `hora_compa` time NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_param_det`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_param_det` (
`id_param_det` smallint(2)
,`id_param_enc` smallint(2)
,`nombre` varchar(50)
,`resumen` varchar(5)
,`estado` char(1)
,`fecha_crea` timestamp
,`usuario_crea` smallint(2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_param_det`
--
DROP TABLE IF EXISTS `vw_param_det`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_param_det`  AS SELECT `tbl_param_det`.`id_param_det` AS `id_param_det`, `tbl_param_det`.`id_param_enc` AS `id_param_enc`, `tbl_param_det`.`nombre` AS `nombre`, `tbl_param_det`.`resumen` AS `resumen`, `tbl_param_det`.`estado` AS `estado`, `tbl_param_det`.`fecha_crea` AS `fecha_crea`, `tbl_param_det`.`usuario_crea` AS `usuario_crea` FROM `tbl_param_det` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_acciones`
--
ALTER TABLE `tbl_acciones`
  ADD PRIMARY KEY (`id_accion`);

--
-- Indices de la tabla `tbl_compra_det`
--
ALTER TABLE `tbl_compra_det`
  ADD PRIMARY KEY (`id_compra_det`),
  ADD KEY `fk_tbl_compra_det_tbl_productos1_idx` (`id_producto`),
  ADD KEY `fk_tbl_compra_det_tlb_compras_enc1_idx` (`id_compra_enc`);

--
-- Indices de la tabla `tbl_correos`
--
ALTER TABLE `tbl_correos`
  ADD PRIMARY KEY (`id_correo`,`id_usuario`,`prioridad_crr`),
  ADD KEY `fk_tbl_telefonos_tbl_param_det2_idx` (`prioridad_crr`),
  ADD KEY `fk_tbl_telefonos_tbl_usuarios1_idx` (`id_usuario`);

--
-- Indices de la tabla `tbl_img_producto`
--
ALTER TABLE `tbl_img_producto`
  ADD PRIMARY KEY (`id_img`);

--
-- Indices de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `tbl_param_det`
--
ALTER TABLE `tbl_param_det`
  ADD PRIMARY KEY (`id_param_det`),
  ADD KEY `id_param_enc` (`id_param_enc`);

--
-- Indices de la tabla `tbl_param_enc`
--
ALTER TABLE `tbl_param_enc`
  ADD PRIMARY KEY (`id_param_enc`);

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tbl_telefonos`
--
ALTER TABLE `tbl_telefonos`
  ADD PRIMARY KEY (`id_telefono`,`id_usuario`,`tipo_tel`,`prioridad_tel`),
  ADD KEY `fk_tbl_telefonos_tbl_param_det1_idx` (`tipo_tel`),
  ADD KEY `fk_tbl_telefonos_tbl_param_det2_idx` (`prioridad_tel`),
  ADD KEY `fk_tbl_telefonos_tbl_usuarios1_idx` (`id_usuario`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tlb_compras_enc`
--
ALTER TABLE `tlb_compras_enc`
  ADD PRIMARY KEY (`id_compra_enc`,`usuario_comprador`,`metodo_pago`),
  ADD KEY `fk_tlb_compras_enc_tbl_usuarios1_idx` (`usuario_comprador`),
  ADD KEY `fk_tlb_compras_enc_tbl_param_det1_idx` (`metodo_pago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_acciones`
--
ALTER TABLE `tbl_acciones`
  MODIFY `id_accion` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_compra_det`
--
ALTER TABLE `tbl_compra_det`
  MODIFY `id_compra_det` smallint(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_correos`
--
ALTER TABLE `tbl_correos`
  MODIFY `id_correo` smallint(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_img_producto`
--
ALTER TABLE `tbl_img_producto`
  MODIFY `id_img` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  MODIFY `id_modulo` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_param_det`
--
ALTER TABLE `tbl_param_det`
  MODIFY `id_param_det` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_param_enc`
--
ALTER TABLE `tbl_param_enc`
  MODIFY `id_param_enc` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id_producto` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id_rol` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_telefonos`
--
ALTER TABLE `tbl_telefonos`
  MODIFY `id_telefono` smallint(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_compra_det`
--
ALTER TABLE `tbl_compra_det`
  ADD CONSTRAINT `fk_tbl_compra_det_tbl_productos1` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_compra_det_tlb_compras_enc1` FOREIGN KEY (`id_compra_enc`) REFERENCES `tlb_compras_enc` (`id_compra_enc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_correos`
--
ALTER TABLE `tbl_correos`
  ADD CONSTRAINT `fk_tbl_telefonos_tbl_param_det20` FOREIGN KEY (`prioridad_crr`) REFERENCES `tbl_param_det` (`id_param_det`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_telefonos_tbl_usuarios10` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_param_det`
--
ALTER TABLE `tbl_param_det`
  ADD CONSTRAINT `id_enc` FOREIGN KEY (`id_param_enc`) REFERENCES `tbl_param_enc` (`id_param_enc`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_telefonos`
--
ALTER TABLE `tbl_telefonos`
  ADD CONSTRAINT `fk_tbl_telefonos_tbl_param_det1` FOREIGN KEY (`tipo_tel`) REFERENCES `tbl_param_det` (`id_param_det`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_telefonos_tbl_param_det2` FOREIGN KEY (`prioridad_tel`) REFERENCES `tbl_param_det` (`id_param_det`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_telefonos_tbl_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tlb_compras_enc`
--
ALTER TABLE `tlb_compras_enc`
  ADD CONSTRAINT `fk_tlb_compras_enc_tbl_param_det1` FOREIGN KEY (`metodo_pago`) REFERENCES `tbl_param_det` (`id_param_det`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tlb_compras_enc_tbl_usuarios1` FOREIGN KEY (`usuario_comprador`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
