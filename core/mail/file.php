<?php

	final class QMail {
		private $headers = array();
		private $use_html = true;
		
		private $name;
		private $recipient;
		private $subject;
		
		/**
		 * Class constructor
		 *
		 * @param	$ini_setting		string 		typical email to use by default
		 *											resolves a known bug 
		 *
		 * @access					public
		 * @return					void
		 */
		 
		public function __construct( $ini_setting = 'les.quinn.2012@gmail.com' ) {
			// required to fix a known bug
			ini_set( 'sendmail_from', $ini_setting );
			
			$this -> headers['type'] = 'Content-type: text/html; charset=utf-8';
		}
		
		/**
		 * Sending body as PLAIN TEXT 
		 *
		 * @access		public
		 * @return		void
		 */
		 
		public function asPlainText() {
			$this -> use_html = false;

			$this -> headers['type'] = 'Content-type: text/plain; charset=utf-8';
		}
		
		/** 
		 * Add an additional header
		 *
		 * @param	$name		string	header identifier
		 * @param	$header		string	header
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function addHeader( $name, $header ) {
			$this -> headers[$name] = $header;
		}
		
		/**
		 * Set from field
		 *
		 * @param	$name	string
		 * @param	$from	string
		 * 
		 * @access					public
		 * @return					void
		 */
		 
		public function from( $name, $from ) {
			$this -> addHeader( 'from', 'From: '.$name.' <'.$from.'>' );
		}
		
		public function subject( $subject ) {
			$this -> subject = $subject;
		}
		
		public function to( $recipient ) {
			$this -> recipient = $recipient;
		}
		
		public function send( $body ) {
			$headers = implode( "\r\n", $this -> headers );
			if( mail( $this -> recipient, $this -> subject, $body, $headers ) ) {
				return true;
			} 
			
			return true;
		}
	}
	
	/*
	
	$mailer = new QMail();
	$mailer -> addHeader( 'mime', 'MIME-Version: 1.0' );
	$mailer -> addHeader( 'mailer', 'X-Mailer: MJ/Mary Jean' );
	$mailer -> addHeader( 'reply', 'Reply-To: '.QEmails::ADMINISTRATOR ); 
		
	// Normal, Personal, Private or Company-Confidential
	$mailer -> addHeader( 'sensitivity', 'Sensitivity: Personal' );
	$mailer -> addHeader( 'encoding', 'Content-Transfer-Encoding: 8bit' );
		
	$mailer -> to( '...' );
	$mailer -> subject( '...' );
	$mailer -> from( 'Mary Jean', 'enquiry@maryjean.co.uk' );
		
	$sent = false;
	if( $mailer -> send( $record -> get( 'body' ) ) ) {
		$sent = true;
	}
	
	*/
	
?>