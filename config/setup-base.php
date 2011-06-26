<?
	define('PATH_BASE', dirname(__DIR__));
	define('PATH_SCRIPT', $_SERVER['SCRIPT_FILENAME']);
	define('PATH_LIBRARY', PATH_BASE.'/libraries');
	define('PATH_REPOSITORY', PATH_BASE.'/repository');
	// Load default libraries
	require_once(PATH_BASE.'/libraries/orange/Error.php');
	require_once(PATH_BASE.'/libraries/orange/Log.php');
	require_once(PATH_BASE.'/libraries/orange/Helpers.php');
	require_once(PATH_BASE.'/libraries/orange/Router.php');
	require_once(PATH_BASE.'/libraries/orange/Loader.php');
?>