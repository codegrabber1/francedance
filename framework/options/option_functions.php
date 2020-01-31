<?php
/**
* The Theme Option Functions page
*
* This page is implemented using the Settings API.
*
* @package  codegraber
* @file     option_functions.php
* @author   codegramcwer [Oleg Poruchenko]
* @link    [makecodework@gmail.com]
*/

$options = get_option( 'mcw_options' );

/*
 * ==================
 * Set the animations.
 * ==================
*/
//function makecodework_animate_css() {
//	$options = get_option('mcw_options');
//	$show_animation = $options['mcw_enable_animation'];
//
//	if( !empty($show_animation) ){
//		wp_enqueue_style( 'mcw-animatecss', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css' );
//		wp_enqueue_script( 'mcw-wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array( 'jquery' ), '20151215', true );
//	}
//}
//add_action( 'wp_enqueue_scripts', 'makecodework_animate_css' );

/*
 * ==================
 * Set custom CSS styles
 * ==================
*/
function mcw_custom_styles(){
	$options = get_option( 'mcw_options' );
	$mcw_custom_style = '';
	wp_enqueue_style( 'style', get_template_directory_uri().'style.css' );
	$mcw_topheader_color = $options['mcw_topheader_color'];
	$mcw_links_color = $options['mcw_links_color'];

	if( !empty( $mcw_topheader_color ) ) {
		$mcw_custom_style .= "nav, input[type='submit']{\n background-color: $mcw_topheader_color;\n}\n\n";
		$mcw_custom_style .= ".block_lstart, .s_title {\n border-bottom: 2px solid $mcw_topheader_color;\n}\n\n";
		$mcw_custom_style .= ".widget h3{\n border-bottom: 1px solid $mcw_topheader_color;\n }\n\n";
		$mcw_custom_style .= ".widget h3, .entry-title{\n border-left: 5px solid $mcw_topheader_color;\n}\n\n";
		$mcw_custom_style .= ".widget h3::after{\n border-left: 9px solid $mcw_topheader_color;\n}\n\n";
		$mcw_custom_style .= ".related-posts{\n border-top: 1px solid $mcw_topheader_color;\n}\n\n";
		$mcw_custom_style .= ".owl-nav .owl-next::after, .owl-nav .owl-prev::after {\n color: $mcw_topheader_color;\n}\n\n";
		$mcw_custom_style .= ".mainBlock .owl-dots .owl-dot.active {\n background: $mcw_topheader_color;\n}\n\n";

	}

	if( !empty( $mcw_links_color ) ) {
		$mcw_custom_style .= "a,.entry-title a {\n color: $mcw_links_color;\n}\n\n";
		$mcw_custom_style .= ".breadcrumbs li a:hover::before {\n border-color: $mcw_links_color transparent;\n}\n\n";
		$mcw_custom_style .= ".breadcrumbs li a:hover::after {\n border-left-color: $mcw_links_color;\n}\n\n";
		$mcw_custom_style .= ".breadcrumbs li a:hover, .breadcrumbs .current, .breadcrumbs .current:hover {\n background: $mcw_links_color;\n}\n\n";
		$mcw_custom_style .= ".breadcrumbs .current::before, .breadcrumbs .current:hover::before {\n border-color: $mcw_links_color transparent;\n}\n\n";
		$mcw_custom_style .= ".breadcrumbs .current::after, .breadcrumbs .current:hover::after  {\n color: $mcw_links_color;\n}\n\n";
	}

	wp_add_inline_style( 'style', $mcw_custom_style );
}
add_action( 'wp_enqueue_scripts', 'mcw_custom_styles' );