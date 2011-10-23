<?
	// Log levels
	define('LFAIL', 1);
	define('LINFO', 2);
	define('LDEBUG', 4);
	define('LLINFO', 8); // library info
	define('LLDEBUG', 16); // library debug
	// Current log level
	define('LLEVEL', LFAIL | LINFO | LDEBUG | LLINFO);
	// Log function
	function l($message, $priority=LDEBUG) {
		if(($priority & LLEVEL) != $priority)
			return;
		$suffix = '';
		if(isset($_SESSION['login']))
			$suffix .= "user=".$_SESSION['login'];
		if($suffix != '')
			$suffix = ' ['.$suffix.']';
		error_log(trim($message).$suffix);
	}
?>