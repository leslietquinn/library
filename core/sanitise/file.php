<?php

	/**
	 * @package		sanitise
	 * @version		beta-07e, 13;14-dev
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QSanitise {
		private $string;
		
		public function __construct( string $string ) {
			$this -> string = $string;
		}
		
		/**
		 * Escape unwanted characters based upon a reg expression
		 *
		 * @param	$pattern		string		reg expression
		 *
		 * @see		./filter/sanitise/unwanted/
		 * @see		./expressions/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function unwanted( string $pattern ) : string {
			return preg_replace( $pattern, '', $this -> trim( $this -> string ) );
		}
		
		/**
		 * Escape special characters to HTML entities
		 *
		 * @see		QFilter_Sanitise_Escape::process();
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function escape( string $quote, string $encoding ) : string {
			return htmlspecialchars( $this -> trim( $this -> string ), $quote, $encoding );
		}
		
		/**
		 * Escape [sanitise] string of common HTML tags
		 *
		 * @see		./filter/sanitise/html/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function html() : string {
			$search = array(
				'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
				'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
				'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
				'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
			);

			return preg_replace( $search, '', $this -> trim( $this -> string ) );
		}
		
		/**
		 * Escape [sanitise] string for email address
		 *
		 * @see		./filter/sanitise/email/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function email() : string {
			return preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $this -> trim( $this -> string ) );
		}
		
		/**
		 * Escape [sanitise] string for web address
		 *
		 * @see		./filter/sanitise/uri/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function uri() : string {
			return preg_replace( '#[\'\,\@\^\?\(\)\[\]\*\+\#\"\\\&\=\|\%\!]+#' , '', $this -> trim( $this -> string ) );
		}
		
		/**
		 * Escape [sanitise] string for filename
		 *
		 * @see		./filter/sanitise/filename/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function filename() : string {
			return preg_replace( '/[^a-zA-Z0-9._-]/i', '', str_replace( array( ' ', '`', '"', '\'', '\\', '/' ), '', $this -> trim( $this -> string ) ) );
		}
		
		/**
		 * Strip escaped quotes
		 *
		 * @see		./filter/sanitise/stripslashes/
		 * @see		./filter/magic/quotes/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function stripslashes() : string {
			return stripslashes( $this -> string );
		}
		
		/**
		 * Trim string of new line characters, null character and vertical space just to be sure
		 *
		 * @param	string			string
		 *
		 * @access			private
		 *
		 * @return			string
		 */
		 
		private function trim( string $string ) : string {
			return trim( $string, " \n\r\t\v\0" );
		}
	}
	
?>