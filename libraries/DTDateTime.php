<?
	Load::library('DTDateInterval');
	class DTDateTime extends DateTime {
		public function __construct($dateTime=null, $timezone=null) {
			if(!$dateTime) throw new Exception('Date/time is null');
			parent::__construct($dateTime);
		}
		public function __toString() {
			return $this->format('d M Y h:i a');
		}
		public function diff($dateTime=null, $absolute=false, $invert=false) {
			if($dateTime === null) $dateTime = new DateTime();
			$x = parent::diff($dateTime, $absolute);
			if($invert) {
				if($x->invert) $x->invert = 0;
				else $x->invert = 1;
			}
			return new DTDateInterval($x);
		}
		public function icalDateTime() {
			$utc = new DateTimeZone('UTC');
			$tmp = clone $this;
			$tmp->setTimezone($utc);
			return $tmp->format('Ymd')."T".$tmp->format('His')."Z";
		}
		public function icalDate() {
			$utc = new DateTimeZone('UTC');
			$tmp = clone $this;
			$tmp->setTimezone($utc);
			return $tmp->format('Ymd');
		}
	}
?>