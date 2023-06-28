Tabla programas
---------------
INSERT INTO `programas` (`id`, `codigo`, `descripcion`, `created_at`, `updated_at`) VALUES (NULL, 'PPP', 'Programa Puntos de Prueba', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

Tabla personas
--------------
INSERT INTO `personas` (`id`, `nif`, `nombre`, `apellidos`, `direccion`, `email`, `tarjeta`, `created_at`, `updated_at`) VALUES (NULL, '10000001A', 'Margaret', 'Rose', 'Av. Pignarelli, 56', 'margaret@mail.com', '1234567890123456', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

Tabla cuentas
-------------
INSERT INTO `cuentas` (`id`, `entidad`, `oficina`, `dc`, `cuenta`, `programa`, `extracto`, `renuncia`, `saldo`, `fechaextracto`, `created_at`, `updated_at`, `persona_id`) VALUES (NULL, '0001', '0200', '10', '0200123456', 'PPP', '0', '0', '0', '2021-11-16', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '55');

Tabla movimientos
-----------------
INSERT INTO `movimientos` (`id`, `fecha`, `operacion`, `concepto`, `puntos`, `saldomov`, `tarjeta`, `localizador`, `comercio`, `comentarios`, `created_at`, `updated_at`, `cuenta_id`) VALUES (NULL, '2021-11-16', 'A', 'Compra en Comercio On-Line', '100', '100', '1234567890123456', 'AA233EE', 'El Libro Feliz', 'Pendiente de verificación', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '8');