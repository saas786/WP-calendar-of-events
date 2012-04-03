<?php
/*
 * Calendar Interface
 * Create by Dreams Factory Web
 * http://www.dreamsfactoryweb.com
 * 
 * version: 1.0
 */

$dfw_agenda_dir = get_template_directory() . '/agenda/';
$dfw_scripts_dir = get_bloginfo('template_url') . '/agenda/';

// Agenda Custom Post Type
require_once ($dfw_agenda_dir . 'admin/agenda-cpt.php');

// Agenda Metabox
require_once ($dfw_agenda_dir . 'admin/agenda-metabox.php');

// Add theme support for post thumbnails
add_theme_support('post-thumbnails');

// Load scripts in back-end
function dfw_agenda_admin_scripts() {
    global $dfw_scripts_dir;
    wp_register_style('agenda-admin', $dfw_scripts_dir . 'css/agenda-admin-styles.css');
    wp_enqueue_style('agenda-admin');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_register_style('jquery-ui-agenda-styles', $dfw_scripts_dir . 'css/agenda-jquery-ui-styles.css');
    wp_enqueue_style('jquery-ui-agenda-styles');
}
add_action('admin_enqueue_scripts', 'dfw_agenda_admin_scripts');

// Load scripts in front-end
function dfw_agenda_front_scripts() {
    global $dfw_scripts_dir;
    wp_enqueue_script('jquery-ui-core');
    wp_register_style('fullcalendar-styles', $dfw_scripts_dir . 'css/fullcalendar.css');
    wp_enqueue_style('fullcalendar-styles');
    wp_register_script('fullcalendar-scripts', $dfw_scripts_dir . 'js/fullcalendar.min.js');
    wp_enqueue_script('fullcalendar-scripts');
}
add_action('wp_enqueue_scripts', 'dfw_agenda_front_scripts');

// Array of valid days
function dfw_agenda_meta_value() {
    
    // Verify transient
    $cache = get_transient('dfw_agenda_meta_value');
    if ($cache != false) return $cache;
    
    // Get the current date
    $dfw_get_year = date('Y');
    $dfw_get_month = date('m');
    $dfw_get_next_month = dfw_agenda_set_zeros($dfw_get_month + 1, 2);
    $dfw_get_next_next_month = dfw_agenda_set_zeros($dfw_get_month + 2, 2);
    $dfw_get_day = date('d');

    $dfw_current_month = '';

    // Creates a string with the remaining days of the month
    for ($dfw_day = $dfw_get_day; $dfw_day <= 31; $dfw_day++) :
        $dfw_current_month .= dfw_agenda_set_zeros($dfw_day, 2) . '/' . $dfw_get_month . '/' . $dfw_get_year . ',';
    endfor;

    // Creates a string with the day of the month following
    for ($dfw_day = 1; $dfw_day <= 31; $dfw_day++) :
        $dfw_current_month .= dfw_agenda_set_zeros($dfw_day, 2) . '/' . $dfw_get_next_month . '/' . $dfw_get_year . ',';
    endfor;

    // Creates a string with the days of one month following
    for ($dfw_day = 1; $dfw_day <= 31; $dfw_day++) :
        $dfw_current_month .= dfw_agenda_set_zeros($dfw_day, 2) . '/' . $dfw_get_next_next_month . '/' . $dfw_get_year . ',';
    endfor;

    // Remove last character from string 
    $dfw_date_final_string = substr($dfw_current_month, 0 , -1);

    // Creates an array
    $dfw_agenda_meta_value = explode(',', $dfw_date_final_string);
    
    // Save Transient
    $cache = $dfw_agenda_meta_value;
    set_transient('dfw_agenda_meta_value', $cache, 60*60*24);
}

// Clear cache to publish ou edit post
function dfw_clear_agenda_cache(){
    delete_transient('dfw_agenda_meta_value');
}
add_action('publish_post', 'dfw_clear_agenda_cache');
?>