<?php

function wp_blade($compiler) {
	$compiler->directive('wpposts', function() {
		return "<?php if(have_posts()): while(have_posts()): the_post(); ?>";
	});

	$compiler->directive('elseposts', function() {
		return '<?php endwhile; else: $started=false; while(!$started): $started=true; ?>';
	});

	$compiler->directive('endposts', function() {
		return "<?php endwhile; endif; ?>";
	});

	$compiler->directive('mod', function($expression) {
		return "<?php echo get_theme_mod($expression) ?>";
	});

	$compiler->directive('modp', function($expression) {
		return "<?php echo wpautop( get_theme_mod($expression) ) ?>";
	});

	$compiler->directive('id', function() { 
		return "<?php echo the_ID() ?>";
	});

	$compiler->directive('permalink', function() {
		return "<?php echo esc_url( get_permalink() ) ?>";
	});

	$compiler->directive('title', function() {
		return "<?php echo get_the_title() ?>";
	});

	$compiler->directive('wptext', function($text) {
		return "<?php echo __($text, 'kstrap'); ?>";
	});

	$compiler->directive('echoif', function($arguments) {
		list($text, $condition) = explode(',', $arguments);

		return "<?php echo($condition ? $text : '') ?>";
	});
}
