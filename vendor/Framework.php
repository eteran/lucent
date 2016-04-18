<?php namespace Lucent;

require_once('Lucent.php');
require_once('Log.php');
require_once('Request.php');
require_once('Response.php');
require_once('View.php');
require_once('Route.php');
require_once('Input.php');
require_once('Redirect.php');

// TODO(eteran): implement some clever autoloading

require_once(Lucent::config_path() . '/config.php');
require_once(Lucent::config_path() . '/routes.php');
