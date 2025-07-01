-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2025 a las 20:55:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `whr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `operating_system` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `devices`
--

INSERT INTO `devices` (`id`, `brand`, `model`, `operating_system`, `serial_number`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'HP', 'EliteBook 840 G3', 'Windows 10 Pro', 'GCG30509LC', 'Disponible', 'Laptop', NULL, NULL),
(2, 'HP', 'EliteBook 840 G4', 'Windows 10 Pro', 'GCG30510LC', 'Disponible', 'Laptop', NULL, NULL),
(3, 'Dell', 'Latitude 7490', 'Windows 10 Pro', 'GCG30511LC', 'Disponible', 'Laptop', NULL, NULL),
(4, 'Samsung', 'Galaxy Tab S6', 'Android', 'GCG30512LC', 'Disponible', 'Tablet', NULL, NULL),
(5, 'Apple', 'iPhone 11', 'iOS', 'GCG30513LC', 'Disponible', 'Celular', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `asset_tag` varchar(255) DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `operating_system` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Disponible',
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id`, `serial_number`, `asset_tag`, `brand`, `model`, `operating_system`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'GCG30509LC', NULL, 'HP', 'EliteBook 840 G3', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(2, 'GCG30510LC', NULL, 'HP', 'EliteBook 840 G4', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(3, 'GCG30511LC', NULL, 'Dell', 'Latitude 7490', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(4, 'GCG30512LC', NULL, 'Samsung', 'Galaxy Tab S6', 'Android', 'Disponible', 'Tablet', NULL, NULL),
(5, 'GCG30513LC', NULL, 'Apple', 'iPhone 11', 'iOS', 'Disponible', 'Celular', NULL, NULL),
(6, '5CD203LLQM', 'HB000199', 'HP', 'Chromebook C645', 'ChromeOS', 'Disponible', 'Laptop', NULL, NULL),
(7, '5CD2491D81', 'HB001056', 'HP', 'Probook 640 G9', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(8, '5CD4288J9T', 'HB003094', 'HP', 'Elitebook 650 G10', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(9, '5CD4288JBQ', 'HB003122', 'HP', 'Elitebook 650 G10', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(10, '5CD450C8DM', 'HB003912', 'HP', 'HP ZBook Power 15 G10', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(11, '5CD4525S3J', 'HB003936', 'HP', 'HP EliteBook 640 G11', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(12, '5CD4525S9Z', 'HB004158', 'HP', 'HP EliteBook 640 G11', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(13, '5CD4525SCN', 'HB004203', 'HP', 'HP EliteBook 640 G11', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(14, '5CD4525SG0', 'HB004269', 'HP', 'HP EliteBook 640 G11', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(15, '5CD4525SGJ', 'HB004283', 'HP', 'HP EliteBook 640 G11', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(16, '5CD4525SGQ', 'HB004289', 'HP', 'HP EliteBook 640 G11', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(17, '5CD4525SGS', 'HB004291', 'HP', 'HP EliteBook 640 G11', 'Windows 10 Pro', 'Disponible', 'Laptop', NULL, NULL),
(18, '5CD511D7W0', 'HB004371', 'HP', 'HP Pro c640 Chromebook', 'ChromeOS', 'Disponible', 'Laptop', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_28_194515_create_permission_tables', 1),
(5, '2025_01_29_015343_create_usuarios_table', 1),
(6, '2025_02_05_041206_create_tecnicos_table', 1),
(7, '2025_02_05_041218_create_dispositivos_table', 1),
(8, '2025_06_17_001925_add_technician_fields_to_users_table', 1),
(9, '2025_06_17_002658_create_devices_table', 1),
(10, '2025_06_17_013449_create_dispositivos_table', 2),
(11, '2025_06_17_021233_add_fields_to_tecnicos_table', 3),
(12, '2025_06_17_021447_remove_correo_from_tecnicos_table', 4),
(13, '2025_06_17_021854_add_fields_to_usuarios_table', 5),
(14, '2025_06_17_022146_make_nombre_nullable_in_usuarios_table', 6),
(15, '2025_06_17_023834_create_usuarios_table', 7),
(16, '2025_06_17_024351_create_usuarios_table', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'crear cartas de asignacion', 'web', '2025-06-17 06:30:13', '2025-06-17 06:30:13'),
(2, 'ver dispositivos asignados', 'web', '2025-06-17 06:30:13', '2025-06-17 06:30:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-06-17 06:30:13', '2025-06-17 06:30:13'),
(2, 'employee', 'web', '2025-06-17 06:30:13', '2025-06-17 06:30:13'),
(3, 'dss', 'web', '2025-06-17 06:30:13', '2025-06-17 06:30:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnicos`
--

CREATE TABLE `tecnicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `cost_center_account_number` varchar(255) DEFAULT NULL,
  `cost_center_name` varchar(255) DEFAULT NULL,
  `supervisor` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tecnicos`
--

INSERT INTO `tecnicos` (`id`, `created_at`, `updated_at`, `user_id`, `name`, `display_name`, `email`, `position`, `location`, `cost_center_account_number`, `cost_center_name`, `supervisor`, `type`, `password`) VALUES
(1, NULL, NULL, 'ALVARA56', 'Alejandro Alvarado1', 'Alejandro Alvarado1', 'alejandro_alvarado_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$x9lCAjAtdDeFJRdHA6Uev.dLSNfzmNu9COD6.FhlEeISc8KLlZFoq'),
(2, NULL, NULL, 'REYNAA22', 'Alondra Reyna', 'Alondra Reyna', 'alondra_reyna_grupoti@whirlpool.com', '', 'Ramos Arizpe', '', 'Ramos Arizpe', '', 'technician', '$2y$12$dA2PoXnMLDuE9vK9TW.rn.Sfca2asM4Jixnri6d3wgbIb7v38ZW.6'),
(3, NULL, NULL, 'HERNA289', 'Andres Hernandez', 'Andres Hernandez', 'andres_hernandez_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$X6l3PtR0EicrpuDFyMt6gukPxwt7f3Lwejuj8OmrqP/gFJnguLS5O'),
(4, NULL, NULL, 'NONEA2', 'Antonio Ivon', 'Antonio Ivon', 'antonio_ivon_grupoti@whirlpool.com', '', 'Guadalajara CAAW', '', 'Guadalajara CAAW', '', 'technician', '$2y$12$WFYdCb.Phoon/80/hFKL4.oOaVL7RQePll7LkPuhnGVMrHNj4kyxC'),
(5, NULL, NULL, 'TOVARA17', 'Axel Tovar', 'Axel Tovar', 'axel_tovar_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$uUtW5MllnPDD/yBa2C/I8eZ3pxTpZz0.J8YL2sdd.Ds81xxinIAje'),
(6, NULL, NULL, 'ALVARC40', 'Cinthya Alvarez', 'Cinthya Alvarez', 'cinthya_alvarez_grupoti@whirlpool.com', '', 'Ramos Arizpe', '', 'Ramos Arizpe', '', 'technician', '$2y$12$gtq0JwHDocHvswuD97iPO.0MRBsCoFrTTLZwqr69pemEsHd1L0LIy'),
(7, NULL, NULL, 'GONZAE91', 'Eber Gonzalez', 'Eber Gonzalez', 'eber_gonzalez_grupoti@whirlpool.com', '', 'Ramos Arizpe', '', 'Ramos Arizpe', '', 'technician', '$2y$12$E1kV7EJem3xOVFLh48IaI.8aYBGNwZxsREfRSCfaHtajBDJ1v50Wi'),
(8, NULL, NULL, 'LARAE21', 'Edgar Lara', 'Edgar Lara', 'edgar_lara_grupoti@whirlpool.com', '', 'Ramos Arizpe', '', 'Ramos Arizpe', '', 'technician', '$2y$12$HKY8k88BUfRcuGmDygQRYebFTxLP/nbXGTsDy/XC6IvIJQCTTk.xa'),
(9, NULL, NULL, 'LUGOE5', 'Edgar Lugo', 'Edgar Lugo', 'edgar_lugo_grupoti@whirlpool.com', '', 'México CEDIS', '', 'México CEDIS', '', 'technician', '$2y$12$5y.hDbD9xXhLJTDisyn54O7tqzL8YQ1xjpU73Iw1LiJi7GSNtsNL6'),
(10, NULL, NULL, 'LOPEZE77', 'Emmanuel Lopez', 'Emmanuel Lopez', 'emmanuel_lopez_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$ryL94Lu7545Lke7cfxKyvOuU3jGuKt2IfaYd96tRpFKwcb2LasYxi'),
(11, NULL, NULL, 'ESTRAE14', 'Erick Estrada', 'Erick Estrada', 'erick_estrada_grupoti@whirlpool.com', '', 'Celaya ERNA', '', 'Celaya ERNA', '', 'technician', '$2y$12$RgYJwdApIqu77b2bedSE5Ok5QBjTdpXxkqo6IJvMLTXaxZUKj/5h2'),
(12, NULL, NULL, 'SANCHG27', 'Gaston Sanchez', 'Gaston Sanchez', 'gaston_sanchez_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$4cpHglDlCX4VAGhdT/2eKOy4tThufGesGDcC.XF/YIQaZC4FU2JZa'),
(13, NULL, NULL, 'PINEDG2', 'Gerardo Pineda', 'Gerardo Pineda', 'gerardo_pineda_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$9K87O609qAwGXVinrkGb/epiNfhnFNZR9UaLlwIRdsNG2Ns/DbGES'),
(14, NULL, NULL, 'TREVJI18', 'Joel Treviño', 'Joel Treviño', 'joel_trevino_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$HNED4wz08eXpbKnryG8h0eFE.dCPkBv9AQImnBzJ879MNG3ERLeqG'),
(15, NULL, NULL, 'COVARJ9', 'Josue Covarrubias', 'Josue Covarrubias', 'josue_covarrubias_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$wFUS0MDSKoqXcLklEVeihOK7l0ueDfUI/2zynXnGhCo9SrZJ5VPzS'),
(16, NULL, NULL, 'SALADM2', 'Mitzi Salado', 'Mitzi Salado', 'mitzi_salado_grupoti@whirlpool.com', '', 'Monterrey IT', '', 'Monterrey IT', '', 'technician', '$2y$12$5.qS18HzPg2E7XaKwxbCGexrNA9kRSs8J7af.S87kly4lqCFdMRSi'),
(17, NULL, NULL, 'JIMENP19', 'Pedro Jimenez', 'Pedro Jimenez', 'pedro_jimenez_grupoti@whirlpool.com', '', 'Celaya ERNA', '', 'Celaya ERNA', '', 'technician', '$2y$12$U3LyIHwf3wSIsyeCr2JSbuk8EOAnEAtu3zfydxKoK0BafhvmEJRaS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `cost_center_account_number` varchar(255) DEFAULT NULL,
  `cost_center_name` varchar(255) DEFAULT NULL,
  `supervisor` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_id`, `display_name`, `location`, `position`, `cost_center_account_number`, `cost_center_name`, `supervisor`, `type`) VALUES
(1, 'Paola', 'paosaenz201@gmail.com', NULL, '$2y$12$kr7EPV6KEKJ8MsTQ/LpvBuyRzdi6IWUvChtn2FJ8HM89IaLWKiPfe', NULL, '2025-06-17 06:30:14', '2025-06-17 06:30:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'employee'),
(2, 'Alejandro Alvarado1', 'alejandro_alvarado_grupoti@whirlpool.com', NULL, '$2y$12$Ps5auQleLvSxMBUAeHICueoU0ehi1m87JZDNh1/gE612vWoobqi9m', NULL, NULL, NULL, 'ALVARA56', 'Alejandro Alvarado1', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(3, 'Alondra Reyna', 'alondra_reyna_grupoti@whirlpool.com', NULL, '$2y$12$45ow3b8IbxU/Zcj9340rbuy7MIoie4zJZbokY3j/G2QVKpxatm1mO', NULL, NULL, NULL, 'REYNAA22', 'Alondra Reyna', 'Ramos Arizpe', '', '', 'Ramos Arizpe', '', 'technician'),
(4, 'Andres Hernandez', 'andres_hernandez_grupoti@whirlpool.com', NULL, '$2y$12$yDSJB2LQOLi/obWd9YySEOnkIO5mfo/AZ5OUCkr5BgBbQ41u1dZjO', NULL, NULL, NULL, 'HERNA289', 'Andres Hernandez', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(5, 'Antonio Ivon', 'antonio_ivon_grupoti@whirlpool.com', NULL, '$2y$12$D.RpQNCU15f6jxzzbrQ.KeiHHUSafvDQCLO4UG5xXzcKbjMzzdaGm', NULL, NULL, NULL, 'NONEA2', 'Antonio Ivon', 'Guadalajara CAAW', '', '', 'Guadalajara CAAW', '', 'technician'),
(6, 'Axel Tovar', 'axel_tovar_grupoti@whirlpool.com', NULL, '$2y$12$yt2BP38dj2m2wMHnUK1o6.AH6IZPQrySSL8xAeYGhoGESuPB/6eMy', NULL, NULL, NULL, 'TOVARA17', 'Axel Tovar', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(7, 'Cinthya Alvarez', 'cinthya_alvarez_grupoti@whirlpool.com', NULL, '$2y$12$yYzAdqE96jRcO2yXI5NvB.5sUNUJENec/pUn51VmUuIoDNwPy9Xdi', NULL, NULL, NULL, 'ALVARC40', 'Cinthya Alvarez', 'Ramos Arizpe', '', '', 'Ramos Arizpe', '', 'technician'),
(8, 'Eber Gonzalez', 'eber_gonzalez_grupoti@whirlpool.com', NULL, '$2y$12$Hpu/ZsayaYQsNEl2xjPlV.Md2kuYSoU5aie69azt4UCYdRMB36F7u', NULL, NULL, NULL, 'GONZAE91', 'Eber Gonzalez', 'Ramos Arizpe', '', '', 'Ramos Arizpe', '', 'technician'),
(9, 'Edgar Lara', 'edgar_lara_grupoti@whirlpool.com', NULL, '$2y$12$GvUXjA1FRhWUqeSiVkcQcO10Z8r0pPRQ79mPHzdP4bG1Qihjhz8iK', NULL, NULL, NULL, 'LARAE21', 'Edgar Lara', 'Ramos Arizpe', '', '', 'Ramos Arizpe', '', 'technician'),
(10, 'Edgar Lugo', 'edgar_lugo_grupoti@whirlpool.com', NULL, '$2y$12$3oTLRlh/7QgyWnqsTa6FbOly5wuHwRjLwgxGvFTCStiE5pIro7mQm', NULL, NULL, NULL, 'LUGOE5', 'Edgar Lugo', 'México CEDIS', '', '', 'México CEDIS', '', 'technician'),
(11, 'Emmanuel Lopez', 'emmanuel_lopez_grupoti@whirlpool.com', NULL, '$2y$12$VRogWOPHvNMxY0IYh8uNZefpqtFd8fCzzfN6wcy864RScsxC.QRrW', NULL, NULL, NULL, 'LOPEZE77', 'Emmanuel Lopez', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(12, 'Erick Estrada', 'erick_estrada_grupoti@whirlpool.com', NULL, '$2y$12$kMfxSdoeXXWyCxhy2kg.Nu/ZELfYLvcsCvktN4B0unpDjjGtw8Pvy', NULL, NULL, NULL, 'ESTRAE14', 'Erick Estrada', 'Celaya ERNA', '', '', 'Celaya ERNA', '', 'technician'),
(13, 'Gaston Sanchez', 'gaston_sanchez_grupoti@whirlpool.com', NULL, '$2y$12$qHy7jviQBTG5s.xNpWHkUuKFb0iW9j/uKsxEn9tZRG/H.3cR70R2q', NULL, NULL, NULL, 'SANCHG27', 'Gaston Sanchez', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(14, 'Gerardo Pineda', 'gerardo_pineda_grupoti@whirlpool.com', NULL, '$2y$12$U8BL3Y/Z7S56R.ztU4TTze6EmLafQRHNL.t0lJGfmo9/o239PPU2a', NULL, NULL, NULL, 'PINEDG2', 'Gerardo Pineda', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(15, 'Joel Treviño', 'joel_trevino_grupoti@whirlpool.com', NULL, '$2y$12$H0GSN1hE2PR2HnaupYMk.e9qdsiZYGlkZOzDwQByv.GlMJrSSwhBW', NULL, NULL, NULL, 'TREVJI18', 'Joel Treviño', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(16, 'Josue Covarrubias', 'josue_covarrubias_grupoti@whirlpool.com', NULL, '$2y$12$D7VpzvHlw21iqaU5PE.K5.duxC/dhWkIPqNR7j48ylrspn.KDbEa2', NULL, NULL, NULL, 'COVARJ9', 'Josue Covarrubias', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(17, 'Mitzi Salado', 'mitzi_salado_grupoti@whirlpool.com', NULL, '$2y$12$DDzcu2pgBDWTPv9ymSGrNedK/fgudIUY5NFIMH7Mtv1Cx7iT2f0nq', NULL, NULL, NULL, 'SALADM2', 'Mitzi Salado', 'Monterrey IT', '', '', 'Monterrey IT', '', 'technician'),
(18, 'Pedro Jimenez', 'pedro_jimenez_grupoti@whirlpool.com', NULL, '$2y$12$zsr3H97CTgxiwzJ9yeJ7D.3ceMnS5XRYx8H7OMgrfXTjv9cocuBCK', NULL, NULL, NULL, 'JIMENP19', 'Pedro Jimenez', 'Celaya ERNA', '', '', 'Celaya ERNA', '', 'technician');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `cost_center_account_number` varchar(255) NOT NULL,
  `cost_center_name` varchar(255) NOT NULL,
  `supervisor` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `centro` varchar(255) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user_id`, `display_name`, `email`, `location`, `cost_center_account_number`, `cost_center_name`, `supervisor`, `position`, `nombre`, `centro`, `correo`, `created_at`, `updated_at`) VALUES
(1, 'HERNA289', 'Andres Hernandez', 'andres_hernandez_grupoti@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Andres Hernandez', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(2, 'AGUILA45', 'Antonio Aguilar', 'antonio_aguilar_movit@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Antonio Aguilar', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(3, 'ARMASA1', 'Antonio Armas', 'antonio_armas_teknna@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Antonio Armas', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(4, 'TOVARA17', 'Axel Tovar', 'axel_tovar_grupoti@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Axel Tovar', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(5, 'ANTONE18', 'Edith Antonio', 'edith_antonio_teknna3@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Edith Antonio', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(6, 'MORENI13', 'Isaac Moreno', 'isaac_moreno_teknna@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Isaac Moreno', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(7, 'TREVIJ18', 'Joel Treviño', 'joel_trevino_grupoti@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Joel Treviño', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(8, 'LICONJ3', 'Josselhly Licona', 'josselhly_licona_hp@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Josselhly Licona', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(9, 'MEZAL2', 'Luis Meza', 'luis_meza_grupoti@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Luis Meza', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(10, 'SALADM2', 'Mitzi Salado', 'mitzi_salado_grupoti@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Mitzi Salado', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(11, 'DELATOA', 'Oscar De la Torre', 'oscar_delatorre_movit@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Oscar De la Torre', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(12, 'MARTIR94', 'Rodrigo Martinez', 'rodrigo_martinez_movit@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Rodrigo Martinez', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(13, 'SIDONR', 'Ruben Sidon', 'ruben_sidon_openservice@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Ruben Sidon', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(14, 'URQUIS', 'Santiago Urquides', 'santiago_urquides_conissis@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Santiago Urquides', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(15, 'PINACU1', 'Uriel Pinacho', 'uriel_pinacho_conissis@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Uriel Pinacho', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(16, 'NAVARAK', 'Karen Navarro', 'karen_navarro@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Karen Navarro', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(17, 'MONTAAM', 'Abel Montalvo', 'abel_mata_conissis@whirlpool.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Abel Montalvo', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(18, 'VICOHZ01', 'Vicente Fraga', 'vicohdz.fraga@gmail.com', 'Monterrey IT', 'TEST01', 'Dummy Center', 'Tester', 'Pruebas', 'Vicente Fraga', 'Dummy Center', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(19, 'POLOLO01', 'Polo López', 'pololohdz2000@gmail.com', 'Monterrey IT', 'TEST02', 'Dummy Center', 'Tester', 'Pruebas', 'Polo López', 'Dummy Center', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(20, 'SANCHEZG1', 'Gastón Sánchez Calderón', 'cadetek.contacto@gmail.com', 'Monterrey IT', 'TEST03', 'Grupo México TI', 'Karen Navarro', 'Líder de Proyecto', 'Gastón Sánchez Calderón', 'Grupo México TI', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30'),
(21, 'JIMENG1', 'Guillermo Jiménez', 'guillermojimenez385@gmail.com', 'Monterrey IT', '80923', 'Monterrey IT', 'Karen Navarro', 'Sin especificar', 'Guillermo Jiménez', 'Monterrey IT', NULL, '2025-06-17 12:06:30', '2025-06-17 12:06:30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `devices_serial_number_unique` (`serial_number`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dispositivos_serial_number_unique` (`serial_number`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tecnicos_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `tecnicos_email_unique` (`email`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_user_id_unique` (`user_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tecnicos`
--
ALTER TABLE `tecnicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
