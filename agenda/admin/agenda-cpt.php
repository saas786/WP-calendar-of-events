<?php
// Add Agenda Post Type
function dfw_register_cpt_agenda(){

    $labels = array( 
        'name' => _x('Agenda', 'agenda'),
        'singular_name' => _x('Agenda', 'agenda'),
        'add_new' => _x('Adicionar novo', 'agenda'),
        'add_new_item' => _x('Adicionar novo Evento', 'agenda'),
        'edit_item' => _x('Editar Evento', 'agenda'),
        'new_item' => _x('Novo Evento', 'agenda'),
        'view_item' => _x('Ver Evento', 'agenda'),
        'search_items' => _x('Procurar Eventos', 'agenda'),
        'not_found' => _x('Nenhum evento foi encontrado', 'agenda'),
        'not_found_in_trash' => _x('Nenhum evento na lixeira', 'agenda'),
        'parent_item_colon' => _x('Evento parente:', 'agenda'),
        'menu_name' => _x('Agenda', 'agenda'),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Agenda de eventos',
        'supports' => array('title', 'editor', 'author', 'thumbnail'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type('agenda', $args);
}
add_action('init', 'dfw_register_cpt_agenda');
?>