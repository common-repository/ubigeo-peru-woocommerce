<?php

function kwp_crearProvincia()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_provincia";

    $sql = " CREATE TABLE $table_name (
          `idProv` int(5) NOT NULL DEFAULT '0',
          `provincia` varchar(50) DEFAULT NULL,
          `idDepa` int(5) DEFAULT NULL,
          PRIMARY KEY (`idProv`)
          )ENGINE=MyISAM DEFAULT CHARSET=utf8;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    kwp_cargaDatosProvinciasUno();
    kwp_cargaDatosProvinciasDos();
    kwp_cargaDatosProvinciasTres();
}

function kwp_cargaDatosProvinciasUno()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_provincia";
    $sql = " INSERT INTO $table_name (`idProv`, `provincia`, `idDepa`) VALUES
              (1, 'CHACHAPOYAS ', 1),
              (2, 'BAGUA', 1),
              (3, 'BONGARA', 1),(4, 'CONDORCANQUI', 1),
              (5, 'LUYA', 1),
              (6, 'RODRIGUEZ DE MENDOZA', 1),
              (7, 'UTCUBAMBA', 1),
              (8, 'HUARAZ', 2),
              (9, 'AIJA', 2),
              (10, 'ANTONIO RAYMONDI', 2),
              (11, 'ASUNCION', 2),
              (12, 'BOLOGNESI', 2),
              (13, 'CARHUAZ', 2),
              (14, 'CARLOS FERMIN FITZCARRALD', 2),
              (15, 'CASMA', 2),
              (16, 'CORONGO', 2),
              (17, 'HUARI', 2),
              (18, 'HUARMEY', 2),
              (19, 'HUAYLAS', 2),
              (20, 'MARISCAL LUZURIAGA', 2),
              (21, 'OCROS', 2),
              (22, 'PALLASCA', 2),
              (23, 'POMABAMBA', 2),
              (24, 'RECUAY', 2),
              (25, 'SANTA', 2),
              (26, 'SIHUAS', 2),
              (27, 'YUNGAY', 2),
              (28, 'ABANCAY', 3),
              (29, 'ANDAHUAYLAS', 3),
              (30, 'ANTABAMBA', 3),
              (31, 'AYMARAES', 3),
              (32, 'COTABAMBAS', 3),
              (33, 'CHINCHEROS', 3),
              (34, 'GRAU', 3),
              (35, 'AREQUIPA', 4),
              (36, 'CAMANA', 4),
              (37, 'CARAVELI', 4),
              (38, 'CASTILLA', 4),
              (39, 'CAYLLOMA', 4),
              (40, 'CONDESUYOS', 4),
              (41, 'ISLAY', 4),
              (42, 'LA UNION', 4),
              (43, 'HUAMANGA', 5),
              (44, 'CANGALLO', 5),
              (45, 'HUANCA SANCOS', 5),
              (46, 'HUANTA', 5),
              (47, 'LA MAR', 5),
              (48, 'LUCANAS', 5),
              (49, 'PARINACOCHAS', 5),
              (50, 'PAUCAR DEL SARA SARA', 5),
              (51, 'SUCRE', 5),
              (52, 'VICTOR FAJARDO', 5),
              (53, 'VILCAS HUAMAN', 5),
              (54, 'CAJAMARCA', 6),
              (55, 'CAJABAMBA', 6),
              (56, 'CELENDIN', 6),
              (57, 'CHOTA ', 6),
              (58, 'CONTUMAZA', 6),
              (59, 'CUTERVO', 6),
              (60, 'HUALGAYOC', 6),
              (61, 'JAEN', 6),
              (62, 'SAN IGNACIO', 6),
              (63, 'SAN MARCOS', 6),(64, 'SAN PABLO', 6),
              (65, 'SANTA CRUZ', 6),
              (66, 'CALLAO', 7),
              (67, 'CUSCO', 8),
              (68, 'ACOMAYO', 8),
              (69, 'ANTA', 8),
              (70, 'CALCA', 8),
              (71, 'CANAS', 8),
              (72, 'CANCHIS', 8),
              (73, 'CHUMBIVILCAS', 8),
              (74, 'ESPINAR', 8),
              (75, 'LA CONVENCION', 8),
              (76, 'PARURO', 8),
              (77, 'PAUCARTAMBO', 8),
              (78, 'QUISPICANCHI', 8),
              (79, 'URUBAMBA', 8),
              (80, 'HUANCAVELICA', 9);";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function kwp_cargaDatosProvinciasDos()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_provincia";
    $sql = " INSERT INTO $table_name (`idProv`, `provincia`, `idDepa`) VALUES
              (81, 'ACOBAMBA', 9),
              (82, 'ANGARAES', 9),
              (83, 'CASTROVIRREYNA', 9),
              (84, 'CHURCAMPA', 9),
              (85, 'HUAYTARA', 9),
              (86, 'TAYACAJA', 9),
              (87, 'HUANUCO', 10),
              (88, 'AMBO', 10),
              (89, 'DOS DE MAYO', 10),
              (90, 'HUACAYBAMBA', 10),
              (91, 'HUAMALIES', 10),
              (92, 'LEONCIO PRADO', 10),
              (93, 'MARAÑON', 10),
              (94, 'PACHITEA', 10),
              (95, 'PUERTO INCA', 10),
              (96, 'LAURICOCHA', 10),
              (97, 'YAROWILCA', 10),
              (98, 'ICA', 11),
              (99, 'CHINCHA', 11),
              (100, 'NAZCA', 11),
              (101, 'PALPA', 11),
              (102, 'PISCO', 11),
              (103, 'HUANCAYO', 12),
              (104, 'CONCEPCION', 12),
              (105, 'CHANCHAMAYO', 12),
              (106, 'JAUJA', 12),
              (107, 'JUNIN', 12),
              (108, 'SATIPO', 12),
              (109, 'TARMA', 12),
              (110, 'YAULI', 12),
              (111, 'CHUPACA', 12),
              (112, 'TRUJILLO', 13),
              (113, 'ASCOPE', 13),
              (114, 'BOLIVAR', 13),
              (115, 'CHEPEN', 13),
              (116, 'JULCAN', 13),
              (117, 'OTUZCO', 13),
              (118, 'PACASMAYO', 13),
              (119, 'PATAZ', 13),
              (120, 'SANCHEZ CARRION', 13),
              (121, 'SANTIAGO DE CHUCO', 13),
              (122, 'GRAN CHIMU', 13),
              (123, 'VIRU', 13),
              (124, 'CHICLAYO', 14),
              (125, 'FERREÑAFE', 14),
              (126, 'LAMBAYEQUE', 14),
              (127, 'LIMA', 15),
              (128, 'BARRANCA', 15),
              (129, 'CAJATAMBO', 15),
              (130, 'CANTA', 15),
              (131, 'CAÑETE', 15),
              (132, 'HUARAL', 15),
              (133, 'HUAROCHIRI', 15),
              (134, 'HUAURA', 15),
              (135, 'OYON', 15),
              (136, 'YAUYOS', 15),
              (137, 'MAYNAS', 16),
              (138, 'ALTO AMAZONAS', 16),
              (139, 'LORETO', 16),
              (140, 'MARISCAL RAMON CASTILLA', 16),
              (141, 'REQUENA', 16),
              (142, 'UCAYALI', 16),
              (143, 'TAMBOPATA', 17),
              (144, 'MANU', 17),
              (145, 'TAHUAMANU', 17),
              (146, 'MARISCAL NIETO', 18),
              (147, 'GENERAL SANCHEZ CERRO', 18),
              (148, 'ILO', 18),
              (149, 'PASCO', 19),
              (150, 'DANIEL ALCIDES CARRION', 19),
              (151, 'OXAPAMPA', 19),
              (152, 'PIURA', 20),
              (153, 'AYABACA', 20),
              (154, 'HUANCABAMBA', 20),
              (155, 'MORROPON', 20),
              (156, 'PAITA', 20),
              (157, 'SULLANA', 20),
              (158, 'TALARA', 20),
              (159, 'SECHURA', 20),
              (160, 'PUNO', 21);";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function kwp_cargaDatosProvinciasTres()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_provincia";
    $sql = " INSERT INTO $table_name (`idProv`, `provincia`, `idDepa`) VALUES
              (161, 'AZANGARO', 21),
              (162, 'CARABAYA', 21),
              (163, 'CHUCUITO', 21),
              (164, 'EL COLLAO', 21),
              (165, 'HUANCANE', 21),
              (166, 'LAMPA', 21),
              (167, 'MELGAR', 21),
              (168, 'MOHO', 21),
              (169, 'SAN ANTONIO DE PUTINA', 21),
              (170, 'SAN ROMAN', 21),
              (171, 'SANDIA', 21),
              (172, 'YUNGUYO', 21),
              (173, 'MOYOBAMBA', 22),
              (174, 'BELLAVISTA', 22),
              (175, 'EL DORADO', 22),
              (176, 'HUALLAGA', 22),
              (177, 'LAMAS', 22),
              (178, 'MARISCAL CACERES', 22),
              (179, 'PICOTA', 22),
              (180, 'RIOJA', 22),
              (181, 'SAN MARTIN', 22),
              (182, 'TOCACHE', 22),
              (183, 'TACNA', 23),
              (184, 'CANDARAVE', 23),
              (185, 'JORGE BASADRE', 23),
              (186, 'TARATA', 23),
              (187, 'TUMBES', 24),
              (188, 'CONTRALMIRANTE VILLAR', 24),
              (189, 'ZARUMILLA', 24),
              (190, 'CORONEL PORTILLO', 25),
              (191, 'ATALAYA', 25),
              (192, 'PADRE ABAD', 25),
              (193, 'PURUS', 25);";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
