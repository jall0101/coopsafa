-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2024 a las 05:44:37
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cooperativa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignados`
--

CREATE TABLE `asignados` (
  `asignadocod` bigint(20) NOT NULL,
  `nombreDepartamento` varchar(255) DEFAULT NULL,
  `nombreAsignado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignados`
--

INSERT INTO `asignados` (`asignadocod`, `nombreDepartamento`, `nombreAsignado`) VALUES
(1, 'Recuperaciones', 'Marvin Sarmiento'),
(2, 'Recuperaciones', 'Manuel Caballero'),
(3, 'Recuperaciones', 'Ana García'),
(4, 'Gestión Social', 'Bertha Rodríguez'),
(5, 'Soporte Técnico', 'Juan Carlos López');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `departamentocod` bigint(20) NOT NULL,
  `nombredepartamento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`departamentocod`, `nombredepartamento`) VALUES
(1, 'Soporte'),
(5, 'Gerencia'),
(6, 'Afiliación'),
(7, 'Gestión Social'),
(8, 'Caja'),
(9, 'Analista de Crédito'),
(10, 'Supervisor de caja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_salidas`
--

CREATE TABLE `entradas_salidas` (
  `idEntradas_salidas` bigint(20) NOT NULL,
  `gestionEoS` varchar(255) DEFAULT NULL,
  `inventarioEquipoES` varchar(255) DEFAULT NULL,
  `nomEquipo` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `filial` varchar(255) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `asignado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filiales`
--

CREATE TABLE `filiales` (
  `filialcod` bigint(20) NOT NULL,
  `nombreFilial` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `filiales`
--

INSERT INTO `filiales` (`filialcod`, `nombreFilial`) VALUES
(1, 'Regional La Ceiba'),
(2, 'Tela'),
(3, 'Roatán'),
(4, 'San Isidro'),
(5, 'Mall Megaplaza'),
(6, 'La Masica'),
(7, 'Tocoa'),
(8, 'Puerto Lempira');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `fncod` varchar(255) NOT NULL,
  `fndsc` varchar(45) DEFAULT NULL,
  `fnest` char(3) DEFAULT NULL,
  `fntyp` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`fncod`, `fndsc`, `fnest`, `fntyp`) VALUES
('Controllers\\Admin\\Admin', 'Controllers\\Admin\\Admin', 'ACT', 'CTR'),
('Controllers\\Mnt\\Asignado', 'Controllers\\Mnt\\Asignado', 'ACT', 'CTR'),
('Controllers\\Mnt\\Asignados', 'Controllers\\Mnt\\Asignados', 'ACT', 'CTR'),
('Controllers\\Mnt\\Departamento', 'Controllers\\Mnt\\Departamento', 'ACT', 'CTR'),
('Controllers\\Mnt\\Departamentos', 'Controllers\\Mnt\\Departamentos', 'ACT', 'CTR'),
('Controllers\\Mnt\\DetallesVentas', 'Controllers\\Mnt\\DetallesVentas', 'ACT', 'CTR'),
('Controllers\\Mnt\\EntradasSalida', 'Controllers\\Mnt\\EntradasSalida', 'ACT', 'CTR'),
('Controllers\\Mnt\\EntradasSalidas', 'Controllers\\Mnt\\EntradasSalidas', 'ACT', 'CTR'),
('Controllers\\Mnt\\Filial', 'Controllers\\Mnt\\Filial', 'ACT', 'CTR'),
('Controllers\\Mnt\\Filiales', 'Controllers\\Mnt\\Filiales', 'ACT', 'CTR'),
('Controllers\\Mnt\\Funcion', 'Controllers\\Mnt\\Funcion', 'ACT', 'CTR'),
('Controllers\\Mnt\\Funciones', 'Controllers\\Mnt\\Funciones', 'ACT', 'CTR'),
('Controllers\\Mnt\\FuncionesRoles', 'Controllers\\Mnt\\FuncionesRoles', 'ACT', 'CTR'),
('Controllers\\Mnt\\FuncionRol', 'Controllers\\Mnt\\FuncionRol', 'ACT', 'CTR'),
('Controllers\\Mnt\\Inventario', 'Controllers\\Mnt\\Inventario', 'ACT', 'CTR'),
('Controllers\\Mnt\\Inventarios', 'Controllers\\Mnt\\Inventarios', 'ACT', 'CTR'),
('Controllers\\Mnt\\Marca', 'Controllers\\Mnt\\Marca', 'ACT', 'CTR'),
('Controllers\\Mnt\\Marcas', 'Controllers\\Mnt\\Marcas', 'ACT', 'CTR'),
('Controllers\\Mnt\\Rol', 'Controllers\\Mnt\\Rol', 'ACT', 'CTR'),
('Controllers\\Mnt\\Roles', 'Controllers\\Mnt\\Roles', 'ACT', 'CTR'),
('Controllers\\Mnt\\RolesUsuario', 'Controllers\\Mnt\\RolesUsuario', 'ACT', 'CTR'),
('Controllers\\Mnt\\RolesUsuarios', 'Controllers\\Mnt\\RolesUsuarios', 'ACT', 'CTR'),
('Controllers\\Mnt\\Usuario', 'Controllers\\Mnt\\Usuario', 'ACT', 'CTR'),
('Controllers\\Mnt\\Usuarios', 'Controllers\\Mnt\\Usuarios', 'ACT', 'CTR'),
('Controllers\\Mnt\\Ventas', 'Controllers\\Mnt\\Ventas', 'ACT', 'CTR'),
('Menu_MntAsignados', 'Menu_MntAsignados', 'ACT', 'CTR'),
('Menu_MntDepartamentos', 'Menu_MntDepartamentos', 'ACT', 'CTR'),
('Menu_MntEntradasSalidas', 'Menu_MntEntradasSalidas', 'ACT', 'CTR'),
('Menu_MntFiliales', 'Menu_MntFiliales', 'ACT', 'CTR'),
('Menu_MntFunciones', 'Menu_MntFunciones', 'ACT', 'CTR'),
('Menu_MntFuncionesRoles', 'Menu_MntFuncionesRoles', 'ACT', 'CTR'),
('Menu_MntHistorialTransacciones', 'Menu_MntHistorialTransacciones', 'ACT', 'CTR'),
('Menu_MntInventarios', 'Menu_MntInventarios', 'ACT', 'CTR'),
('Menu_MntMarcas', 'Menu_MntMarcas', 'ACT', 'CTR'),
('Menu_MntPedidos', 'Menu_MntPedidos', 'ACT', 'CTR'),
('Menu_MntRoles', 'Menu_MntRoles', 'ACT', 'CTR'),
('Menu_MntRolesUsuarios', 'Menu_MntRolesUsuarios', 'ACT', 'CTR'),
('Menu_MntUsuarios', 'Menu_MntUsuarios', 'ACT', 'CTR'),
('Menu_MntZapatos', 'Menu_MntZapatos', 'ACT', 'CTR'),
('Menu_PaymentCheckout', 'Menu_PaymentCheckout', 'ACT', 'CTR'),
('Menu_Perfil', 'Menu_Perfil', 'ACT', 'CTR'),
('mnt_asignados_delete', 'mnt_asignados_delete', 'ACT', 'CTR'),
('mnt_asignados_edit', 'mnt_asignados_edit', 'ACT', 'CTR'),
('mnt_asignados_new', 'mnt_asignados_new', 'ACT', 'CTR'),
('mnt_asignados_view', 'mnt_asignados_view', 'ACT', 'CTR'),
('mnt_departamentos_delete', 'mnt_departamentos_delete', 'ACT', 'CTR'),
('mnt_departamentos_edit', 'mnt_departamentos_edit', 'ACT', 'CTR'),
('mnt_departamentos_new', 'mnt_departamentos_new', 'ACT', 'CTR'),
('mnt_departamentos_view', 'mnt_departamentos_view', 'ACT', 'CTR'),
('mnt_entradassalidas_delete', 'mnt_entradassalidas_delete', 'ACT', 'CTR'),
('mnt_entradassalidas_edit', 'mnt_entradassalidas_edit', 'ACT', 'CTR'),
('mnt_entradassalidas_new', 'mnt_entradassalidas_new', 'ACT', 'CTR'),
('mnt_entradassalidas_view', 'mnt_entradassalidas_view', 'ACT', 'CTR'),
('mnt_filiales_delete', 'mnt_filiales_delete', 'ACT', 'CTR'),
('mnt_filiales_edit', 'mnt_filiales_edit', 'ACT', 'CTR'),
('mnt_filiales_new', 'mnt_filiales_new', 'ACT', 'CTR'),
('mnt_filiales_view', 'mnt_filiales_view', 'ACT', 'CTR'),
('mnt_funcionesroles_delete', 'mnt_funcionesroles_delete', 'ACT', 'CTR'),
('mnt_funcionesroles_edit', 'mnt_funcionesroles_edit', 'ACT', 'CTR'),
('mnt_funcionesroles_new', 'mnt_funcionesroles_new', 'ACT', 'CTR'),
('mnt_funcionesroles_view', 'mnt_funcionesroles_view', 'ACT', 'CTR'),
('mnt_funciones_delete', 'mnt_funciones_delete', 'ACT', 'CTR'),
('mnt_funciones_edit', 'mnt_funciones_edit', 'ACT', 'CTR'),
('mnt_funciones_new', 'mnt_funciones_new', 'ACT', 'CTR'),
('mnt_funciones_view', 'mnt_funciones_view', 'ACT', 'CTR'),
('mnt_inventarios_delete', 'mnt_inventarios_delete', 'ACT', 'CTR'),
('mnt_inventarios_edit', 'mnt_inventarios_edit', 'ACT', 'CTR'),
('mnt_inventarios_new', 'mnt_inventarios_new', 'ACT', 'CTR'),
('mnt_inventarios_view', 'mnt_inventarios_view', 'ACT', 'CTR'),
('mnt_marcas_delete', 'mnt_marcas_delete', 'ACT', 'CTR'),
('mnt_marcas_edit', 'mnt_marcas_edit', 'ACT', 'CTR'),
('mnt_marcas_new', 'mnt_marcas_new', 'ACT', 'CTR'),
('mnt_marcas_view', 'mnt_marcas_view', 'ACT', 'CTR'),
('mnt_pedidos_view', 'mnt_pedidos_view', 'ACT', 'CTR'),
('mnt_pedido_change', 'mnt_pedido_change', 'ACT', 'CTR'),
('mnt_rolesUsuarios_delete', 'mnt_rolesUsuarios_delete', 'ACT', 'CTR'),
('mnt_rolesUsuarios_edit', 'mnt_rolesUsuarios_edit', 'ACT', 'CTR'),
('mnt_rolesUsuarios_new', 'mnt_rolesUsuarios_new', 'ACT', 'CTR'),
('mnt_rolesUsuarios_view', 'mnt_rolesUsuarios_view', 'ACT', 'CTR'),
('mnt_roles_delete', 'mnt_roles_delete', 'ACT', 'CTR'),
('mnt_roles_edit', 'mnt_roles_edit', 'ACT', 'CTR'),
('mnt_roles_new', 'mnt_roles_new', 'ACT', 'CTR'),
('mnt_roles_view', 'mnt_roles_view', 'ACT', 'CTR'),
('mnt_usuarios_delete', 'mnt_usuarios_delete', 'ACT', 'CTR'),
('mnt_usuarios_edit', 'mnt_usuarios_edit', 'ACT', 'CTR'),
('mnt_usuarios_new', 'mnt_usuarios_new', 'ACT', 'CTR'),
('mnt_usuarios_view', 'mnt_usuarios_view', 'ACT', 'CTR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones_roles`
--

CREATE TABLE `funciones_roles` (
  `rolescod` varchar(15) NOT NULL,
  `fncod` varchar(255) NOT NULL,
  `fnrolest` char(3) DEFAULT NULL,
  `fnexp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `funciones_roles`
--

INSERT INTO `funciones_roles` (`rolescod`, `fncod`, `fnrolest`, `fnexp`) VALUES
('ADMIN', 'Controllers\\Admin\\Admin', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Asignado', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Asignados', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Departamento', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Departamentos', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\EntradasSalida', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\EntradasSalidas', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Filial', 'ACT', '2024-01-07 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Filiales', 'ACT', '2024-01-07 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Funcion', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Funciones', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\FuncionesRoles', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\FuncionRol', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Inventario', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Inventarios', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Marca', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Marcas', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Rol', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Roles', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\RolesUsuario', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\RolesUsuarios', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Usuario', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Controllers\\Mnt\\Usuarios', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntAsignados', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntDepartamentos', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntEntradasSalidas', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntFiliales', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntFunciones', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntFuncionesRoles', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntInventarios', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntMarcas', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntRoles', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntRolesUsuarios', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'Menu_MntUsuarios', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_asignados_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_asignados_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_asignados_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_asignados_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_departamentos_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_departamentos_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_departamentos_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_departamentos_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_entradassalidas_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_entradassalidas_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_entradassalidas_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_entradassalidas_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_filiales_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_filiales_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_filiales_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_filiales_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_funcionesroles_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_funcionesroles_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_funcionesroles_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_funcionesroles_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_funciones_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_funciones_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_funciones_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_funciones_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_inventarios_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_inventarios_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_inventarios_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_inventarios_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_marcas_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_marcas_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_marcas_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_marcas_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_rolesUsuarios_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_rolesUsuarios_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_rolesUsuarios_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_rolesUsuarios_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_roles_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_roles_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_roles_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_roles_view', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_usuarios_delete', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_usuarios_edit', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_usuarios_new', 'ACT', '2024-01-10 00:00:00'),
('ADMIN', 'mnt_usuarios_view', 'ACT', '2024-01-10 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` bigint(20) NOT NULL,
  `inventarioest` char(3) DEFAULT 'ACT',
  `numInventario` varchar(255) DEFAULT NULL,
  `nomEquipo` varchar(255) DEFAULT NULL,
  `categoriaEquipo` varchar(255) DEFAULT NULL,
  `descripcionEquipo` varchar(255) DEFAULT NULL,
  `filialEquipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventarios`
--

INSERT INTO `inventarios` (`id`, `inventarioest`, `numInventario`, `nomEquipo`, `categoriaEquipo`, `descripcionEquipo`, `filialEquipo`) VALUES
(9, 'ACT', '23314', 'POINTMAN', 'Impresora', 'Impresora para tarjetas de crédito marca POINTMAN, modelo Nuvia N20', 'Regional La Ceiba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `marcacod` bigint(20) NOT NULL,
  `nombremarca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`marcacod`, `nombremarca`) VALUES
(4, 'DELL'),
(5, 'HP'),
(6, 'Lenovo'),
(7, 'Asus'),
(8, 'Razer'),
(9, 'Huawei');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rolescod` varchar(15) NOT NULL,
  `rolesdsc` varchar(45) DEFAULT NULL,
  `rolesest` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rolescod`, `rolesdsc`, `rolesest`) VALUES
('ADMIN', 'Administrador del sistema', 'ACT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_usuarios`
--

CREATE TABLE `roles_usuarios` (
  `usercod` bigint(20) NOT NULL,
  `rolescod` varchar(15) NOT NULL,
  `roleuserest` char(3) DEFAULT NULL,
  `roleuserfch` datetime DEFAULT NULL,
  `roleuserexp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles_usuarios`
--

INSERT INTO `roles_usuarios` (`usercod`, `rolescod`, `roleuserest`, `roleuserfch`, `roleuserexp`) VALUES
(6, 'ADMIN', 'ACT', '2024-01-10 00:00:00', '2025-01-10 00:00:00'),
(10, 'ADMIN', 'ACT', '2024-01-10 00:00:00', '2025-01-10 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usercod` bigint(20) NOT NULL,
  `useremail` varchar(80) DEFAULT NULL,
  `username` varchar(80) DEFAULT NULL,
  `userpswd` varchar(128) DEFAULT NULL,
  `userfching` datetime DEFAULT NULL,
  `userpswdest` char(3) DEFAULT NULL,
  `userpswdexp` datetime DEFAULT NULL,
  `userest` char(3) DEFAULT NULL,
  `useractcod` varchar(128) DEFAULT NULL,
  `userpswdchg` varchar(128) DEFAULT NULL,
  `usertipo` char(3) DEFAULT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usercod`, `useremail`, `username`, `userpswd`, `userfching`, `userpswdest`, `userpswdexp`, `userest`, `useractcod`, `userpswdchg`, `usertipo`) VALUES
(6, 'kevin@gmail.com', 'John Doe', '$2y$10$9p.XpmnLENFHtztawXgoa.de4.fNtfu6A99qijznIjIkcT1T1D6fy', '2024-01-10 01:11:49', 'ACT', '2024-04-20 00:00:00', 'ACT', 'c09f62aa99988d3bfc4fa381257d3680ca221fa55f3f5c136105273ed6bb2486', '2024-01-10 01:11:49', 'ADM'),
(10, 'juan_lopez@sagradafamilia.hn', 'Juan López', '$2y$10$UZWLcR8oDj5rf1gfwrGWYumifweMx8zbrb7yDX5kEnudgDl9NQe6G', '2024-01-06 21:44:43', 'ACT', '2024-04-05 00:00:00', 'ACT', '22946ca663f3e2729fa93494062b260194af780659e06d112112f22844eb78e7', '2024-01-06 21:44:43', 'ADM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zapatos`
--

CREATE TABLE `zapatos` (
  `zapatocod` bigint(20) NOT NULL,
  `marcacod` bigint(20) NOT NULL,
  `departamentocod` bigint(20) NOT NULL,
  `precio` float NOT NULL,
  `zapatoest` char(3) DEFAULT 'ACT',
  `imagenzapato` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `detalles` varchar(255) DEFAULT NULL,
  `nombrezapato` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zapatos`
--

INSERT INTO `zapatos` (`zapatocod`, `marcacod`, `departamentocod`, `precio`, `zapatoest`, `imagenzapato`, `color`, `descripcion`, `detalles`, `nombrezapato`) VALUES
(1, 1, 1, 50, 'ACT', '1.jpg', 'Blanco-Rojo', 'Stay cool and casual in the Cool Cat Sport slides. Featuring a comfortable textured foot bed andmolded EVA outsole, the Cool Cat Sport combines soft cushioning and classic style for every day.', 'Breathable knit upper, Slip-on sock collar, Extended lacing system for additional support and midsolelockdown, Soft, cushioned midsole, ', 'Tenis Adidas Rosado'),
(2, 1, 1, 60, 'ACT', '2.jpg', 'Gris-Negro', 'Stay cool and casual in the Cool Cat Sport slides. Featuring a comfortable textured foot bed andmolded EVA outsole, the Cool Cat Sport combines soft cushioning and classic style for every day.', 'Breathable knit upper, Slip-on sock collar, Extended lacing system for additional support and midsolelockdown, Soft, cushioned midsole, ', 'Super star'),
(3, 1, 1, 55, 'ACT', '3.jpg', 'Negro-Blanco', 'Stay cool and casual in the Cool Cat Sport slides. Featuring a comfortable textured foot bed andmolded EVA outsole, the Cool Cat Sport combines soft cushioning and classic style for every day.', 'Breathable knit upper, Slip-on sock collar, Extended lacing system for additional support and midsolelockdown, Soft, cushioned midsole, ', 'Fluffly ones'),
(4, 1, 1, 65, 'ACT', '4.jpg', 'Negro-Blanco', 'Stay cool and casual in the Cool Cat Sport slides. Featuring a comfortable textured foot bed andmolded EVA outsole, the Cool Cat Sport combines soft cushioning and classic style for every day.', 'Breathable knit upper, Slip-on sock collar, Extended lacing system for additional support and midsolelockdown, Soft, cushioned midsole, ', 'Tenis Adidas Rosado'),
(5, 2, 1, 40, 'ACT', '5.jpg', 'Negro-Blanco-Rojo', 'Stay cool and casual in the Cool Cat Sport slides. Featuring a comfortable textured foot bed andmolded EVA outsole, the Cool Cat Sport combines soft cushioning and classic style for every day.', 'Breathable knit upper, Slip-on sock collar, Extended lacing system for additional support and midsolelockdown, Soft, cushioned midsole, ', 'Tenis Adidas Rosado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignados`
--
ALTER TABLE `asignados`
  ADD PRIMARY KEY (`asignadocod`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`departamentocod`);

--
-- Indices de la tabla `entradas_salidas`
--
ALTER TABLE `entradas_salidas`
  ADD PRIMARY KEY (`idEntradas_salidas`);

--
-- Indices de la tabla `filiales`
--
ALTER TABLE `filiales`
  ADD PRIMARY KEY (`filialcod`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`fncod`);

--
-- Indices de la tabla `funciones_roles`
--
ALTER TABLE `funciones_roles`
  ADD PRIMARY KEY (`rolescod`,`fncod`),
  ADD KEY `rol_funcion_key_idx` (`fncod`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`marcacod`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rolescod`);

--
-- Indices de la tabla `roles_usuarios`
--
ALTER TABLE `roles_usuarios`
  ADD PRIMARY KEY (`usercod`,`rolescod`),
  ADD KEY `rol_usuario_key_idx` (`rolescod`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usercod`),
  ADD UNIQUE KEY `useremail_UNIQUE` (`useremail`),
  ADD KEY `usertipo` (`usertipo`,`useremail`,`usercod`,`userest`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignados`
--
ALTER TABLE `asignados`
  MODIFY `asignadocod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `departamentocod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `entradas_salidas`
--
ALTER TABLE `entradas_salidas`
  MODIFY `idEntradas_salidas` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `filiales`
--
ALTER TABLE `filiales`
  MODIFY `filialcod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `marcacod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usercod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `funciones_roles`
--
ALTER TABLE `funciones_roles`
  ADD CONSTRAINT `funcion_rol_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`),
  ADD CONSTRAINT `rol_funcion_key` FOREIGN KEY (`fncod`) REFERENCES `funciones` (`fncod`);

--
-- Filtros para la tabla `roles_usuarios`
--
ALTER TABLE `roles_usuarios`
  ADD CONSTRAINT `rol_usuario_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`),
  ADD CONSTRAINT `usuario_rol_key` FOREIGN KEY (`usercod`) REFERENCES `usuario` (`usercod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
