<?php

function kstrap_front_page() {
	$url = parse_url( home_url() );
	$front_page_path = $url['path'] . '/';

	global $wp;
	$request_url = parse_url( home_url( $wp->request ) );
	$request_path = $request_url['path'] . '/';

	return is_front_page() || strcmp($request_path, $front_page_path) === 0 && empty($_GET['s']);
}

function kstrap_current_url() {
	global $wp;
	return home_url( $wp->request ).'/';
}

function kstrap_dir() {
	return dirname(__DIR__);
}

function kstrap_inc() {
	return kstrap_dir().'/inc';
}

function kstrap_resources() {
	return kstrap_dir().'/resources';
}

function kstrap_storage() {
	return kstrap_dir().'/storage';
}

function kstrap_scandir( $path ) {
	$results = scandir( $path );
	$files = array();

	foreach ( $results as $result ) {
		if ( '.' == $result[0] || is_dir( $result ) ) {
			continue;
		}
		
		$files[ $result ] = $path.'/'.$result;
	}

	return $files;
}


// Copied from Laravel Illuminate\Support\Str, Illuminate\Support\Arr

function str_starts_with($haystack, $needles)
{
	foreach ((array) $needles as $needle) {
		if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
			return true;
		}
	}

	return false;
}

function str_contains($haystack, $needles)
{
	foreach ((array) $needles as $needle) {
		if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
			return true;
		}
	}

	return false;
}

function str_ends_with($haystack, $needles)
{
	foreach ((array) $needles as $needle) {
		if (substr($haystack, -strlen($needle)) === (string) $needle) {
			return true;
		}
	}

	return false;
}

function str_substr($string, $start, $length = null)
{
	return mb_substr($string, $start, $length, 'UTF-8');
}

function value($value)
{
	return $value instanceof Closure ? $value() : $value;
}

function arr_get($array, $key, $default = null)
{
	if (! is_array($array)) {
		return value($default);
	}

	if (is_null($key)) {
		return $array;
	}

	if (array_key_exists($key, $array)) {
		return $array[$key];
	}

	if (strpos($key, '.') === false) {
		return $array[$key] ?? value($default);
	}

	foreach (explode('.', $key) as $segment) {
		if (is_array($array) && array_key_exists($segment, $array)) {
			$array = $array[$segment];
		} else {
			return value($default);
		}
	}

	return $array;
}

function e($value)
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}