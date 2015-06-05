<?php namespace Lucent;

class Response {
	public $type    = 'text/html';
	public $status  = 200;
	public $content = '';
	
	public function execute() {
		echo $this->content;
	}
}
