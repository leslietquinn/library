<?php

	final class QValidator_Condition_Array extends QValidator_Condition {
		protected $conditions = array();
		protected $field_name;
		protected $message;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 * @param	$conditions			array		1..n typeof QValidator_Condition
		 * @param	$message			string
		 */
		 
		public function __construct( string $field_name, array $conditions, string $message = '.' ) {
			$this -> field_name = $field_name;
			$this -> conditions = $conditions;
			$this -> message = $message;
		}
		
		/**
		 * Validate a number of conditions on one or more array elements
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			bool
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) : bool {
			$validation = false;
			if( is_array( $array = $dataspace -> get( $this -> field_name ) ) ) {
				
				/**
				 * @note	for every array index, we validate its value 
				 *			against one or more validation conditions
				 */
				 
				foreach( $array as $value ) {
					
					/**
					 * @note	for the validation to work, we need an interface 
					 */
					 
					$parameters = new QParameters( array( $this -> field_name => $value ) ); 
					
					$validation = true;
					foreach( $this -> conditions as $condition ) {
						if( !$condition instanceof QValidator_Condition ) {
							
							/**
							 * @note	if we don't get what we expect, then leave
							 */
							 
							break;
						}
						
						$validation = $condition -> isValid( $parameters, $logger ) && $validation;
					} 
					
					/**
					 * @note	there is no point to continue with the 
					 *			interation if the validation ever fails
					 */
					 
					if( !$validation ) {
						break;
					}
				}
			}
			
			if( $validation ) {
				return true;
			} 
			
			$logger -> set( $this -> field_name, $this -> message );
			return false;			
		}
	}
	
	/* example of use *//*
				$this -> addCondition( QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( 'tags' ) )
				-> addCondition( new QValidator_Condition_Size_Maximum_Array( 'tags', 4 ) )
				-> addCondition( 
					new QValidator_Condition_Array( 'tags', 
						array(
							// one or more conditions to be performed on each array index
							new QValidator_Condition_Expression( 'tags', '/^[a-zA-Z ]+$/' ),
							new QValidator_Condition_Size_Maximum( 'tags', 32 )
						) 
					) 
				)
			);
	*/
	
?>