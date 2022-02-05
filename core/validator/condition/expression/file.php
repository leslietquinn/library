<?php

	final class QValidator_Condition_Expression extends QValidator_Condition {
		protected $field_name;
		protected $expression;
		protected $message;
		
		public function __construct( $field_name, $expression, $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> expression = $expression;
			$this -> message = $message;
		}
		
		/**
		 * A specified field name must match a regular expression
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			if( !preg_match( $this -> expression, (string) $dataspace -> get( $this -> field_name ) ) ) {
				$logger -> set( $this -> field_name, $this -> message );
				return false;
			} 
			return true;
		}
	}
	
?>