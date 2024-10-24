-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando datos para la tabla syscpp.proveedores: ~12 rows (aproximadamente)

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `img`, `estado`, `rol_type`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Francisco Escobar', 'franescobar97@hotmail.com', NULL, '$2y$10$ccW7jsXejwBZinzCvB9ei.WXZLAHPITjfid1j0rVJtPQJ6S08kIEG', '/temp/perfiles/img_perfil_1729786261.jpg', 1, 1, NULL, '2024-10-24 15:14:34', '2024-10-24 16:11:01');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `img`, `estado`, `rol_type`, `remember_token`, `created_at`, `updated_at`) VALUES (2, 'Sara Mancia', 'sarymancia95@gmail.com', NULL, '$2y$10$nrizPSqHyLCCXDYBQ27NBuJfOYQPd4yBnyIFJH564uLwky4TV119K', '/temp/perfiles/img_perfil_1729786485.jpg', 1, 1, NULL, '2024-10-24 15:34:56', '2024-10-24 16:14:45');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `img`, `estado`, `rol_type`, `remember_token`, `created_at`, `updated_at`) VALUES (3, 'Estandar', 'estandar@hotmail.com', NULL, '$2y$10$4f7XoYJLb1DWFXkHTCarA.uOLY7Rbqpz9MwHuDcdMG/kyXb1jKG4q', '/temp/perfiles/img_perfil_1729786365.jpg', 1, 3, NULL, '2024-10-24 16:12:45', '2024-10-24 16:12:45');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `img`, `estado`, `rol_type`, `remember_token`, `created_at`, `updated_at`) VALUES (4, 'Monitoreo', 'monitoreo@hotmail.com', NULL, '$2y$10$MyUImczTUu5428Hi4QBepege2CYYuXfgWSg2DxfCv7o017Q8iDw8u', '/temp/perfiles/img_perfil_1729786390.webp', 1, 2, NULL, '2024-10-24 16:13:10', '2024-10-24 16:13:10');


INSERT INTO `proveedores` (`id`, `nombreProveedor`, `telefonoProveedor`, `correoProveedor`, `created_at`, `updated_at`) VALUES
	(1, 'Zona Digital', NULL, NULL, '2024-10-07 08:25:22', '2024-10-07 08:25:22'),
	(2, 'Kayfa S.A de C.V', NULL, NULL, '2024-10-07 08:25:36', '2024-10-07 08:25:36'),
	(3, 'KPC Hardware', NULL, NULL, '2024-10-07 08:25:44', '2024-10-07 08:25:44'),
	(4, 'XTREME HARDWARE TECHNOLOGY', NULL, NULL, '2024-10-07 08:25:56', '2024-10-07 08:25:56'),
	(5, 'DIGITAL SOLUTION', NULL, NULL, '2024-10-07 08:26:07', '2024-10-07 08:26:07'),
	(6, 'R.G Nietos', NULL, NULL, '2024-10-07 08:26:18', '2024-10-07 08:26:18'),
	(7, 'Electronica Japonesa', NULL, NULL, '2024-10-07 08:26:34', '2024-10-07 08:26:34'),
	(8, 'Udemy', NULL, NULL, '2024-10-07 08:28:07', '2024-10-07 08:28:07'),
	(9, 'Platzi', NULL, NULL, '2024-10-07 08:28:27', '2024-10-07 08:28:27'),
	(10, 'SIMAN S.A de C.V', NULL, NULL, '2024-10-07 08:28:53', '2024-10-07 08:28:53'),
	(11, 'Hostinger', NULL, NULL, '2024-10-07 08:29:45', '2024-10-07 08:29:45'),
	(12, 'AEON COMPUTERS', NULL, NULL, '2024-10-07 08:49:29', '2024-10-07 08:49:29');

