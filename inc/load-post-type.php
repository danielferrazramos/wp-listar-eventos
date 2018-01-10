<?php
// Register Custom Post Type

function custom_post_type_evento() {

    $labels = array(
        'name'                => _x( 'Eventos', 'Post Type General Name', '' ),
        'singular_name'       => _x( 'Evento', 'Post Type Singular Name', '' ),
        'menu_name'           => __( 'Eventos', '' ),
        'name_admin_bar'      => __( 'Eventos', '' ),
        'parent_item_colon'   => __( 'Categoria Pai:', '' ),
        'all_items'           => __( 'Todos os Eventos', '' ),
        'add_new_item'        => __( 'Adicionar', '' ),
        'add_new'             => __( 'Novo', '' ),
        'new_item'            => __( 'Novo', '' ),
        'edit_item'           => __( 'Editar', '' ),
        'update_item'         => __( 'Atualizar', '' ),
        'view_item'           => __( 'Visualizar', '' ),
        'search_items'        => __( 'Buscar', '' ),
        'not_found'           => __( 'Não encontrado', '' ),
        'not_found_in_trash'  => __( 'Não encontrado na Lixeira', '' ),
    );
    $args = array(
        'label'               => __( 'Eventos', '' ),
        'description'         => __( 'Eventos', '' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes', ),
        'taxonomies'          => array( 'evento-categoria', 'evento-tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-calendar-alt',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'evento', $args );

}
add_action( 'init', 'custom_post_type_evento', 0 );
/* =================================================================================================== */
// Register Custom Taxonomy
function Categoria_Evento() {

    $labels = array(
        'name'                       => _x( 'Categorias de Eventos', 'Taxonomy General Name', '' ),
        'singular_name'              => _x( 'Categoria', 'Taxonomy Singular Name', '' ),
        'menu_name'                  => __( 'Categorias', '' ),
        'all_items'                  => __( 'Todos', '' ),
        'parent_item'                => __( 'Categoria Pai', '' ),
        'parent_item_colon'          => __( 'Categoria Pai:', '' ),
        'new_item_name'              => __( 'Novo', '' ),
        'add_new_item'               => __( 'Adicionar', '' ),
        'edit_item'                  => __( 'Editar', '' ),
        'update_item'                => __( 'Atualizar', '' ),
        'view_item'                  => __( 'Visualizar', '' ),
        'separate_items_with_commas' => __( 'Separe itens por vírgula', '' ),
        'add_or_remove_items'        => __( 'Adicionar ou remover itens', '' ),
        'choose_from_most_used'      => __( 'Escolha entre os mais usados', '' ),
        'popular_items'              => __( 'Mais populares', '' ),
        'search_items'               => __( 'Buscados', '' ),
        'not_found'                  => __( 'Não encontrado', '' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'evento-categoria', array( 'evento' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'Categoria_Evento', 0 );
/* =================================================================================================== */
// Register Custom Taxonomy
function Tags_Evento() {

    $labels = array(
        'name'                       => _x( 'Tags de Eventos', 'Taxonomy General Name', '' ),
        'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', '' ),
        'menu_name'                  => __( 'Tag', '' ),
        'all_items'                  => __( 'Todos', '' ),
        'parent_item'                => __( 'Categoria Pai', '' ),
        'parent_item_colon'          => __( 'Categoria Pai:', '' ),
        'new_item_name'              => __( 'Novo', '' ),
        'add_new_item'               => __( 'Adicionar', '' ),
        'edit_item'                  => __( 'Editar', '' ),
        'update_item'                => __( 'Atualizar', '' ),
        'view_item'                  => __( 'Visualizar', '' ),
        'separate_items_with_commas' => __( 'Separe itens por vírgula', '' ),
        'add_or_remove_items'        => __( 'Adicionar ou remover itens', '' ),
        'choose_from_most_used'      => __( 'Escolha entre os mais usados', '' ),
        'popular_items'              => __( 'Mais populares', '' ),
        'search_items'               => __( 'Buscados', '' ),
        'not_found'                  => __( 'Não encontrado', '' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'evento-tag', array( 'evento' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'Tags_Evento', 0 );/*
/* =================================================================================================== */

function custom_meta_box_eventos_data() {
   add_meta_box(
       'custom_meta_box_eventos_data',
       'Data e Horário do Evento',
       'custom_meta_field_eventos_data',
       'evento',
       'advanced',
       'high'
   );
}

add_action('add_meta_boxes', 'custom_meta_box_eventos_data');

function custom_meta_field_eventos_data($object) {
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'eventos_our_nonce' );
    echo '<p><label for="dataEvento">Informe a data e horário em que ocorrerá a realização do evento:</label></p>';
    echo '<input style="text-align:center;" type="datetime-local" name="dataEvento" value="'.get_post_meta($object->ID, "dataEvento", true).'" required="required">';
}

add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});


function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["eventos_our_nonce"]) || !wp_verify_nonce($_POST["eventos_our_nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "evento";
    if($slug != $post->post_type)
        return $post_id;

    $dataEvento = "";

    if(isset($_POST["dataEvento"]))
    {
        $dataEvento = $_POST["dataEvento"];
    }   
    update_post_meta($post_id, "dataEvento", $dataEvento);
}

add_action("save_post", "save_custom_meta_box", 10, 3);