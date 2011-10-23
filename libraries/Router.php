<?
	class Router {
		var $viewPath;
		var $arguments;
		function __construct() {
			if(isset($_SERVER['PATH_INFO'])) {
				$segments = explode('/', $_SERVER['PATH_INFO']);
				array_shift($segments); // first element will always be empty
				//array_walk($segments, function(&$value, $key) { $value = urldecode($value); }); // remove any url encoding
				$path = PATH_BASE.'/views'; // all controllers should be located here or sub directory
				foreach($segments as $segment) {
					if(empty($this->viewPath)) { // as long as we haven't set controller property...
						$path .= '/'.$segment; // add segments to the path
						if(is_file($path.'.php')) { // once we find the file, set the paths
							$this->viewPath = $path.'.php';
						} elseif(is_file($path.'/index.php')) { // try looking for an index.php
							$this->viewPath = $path.'/index.php';
						}
					} else { // all other segments will be method arguments
						$parts = explode('=', $segment);
						if(count($parts) == 1) {
							$this->arguments[] = $segment;
						} elseif(count($parts) == 2) {
							$this->arguments[$parts[0]] = $parts[1];
						}
					}
				}
			} else { // no attempt was made to provide path info, use defaults
				$this->viewPath = PATH_BASE.'/views/index.php';
			}
			if(!is_file($this->viewPath))
				throw new Exception('Sorry, I\'m not sure what you are looking for.');
		}
		function arg($index) { return (isset($this->arguments[$index]) ? $this->arguments[$index] : null); }
	}
?>
