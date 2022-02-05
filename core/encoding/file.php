<?php

	/**
	 * @package		encoding
	 * @version		beta-07e, 13;14-dev
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QEncoding {
		private $encoding = 'utf-8';
		private $string;
		
		private $supported = array(
			'iso-8859-1',   
			'iso8859-1',    
			'iso-8859-5',   
			'iso8859-5',
			'iso-8859-15',  
			'iso8859-15',   
			'utf-8',        
			'cp866',
			'ibm866',       
			'866',          
			'cp1251',       
			'windows-1251',
			'win-1251',     
			'1251',         
			'cp1252',       
			'windows-1252',
			'1252',         
			'koi8-r',       
			'koi8-ru',      
			'koi8r',
			'big5',         
			'950',          
			'gb2312',       
			'936',
			'big5-hkscs',   
			'shift_jis',    
			'sjis',         
			'sjis-win',
			'cp932',        
			'932',          
			'euc-jp',       
			'eucjp',
			'eucjp-win',    
			'macroman', 
		);
		
		private static $entities = array(
			34 => 'quot',         
			38 => 'amp',          
			60 => 'lt',           
			62 => 'gt',           
		);
		
		private $quotes = ENT_QUOTES;
		
		/**
		 * Class constructor
		 *
		 * @param	$string			string
		 * @param	$encoding		string		defaults to UTF8
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function __construct( $string, $encoding = 'utf-8' ) {
			if( !( in_array( $encoding, $this -> supported ) ) ) {
				$this -> encoding = 'utf-8';
			}
			
			// as of PHP5.4 correctly manage false or illegal UTF-8 sequences
			if( defined( 'ENT_SUBSTITUTE' ) ) {
				$this -> quotes |= ENT_SUBSTITUTE;
			}
			
			$this -> encoding = $encoding;
			$this -> string = $string;
		}
		
		/**
		 * Encode an IP address to binary format
		 *
		 * @see		./filter/ip/address/encode/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function encodeIpAddress() {
			return inet_pton( $this -> string );
		}
		
		/**
		 * Decode number from binary format to IP address
		 *
		 * @see		./filter/ip/address/decode/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function decodeIpAddress() {
			return inet_ntop( $this -> string );
		}
		
		/**
		 * Decode a string in Base 64 format
		 *
		 * @see		./filter/decode/base64/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function fromBase64() {
			return base64_decode( $this -> string );
		}
		
		/**
		 * Encode a string in Base 64 format
		 *
		 * @see		./filter/encode/base64/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function toBase64() {
			return base64_encode( $this -> string );
		}
		
		/**
		 * Decode a string 
		 *
		 * @see		./filter/decode/uri/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function fromUri() {
			return urldecode( $this -> string );
		}
		
		/**
		 * Encode a string
		 *
		 * @see		./filter/encode/uri/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function toUri() {
			return urlencode( $this -> string );
		}
		
		/**
		 * Decode a JSON encoded string 
		 *
		 * @see		./filter/decode/json/
		 *
		 * @access				public
		 * @return				array
		 */
		 
		public function fromJSon() {
			return json_decode( $this -> string );
		}
		
		/**
		 * Encode a string using JSON
		 *
		 * @see		./filter/encode/json/
		 *
		 * @access				public
		 * @return				string
		 */
		 
		public function toJSon() {
			if( is_array( $this -> string ) ) {
				return json_decode( $this -> string );
			}
		}
		
		/**
		 * Convert string to UTF8 from base encoding, if not already encoded as UTF8
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		public function toUtf8() {
			if( !( mb_detect_encoding( $this -> string ) == 'UTF-8' ) ) {
				return utf8_encode( $this -> string );
			}
			
			return false;
		}
		
		/**
		 * Convert string from UTF8 to base encoding, if not already encoded as UTF8
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		public function fromUtf8() {
			$count = 0;
			$tmp = $this -> string;
			$string = $this -> string;
			while( mb_detect_encoding( $tmp ) == 'UTF-8' ) {
				$tmp = utf8_decode( $tmp );
				$count++;
			}
  
			for( $i = 0; $i < $count -1; $i++ ) {
				$string = utf8_decode( $string );
			}
			
			return $string;
		}
		
		public function unicodeToUtf8() {
			return mb_convert_encoding( preg_replace( '/U\+([0-9A-F]*)/', '&#x\\1;', $this -> string ), 'UTF-8', 'HTML-ENTITIES' );
		}
		
	}
	
?>