<?php

	final class QDate_Form_Control_Month extends QForm_Select_Control {
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
			parent::__construct();
		}
		
		public function toArray() {
			return array(
				0	=>	new QParameters( array(
					'id'	=>	'01',
					'name'	=>	'01' ) ),
				1	=>	new QParameters( array(
					'id'	=>	'02', 
					'name'	=>	'02' ) ),
				2	=>	new QParameters( array(
					'id'	=>	'03', 
					'name'	=>	'03' ) ),
				3	=>	new QParameters( array(
					'id'	=>	'04', 
					'name'	=>	'04' ) ),
				4	=>	new QParameters( array(
					'id'	=>	'05', 
					'name'	=>	'05' ) ),
				5	=>	new QParameters( array(
					'id'	=>	'06', 
					'name'	=>	'06' ) ),
				6	=>	new QParameters( array(
					'id'	=>	'07', 
					'name'	=>	'07' ) ),
				7	=>	new QParameters( array(
					'id'	=>	'08', 
					'name'	=>	'08' ) ),
				8	=>	new QParameters( array(
					'id'	=>	'09', 
					'name'	=>	'09' ) ),
				9	=>	new QParameters( array(
					'id'	=>	'10', 
					'name'	=>	'10' ) ),
				10	=>	new QParameters( array(
					'id'	=>	'11', 
					'name'	=>	'11' ) ),
				11	=>	new QParameters( array(
					'id'	=>	'12', 
					'name'	=>	'12' ) ),
					
			);
		}
	}
	
?>