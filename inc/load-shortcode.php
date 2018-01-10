<?php
/* =================================================================================================== */
function listar_eventos_function($atts=null) {
	
	date_default_timezone_set('America/Sao_Paulo');

	if ($atts) {
		$atts = shortcode_atts(
				array(
					'items' => $atts['items']
				), $atts, 'listar_eventos' );
		$items = $atts['items'];
	} else {
		$items = '-1';
	}


	echo '<ul class="listar-eventos clearfix">';
		$custom_query = new WP_Query( array(
				'post_type'			 => 'evento',
				'posts_per_page'     => $items,
    			'orderby'            => 'dataEvento',
    			'order'              => 'ASC',
			    'meta_query' => [
			    					[
			    					'data' => [
									'key'     => 'dataEvento',
									'value'   => date('Y-m-d H:i'),
									'compare' => '>',
									'type'	  => 'DATETIME' 
										]
									]
			    				]
    		)
		);

			echo '<header>';
				echo '<h1 class="centraliza">Listagem de Eventos</h1>';
			echo '</header>';

			if ( $custom_query->have_posts() ) :

			$i = 1;

			while ( $custom_query->have_posts() ) : $custom_query->the_post();


				$data_evento = new DateTime(get_post_meta(get_the_ID(),"dataEvento", true));
				$data_convertida = $data_evento->format('j/m/Y');
				$horaEvento = new DateTime(get_post_meta(get_the_ID(),"dataEvento", true));
				$hora_convertida = $horaEvento->format('H:i');

				echo '<li class="item_evento clearfix">';
				echo '<div class="titulo_evento">Evento '.$i.':<span>'.get_the_title().'</span></div>';
				echo '<div class="data_evento item_margin">Data:<span>'.$data_convertida.'</span></div>';
				echo '<div class="horario_evento item_margin">Horário:<span>'.$hora_convertida.' hora(s)</span></div>';
				echo '<div class="conteudo_evento">Descrição:<span class="clearfix">'.get_the_content().'</span></div>';
				echo '</li>';

				$i = $i+1;

			endwhile;

		else :

			echo '<h2 class="centraliza">Nenhum evento encontrado.</h2>';

		endif;
	echo '</ul>';
	echo '<small class="footer_plugin clearfix centraliza">Plugin desenvolvido por <span><a href="https://art2web.com.br/sobre/" target="_blank">Daniel Ferraz Ramos</a></span> para o processo seletivo da <span>Globalweb</span>.</small>';
	echo '<div class="copyright clearfix centraliza"><small>© '.date("Y").' Copyright.</small></div>';

    return;
}
add_shortcode('listar_eventos', 'listar_eventos_function');
/* =================================================================================================== */
?>
