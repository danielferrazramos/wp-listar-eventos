<?php
/*------------------------------------------------------------------------------------------------------------------
Plugin Name: WP Listar Eventos
Description: Plugin para listar eventos. Desenvolvido para o processo seletivo da Globalweb.
Version: 1.0.0
Author: Daniel Ferraz Ramos
Author URI: http://art2web.com.br
---------------------------------------------------------------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Sair se for acessado diretamente.
}

define('WPLISTAREVENTOS_PLUGIN_URL', plugins_url('', __FILE__));
define('WPLISTAREVENTOS_PLUGIN_DIR', plugin_dir_path(__FILE__));

	require_once( WPLISTAREVENTOS_PLUGIN_DIR . '/inc/load-post-type.php');
	require_once( WPLISTAREVENTOS_PLUGIN_DIR . '/inc/load-shortcode.php');
	require_once( WPLISTAREVENTOS_PLUGIN_DIR . '/inc/load-assets.php');
?>