-- Volcando datos para la tabla syscpp.facturas: ~18 rows (aproximadamente)
INSERT INTO `facturas` (`id`, `fechaFactura`, `facturador`, `totalFactura`, `estadoFactura`, `idProveedor`, `created_at`, `updated_at`) VALUES
	(1, '2024-09-24', 'Francisco Escobar', 539.99, 'Sin Pagar', 1, '2024-10-07 08:30:53', '2024-10-07 08:30:53'),
	(2, '2024-09-25', 'Francisco', 399.99, 'Sin Pagar', 1, '2024-10-07 08:31:33', '2024-10-07 08:31:33'),
	(3, '2024-10-07', 'Rodrigo', 44.99, 'Sin Pagar', 2, '2024-10-07 08:31:56', '2024-10-07 08:31:56'),
	(4, '2024-09-30', 'Francisco', 124.99, 'Sin Pagar', 4, '2024-10-07 08:32:33', '2024-10-07 08:32:33'),
	(5, '2024-10-07', 'Francisco', 54.50, 'Pagado Parcialmente', 1, '2024-10-07 08:32:53', '2024-10-07 08:41:06'),
	(6, '2024-10-01', 'Roberto', 13.99, 'Pagado', 8, '2024-10-07 08:33:21', '2024-10-07 08:40:58'),
	(7, '2024-10-06', 'Mark Strega', 250.00, 'Pagado', 11, '2024-10-07 08:34:36', '2024-10-07 08:53:10'),
	(8, '2024-10-01', 'Mario', 4.99, 'Pagado', 6, '2024-10-07 08:35:36', '2024-10-07 08:40:47'),
	(9, '2024-10-07', 'Francisco', 35.00, 'Sin Pagar', 1, '2024-10-07 08:36:49', '2024-10-07 08:36:49'),
	(10, '2024-10-01', 'Jorge', 1500.00, 'Pagado', 10, '2024-10-07 08:37:39', '2024-10-07 08:42:46'),
	(11, '2024-10-07', 'Francisco', 450.25, 'Sin Pagar', 1, '2024-10-07 08:38:16', '2024-10-07 08:38:16'),
	(12, '2024-10-07', 'Francisco', 99.99, 'Sin Pagar', 1, '2024-10-07 08:38:45', '2024-10-07 08:38:45'),
	(13, '2024-10-01', 'Francisco', 800.00, 'Pagado Parcialmente', 1, '2024-10-07 08:39:46', '2024-10-07 08:43:07'),
	(14, '2024-09-01', 'Leon S. Kennedy', 250.00, 'Pagado Parcialmente', 9, '2024-10-07 08:40:10', '2024-10-07 08:45:26'),
	(15, '2024-10-01', 'Leon S. Kennedy', 250.00, 'Sin Pagar', 9, '2024-10-07 08:40:25', '2024-10-07 08:40:25'),
	(16, '2024-10-06', 'Mario', 45.00, 'Sin Pagar', 2, '2024-10-07 08:49:07', '2024-10-07 08:49:07'),
	(17, '2024-10-06', 'Mario', 750.00, 'Sin Pagar', 2, '2024-10-07 08:49:19', '2024-10-07 08:49:19'),
	(18, '2024-09-30', 'Roberto', 60.00, 'Sin Pagar', 4, '2024-10-07 08:50:48', '2024-10-07 08:50:48');

-- Volcando datos para la tabla syscpp.pagos: ~19 rows (aproximadamente)
INSERT INTO `pagos` (`id`, `pagoRealizado`, `idFactura`, `created_at`, `updated_at`) VALUES
	(1, 4.99, 8, '2024-10-07 08:40:47', '2024-10-07 08:40:47'),
	(2, 13.99, 6, '2024-10-07 08:40:58', '2024-10-07 08:40:58'),
	(3, 25.00, 5, '2024-10-07 08:41:06', '2024-10-07 08:41:06'),
	(4, 125.00, 10, '2024-10-07 08:41:27', '2024-10-07 08:41:27'),
	(5, 125.00, 10, '2024-10-07 08:41:34', '2024-10-07 08:41:34'),
	(6, 125.00, 10, '2024-10-07 08:41:42', '2024-10-07 08:41:42'),
	(7, 125.00, 10, '2024-10-07 08:41:48', '2024-10-07 08:41:48'),
	(8, 125.00, 10, '2024-10-07 08:42:00', '2024-10-07 08:42:00'),
	(9, 125.00, 10, '2024-10-07 08:42:07', '2024-10-07 08:42:07'),
	(10, 125.00, 10, '2024-10-07 08:42:12', '2024-10-07 08:42:12'),
	(11, 125.00, 10, '2024-10-07 08:42:20', '2024-10-07 08:42:20'),
	(12, 125.00, 10, '2024-10-07 08:42:27', '2024-10-07 08:42:27'),
	(13, 125.00, 10, '2024-10-07 08:42:34', '2024-10-07 08:42:34'),
	(14, 125.00, 10, '2024-10-07 08:42:39', '2024-10-07 08:42:39'),
	(15, 125.00, 10, '2024-10-07 08:42:46', '2024-10-07 08:42:46'),
	(16, 200.00, 13, '2024-10-07 08:43:07', '2024-10-07 08:43:07'),
	(17, 200.00, 13, '2024-10-07 08:43:26', '2024-10-07 08:43:26'),
	(18, 125.00, 14, '2024-10-07 08:45:26', '2024-10-07 08:45:26'),
	(19, 250.00, 7, '2024-10-07 08:53:10', '2024-10-07 08:53:10');


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
