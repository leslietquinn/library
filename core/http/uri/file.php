<?php

	final class QHttp_Uri {
		private $uri;
		
		public function __construct( $uri ) {
			$this -> uri = $uri;
		}
		
		public function reclaim() {
			return $this -> uri;
		}
		
		/**
		 * Append query string parameter to specified uri
		 *
		 * @param	$key			string
		 * @param	$val			string
		 *
		 * @access				public
		 * @return				object	
		 */
		 
		public function addQuery( $key, $val ) {
			$uri = preg_replace( '/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $this -> uri . '&' );
			$uri = substr( $uri, 0, -1 );
			
			if( strpos( $uri, '?' ) === false ) {
				$this -> uri = $uri . '?' . $key . '=' . $val;
			} else {
				$this -> uri = $uri . '&' . $key . '=' . $val;
			}
			
			// allow chaining
			return $this;
		}
		
		/**
		 * Remove query string parameter from specified uri
		 *
		 * @param	$key			string
		 *
		 * @access				public
		 * @return				object	
		 */
		 
		public function removeQuery( $key ) {
			$uri = preg_replace( '/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $this -> uri . '&' );
			$this -> uri = substr( $uri, 0, -1) ;
			
			// allow chaining
			return $this;
		}
		
	}
	
?>