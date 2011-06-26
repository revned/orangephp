<?php
	class Session {
		static function start() {
			if(!isset($_SESSION)) {
				session_start();
				unset( $_SESSION['ipbError'] );
			}
		}
		static function authenticate() {
			if(!isset( $_SESSION['login'])) {
				header("Location: ".URI_SCRIPT."/login?referrer={$_SERVER['REQUEST_URI']}"); die;
			}
		}
	}
?>