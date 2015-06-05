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
}
