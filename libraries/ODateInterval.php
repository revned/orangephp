<?
	class ODateInterval {
		public $s;
		public $i;
		public $h;
		public $d;
		public $m;
		public $y;
		public $invert;
		public $days;
		public $originalInterval;
		public function __construct($interval) {
			$this->originalInterval = $interval;
			$this->s = $interval->s;
			$this->i = $interval->i;
			$this->h = $interval->h;
			$this->d = $interval->d;
			$this->m = $interval->m;
			$this->y = $interval->y;
			$this->invert = $interval->invert;
			$this->days = $interval->days;
		}
		public function hours() {
			return ($this->invert ? -1 : 1) * (($this->days ? $this->days/24/60 : 0) + ($this->h + ($this->i/60) + ($this->s/3600)));
		}
		public function __toString() {
			return $this->truncate();
		}
		public function format($format) {
			return $this->originalInterval->format($format);
		}
		public function truncate($part=null, $precision=0) {
			$td = $this->s/60/60/24 + $this->i/60/24 + $this->h/24 + $this->d;
			$th = $this->s/60/60 + $this->i/60 + $this->h;
			$ti = $this->s/60 + $this->i;
			$y = $this->y;
			$m = $this->m;
			switch($part) {
				case 'd':
					$d = $td;
					$h = 0;
					$i = 0;
					$s = 0;
					break;
				case 'h':
					$d = $this->d;
					$h = $th;
					$i = 0;
					$s = 0;
					break;
				case 'i':
					$d = $this->d;
					$h = $this->h;
					$i = $ti;
					$s = 0;
					break;
				default:
					$d = $this->d;
					$h = $this->h;
					$i = $this->i;
					$s = $this->s;
			}			
			$str = ($this->invert ? '-' : '');
			if($y > 0) $str .= round($y, $precision).'y ';
			if($m > 0) $str .= round($m, $precision).'m ';
			if($d > 0) $str .= round($d, $precision).'d ';
			if($h > 0) $str .= round($h, $precision).'h ';
			if($i > 0) $str .= round($i, $precision).'m ';
			if($s > 0) $str .= round($s, $precision).'s ';
			return $str;
		}
	}
?>