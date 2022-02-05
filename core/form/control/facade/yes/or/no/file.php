<?php
	
	final class QForm_Control_Facade_Yes_Or_No extends QForm_Select_Control implements QAcceptee_Interface {
		protected $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/11/21
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name ) { 
			$this -> field_name = $field_name;
			parent::__construct();
		}
		
		/**
		 * Prepare and return a data set suitable for a form control
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			array
		 */
		 
		protected function toArray() : array {
			return array(
					0	=>	new QParameters( array(
						'id' 	=>	'yes',
						'name'	=>	'Yes' )
					),
					
					1	=>	new QParameters( array(
						'id'	=>	'no',
						'name'	=>	'No' )
					)
			);
		}
	}
	
?>