<?php

function kwp_crearDepartamento()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_departamento";

    $sql = "CREATE TABLE $table_name (
            idDepa int(5) NOT NULL DEFAULT '0',
            departamento varchar(50) DEFAULT NULL,
            PRIMARY KEY (`idDepa`)
            )ENGINE=MyISAM DEFAULT CHARSET=utf8; ";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    kwp_carga_datos_departamentos();
}

function kwp_carga_datos_departamentos()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_departamento";
    $sql = " INSERT INTO $table_name (`idDepa`, `departamento`) VALUES
            (1, 'AMAZONAS'),
            (2, 'ANCASH'),
            (3, 'APURIMAC'),
            (4, 'AREQUIPA'),
            (5, 'AYACUCHO'),
            (6, 'CAJAMARCA'),
            (7, 'CALLAO'),
            (8, 'CUSCO'),
            (9, 'HUANCAVELICA'),
            (10, 'HUANUCO'),
            (11, 'ICA'),
            (12, 'JUNIN'),
            (13, 'LA LIBERTAD'),
            (14, 'LAMBAYEQUE'),
            (15, 'LIMA'),
            (16, 'LORETO'),
            (17, 'MADRE DE DIOS'),
            (18, 'MOQUEGUA'),
            (19, 'PASCO'),
            (20, 'PIURA'),
            (21, 'PUNO'),
            (22, 'SAN MARTIN'),
            (23, 'TACNA'),
            (24, 'TUMBES'),
            (25, 'UCAYALI'); ";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
