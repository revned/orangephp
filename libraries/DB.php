<?
	define('PGDATETIME', "Y-m-d G:i:s");
	class DB {
		var $connection;
		var $result;
		var $query;
		function __construct($query=null, $args=null) { 
			$this->connection = pg_connect(PGCONNECT);
			if($query !== null) { $this->p($query); }
			if($args !== null) { $this->xa($args); }
		}
		function p($query=null, $name='') { // prepare
			l('Prepared query = ['.$query.']', LLDEBUG);
			if($query === null) throw new Exception('Query is null');
			// Replace the '?' in '$?' with a number
			for($i=1; ($pos = strpos($query, '$?')) !== false; $i++) {
				$query = substr_replace($query, $i, $pos+1, 1);
			}
			// Prepare query
			$this->result = pg_prepare($this->connection, $name, $query);
			if(false === $this->result)	throw new Exception('Could not prepare query');
			return $this;
		}
		function x() { // execute, with args being listed as function parameters
			$args = func_get_args();
			return $this->xa($args);
		}
		function xa($args=array(), $name='') { // execute array, with args given in an array as first parameter, also allows named query
			l('Execute query = '.print_r($args, 1), LLDEBUG);
			$this->result = pg_execute($this->connection, $name, $args);
			if(false === $this->result) throw new Exception('Could not execute query');
			return $this;
		}
		function q() {  // query (prepare and execute), first parameter being the query, and the remainging parameters being the args
			$args = func_get_args();
			$query = array_shift($args);
			return $this->p($query)->xa($args); 
		}
		function qa($query, $args=array()) { // query array (prepare and execute), first parameter is the query and second parameter is an array of args
			return $this->p($query)->xa($args);
		}
		function f() { // fetch
			if(!$this->result) throw new Exception('There was a problem with the query');
			return pg_fetch_object($this->result);
		}
		function fs() { // fetch, ensuring a single result
			if($this->r() < 1 || $this->r() > 1) throw new Exception('Could not find a unique record');
			return $this->f();
		}
		function fa() { // get all rows and columns of the result as an array
			if(!$this->result) throw new Exception('There was a problem with the query');
			return pg_fetch_all($this->result);
		}
		function r() { return pg_num_rows($this->result); }
		function update($table, $data, $criteria) {
			return $this->q(pg_update($this->connection, $table, $data, $criteria, PGSQL_DML_STRING));
		}
		function insert($table, $data) {
			return $this->q(pg_insert($this->connection, $table, $data, PGSQL_DML_STRING));
		}
		static function augment(&$query, &$args, $queryPiece, $newArg=null) {
			$queryPiece = str_replace('$#', '$'.(count($args)+1), $queryPiece);
			$query .= ' '.$queryPiece;
			if($newArg !== null) $args[] = $newArg;
		}
	}	
?>