<?php

	final class QValidator_Condition_Optional extends QValidator_Condition {
		protected $field_name;
		protected $message;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 * @param	$message			string
		 *
		 * @access			public
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name, string $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> message = $message;
		}
		
		/**
		 * A specified field name is optional
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			$value = $dataspace -> get( $this -> field_name ); 
			if( empty( $value ) || !isset( $value ) || is_null( $value ) ) {
				return true;
			} 
			
			return false;
		}
	}
	
	// example of use
	/*
	protected function initialise() {
		$this -> addCondition( QValidator::factory()
			// validate against first three rules OR fourth
			-> addCondition( new QValidator_Condition_Required( '__temp__' ) )
			-> addCondition( new QValidator_Condition_Expression( '__temp__', '/^[a-zA-Z ]+$/' ) )
			-> addCondition( new QValidator_Condition_Size_Maximum( '__temp__', 8 ) )
			
			// treated as separate rule
			-> orCondition( new QValidator_Condition_Optional( '__temp__' ) )
		);
	}
	*/
	
?>