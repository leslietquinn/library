<?php

	final class QDate_Form_Control_Year extends QForm_Select_Control {
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
			parent::__construct();
		}
		
		public function toArray() {
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