<?php
	function wp_listar_eventos_assets_init() {
		if (!is_admin()) {
			function wp_listar_eventos_styles() {
				wp_enqueue_style( 'wp-listar-eventos-styles', WPLISTAREVENTOS_PLUGIN_URL . '/inc/assets/css/styles.css?'.time() );
			}
			add_action( 'wp_enqueue_scripts', 'wp_listar_eventos_styles', 99 );
		}
}
add_action('init', 'wp_listar_eventos_assets_init');
?>
