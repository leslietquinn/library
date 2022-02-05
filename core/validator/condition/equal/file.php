<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QValidator_Condition_Equal extends QValidator_Condition { 
		protected $field_name;
		protected $message;
		protected $source;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string			field name
		 * @param	$source				mixed			
		 * @param	$message			string
		 *
		 * @access				public
		 * @return				void
		 */
		public function __construct( $field_name, $source, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
			$this -> source = $source;
		}
		
		/**
		 * Return true if matched field against parameter
		 *
		 * @param	$dataspace			object
		 * @param	$logger				object
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( ( (string) $dataspace -> get( $this -> field_name ) === (string) $this -> source ) ) {
				return true;
			}
			
			$logger -> set( $this -> field_name, $this -> message );
			return false;
		}
	}
	
?>