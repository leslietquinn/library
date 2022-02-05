<?php

	/**
	 * @package		page
	 * @subpackage	dataspace
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 */
	 
	abstract class QPage extends QDataspace implements QPage_Interface, QOperator_Interface {

		/**
		 * Import a current dataspace
		 *
		 * @param	$dataspace			object	represents a QDataspace_Interface type
		 * @access	public
		 * @return						void
		 */
		 
		public function __construct( QDataspace_Interface $dataspace ) {
			$this -> import( $dataspace );
		}
		
		/**
		 * Determine if variable exists or not within $_SESSION
		 *
		 * @param	$key				string	key to look for
		 *
		 * @access						public
		 * @return						bool
		 */
		 
		public function hasSession( string $key ) : bool { 
			if( $this -> get( 'session' ) -> has( $key ) ) {
				return true;
			}

			return false;
		}
		
		/**
		 * Return a variable within $_SESSION
		 *
		 * @param	$key				string	key to look for
		 *
		 * @access						public
		 * @return						mixed
		 */
		 
		public function getSession( string $key ) { 
			if( $this -> get( 'session' ) -> has( $key ) ) {
				return $this -> get( 'session' ) -> get( $key );
			}

			return false;
		}
		
		/**
		 * Determine if variable exists or not within $_COOKIE
		 *
		 * @param	$key				string	key to look for
		 *
		 * @access						public
		 * @return						bool
		 */
		 
		public function hasCookie( string $key ) : bool { 
			if( QHttp_Cookie::has( $key ) ) {
				return true;
			}

			return false;
		}
		
		/**
		 * Return a variable within $_COOKIE
		 *
		 * @param	$key				string	key to look for
		 *
		 * @access						public
		 * @return						mixed
		 */
		 
		public function getCookie( string $key ) { 
			if( QHttp_Cookie::has( $key ) ) {
				return QHttp_Cookie::get( $key );
			}

			return false;
		}
		
		/**
		 * Perform an operation on $object
		 *
		 * @param	$object				object
		 *
		 * @access					public
		 * @introduced				2021/11/02
		 *
		 * @return					void
		 * @throws					QFront_Controller_Action_Dispatcher_Exception
		 */
		 
		public function operate( object $object ) {
			try {
				$object -> push( $this );
			} catch( QPage_Exception $e ) {
				throw new QFront_Controller_Action_Dispatcher_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Escape string prior to output to template
		 *
		 * @param	$parameter		string	string to escape
		 * @param	$encoding		string	encoding to use for escape
		 *
		 * @access					public
		 * @return					string
		 */
		 
		public function escape( string $parameter, string $encoding = 'UTF-8' ) : string { 
			return htmlentities( $parameter, ENT_QUOTES, $encoding );
		}
		
		/**
		 * Prepare template path based upon a language if found
		 *
		 * @param	$template		string	directory path to template
		 *
		 * @return					string	
		 * @access					protected
		 *
		 * @return			string
		 */
		 
		protected function prepare( string $template ) : string { 
			if( $this -> has( QCommon::LOCALE_LANGUAGE_TOKEN ) ) { 
				if( $this -> has( QCommon::LOCALE_COUNTRY_TOKEN ) ) {
					return $this -> get( QCommon::LOCALE_LANGUAGE_TOKEN ).'/'.$this -> get( QCommon::LOCALE_COUNTRY_TOKEN ).'/'.$template;
				} else {
					return $this -> get( QCommon::LOCALE_LANGUAGE_TOKEN ).'/'.$template;
				}
			} 
			
			return $template;
		}
		
		/**
		 * Render template with imported data
		 *
		 * @abstract
		 */
		 
		abstract public function render( string $template );
		
	}
	
?>