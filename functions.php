<?php

require get_template_directory() . '/inc/util.php';
require get_template_directory() . '/inc/view.php';

add_action( 'wp_enqueue_scripts', function () {
	// Get the theme data.
	$the_theme = wp_get_theme();
	wp_enqueue_style( 'gdp-theme-styles', get_stylesheet_directory_uri() . '/public/css/theme.min.css', array(), $the_theme->get( 'Version' ), false );
	wp_enqueue_script( 'gdp-theme-scripts', get_template_directory_uri() . '/public/js/theme.min.js', array(), $the_theme->get( 'Version' ), true );
} );
