<?php namespace Lucent;

class Lucent {

	public static function app_path() {
		return realpath(sprintf('%s/../app', __DIR__));
	}
	
	public static function storage_path() {
		return realpath(sprintf('%s/storage', self::app_path()));
	}

	public static function cache_path() {
		return realpath(sprintf('%s/cache', self::storage_path()));
	}
	
	public static function temp_path() {
		return realpath(sprintf('%s/temp', self::storage_path()));
	}

	public static function log_path() {
		return realpath(sprintf('%s/log', self::storage_path()));
	}
	
	public static function config_path() {
		return realpath(sprintf('%s/config', self::app_path()));
	}
	
	public static function resource_path() {
		return realpath(sprintf('%s/resources', self::app_path()));
	}
	
	public static function view_path() {
		return realpath(sprintf('%s/views', self::resource_path()));
	}
	
	
}
