<?php

	/**
	 * @package		http
	 * @subpackage	dataspace
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	
	final class QHttp_Request extends QFilter implements QOperator_Interface { 
		public function __construct() {
			foreach( array_merge( $_GET, $_POST, $_COOKIE ) as $parameter => $value ) {
				$this -> set( strtolower( $parameter ), $value );
			}
		}
		
		/**
		 * Perform an operation on an object
		 *
		 * @param	$object			object 
		 *
		 * @access			public
		 * @introduced		2021/11/03
		 *
		 * @return			void
		 */
		 
		public function operate( $object ) {
			$object -> push( $this );
		}
		
		public function locale() : string {
			if( $locale = $this -> get( '__language' ) ) {
				return $locale;
			}
			
			return 'en';
		}
		
		public function requestUri() : string {
			if( isset( $_SERVER['REQUEST_URI'] ) ) {
				return $_SERVER['REQUEST_URI'];
			}
			
			return '';
		}
		
		public function isSecure() : bool {
			$is_secure = @$_SERVER['HTTPS'];
			if( isset( $is_secure ) && strtolower( $is_secure ) == 'on' ) {
				return true;
			}
			
			return false;
		}
		
		public function requestMethod() : string {
			return ( strcasecmp( $_SERVER['REQUEST_METHOD'], 'POST' ) == (int) 0 )? 'POST':'GET';
		}
		
		public function isPost() : bool {
			return $this -> requestMethod() == 'POST';
		}
		
		/**
		 * Determine if a given request is AJAX or not
		 *
		 * @access					public
		 * @return					bool		true|false
		 *
		 */
		 
		public function isAjax() : bool {
			if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ) {
				$ajax = (string) strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] );
			
				return $ajax == 'xmlhttprequest';
			}
			
			return false;
		}
		
	}
	
?>