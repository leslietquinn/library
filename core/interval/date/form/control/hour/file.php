<?php

	final class QDate_Form_Control_Hour extends QForm_Select_Control {
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
			parent::__construct();
		}
		
		public function toArray() {
			return array(
				0	=>	new QParameters( array(
					'id'	=>	'00',
					'name'	=>	'00' ) ),
				1	=>	new QParameters( array(
					'id'	=>	'01', 
					'name'	=>	'01' ) ),
				2	=>	new QParameters( array(
					'id'	=>	'02', 
					'name'	=>	'02' ) ),
				3	=>	new QParameters( array(
					'id'	=>	'03', 
					'name'	=>	'03' ) ),
				4	=>	new QParameters( array(
					'id'	=>	'04', 
					'name'	=>	'04' ) ),
				5	=>	new QParameters( array(
					'id'	=>	'05', 
					'name'	=>	'05' ) ),
				6	=>	new QParameters( array(
					'id'	=>	'06', 
					'name'	=>	'06' ) ),
				7	=>	new QParameters( array(
					'id'	=>	'07', 
					'name'	=>	'07' ) ),
				8	=>	new QParameters( array(
					'id'	=>	'08', 
					'name'	=>	'08' ) ),
				9	=>	new QParameters( array(
					'id'	=>	'09', 
					'name'	=>	'09' ) ),
				10	=>	new QParameters( array(
					'id'	=>	'10', 
					'name'	=>	'10' ) ),
				11	=>	new QParameters( array(
					'id'	=>	'11', 
					'name'	=>	'11' ) ),
				12	=>	new QParameters( array(
					'id'	=>	'12', 
					'name'	=>	'12' ) ),
				13	=>	new QParameters( array(
					'id'	=>	'13', 
					'name'	=>	'13' ) ),
				14	=>	new QParameters( array(
					'id'	=>	'14', 
					'name'	=>	'14' ) ),
				15	=>	new QParameters( array(
					'id'	=>	'15', 
					'name'	=>	'15' ) ),
				16	=>	new QParameters( array(
					'id'	=>	'16', 
					'name'	=>	'16' ) ),
				17	=>	new QParameters( array(
					'id'	=>	'17', 
					'name'	=>	'17' ) ),
				18	=>	new QParameters( array(
					'id'	=>	'18', 
					'name'	=>	'18' ) ),
				19	=>	new QParameters( array(
					'id'	=>	'19', 
					'name'	=>	'19' ) ),
				20	=>	new QParameters( array(
					'id'	=>	'20', 
					'name'	=>	'20' ) ),
				21	=>	new QParameters( array(
					'id'	=>	'21', 
					'name'	=>	'21' ) ),
				22	=>	new QParameters( array(
					'id'	=>	'22', 
					'name'	=>	'22' ) ),
				23	=>	new QParameters( array(
					'id'	=>	'23', 
					'name'	=>	'23' ) ),
					
			);
		}
	}
	
?>