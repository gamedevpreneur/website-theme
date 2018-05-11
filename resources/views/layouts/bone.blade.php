<!DOCTYPE html>
<html {{ language_attributes() }} class="@yield('html-class')" >
<head>
	<meta charset="{{ bloginfo( 'charset' ) }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="{{ bloginfo( 'name' ) }} - {{ bloginfo( 'description' ) }}">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="{{ bloginfo( 'pingback_url' ) }}">
	{{ wp_head() }}
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
</head>

<body {{ body_class() }}>
	@yield('body')
	<script>
		var apiUrl = '{{ home_url() }}/wp-json/wp/v2/';
		var kstrapApiUrl = '{{ home_url() }}/wp-json/kstrap/v1/';
		var postID = @id;
		var restNonce = '<?php echo wp_create_nonce( 'wp_rest' ) ?>';
	</script>
	{{ wp_footer() }}
</body>
</html>