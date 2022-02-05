<?php
	
	final class QDate_Form_Control_Facade_Day extends QForm_Select_Control implements QAcceptee_Interface {
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
		 
		protected function toArray() {
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
				12	=>	new QParameters( array(
					'id'	=>	'13', 
					'name'	=>	'13' ) ),
				13	=>	new QParameters( array(
					'id'	=>	'14', 
					'name'	=>	'14' ) ),
				14	=>	new QParameters( array(
					'id'	=>	'15', 
					'name'	=>	'15' ) ),
				15	=>	new QParameters( array(
					'id'	=>	'16', 
					'name'	=>	'16' ) ),
				16	=>	new QParameters( array(
					'id'	=>	'17', 
					'name'	=>	'17' ) ),
				17	=>	new QParameters( array(
					'id'	=>	'18', 
					'name'	=>	'18' ) ),
				18	=>	new QParameters( array(
					'id'	=>	'19', 
					'name'	=>	'19' ) ),
				19	=>	new QParameters( array(
					'id'	=>	'20', 
					'name'	=>	'20' ) ),
				20	=>	new QParameters( array(
					'id'	=>	'21', 
					'name'	=>	'21' ) ),
				21	=>	new QParameters( array(
					'id'	=>	'22', 
					'name'	=>	'22' ) ),
				22	=>	new QParameters( array(
					'id'	=>	'23', 
					'name'	=>	'23' ) ),
				23	=>	new QParameters( array(
					'id'	=>	'24', 
					'name'	=>	'24' ) ),
				24	=>	new QParameters( array(
					'id'	=>	'25', 
					'name'	=>	'25' ) ),
				25	=>	new QParameters( array(
					'id'	=>	'26', 
					'name'	=>	'26' ) ),
				26	=>	new QParameters( array(
					'id'	=>	'27', 
					'name'	=>	'27' ) ),
				27	=>	new QParameters( array(
					'id'	=>	'28', 
					'name'	=>	'28' ) ),
				28	=>	new QParameters( array(
					'id'	=>	'29', 
					'name'	=>	'29' ) ),
				29	=>	new QParameters( array(
					'id'	=>	'30', 
					'name'	=>	'30' ) ),
				30	=>	new QParameters( array(
					'id'	=>	'31', 
					'name'	=>	'31' ) ),
					
			);
		}
	}
	
?>