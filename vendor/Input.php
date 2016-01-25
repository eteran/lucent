<?php namespace Lucent;

class Input {
public static function all() {
	static $contents;

	if(!isset($contents)) {
		$contents = file_get_contents("php://input");
	}

	return $contents;
}

public static function get($key, $default = null) {	
	if(!isset($_GET[$key])) {
		return $default;
	}
	return get_magic_quotes_gpc() ? stripslashes($_GET[$key]) : $_GET[$key];
}

public static function post($key, $default = null) {
	if(!isset($_POST[$key])) {
		return $default;
	}	
	return get_magic_quotes_gpc() ? stripslashes($_POST[$key]) : $_POST[$key];
}

public static function has($key) {
	$method = strtoupper($_SERVER['REQUEST_METHOD']);

	switch($method) {
	case 'GET':
	case 'HEAD':
		return isset($_GET[$key]);
	case 'POST':
		return isset($_POST[$key]);
	default:
		return false;
	}
}	
}
