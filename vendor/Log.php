<?php namespace Lucent;

class LogImpl {

	private $threshold_ = Log::INFO;
	private $logfile_   = null;
	
	public function __construct($logfile, $threshold = Log::INFO) {
		$this->threshold_ = $threshold;
		$this->logfile_   = fopen($logfile, 'a');
	}

	public function __destruct() {
		if ($this->logfile_) {
			fclose($this->logfile_);
		}
	}

	public function debugs($message) {
		$this->log(Log::DEBUG, $message);
	}

	public function info($message) {
		$this->log(Log::INFO, $message);
	}

	public function notice($message) {
		$this->log(Log::NOTICE, $message);
	}

	public function warning($message) {
		$this->log(Log::WARN, $message);
	}

	public function error($message) {
		$this->log(Log::ERR, $message);
	}

	public function alert($message) {
		$this->log(Log::ALERT, $message);
	}

	public function critical($message) {
		$this->log(Log::CRIT, $message);
	}

	public function emergency($message) {
		$this->log(Log::EMERG, $message);
	}

	public function log($level, $message) {	
		if ($this->threshold_ >= $level) {					
			if ($this->logfile_) {
				@fprintf($this->logfile_, "%s - %-7s: %s".PHP_EOL,
					date('Y-m-d H:i:s'), 
					self::log_prefix($level),
					$message);
			}
		}
	}

	static private function log_prefix($level) {
		switch ($level) {
		case Log::EMERG:  return "EMERG";
		case Log::ALERT:  return "ALERT";
		case Log::CRIT:   return "CRIT";
		case Log::ERR:    return "ERROR";
		case Log::WARN:   return "WARN";		
		case Log::NOTICE: return "NOTICE";
		case Log::INFO:   return "INFO";
		case Log::DEBUG:  return "DEBUG";
		
		default:
			return "LOG:";
		}
	}
}

class Log {

	const EMERG  = 0;  // Emergency: system is unusable
	const ALERT  = 1;  // Alert: action must be taken immediately
	const CRIT   = 2;  // Critical: critical conditions
	const ERR    = 3;  // Error: error conditions
	const WARN   = 4;  // Warning: warning conditions
	const NOTICE = 5;  // Notice: normal but significant condition
	const INFO   = 6;  // Informational: informational messages
	const DEBUG  = 7;  // Debug: debug messages


	static private $instance_ = null;
	
	static public function __callStatic($name, $arguments) {
		return call_user_func_array([self::instance(), $name], $arguments);
	}
	
	static public function instance() {
		if(is_null(self::$instance_)) {
			self::$instance_ = new LogImpl(Lucent::log_path() . '/lucent-'.date('Y-m-d').'.log');
		}
		
		return self::$instance_;
	}
}
