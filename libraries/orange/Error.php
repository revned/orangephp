<?
	// Error reporting level
	error_reporting(E_ALL|E_STRICT); // Has no effect on error handler
	ini_set('display_errors', 'yes'); // The custom error handler overrides this
	ini_set('html_errors', 'no'); // The custom error handler overrides this
	set_error_handler('errorHandler');
	set_exception_handler('exceptionHandler');
	function errorHandler($number, $string, $file, $line, $context) {
		throw new ErrorException($string, 0, $number, $file, $line);
	}
	function exceptionHandler($e) {
		$time = time();
		$subject = $e->getMessage();
		if(isset($_SESSION['login'])) $vars[] = "login=".$_SESSION['login'];
		if(isset($_SERVER['REMOTE_ADDR'])) $vars[] = "client=".$_SERVER['REMOTE_ADDR'];
		$vars = (isset($vars) ? "[".implode(", ", $vars)."]" : null);
		$trace = $e->getTraceAsString();
		$globals = print_r($GLOBALS, true);
		// Write to log
		error_log(str_replace("\n", "\n    ", $subject."\n".$vars."\n".$trace));
		// Send email
		mail("error@localhost", $subject, $subject."\n".$vars."\n".$trace."\n".$globals, "From: error@".gethostname());
		// Display error
		$displayErrors = (ini_get('display_errors') == '1' || ini_get('display_errors') == "yes" ? true : false);
		if($displayErrors) print('<div style="border: 1px solid #ccc; background: #fcc; padding: 1em;"><pre style="margin: 0;">'."\n".$subject."\n</pre>"."\n<!-- ***** START ERROR *****\n".date("Y-m-d H:i:s", $time)." ".$subject."\n".$vars."\n".$trace."\n".$globals."\n***** END ERROR *****--></div>");
	}
?>