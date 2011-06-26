<?
	// load base setup
	require_once(__DIR__.'/setup-base.php');
	/*
		setup defaults that are dependent on the web server
		
		Using this URL: http://fqdn.com/app/index.php/path/to/view?key=value
		URI_HOST:	fqdn.com
		URI_BASE:	/app
		URI_SELF:	/app/index.php/path/to/view
		URI_SCRIPT:	/app/index.php
		URI_INFO:	/path/to/view
		URI_FULL:	/app/index.php/path/to/view?key=value
		URI_QUERY:	key=value
	*/
	define('URL_HOST', $_SERVER['HTTP_HOST']);
	define('URL_BASE', dirname($_SERVER['SCRIPT_NAME']));
	define('URL_SELF', $_SERVER['PHP_SELF']);
	define('URL_SCRIPT', $_SERVER['SCRIPT_NAME']);
	define('URL_INFO', (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : ''));
	define('URL_FULL', $_SERVER['REQUEST_URI']);
	define('URL_QUERY', $_SERVER['QUERY_STRING']);
?>