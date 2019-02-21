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

add_action( 'admin_menu', 'extra_styling_menu' );

if( !function_exists("extra_styling_menu") )
{
  function extra_styling_menu(){

    $page_title = 'GF Styling';
    $menu_title = 'GF Styling';
    $capability = 'manage_options';
    $menu_slug  = 'extra-styling';
    $function   = 'extra_styling_page';
    $icon_url   = 'dashicons-media-code';

    add_menu_page( $page_title,
                   $menu_title, 
                   $capability, 
                   $menu_slug, 
                   $function, 
                   $icon_url);
    add_action( 'admin_init', 'update_extra_styling' );
  }
}

if( !function_exists("extra_styling_page") )
{
  function extra_styling_page(){
  ?>
    <h1>Extra styling</h1>
    <form method="post" action="options.php">
      <?php settings_fields( 'extra-styling-settings' ); ?>
      <?php do_settings_sections( 'extra-styling-settings' ); ?>
      <table class="form-table">
        <tr valign="top">
          <td>Font color:</td>
          <td>
            <input type="text" name="font_color" value="<?php echo get_option('font_color'); ?>"/>
            <em>Accepts values: 'red' or '#458692'</em>
          </td>
        </tr>

        <tr valign="top">
          <td >Font family url:</td>
          <td>
            <input type="text" name="font_family_url" value="<?php echo get_option('font_family_url'); ?>"/>
            <em>Accepts url: 'https://fonts.googleapis.com/css?family=Lato'</em>
          </td>
        </tr>

        <tr valign="top">
          <td >Font family name:</td>
          <td>
            <input type="text" name="font_family_name" value="<?php echo get_option('font_family_name'); ?>"/>
            <em>Accepts font name: eg. 'Lato'</em>
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>

  <?php
  }
}

if( !function_exists("update_extra_styling") )
{
  function update_extra_styling() {
    register_setting( 'extra-styling-settings', 'font_color' );
    register_setting( 'extra-styling-settings', 'font_family_url' );
    register_setting( 'extra-styling-settings', 'font_family_name' );
  }
}



function load_gravity_forms_css() {
  wp_enqueue_style( 'custom-gravity-styles', plugin_dir_url(__FILE__) . 'css/gf_styles.css' );
  $color = get_option('font_color');
  $font_family_url = get_option('font_family_url');
  $font_family_name = get_option('font_family_name');
  $custom_css = "
    @import url('{$font_family_url}');
    
    /* General styles for fields */
    body .gform_wrapper {
      font-family: {$font_family_name}, Helvetica, Arial, sans-serif;
    }

    body .gform_wrapper .gform_heading,
    body .gform_wrapper .gform_footer {
      /*padding-left: 17px;*/
      padding-right: 17px;
    }

    body .gform_wrapper .gform_heading h3 {
      font-family: {$font_family_name}, Helvetica, Arial, sans-serif;
      font-size: 34px;
      color: #222;
      font-weight: 400;
    }

    body .gform_wrapper input[type=text]:focus,
    body .gform_wrapper input[type=password]:focus,
    body .gform_wrapper input[type=tel]:focus,
    body .gform_wrapper input[type=email]:focus,
    body .gform_wrapper input.text:focus,
    body .gform_wrapper input.title:focus,
    body .gform_wrapper select:focus,
    body .gform_wrapper textarea:focus {
      box-shadow: 0 2px 0 {$color} !important;
      border-color: {$color} !important;
    }

    body .gform_wrapper .gform_footer input.button,
    body .gform_wrapper .gform_footer input[type=submit],
    body .gform_wrapper .gform_page_footer input.button,
    body .gform_wrapper .gform_page_footer input[type=submit] {
      color: #ffffff;
      background: {$color} url(../images/arrow-right.svg) no-repeat 50% 55%;
      font-size: 20px;
      border: none;
      padding: 0 1em !important;
      line-height: 45px;
      height: 45px;
      border-radius: 2px;
      cursor: pointer;
      -webkit-transition: all 0.3s;
      -moz-transition: all 0.3s;
      transition: all 0.3s;
      position: relative;
    }

    body .gform_wrapper .gform_footer input.button:hover,
    body .gform_wrapper .gform_footer input[type=submit]:hover,
    body .gform_wrapper .gform_page_footer input.button:hover,
    body .gform_wrapper .gform_page_footer input[type=submit]:hover {
      padding-left: 0.7em !important;
      padding-right: 2em !important;
      /*box-shadow: 0 0 0 2px {$color};*/
      background: url(../images/arrow-right-white.svg) 90% 50%;
    }

    body .gform_wrapper ul.gfield_radio li label:after {
      width: 7px;
      height: 7px;
      left: 4px;
      top: 9px;
      border-radius: 4px;
      background: {$color};
      opacity: 0;
    }
  ";
  wp_add_inline_style( 'custom-gravity-styles', $custom_css );
  wp_enqueue_script( 'script-autosize', plugin_dir_url(__FILE__) . '/js/autosize.js', 'jquery' );
  wp_enqueue_script( 'script-custom', plugin_dir_url(__FILE__) . '/js/main.js', 'jquery' );

}
add_action( 'wp_enqueue_scripts', 'load_gravity_forms_css' );

?>