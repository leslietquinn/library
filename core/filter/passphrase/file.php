<?php

	/**
	 * @package		filter
	 * @version		beta-05f, 06;09-revised
	 * @author		les quinn 
	 * @
	 */
	 
	final class QFilter_Passphrase implements QFilter_Interface {
		private $field_name;
		private $options;
		
		/**
		 * Create hashed passphrase based on upto three parameters
		 *
		 * @param	$field_name		string		array index used to store data
		 * @param	$options		array		holds three parameters used in hash
		 *										in order of [1]hash [2]password [3](email|username)
		 *
		 * @return					void
		 */
		 
		public function __construct( string $field_name, array $options = array( 'hash', 'password', 'email' ) ) {
			$this -> field_name = $field_name;
			$this -> options = $options;
		}
		
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$hash = array_shift( $this -> options );
			$password = array_shift( $this -> options );
			$username = array_shift( $this -> options );
			
			$dataspace -> set( $this -> field_name, sha1( $dataspace -> get( $hash ).$dataspace -> get( $password ).$dataspace -> get( $username ) ) );
		}
	}
	
?>