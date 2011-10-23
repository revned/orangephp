<?
	class Load {
		static function view($name, $data=array(), $return=false) {
			$path = PATH_BASE."/views/".$name.".php";
			if(!file_exists($path)) die('Could not find view ('.$name.').');
			if(!empty($data)) extract($data);
			ob_start();
			require($path);
			$buffer = ob_get_contents();
			@ob_end_clean();
			if($return) return $buffer;
			print $buffer;
		}
		static function model($name) {
			$path = PATH_BASE."/models/".$name.".php";
			if(!file_exists($path)) die('Could not find model.');
			require_once($path);
		}
		static function library($name) {
			$path = PATH_BASE."/libraries/".$name.".php";
			if(!file_exists($path)) die('Could not find library '.$name.'.');
			require_once($path);
		}
		static function other($name) {
			$path = PATH_BASE."/".$name.".php";
			if(!file_exists($path)) die('Could not find file. '.print_p(debug_backtrace()));
			require_once($path);
		}
	}
?>