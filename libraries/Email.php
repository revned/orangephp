<?php
	define( "EMAILSYSTEMSAVER", "wholbrook@ipaperbox.com, kholbrook@ipaperbox.com, gmoen@ipaperbox.com, jsmith@ipaperbox.com" );
	define( "EMAILREPAIRREQUEST", "wholbrook@ipaperbox.com, jsmith@ipaperbox.com" );
	define( "EMAILACCTREPORT", "wholbrook@ipaperbox.com" );
	define( "EMAILCHECKLISTREPORT", "wholbrook@ipaperbox.com" );
	define( "EMAILTIMECLOCK", "henning@ipaperbox.com" );
	define( "EMAILSUPPLIESREQUEST", "wholbrook@ipaperbox.com, jodie@ipaperbox.com" );
	define( "EMAILORDERHOLD", "db@ipaperbox.com, csr@ipaperbox.com, wade@ipaperbox.com, jsmith@ipaperbox.com, veigh@ipaperbox.com, gil@ipaperbox.com" );
	class EmailMessage {
		protected $fromName;
		protected $fromAddress;
		protected $to;
		protected $cc;
		protected $bcc;
		protected $subject;
		protected $headers;
		protected $message;
		public function send() {
			$headersTmp = "From: {$this->fromName} <{$this->fromAddress}>\n";
			if( $this->cc ) $headersTmp .= "Cc: {$this->cc}\n";
			if( $this->bcc ) $headersTmp .= "Bcc: {$this->bcc}\n";
			$headersTmp .= "X-Mailer: PHP\n".$this->headers;
			if( !mail( $this->to, $this->subject, $this->message, $headersTmp, "-f".$this->fromAddress ) )
				throw new Exception( "Could not send email message." );
		}
		public function from() { return $this->fromName." <".$this->fromAddress.">"; }
		public function to() { return $this->to; }
		public function cc() { return $this->cc; }
		public function bcc() { return $this->bcc; }
		public function subject() { return $this->subject; }
		public function headers() { return $this->headers; }
		public function message() { return $this->message; }
		public function setFromName( $x ) { $this->fromName = $x; }
		public function setFromAddress( $x ) { $this->fromAddress = $x; }
		public function setFrom( $x ) {
			$this-> setFromName(getName($x));
			$this-> setFromAddress(getAddress($x));
		}
		public function setTo( $x ) {
			if( is_array( $x ) ) {
				$this->to = implode( ',', $x );
			} else {
				$this->to = $x;
			}
		}
		public function setCc( $x ) {
			if( is_array( $x ) ) {
				$this->cc = implode( ',', $x );
			} else {
				$this->cc = $x;
			}
		}
		public function setBcc( $x ) {
			if( is_array( $x ) ) {
				$this->bcc = implode( ',', $x );
			} else {
				$this->bcc = $x;
			}
		}
		public function setSubject( $x ) { $this->subject = $x; } 
		public function setHeaders( $x ) { $this->headers = $x; }
		public function setMessage( $x ) { $this->message = $x; }
		function __toString() {
			return htmlentities(
				"From: ".$this->from()."\n".
				"To: ".$this->to()."\n".
				"Cc: ".$this->cc()."\n".
				"Bcc: ".$this->bcc()."\n".
				"Subject: ".$this->subject()."\n".
				$this->headers."\n".
				"\n".
				$this->message );
		}
	}
	class EmailMimeMessage extends EmailMessage {
		protected $messageText;
		protected $messageHtml;
		function setMessageText($x) { $this->messageText = $x; }
		function setMessageHtml($x) { $this->messageHtml = $x; }
		function setMessage($x)  { die( "Method setMessage() is not supported. Please use setMessageText() and setMessageHtml()." ); }
		function send() {
			// Generate MIME boundary
			$boundary = md5(time());
			// Headers
			$headersTmp = "From: {$this->fromName} <{$this->fromAddress}>\n";
			if($this->cc) $headersTmp .= "Cc: {$this->cc}\n";
			if($this->bcc) $headersTmp .= "Bcc: {$this->bcc}\n";
			$headersTmp .= 
				"X-Mailer: PHP ".phpversion()."\n".
				"MIME-Version: 1.0\n".
				"Content-Type: multipart/alternative; boundary=\"$boundary\"\n".
				$this->headers;
			// Message content with MIME boundaries
			$message = 
				"This is a multi-part MIME message.\n\n".
				"--$boundary\n".
				"Content-Type: text/plain\n".
				"Content-Transfer-Encoding: 7bit\n\n".
				$this->messageText."\n\n".
				"--$boundary\n".
				"Content-Type: text/html\n".
				"Content-Transfer-Encoding: 7bit\n\n".
				$this->messageHtml."\n\n".
				"--$boundary--\n";
			if(!mail($this->to, $this->subject, $message, $headersTmp, "-f".$this->fromAddress ))
				throw new Exception( "Could not send email message." );
			else return true;
		}
	}

	function getAddress( $x ){
		//Returns email address (or anything with a "@") and strips "<" and ">".
		$holder= explode('<', $x);
		foreach ($holder as &$value){
			if (strpos($value,"@")) $address= $value;
		}
		return trim($address, ">");
	}

	function getName( $x ){
		//Returns name (or anything without a "@")
		$name="$x";
		$holder= explode('<', $x);
		foreach ($holder as &$value){
			if (!strpos($value,"@")) $name= $value;
		}
		return $name;
	}
?>