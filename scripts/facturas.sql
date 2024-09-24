INSERT INTO `proveedores` (`id`, `nombreProveedor`, `telefonoProveedor`, `correoProveedor`, `created_at`, `updated_at`) VALUES (1, 'Super Selectos', NULL, NULL, '2024-09-23 17:50:17', '2024-09-23 17:50:17');
INSERT INTO `proveedores` (`id`, `nombreProveedor`, `telefonoProveedor`, `correoProveedor`, `created_at`, `updated_at`) VALUES (2, 'Wallmart', NULL, NULL, '2024-09-23 17:50:30', '2024-09-23 17:50:30');
INSERT INTO `proveedores` (`id`, `nombreProveedor`, `telefonoProveedor`, `correoProveedor`, `created_at`, `updated_at`) VALUES (3, 'Price Smart', NULL, NULL, '2024-09-23 17:50:41', '2024-09-23 17:50:41');

INSERT INTO `facturas` (`id`, `fechaFactura`, `facturador`, `totalFactura`, `estadoFactura`, `idProveedor`, `created_at`, `updated_at`) VALUES (1, '2024-09-23', 'Rocio Salmeron', 50.25, 'Sin Pagar', 1, '2024-09-23 14:21:42', '2024-09-23 14:21:44');
INSERT INTO `facturas` (`id`, `fechaFactura`, `facturador`, `totalFactura`, `estadoFactura`, `idProveedor`, `created_at`, `updated_at`) VALUES (2, '2024-09-21', 'Marta de la Cruz', 530.25, 'Pagado', 3, '2024-09-23 14:22:49', '2024-09-23 14:22:50');
INSERT INTO `facturas` (`id`, `fechaFactura`, `facturador`, `totalFactura`, `estadoFactura`, `idProveedor`, `created_at`, `updated_at`) VALUES (3, '2024-09-22', 'Marta de la Cruz', 25.39, 'Pagado', 3, '2024-09-23 14:23:58', '2024-09-23 14:23:59');
INSERT INTO `facturas` (`id`, `fechaFactura`, `facturador`, `totalFactura`, `estadoFactura`, `idProveedor`, `created_at`, `updated_at`) VALUES (4, '2024-09-21', 'Marcos Parrillas', 115.99, 'Pagado Parcialmente', 2, '2024-09-23 14:24:50', '2024-09-23 14:24:51');
INSERT INTO `facturas` (`id`, `fechaFactura`, `facturador`, `totalFactura`, `estadoFactura`, `idProveedor`, `created_at`, `updated_at`) VALUES (5, '2024-09-23', 'Rocio Salmeron', 15.50, 'Pagado', 1, '2024-09-23 15:23:46', '2024-09-23 15:23:47');

INSERT INTO `pagos` (`id`, `pagoRealizado`, `idFactura`, `created_at`, `updated_at`) VALUES (1, 48.99, 1, '2024-09-23 20:09:58', '2024-09-23 20:09:56');
INSERT INTO `pagos` (`id`, `pagoRealizado`, `idFactura`, `created_at`, `updated_at`) VALUES (2, 100.00, 4, '2024-09-23 20:10:50', '2024-09-23 20:10:52');
