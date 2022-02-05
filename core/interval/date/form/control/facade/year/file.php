<?php
	
	final class QDate_Form_Control_Facade_Year extends QForm_Select_Control implements QAcceptee_Interface {
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
					'id'	=>	'2018',
					'name'	=>	'2018' ) ),
				1	=>	new QParameters( array(
					'id'	=>	'2019', 
					'name'	=>	'2019' ) ),
				2	=>	new QParameters( array(
					'id'	=>	'2020', 
					'name'	=>	'2020' ) ),
				3	=>	new QParameters( array(
					'id'	=>	'2021', 
					'name'	=>	'2021' ) ),
				4	=>	new QParameters( array(
					'id'	=>	'2022', 
					'name'	=>	'2022' ) ),
				5	=>	new QParameters( array(
					'id'	=>	'2023', 
					'name'	=>	'2023' ) ),
				6	=>	new QParameters( array(
					'id'	=>	'2024', 
					'name'	=>	'2024' ) ),
				7	=>	new QParameters( array(
					'id'	=>	'2025', 
					'name'	=>	'2025' ) ),
				8	=>	new QParameters( array(
					'id'	=>	'2026', 
					'name'	=>	'2026' ) ),
				9	=>	new QParameters( array(
					'id'	=>	'2027', 
					'name'	=>	'2027' ) ),
				10	=>	new QParameters( array(
					'id'	=>	'2028', 
					'name'	=>	'2028' ) ),
				11	=>	new QParameters( array(
					'id'	=>	'2029', 
					'name'	=>	'2029' ) ),
				12	=>	new QParameters( array(
					'id'	=>	'2030', 
					'name'	=>	'2030' ) ),
					
			);
		}
	}
	
?>