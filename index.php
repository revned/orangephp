<?
	require_once(dirname(__FILE__).'/config/setup-http.php');
	// Load controller and execute method
	$RTR = new Router();
	require_once($RTR->viewPath);
?>
