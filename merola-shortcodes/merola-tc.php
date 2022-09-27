<?php
/**
 * @package Merola Shotcodes
 * @version 1.3
 */
/*
Plugin Name: Merola Shotcodes
Plugin URI: #
Description: Merola Custom Shortcodes
Author: Soma Moradi
Version: 1.3
Author URI: #
*/

add_action('admin_head', 'merola_add_my_tc_button');
add_action('admin_enqueue_scripts', 'merola_tc_css');

function merola_add_my_tc_button() {
    global $typenow;
    // sprawdzamy czy user ma uprawnienia do edycji postów/podstron
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
   	return;
    }
    // weryfikujemy typ wpisu
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
	// sprawdzamy czy user ma włączony edytor WYSIWYG
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "merola_add_tinymce_plugin");
		add_filter('mce_buttons', 'merola_register_my_tc_button');
	}
}

function merola_add_tinymce_plugin($plugin_array) {
   	$plugin_array['merola_tc_button'] = plugins_url( '/complex-popup-button.js', __FILE__ ); // CHANGE THE BUTTON SCRIPT HERE
   	return $plugin_array;
}

function merola_register_my_tc_button($buttons) {
   array_push($buttons, "merola_tc_button");
   return $buttons;
}

function merola_tc_css() {
	wp_enqueue_style('merola-tc', plugins_url('/style.css', __FILE__));
}

//Resource shortcode
function tooltip_shortcode( $atts , $content = null ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'title' => 'title',
            'content' => 'content',
        ),
        $atts,
        'tooltip'
    );

    $return_tooltip .= '<div class="tool-tip-wrap"><div class="tool-tip "><span>' . $atts['title'] . '</span><i class="fa fa-question-circle"></i><span class="tool-tiptext">' . $atts['content'] . '</span></div></div>';
    return $return_tooltip;

}
add_shortcode( 'tooltip', 'tooltip_shortcode' );