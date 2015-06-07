<?php namespace Lucent;

class Request implements \ArrayAccess {
	public $method;
	public $url;
	public $matches = [];
	
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->matches[] = $value;
        } else {
            $this->matches[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->matches[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->matches[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->matches[$offset]) ? $this->matches[$offset] : null;
    }
	
    public function &__get ($key) {
        return $this->matches[$key];
    }

    public function __set($key,$value) {
        $this->matches[$key] = $value;
    }

    public function __isset ($key) {
        return isset($this->matches[$key]);
    }

    public function __unset($key) {
        unset($this->matches[$key]);
    }
	
	public function mediaType() {
		$headers = apache_request_headers();
		
		if(isset($headers['Content-Type'])) {
			$contentType = $headers['Content-Type'];
			$splitContentType = preg_split('/\\s*[;,]\\s*/', $contentType);
			return strtolower($splitContentType[0]);
		}
		
		return false;
	}
	
	public function isJson() {
		return mediaType() === "application/json";
	}
	
	public function isAjax() {
		$headers = apache_request_headers();
		
		if(isset($headers['X-Requested-With'])) {
			return strpos($headers['X-Requested-With'], 'XMLHttpRequest') !== false;
		}
		
		return false;
		
	}
}
