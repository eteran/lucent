<?php namespace Lucent;

class Route {

private static $Routes = array(
	'GET'     => array(),
	'PUT'     => array(),
	'POST'    => array(),
	'DELETE'  => array(),
	'OPTIONS' => array(),
	'TRACE'   => array(),
	'CONNECT' => array(),
	'PATCH'   => array(),
);

//------------------------------------------------------------------------------
// Name: Route
//------------------------------------------------------------------------------
static private function __create_route($method, $path, $handler) {
	if(is_array($handler)) {
		self::$Routes[$method][] = array($path, $handler);
	} else {
		self::$Routes[$method][] = array($path, array($handler));
	}
}

//------------------------------------------------------------------------------
// Name: Get
//------------------------------------------------------------------------------
static function Get($path, $handler) {
	self::__create_route('GET', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Put
//------------------------------------------------------------------------------
static function Put($path, $handler) {
	self::__create_route('PUT', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Post
//------------------------------------------------------------------------------
static function Post($path, $handler) {
	self::__create_route('POST', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Delete
//------------------------------------------------------------------------------
static function Delete($path, $handler) {
	self::__create_route('DELETE', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Options
//------------------------------------------------------------------------------
static function Options($path, $handler) {
	self::__create_route('OPTIONS', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Options
//------------------------------------------------------------------------------
static function Patch($path, $handler) {
	self::__create_route('PATCH', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: __find_route_handler
//------------------------------------------------------------------------------
private static function __find_route_handler($request_method, $request_url) {

	$routes = self::$Routes[$request_method];
	
	foreach($routes as $route => $handler) {
		$route_path    = $handler[0];
		$route_handler = $handler[1];

		// substitute things to make the regex a bit more useful
		// while having the original route string be clean

		// redundant slashes	
		$route_path = str_replace('/', '[\\/]+', $route_path);			

		// some classes are handled
		/*
		$route_path = str_replace(':pnumber', '(?:0|[1-9][0-9]*)', $route_path); // positive integer
		$route_path = str_replace(':number',  '[0-9]+',            $route_path); // integer
		$route_path = str_replace(':segment', '[^\/]+',            $route_path); // any segment (text between '/'s)
		$route_path = str_replace(':any',     '.+'    ,            $route_path); // the rest of the URL if any
		$route_path = str_replace(':alpha',   '[a-zA-Z]+',         $route_path); // any string consisting of alphabetic chars
		$route_path = str_replace(':alnum',   '[a-zA-Z0-9]+',      $route_path); // any string consisting of alphabetic or numeric chars
		$route_path = str_replace(':hex',     '[a-fA-F0-9]+',      $route_path); // any string consisting of hexdecimal chars
		*/
		
		$route_regex = sprintf('/^%s$/', $route_path);

		$matches = array();
		if(preg_match($route_regex, $request_url, $matches)) {
			return $route_handler;
		}
	}
	
	return null;
}

//------------------------------------------------------------------------------
// Name: Execute
//------------------------------------------------------------------------------
static function Execute() {

	$request_url         = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$real_request_method = strtoupper($_SERVER['REQUEST_METHOD']);

	// HEAD is the same as GET, but PHP will stop sending data after the headers
	$request_method      = ($real_request_method == 'HEAD') ? 'GET' : $real_request_method;

	$handlers = self::__find_route_handler($request_method, $request_url);
	if($handlers != null) {
	
		$request         = new Request();
		$request->url    = $request_url;
		$request->method = $real_request_method;

		$response = new Response();	
	
		foreach($handlers as $handler) {
			assert(is_callable($handler));
			$return = call_user_func($handler, $request, $response);
			if(is_string($return)) {
				$response->content = $return;
				break;
			}
			// TODO(eteran): can we detect if they returned an error code
			// vs. nothing?
		}

		// TODO(eteran): do some real outputting here
		echo $response->content;		
		exit;	
	}
	
	// OK, not found...
	// are there ANY methods that could have matched?
	$accepted_methods = array();
	foreach(self::$Routes as $method => $value) {
		$handlers = self::__find_route_handler($method, $request_url);
		if($handlers != null) {
			$accepted_methods[] = $method;
		}
	}
	
	// TODO(eteran): set headers, read 405 template, etc...
	if(!empty($accepted_methods)) {
		echo '405: Invalid Method';
		echo '<br>';
		echo 'Acceptable Methods: ' . implode(',', $accepted_methods);
		exit;
	}
	
	// TODO(eteran): set headers, read 404 template, etc...
	echo View::make('error.404');
}

}
