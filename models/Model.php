<?
	class Model {
		public function __construct($id=null) { if($id !== null) $this->load($id); }
		public function load($id) {}
		public function insert() {}
		public function update() {}
		static function select($query, $args=array()) {
			$x = array();
			$db = new DB();
			$db->qa($query, $args);
			while($o = $db->f()) { $x[] = new self($o->id); }
			return $x;
		}
	}
?>