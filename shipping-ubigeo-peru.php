<?php

/**
 * Plugin Name: Envios Ubigeo Perú
 * Description: Complemento para mostrar departamentos, provincias, distritos del Perú.
 * Requires at least: 5.2
 * Tested up to: 5.8
 * Requires PHP: 7.0
 * Version: 1.1
 * Author: Miguel Fuentes
 * Plugin URI: https://kodewp.com
 * Author URI: https://kodewp.com/
 * Text Domain: shipping-ubigeo-peru
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

require __DIR__ . '/includes/departamentos.php';
require __DIR__ . '/includes/provincias.php';
require __DIR__ . '/includes/distritos.php';
require __DIR__ . '/includes/checkout.php';

function kwp_ubigeo_install()
{
    global $wpdb;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta("DROP TABLE IF EXISTS " . $wpdb->prefix . "ubigeo_distrito");
    dbDelta("DROP TABLE IF EXISTS " . $wpdb->prefix . "ubigeo_provincia");
    dbDelta("DROP TABLE IF EXISTS " . $wpdb->prefix . "ubigeo_departamento");

    //crear departamentos
    kwp_crearDepartamento();
    //crear provincia
    kwp_crearProvincia();
    //crear distrito
    kwp_crearDistrito();
}

register_activation_hook(__FILE__, 'kwp_ubigeo_install');

//obtener todo los departamento
function kwp_get_departamento()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_departamento";
    $request = "SELECT * FROM $table_name";
    return $wpdb->get_results($request, ARRAY_A);
}
//obtener el departamento por su idDepa
function kwp_get_departamento_by_idDepa($idDepa = 0)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_departamento";
    $request = "SELECT * FROM $table_name  where idDepa = $idDepa";
    $dto = $wpdb->get_results($request, ARRAY_A);
    return $dto[0]['departamento'];
}
//obtener las provincias por idDepa
function kwp_get_provincia_by_idDepa($idDepa = 0)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_provincia";
    $request = "SELECT * FROM $table_name where idDepa = $idDepa";
    return $wpdb->get_results($request, ARRAY_A);
}
//obtener provincia por idProv
function kwp_get_provincia_by_idProv($idProv = 0)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_provincia";
    $request = "SELECT * FROM $table_name where idProv = $idProv";
    $idProv = $wpdb->get_results($request, ARRAY_A);
    return $idProv[0]['provincia'];
}
//obtener distrito por idProv
function kwp_get_distrito_by_idProv($idProv = 0)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_distrito";
    $request = "SELECT * FROM $table_name where idProv = $idProv";
    return $wpdb->get_results($request, ARRAY_A);
}
//obtener distrito por idDist
function kwp_get_distrito_by_idDist($idDist = 0)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_distrito";
    $request = "SELECT * FROM $table_name where idDist = $idDist";
    $dist = $wpdb->get_results($request, ARRAY_A);
    return $dist[0]['distrito'];
}

/********* ubigeo datos*************/

function kwp_get_distrito_by_idProv_filtered($idProv = 0) {
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_distrito";
    $table_precios_name = $wpdb->prefix . "ubigeo_distrito_precio";
    $request = "SELECT * FROM $table_name where idProv = $idProv and idDist in ( select idDist from $table_precios_name)";
    return $wpdb->get_results($request,ARRAY_A);
}

function kwp_get_provincia_by_idDepaFiltered($idDepa = 0) {
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_provincia";
	$table_distrito_name = $wpdb->prefix . "ubigeo_distrito";
    $table_precios_name = $wpdb->prefix . "ubigeo_distrito_precio";
    $request = "SELECT * FROM $table_name where idDepa = $idDepa and idProv in (
	select a.idProv from $table_distrito_name a join $table_precios_name b on(a.idDist = b.idDist)
	)";
    return $wpdb->get_results($request,ARRAY_A);
}

function kwp_plugin_precios_enabled() {
    if (in_array('shipping-ubigeo-peru-precios/shipping-ubigeo-peru-precios.php', (array) get_option('active_plugins', array()))) {
        return true;
    }

    return false;
}

function kwp_get_departamento_filtered() {
    global $wpdb;
    $table_name = $wpdb->prefix . "ubigeo_departamento";
    $table_provincia_name = $wpdb->prefix . "ubigeo_provincia";
	$table_distrito_name = $wpdb->prefix . "ubigeo_distrito";
    //$table_precios_name = $wpdb->prefix . "ubigeo_distrito_precio";
    //$request = "SELECT * FROM $table_name where idDepa in (
	//select c.idDepa from $table_provincia_name c join $table_distrito_name a on(c.idProv = a.idProv) join $table_precios_name b on(a.idDist = b.idDist)
    //)";
    $request = "SELECT * FROM $table_name where idDepa in (
        select c.idDepa from $table_provincia_name c join $table_distrito_name a on(c.idProv = a.idProv)
        )";
    return $wpdb->get_results($request,ARRAY_A);
}

