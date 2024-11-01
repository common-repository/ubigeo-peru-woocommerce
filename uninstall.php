<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

function kwp_delete_tabla($tabla)
{
    global $wpdb;
    $table_name = $wpdb->prefix . $tabla;

    $sql = "DROP TABLE $table_name";
    $wpdb->query($sql);
}

kwp_delete_tabla("ubigeo_departamento");
kwp_delete_tabla("ubigeo_provincia");
kwp_delete_tabla("ubigeo_distrito");