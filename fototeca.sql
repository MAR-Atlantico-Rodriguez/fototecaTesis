-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2018 a las 16:28:27
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fototeca`
--
CREATE DATABASE IF NOT EXISTS `fototeca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fototeca`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `categoriasLista`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `categoriasLista` (IN `_id` INT(11))  SELECT C.*, U.name,  (select count(*) from imagenes AS I where I.id_categoria = C.id) AS cantImagen, (select count(*) from categorias AS CC where CC.id_padre = C.id) AS cantSubCat FROM categorias AS C
            left JOIN users AS U ON U.id = C.id_users
            where C.id_padre = _id$$

DROP PROCEDURE IF EXISTS `descargasRanking`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `descargasRanking` ()  NO SQL
select COUNT(*) from imagen_descargas AS ID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_padre` int(11) NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `block` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `categorias`
--

TRUNCATE TABLE `categorias`;
--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `id_padre`, `id_users`, `categoria`, `block`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'UNNE', 1, '2018-01-17 15:19:43', '2018-01-17 15:19:43'),
(3, 1, 1, 'Rectorado', 1, '2018-01-17 15:20:25', '2018-01-17 15:20:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE `imagenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `foto_orientacion` smallint(6) NOT NULL DEFAULT '0',
  `foto_color` smallint(6) NOT NULL DEFAULT '0',
  `repositorio` smallint(6) NOT NULL DEFAULT '0',
  `url` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `imagenes`
--

TRUNCATE TABLE `imagenes`;
--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_categoria`, `id_user`, `titulo`, `descripcion`, `fecha`, `foto_orientacion`, `foto_color`, `repositorio`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'probando', 'probando', '2018-01-22', 0, 1, 0, 'public/imagenes/1/2a0bc6af1e5f8380ef0bc8e4471cf649.jpg', '2018-01-22 15:49:48', '2018-01-22 15:49:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_descargas`
--

DROP TABLE IF EXISTS `imagen_descargas`;
CREATE TABLE `imagen_descargas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_imagen` int(10) UNSIGNED NOT NULL,
  `id_imagen_recorte` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_users` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `imagen_descargas`
--

TRUNCATE TABLE `imagen_descargas`;
--
-- Volcado de datos para la tabla `imagen_descargas`
--

INSERT INTO `imagen_descargas` (`id`, `id_imagen`, `id_imagen_recorte`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, '2018-01-22 16:12:56', '2018-01-22 16:12:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_tags`
--

DROP TABLE IF EXISTS `imagen_tags`;
CREATE TABLE `imagen_tags` (
  `id_imagen` int(10) UNSIGNED NOT NULL,
  `id_tag` int(10) UNSIGNED NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `imagen_tags`
--

TRUNCATE TABLE `imagen_tags`;
--
-- Volcado de datos para la tabla `imagen_tags`
--

INSERT INTO `imagen_tags` (`id_imagen`, `id_tag`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-01-22 15:49:48', '2018-01-22 15:49:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_02_10_014948_categorias', 1),
(4, '2017_02_10_015002_imagenes', 1),
(5, '2017_02_22_160643_create_recortes_table', 1),
(6, '2017_04_17_102003_create_tags_table', 1),
(7, '2017_04_17_103957_create_imagen_tags_table', 1),
(8, '2017_08_04_145305_create_imagen_descargas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `password_resets`
--

TRUNCATE TABLE `password_resets`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recortes`
--

DROP TABLE IF EXISTS `recortes`;
CREATE TABLE `recortes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_imagen` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `recortes`
--

TRUNCATE TABLE `recortes`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `tags`
--

TRUNCATE TABLE `tags`;
--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `id_users`, `tag`, `block`, `created_at`, `updated_at`) VALUES
(1, 1, 'Unne', 1, '2018-01-22 15:48:42', '2018-01-22 15:48:42'),
(2, 1, 'rectorado', 1, '2018-01-22 15:48:50', '2018-01-22 15:48:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block` smallint(6) NOT NULL,
  `perfil` smallint(6) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `users`
--

TRUNCATE TABLE `users`;
--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `block`, `perfil`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Martin Rodriguez', 'martin', 'martinrodriguez493@hotmail.com', '$2y$10$9LzX4ZfxFg8CMkX2OzusTOuBO0iexNYh/mHzqrG4p3KCzO37IBUNa', 1, 1, NULL, NULL, NULL),
(2, 'Valeria Beltrand', 'valeria', 'valeria@unne.edu.ar', '$2y$10$anOqVy0NlqMnXt5gRaFZFe80otlh/dh62pekEAzrazPtXPOai/bv.', 1, 1, NULL, NULL, NULL),
(3, 'Karina Parras', 'karina', 'comunicacioninstitucional.unne@gmail.com', '$2y$10$G1Nuiyk8MlYF.DVULZyPnOeEsDDpHvUaea0VgRf0iD5KPnKgoeFoi', 1, 1, NULL, NULL, NULL),
(4, 'Florencia Mesa', 'flormesa', 'florencia_a_m@hotmail.com', '$2y$10$1Wolm9REGtTbWyTanNFH/O81f3Z6odOmAv5pzRBM4AkHBIYa1.hsq', 1, 0, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorias_id_users_foreign` (`id_users`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagenes_id_categoria_foreign` (`id_categoria`),
  ADD KEY `imagenes_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `imagen_descargas`
--
ALTER TABLE `imagen_descargas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagen_descargas_id_imagen_foreign` (`id_imagen`);

--
-- Indices de la tabla `imagen_tags`
--
ALTER TABLE `imagen_tags`
  ADD PRIMARY KEY (`id_imagen`,`id_tag`),
  ADD KEY `imagen_tags_id_tag_foreign` (`id_tag`),
  ADD KEY `imagen_tags_id_users_foreign` (`id_users`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `recortes`
--
ALTER TABLE `recortes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recortes_id_imagen_foreign` (`id_imagen`),
  ADD KEY `recortes_id_user_foreign` (`id_user`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_id_users_foreign` (`id_users`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `imagen_descargas`
--
ALTER TABLE `imagen_descargas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `recortes`
--
ALTER TABLE `recortes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `imagenes_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `imagen_descargas`
--
ALTER TABLE `imagen_descargas`
  ADD CONSTRAINT `imagen_descargas_id_imagen_foreign` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagen_tags`
--
ALTER TABLE `imagen_tags`
  ADD CONSTRAINT `imagen_tags_id_imagen_foreign` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`),
  ADD CONSTRAINT `imagen_tags_id_tag_foreign` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `imagen_tags_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `recortes`
--
ALTER TABLE `recortes`
  ADD CONSTRAINT `recortes_id_imagen_foreign` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recortes_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
