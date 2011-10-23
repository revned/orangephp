<?
	class Session {
		static function start() {
			if(!isset($_SESSION)) {
				session_start();
			}
		}
		static function authenticate() {
			Session::start();
			if(!isset($_SESSION['login'])) {
				header("Location: ".URI_SCRIPT."/login?referrer={$_SERVER['REQUEST_URI']}"); die;
			}
		}
	}
?>