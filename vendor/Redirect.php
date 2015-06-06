<?php namespace Lucent;

class Redirect {
	private $url;

	public function __construct($url) {
		$this->url = $url;
	}
	
	public function execute($request) {
		
		// TODO(eteran): provide a good mechanism for differentiating between different 
		//               redirectin types (moved, found, etc..)
	
		header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
		//header($_SERVER['SERVER_PROTOCOL'] . ' 301 Moved Permanently');

		exit(header(sprintf('Location: %s', $this->url)));
	}
}

