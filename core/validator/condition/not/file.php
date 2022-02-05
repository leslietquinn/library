<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QValidator_Condition_Not extends QValidator_Condition { 
		protected $source = null;
		protected $field_name;
		protected $message;
		
		public function __construct( $field_name, QValidator_Condition $source, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
			$this -> source = $source;
		}
		
		/**
		 * Return negated result for any given condition
		 *
		 * @param	$dataspace			object
		 * @param	$logger				object
		 *
		 * @access				public
		 * @return				boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( !$this -> source -> isValid( $dataspace, $logger ) ) {
				return true;
			}
			
			$logger -> set( $this -> field_name, $this -> message );
			return false;
		}
	}
	
?>