<?php
	function empty_r(Array $x) {
		if(empty($x)) return true;
		foreach($x as $y)
			if(!empty($y)) return false;
		return true;
	}
	function print_p($x) { echo "<pre>".print_r($x,1)."</pre>"; }
	function renderSelect($attributes, $options, $selectedIndex=null) {
		$s = '<select ';
		foreach($attributes as $key => $value) {
			$s .= $key.'="'.$value.'" ';
		}
		$s .= '>';
		foreach($options as $key => $value) {
			$s .= '<option value="'.$key.'"'.($selectedIndex !== null && $key == $selectedIndex ? " selected" : "").'>'.$value.'</option>';
		}
		$s .= '</select>';
		return $s;
	}
	function trunc($string, $chars) {
		if(strlen( $string ) > $chars) {
			return substr( $string, 0, $chars )."...";
		} else {
			return $string;
		}
	}
	function sum(Array $x) {
		$sum = 0;
		foreach($x as $v) { $sum += $v; }
		return $sum;
	}
	function avg(Array $x) {
		if(count($x) == 0) return null;
		$sum = sum($x);
		return $sum/count($x);
	}
	function sum_sq(Array $x) {
		$sumSq = 0;
		foreach($x as $v) { $sumSq += pow($v, 2); }
		return $sumSq;
	}
	function stdev(Array $x) {
		$n = count($x);
		if($n == 0 || ($n - 1) == 0) return null;
		$sum = sum($x);
		$sumSq = sum_sq($x);
		return sqrt(($sumSq - (pow($sum, 2)/$n))/($n - 1));
	}
	function renderTable($data) {
		$s = "<table>";
		for($i=0; $i < count($data); $i++) {
			$s .= "<tr>";
			for($j=0; $j < count($data[$i]); $j++) { $s .= "<td>".$data[$i][$j]."</td>"; }
			$s .= "</tr>";
		}
		$s .= "</table>";
		return $s;
	}
	
?>