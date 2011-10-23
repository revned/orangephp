<?
	define('PATH_BASE', dirname(dirname(__FILE__)));
	define('PATH_SCRIPT', $_SERVER['SCRIPT_FILENAME']);
	define('PATH_LIBRARY', PATH_BASE.'/libraries');
	define('PATH_REPOSITORY', PATH_BASE.'/repository');
	// Load default libraries
	require_once(PATH_BASE.'/libraries/Error.php');
	require_once(PATH_BASE.'/libraries/Log.php');
	require_once(PATH_BASE.'/libraries/Helpers.php');
	require_once(PATH_BASE.'/libraries/Router.php');
	require_once(PATH_BASE.'/libraries/Loader.php');
?>
