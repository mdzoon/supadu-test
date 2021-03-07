<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'twenty-twenty-one-style','twenty-twenty-one-style','twenty-twenty-one-print-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

/**
 * Register custom scripts
 */
function add_custom_scripts() {
    wp_register_script('custom_script', get_stylesheet_directory_uri() . '/assets/js/custom_script.js', array('jquery'),'1.1', true);
    wp_enqueue_script('custom_script');
} 
add_action( 'wp_enqueue_scripts', 'add_custom_scripts' );  

/**
 * Enable dashicons on the front-end
 */
add_action('wp_enqueue_scripts', 'dashicons_enqueue_scripts');
function dashicons_enqueue_scripts() {
  if (!is_admin()) {
    wp_enqueue_style('dashicons');
  }
}