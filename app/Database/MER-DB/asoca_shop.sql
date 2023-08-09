-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2023 a las 06:15:56
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
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_acciones`
--

INSERT INTO `tbl_acciones` (`id_accion`, `nombre`, `descripcion`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 'Ver Base de Datos', 'Esta accion permite la previsualizacion de la informacion de la base de datos en el sistema.', 'A', '2023-06-30 00:48:51', 1),
(2, 'Ver Clientes', 'Esta accion permitira que el administrador pueda visualizar toda la informacion de los clientes registrados', 'A', '2023-07-28 03:36:48', 1),
(3, 'Administrar Productos', 'Esta accion permite ver la informacion completa del producto para ser editado, creado o eliminado', 'A', '2023-07-28 03:38:15', 3),
(4, 'Compras', 'Esta accion permite realizar la consulta de cada una de las compras que el usuario ha realizado en el sistema', 'A', '2023-07-28 03:38:15', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras_det`
--

CREATE TABLE `tbl_compras_det` (
  `id_compra_det` smallint(2) NOT NULL,
  `id_compra_enc` smallint(2) NOT NULL,
  `id_producto` smallint(2) NOT NULL,
  `cantidad` smallint(4) NOT NULL,
  `precio` int(8) NOT NULL,
  `subtotal` int(8) NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_compras_det`
--

INSERT INTO `tbl_compras_det` (`id_compra_det`, `id_compra_enc`, `id_producto`, `cantidad`, `precio`, `subtotal`, `observacion`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 1, 1, 6, 4567, 27402, NULL, '8', '2023-08-07 23:34:34', 4),
(2, 1, 3, 3, 123333, 369999, NULL, '5', '2023-08-07 23:22:39', 4),
(3, 2, 2, 3, 127, 381, NULL, '5', '2023-08-07 23:42:02', 4),
(4, 3, 4, 3, 78945, 236835, NULL, 'A', '2023-08-08 01:14:24', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_compras_enc`
--

CREATE TABLE `tbl_compras_enc` (
  `id_compra_enc` smallint(2) NOT NULL,
  `usuario_comprador` smallint(2) NOT NULL,
  `metodo_pago` smallint(2) DEFAULT NULL,
  `subtotal` int(8) NOT NULL,
  `fecha_compra` date NOT NULL,
  `hora_compra` time NOT NULL,
  `fecha_confir` date DEFAULT NULL,
  `hora_confir` time DEFAULT NULL,
  `estado` smallint(2) NOT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_compras_enc`
--

INSERT INTO `tbl_compras_enc` (`id_compra_enc`, `usuario_comprador`, `metodo_pago`, `subtotal`, `fecha_compra`, `hora_compra`, `fecha_confir`, `hora_confir`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 4, NULL, 397401, '2023-08-07', '06:15:52', '2023-08-07', '06:37:51', 8, '2023-08-07 23:37:51', 4),
(2, 4, NULL, 381, '2023-08-07', '06:39:49', '2023-08-07', '06:42:37', 8, '2023-08-07 23:42:37', 4),
(3, 4, NULL, 78945, '2023-08-07', '08:07:02', NULL, NULL, 7, '2023-08-08 01:07:02', 4);

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
(3, '3', '0icon_2.ico', 1, 'A', '2023-07-17 10:12:40', 3),
(4, '1', '0descarga.jfif', 2, 'A', '2023-07-17 16:45:19', 3),
(5, '2', '0desktop-wallpaper-gang-cats-silly-cats.jpg', 2, 'A', '2023-07-17 16:45:19', 3),
(6, '3', '097018554-gato-penal-en-la-estación-de-policía-foto-sobre-fondo-blanco.png', 2, 'A', '2023-07-17 11:51:34', 3),
(7, '1', '0fb367e901c065debee4f0e5ed711cf0d.jpg', 3, 'A', '2023-07-21 01:44:50', 3),
(8, '2', '0OIP.jfif', 3, 'A', '2023-07-21 01:44:50', 3),
(9, '3', '0img.jfif', 3, 'A', '2023-07-21 01:44:50', 3),
(10, '1', '0OIP_1.jfif', 4, 'A', '2023-07-21 02:35:28', 3),
(11, '2', '0fb367e901c065debee4f0e5ed711cf0d_1.jpg', 4, 'A', '2023-07-21 02:35:28', 3),
(12, '3', '0img_1.jfif', 4, 'A', '2023-07-21 02:35:28', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_modulos`
--

CREATE TABLE `tbl_modulos` (
  `id_modulo` smallint(2) NOT NULL,
  `modulo` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
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
(3, 'Administrar Productos', 'adminProduc', 'bi bi-box-seam-fill', 1, 3, 'A', '2023-07-15 03:19:12', 3),
(4, 'Mis Compras', 'comprasRealizadas', 'bi bi-bag-check-fill', 2, 4, 'A', '2023-07-22 04:54:30', 3),
(5, 'Administrar Compras', 'adminCompras', 'bi bi-bag-check-fill', 1, 4, 'A', '2023-07-30 18:38:57', 3);

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
(2, 1, 'Cedula Extranjera', 'CE', 'A', '2023-07-15 03:11:51', 3),
(3, 2, 'Administrador', 'Admin', 'A', '2023-07-22 04:12:52', 3),
(4, 2, 'Cliente', 'Cli', 'A', '2023-07-22 04:13:11', 3),
(5, 4, 'Confirmado', 'Acep', 'A', '2023-07-30 16:49:00', 3),
(6, 4, 'Cancelado', 'Cance', 'A', '2023-07-30 16:49:00', 3),
(7, 4, 'Pendiente', 'Pen', 'A', '2023-07-30 16:49:51', 3),
(8, 4, 'Entregado', 'Entre', 'A', '2023-07-30 16:49:51', 3),
(9, 5, 'Moda', 'Moda', 'A', '2023-07-30 20:08:06', 3),
(10, 5, 'Belleza', 'Belle', 'A', '2023-07-30 20:08:06', 3),
(11, 5, 'Hogar', 'Hogar', 'A', '2023-07-30 20:08:06', 3),
(12, 5, 'Accesorios', 'Acces', 'A', '2023-07-30 20:08:06', 3),
(13, 5, 'Tecnologia', 'Tecno', 'A', '2023-07-30 20:08:06', 3),
(14, 5, 'Gourmet', 'Gourm', 'A', '2023-07-30 20:08:06', 3);

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
(3, 'Tipo Telefono', 'A', '2023-07-15 03:10:54', 3),
(4, 'Estado de Compra', 'A', '2023-07-30 16:48:06', 3),
(5, 'Categoria Productos', 'A', '2023-07-30 20:03:42', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id_producto` smallint(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` smallint(2) NOT NULL,
  `cantidad_actual` smallint(4) NOT NULL,
  `cantidad_vendida` smallint(4) NOT NULL,
  `precio` int(4) NOT NULL,
  `fecha_public` date NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`id_producto`, `nombre`, `descripcion`, `categoria`, `cantidad_actual`, `cantidad_vendida`, `precio`, `fecha_public`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(1, 'Prueba de js', 'sjsjsjsjjs', 9, 8, 0, 4567, '2023-07-20', 'A', '2023-08-09 02:08:09', 3),
(2, 'gato pandillero', 'daña esto daña lo otro el gayo dañadorr con increibles movimientos de karate', 10, 4, 0, 127, '2023-07-20', 'A', '2023-08-09 02:08:14', 3),
(3, 'Otros productos mas', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed efficitur vehicula neque. Curabitur dictum rhoncus ligula non condimentum. Quisque ut mollis odio, quis euismod neque. Nullam pretium ante cursus justo varius sagittis. Proin semper egestas odio ac mollis. Aenean venenatis pretium enim, eu mattis nunc. Vestibulum egestas varius odio eget pretium. Cras in eleifend nunc. Suspendisse sodales, mauris vitae pellentesque euismod, erat orci convallis nisi, in molestie ex quam et urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis ullamcorper ex eu lacus rhoncus congue. Duis ultricies, est non ultricies rutrum, metus justo sodales nibh, ut semper elit mi ullamcorper urna.', 11, 3, 0, 123333, '2023-07-20', 'A', '2023-08-09 02:08:20', 3),
(4, 'Otro mas ', 'loreeeeeeeeem', 12, 10, 0, 78945, '2023-07-20', 'A', '2023-08-09 02:08:24', 3);

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
  `tipo_documento` smallint(2) DEFAULT NULL,
  `n_documento` varchar(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `contrasena` varchar(200) NOT NULL,
  `duracion` varchar(15) NOT NULL,
  `estado` varchar(1) NOT NULL DEFAULT 'A',
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `id_rol`, `tipo_user`, `nombre_p`, `nombre_s`, `apellido_p`, `apellido_s`, `tipo_documento`, `n_documento`, `direccion`, `foto`, `contrasena`, `duracion`, `estado`, `fecha_crea`, `usuario_crea`) VALUES
(3, 1, 3, 'Root', 'Jose', 'Asoca', 'Shop', 1, '123123', '\'', NULL, '$2y$10$XgmUvwdPcAvmjGrswIGvnuZ8r7guFRBiV.IRJqn16VfsPvySNHuMy', '0', 'A', '2023-07-30 18:03:20', 1),
(4, 2, 4, 'Nuevo', '...', 'Cliente', 'Prueba', 1, '147852', 'kra 8', 'fotoUser/default.png', '$2y$10$hyCb7Ka02l4E4H0oc.MaH.aqL61n4pSmEfd4TdYuX300YFz/UvLa2', '', 'A', '2023-07-30 21:28:29', 0),
(5, 2, 4, 'Moises', 'David', 'Mazo', 'Solano', 1, '1130266003', 'Calle 68 #16B-14', 'fotoUser/default.png', '$2y$10$EYGYMsV1a13CZ6LxMGZ/6u0b1/zB65hRGpphHBcqmHk1SiNscKIXW', '', 'A', '2023-07-30 17:54:07', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_valoracion_producto`
--

CREATE TABLE `tbl_valoracion_producto` (
  `id_valoracion` smallint(4) NOT NULL,
  `id_producto` smallint(2) NOT NULL,
  `id_usuario` smallint(2) NOT NULL,
  `valoracion` tinyint(3) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha_crea` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) NOT NULL DEFAULT 'A',
  `usuario_crea` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_valoracion_producto`
--

INSERT INTO `tbl_valoracion_producto` (`id_valoracion`, `id_producto`, `id_usuario`, `valoracion`, `comentario`, `fecha_crea`, `estado`, `usuario_crea`) VALUES
(1, 2, 5, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam quis ligula nec est eleifend pulvinar sit amet in nunc. Nam in metus quis magna luctus hendrerit. Quisque mi massa, mollis et enim vel, mattis bibendum nisl. Praesent ut bibendum purus. Fusce sollicitudin feugiat dolor. Nam quis est ut justo ultrices gravida.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam quis ligula nec est eleifend pulvinar sit amet in nunc. Nam in metus quis magna luctus hendrerit. Quisque mi massa, mollis et enim vel, mattis bibendum nisl. Praesent ut bibendum purus. Fusce sollicitudin feugiat dolor. Nam quis est ut justo ultrices gravida.', '2023-08-09 02:24:50', 'A', 5),
(2, 2, 3, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consectetur ante sed mattis facilisis. Etiam sit amet urna facilisis, sodales dolor eget, eleifend urna. Donec quis massa sed lectus bibendum semper eget in ante. Sed facilisis nibh in felis venenatis, nec pulvinar velit tincidunt. Fusce hendrerit semper metus in mattis. Aenean accumsan libero et tincidunt tempor. Quisque sollicitudin tellus dolor, eu pretium risus blandit quis. Aliquam rhoncus odio orci, non pulvinar nisl rutrum quis. Maecenas congue nibh sit amet ante semper eleifend. Sed placerat nunc enim, ut dictum neque vestibulum quis.', '2023-08-09 04:12:11', 'A', 3);

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

CREATE VIEW `vw_param_det`  AS SELECT `tbl_param_det`.`id_param_det` AS `id_param_det`, `tbl_param_det`.`id_param_enc` AS `id_param_enc`, `tbl_param_det`.`nombre` AS `nombre`, `tbl_param_det`.`resumen` AS `resumen`, `tbl_param_det`.`estado` AS `estado`, `tbl_param_det`.`fecha_crea` AS `fecha_crea`, `tbl_param_det`.`usuario_crea` AS `usuario_crea` FROM `tbl_param_det` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_acciones`
--
ALTER TABLE `tbl_acciones`
  ADD PRIMARY KEY (`id_accion`);

--
-- Indices de la tabla `tbl_compras_det`
--
ALTER TABLE `tbl_compras_det`
  ADD PRIMARY KEY (`id_compra_det`);

--
-- Indices de la tabla `tbl_compras_enc`
--
ALTER TABLE `tbl_compras_enc`
  ADD PRIMARY KEY (`id_compra_enc`),
  ADD KEY `estado` (`estado`);

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
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria` (`categoria`);

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
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `tipo_user` (`tipo_user`),
  ADD KEY `rol` (`id_rol`);

--
-- Indices de la tabla `tbl_valoracion_producto`
--
ALTER TABLE `tbl_valoracion_producto`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_acciones`
--
ALTER TABLE `tbl_acciones`
  MODIFY `id_accion` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_compras_det`
--
ALTER TABLE `tbl_compras_det`
  MODIFY `id_compra_det` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_compras_enc`
--
ALTER TABLE `tbl_compras_enc`
  MODIFY `id_compra_enc` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_correos`
--
ALTER TABLE `tbl_correos`
  MODIFY `id_correo` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_img_producto`
--
ALTER TABLE `tbl_img_producto`
  MODIFY `id_img` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  MODIFY `id_modulo` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_param_det`
--
ALTER TABLE `tbl_param_det`
  MODIFY `id_param_det` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbl_param_enc`
--
ALTER TABLE `tbl_param_enc`
  MODIFY `id_param_enc` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id_producto` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id_rol` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_telefonos`
--
ALTER TABLE `tbl_telefonos`
  MODIFY `id_telefono` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_valoracion_producto`
--
ALTER TABLE `tbl_valoracion_producto`
  MODIFY `id_valoracion` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_compras_enc`
--
ALTER TABLE `tbl_compras_enc`
  ADD CONSTRAINT `estado` FOREIGN KEY (`estado`) REFERENCES `tbl_param_det` (`id_param_det`) ON UPDATE CASCADE;

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
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `categoria` FOREIGN KEY (`categoria`) REFERENCES `tbl_param_det` (`id_param_det`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_telefonos`
--
ALTER TABLE `tbl_telefonos`
  ADD CONSTRAINT `fk_tbl_telefonos_tbl_param_det1` FOREIGN KEY (`tipo_tel`) REFERENCES `tbl_param_det` (`id_param_det`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_telefonos_tbl_param_det2` FOREIGN KEY (`prioridad_tel`) REFERENCES `tbl_param_det` (`id_param_det`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_telefonos_tbl_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD CONSTRAINT `rol` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_user` FOREIGN KEY (`tipo_user`) REFERENCES `tbl_param_det` (`id_param_det`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_valoracion_producto`
--
ALTER TABLE `tbl_valoracion_producto`
  ADD CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
