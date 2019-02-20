<?php
/*
Plugin Name: SB Custom Gravity Forms Styles
Plugin URI: https://sbarkin.com
Description: Adds awesome styling to gravity forms
Version: 1.4.0
Author: Alex Patsyk & Shmuel Barkin
Author URI: https://sbarkin.com
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function load_gravity_forms_css()
{
    wp_enqueue_style('custom-gravity-styles', plugin_dir_url(__FILE__) . 'gf_styles.css');
    wp_enqueue_script('script-autosize', plugin_dir_url(__FILE__) . '/js/autosize.js', 'jquery');
    wp_enqueue_script('script-custom', plugin_dir_url(__FILE__) . '/js/main.js', 'jquery');

}

add_action('wp_enqueue_scripts', 'load_gravity_forms_css');

?>