function kwp_get_departamentos_for_select() {
	$dptos = [
		'' => 'Seleccionar Departamento'
	];
    $enabledZones = [];
    if (in_array('shipping-ubigeo-peru-precios/shipping-ubigeo-peru-precios.php', (array) get_option('active_plugins', array()))) {
        // Stop activation redirect and show error
        $option = get_option('kwp_zone_list_disabled', '');
        if (empty($option)) {
            $enabledZones = [];
        } else {
            $enabledZones = explode(',', $option);
        }
    }
    
    if (!kwp_plugin_precios_enabled()) {
        $departamentoList = kwp_get_departamento();
    }/* elseif (kwp_is_prices_empty()) {
        $departamentoList = kwp_get_departamento();
    }*/ else {
        $departamentoList = kwp_get_departamento_filtered();
    }
	
	if(empty($enabledZones) || count($enabledZones) >= 25){
		foreach ($departamentoList as $dpto) {
			$dptos[$dpto['idDepa']] = $dpto['departamento'];
		}
	}else{
		foreach ($departamentoList as $dpto) {
			if(in_array((int)$dpto['idDepa'],$enabledZones)){
				$dptos[$dpto['idDepa']] = $dpto['departamento'];
			}
		}
	}

	return $dptos;
}

function kwp_is_prices_empty(){
	global $wpdb;
    $table_precios_name = $wpdb->prefix . "ubigeo_distrito_precio";
    $request = "select count(*) as cantidad from $table_precios_name";
	$result = $wpdb->get_results($request,ARRAY_A);
	
	$count = (int)$result[0]['cantidad'];
    
	return ($count == 0);
}

function kwp_is_prices_empty_for_departamento($idDepa){
	global $wpdb;
    $table_precios_name = $wpdb->prefix . "ubigeo_distrito_precio";
    $request = "select count(*) as cantidad from $table_precios_name p
                inner join " . $wpdb->prefix . "ubigeo_distrito ud on ud.idDist = p.idDist
                inner join " . $wpdb->prefix . "ubigeo_provincia up on up.idProv = ud.idProv
                where up.idDepa = " . intval($idDepa);
	$result = $wpdb->get_results($request,ARRAY_A);
	
	$count = (int)$result[0]['cantidad'];
    
	return ($count == 0);
}

function kwp_is_prices_empty_for_provincia($idProv){
	global $wpdb;
    $table_precios_name = $wpdb->prefix . "ubigeo_distrito_precio";
    $request = "select count(*) as cantidad from $table_precios_name p
                inner join " . $wpdb->prefix . "ubigeo_distrito ud on ud.idDist = p.idDist
                where ud.idProv = " . intval($idProv);
	$result = $wpdb->get_results($request,ARRAY_A);
	
	$count = (int)$result[0]['cantidad'];
    
	return ($count == 0);
}

function kwp_get_distrito_data ($idDist) {
    $idDist = intval($idDist);

    global $wpdb;
    $table_departamento = $wpdb->prefix . "ubigeo_departamento";
    $table_provincia = $wpdb->prefix . "ubigeo_provincia";
    $table_distrito = $wpdb->prefix . "ubigeo_distrito";

    $sql = "SELECT de.idDepa, de.departamento, pr.idProv, pr.provincia, di.idDist, di.distrito FROM $table_departamento de
            INNER JOIN $table_provincia pr ON pr.idDepa = de.idDepa
            INNER JOIN $table_distrito di ON di.idProv = pr.idProv
            WHERE di.idDist = $idDist";
    
    $row = $wpdb->get_row($sql, ARRAY_A);
    if ($row)   return $row;
    return null;
}

add_action( 'wp_ajax_kwp_load_provincias_front', 'kwp_load_provincias_front' );
add_action( 'wp_ajax_nopriv_kwp_load_provincias_front', 'kwp_load_provincias_front' );
function kwp_load_provincias_front() {
	$idDepa = isset($_POST['idDepa']) ? $_POST['idDepa'] : null;

	$response = [];
	if (is_numeric($idDepa)) {
        if (!kwp_plugin_precios_enabled()) {
            $provincias = kwp_get_provincia_by_idDepa($idDepa);
        } elseif (kwp_is_prices_empty_for_departamento($idDepa)) {
            $provincias = kwp_get_provincia_by_idDepa($idDepa);
        } else {
            $provincias = kwp_get_provincia_by_idDepaFiltered($idDepa);
        }

		foreach ($provincias as $provincia) {
			$response[$provincia['idProv']] = $provincia['provincia'];
		}
	}

	echo json_encode($response);
	wp_die();
}

add_action( 'wp_ajax_kwp_load_distritos_front', 'kwp_load_distritos_front' );
add_action( 'wp_ajax_nopriv_kwp_load_distritos_front', 'kwp_load_distritos_front' );
function kwp_load_distritos_front() {
	$idProv = isset($_POST['idProv']) ? $_POST['idProv'] : null;

	$response = [];
	if (is_numeric($idProv)) {
        if (!kwp_plugin_precios_enabled()) {
            $distritos = kwp_get_distrito_by_idProv($idProv);
        } elseif (kwp_is_prices_empty_for_provincia($idProv)) {
            $distritos = kwp_get_distrito_by_idProv($idProv);
        } else {
            $distritos = kwp_get_distrito_by_idProv_filtered($idProv);
        }

		foreach ($distritos as $distrito) {
			$response[$distrito['idDist']] = $distrito['distrito'];
		}
	}

	echo json_encode($response);
	wp_die();
}