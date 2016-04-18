<?php namespace Lucent;

class View {
	//--------------------------------------------------------------------------
	// Name: make
	//--------------------------------------------------------------------------
	public static function make($filename, $variables = []) {
	
		extract($variables);
		ob_start();
		$template_file = sprintf('%s/%s.php', Lucent::view_path(), str_replace('.', DIRECTORY_SEPARATOR, $filename));		
		@require($template_file);
		return ob_get_clean();
	}
}
