<?php namespace Lucent;

class Redirect {
	private $url;
	private $code;

	public function __construct($url, $code = 302) {
		$this->url  = $url;
		$this->code = $code;
	}
	
	public function execute() {
		
		switch($this->code) {
		case 302:
			header($_SERVER['SERVER_PROTOCOL'] . ' 302 Found');
			break;
		case 301:
			header($_SERVER['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
			break;
		}

		exit(header(sprintf('Location: %s', $this->url)));
	}
}

