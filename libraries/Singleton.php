<?php
	class Singleton {
		private static $instance;
		private function __construct() {} // Prevents creating new object
		private function __clone() {} // Prevents cloning
		static function instance() {
			if(!isset(self::$instance)) {
				$c = get_called_class();
				self::$instance = new $c;
			}
			return self::$instance;
		}
	}
?>