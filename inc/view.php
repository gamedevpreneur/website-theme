<?php

require_once(kstrap_inc().'/blade/section.php');
require_once(kstrap_inc().'/blade/wp-blade.php');

require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesComments.php');
require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesConditionals.php');
require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesEchos.php');
require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesIncludes.php');
require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesJson.php');
require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesLayouts.php');
require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesLoops.php');
require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesRawPhp.php');
require_once(kstrap_inc().'/blade/Blade/Concerns/CompilesStacks.php');
require_once(kstrap_inc().'/blade/Blade/CompilerInterface.php');
require_once(kstrap_inc().'/blade/Blade/Compiler.php');
require_once(kstrap_inc().'/blade/Blade/BladeCompiler.php');

$types = array(
	'index', '404', 'archive', 
	'author', 'category', 'tag', 
	'taxonomy', 'date', 'embed', 
	'home', 'frontpage', 'page', 
	'paged', 'search', 'single', 
	'singular', 'attachment',
);

foreach($types as $t) {
	add_filter( "{$t}_template", function ($template, $type, $templates) {
		foreach ($templates as $template_name) {
			$path_to_compiled_file = compile_view( $template_name );
			
			if( $path_to_compiled_file != null ) {
				return $path_to_compiled_file;
			}
		}

		return $template;
	}, 10, 3);
}

function compile_view( $template_name ) {
	$blade_file = str_replace('.blade.php', '', $template_name); // normalize name
	$blade_file = str_replace('.php', '', $blade_file);
	$blade_file = str_replace('.', '/', $blade_file);
	$blade_file = kstrap_resources().'/views/'.$blade_file.'.blade.php';

	if ( file_exists( $blade_file ) ) {
		$path_to_compiled_file = kstrap_storage().'/views/'.md5( $blade_file ).'.php';

		$blade = new Laravel\BladeCompiler();
		wp_blade($blade);

		if ( ! file_exists( $path_to_compiled_file ) or filemtime( $blade_file ) > filemtime( $path_to_compiled_file ) ) {
			file_put_contents( $path_to_compiled_file, "<?php // $blade_file ?>\n".$blade->compile( file_get_contents( $blade_file ) ) );
		}

		return $path_to_compiled_file;
	}

	return null;
}

function include_view( $template_name, $variables = [] ) {
	$path_to_compiled_file = compile_view( $template_name );

	if ( $path_to_compiled_file != null ) {
		foreach($variables as $name => $value) {
			${$name} = $value;
		}

		require( $path_to_compiled_file );
	} else {
		echo "Warning: $template_name doesn't exist.";
	}
}

add_action('admin_init', function() {
	add_page_templates();
});

function add_page_templates() {
	$post_templates = array();

	$files = kstrap_scandir(kstrap_resources().'/views/pages/');

	foreach ( $files as $file => $full_path ) {
		if ( ! preg_match( '|Template Name:(.*)$|mi', file_get_contents( $full_path ), $header ) ) {
			continue;
		}

		$types = array( 'page' );
		if ( preg_match( '|Template Post Type:(.*)$|mi', file_get_contents( $full_path ), $type ) ) {
			$types = explode( ',', _cleanup_header_comment( $type[1] ) );
		}

		foreach ( $types as $type ) {
			$type = sanitize_key( $type );
			if ( ! isset( $post_templates[ $type ] ) ) {
				$post_templates[ $type ] = array();
			}

			$post_templates[ $type ][ 'pages/'.$file ] = _cleanup_header_comment( $header[1] );
		}
	}
	
	$cache_key = 'post_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
	$templates = wp_get_theme()->get_post_templates();
	if ( empty( $templates ) ) {
		$templates = array();
	} 
	
	wp_cache_delete( $cache_key , 'themes');
	$templates = array_merge_recursive( $templates, $post_templates );
	
	wp_cache_add( $cache_key, $templates, 'themes', 1800 );
}
