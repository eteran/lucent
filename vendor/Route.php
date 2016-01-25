<?php namespace Lucent;

class Route {

private static $Routes = [
	'GET'     => [],
	'PUT'     => [],
	'POST'    => [],
	'DELETE'  => [],
	'OPTIONS' => [],
	'TRACE'   => [],
	'CONNECT' => [],
	'PATCH'   => [],
];

private static $Patterns = [
	'number' => '[0-9]+',
	'alpha'  => '[a-zA-Z]+',
	'alnum'  => '[a-zA-Z0-9]+',
	'hex'    => '[a-fA-F0-9]+',
];

private static $FilterStack = [];

//------------------------------------------------------------------------------
// Name: __create_route
//------------------------------------------------------------------------------
static private function __create_route($method, $path, $handler) {

	if(!is_array($handler)) {
		$handler = [$handler];
	}
	
	$handler = array_merge(self::$FilterStack, $handler);
	
	self::$Routes[$method][] = array($path, $handler);
}

//------------------------------------------------------------------------------
// Name: Filter
//------------------------------------------------------------------------------
static function Filter($filter, $handlers) {

	array_push(self::$FilterStack, $filter);
	$handlers();
	array_pop(self::$FilterStack);
}

//------------------------------------------------------------------------------
// Name: Get
//------------------------------------------------------------------------------
static function Get($path, $handler) {
	return self::__create_route('GET', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Put
//------------------------------------------------------------------------------
static function Put($path, $handler) {
	return self::__create_route('PUT', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Post
//------------------------------------------------------------------------------
static function Post($path, $handler) {
	return self::__create_route('POST', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Delete
//------------------------------------------------------------------------------
static function Delete($path, $handler) {
	return self::__create_route('DELETE', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Options
//------------------------------------------------------------------------------
static function Options($path, $handler) {
	return self::__create_route('OPTIONS', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: Patch
//------------------------------------------------------------------------------
static function Patch($path, $handler) {
	return self::__create_route('PATCH', $path, $handler);
}

//------------------------------------------------------------------------------
// Name: __find_route_handler
//------------------------------------------------------------------------------
private static function __find_route_handler($request_method, $request_url, &$matches) {

	$routes = self::$Routes[$request_method];

	foreach($routes as $route => $handler) {
		$route_path    = $handler[0];
		$route_handler = $handler[1];

		$route_as_regex = preg_replace_callback('#:([\w\.]+)#', function($m) {

			if(array_key_exists($m[1], self::$Patterns)) {
				$pattern = self::$Patterns[$m[1]];
			} else {
				$pattern = '[\w\.-]+';
			}

			return "(?P<$m[1]>$pattern)";
		}, 	$route_path);

		$route_regex = sprintf('#^%s$#', $route_as_regex);

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

	// NOTE(eteran): PHP >= 5.4.7 parse_url assumes that two or more 
	//               redundant leading forward slashes in the URL are simply
	//               a path with a missing scheme... But, it doesn't seem to
	//               handle things like "///test" correctly. Just returning
	//               (bool)false (instead of the expected "/test"
	$request_url         = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	$real_request_method = strtoupper($_SERVER['REQUEST_METHOD']);

	// HEAD is the same as GET, but PHP will stop sending data after the headers
	$request_method      = ($real_request_method == 'HEAD') ? 'GET' : $real_request_method;

	$matches = [];
	$handlers = self::__find_route_handler($request_method, $request_url, $matches);

	$request          = new Request();
	$request->url     = $request_url;
	$request->method  = $real_request_method;
	$request->matches = $matches;

	if($handlers != null) {
		$response = null;

		foreach($handlers as $handler) {
			assert(is_callable($handler));
			$return = call_user_func($handler, $request);
			if(is_string($return)) {
				$response = response($return);
				break;
			} else if($return != null) {
				$response = $return;
				break;
			}
		}

		if(is_object($response)) {
			@$response->execute();
		}
		exit;
	}

	// OK, not found...
	// are there ANY methods that could have matched?
	$accepted_methods = [];
	foreach(self::$Routes as $method => $value) {
		$handlers = self::__find_route_handler($method, $request_url, $matches);
		if($handlers != null) {
			$accepted_methods[] = $method;
		}
	}

	// other methods found? then 405
	if(!empty($accepted_methods)) {
		$response = response(
			View::make('error.405', ['request' => $request]), 
			405, 
			['Allow: ' . implode(', ', $accepted_methods)]
		);
		exit($response->execute());
	}

	// ok, nothing was found, 404
	$response = response(View::make('error.404', ['request' => $request]), 404);
	exit($response->execute());
}

}
