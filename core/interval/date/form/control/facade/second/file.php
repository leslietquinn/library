<?php
	
	final class QDate_Form_Control_Facade_Second extends QForm_Select_Control implements QAcceptee_Interface {
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
				24	=>	new QParameters( array(
					'id'	=>	'24', 
					'name'	=>	'24' ) ),
				25	=>	new QParameters( array(
					'id'	=>	'25', 
					'name'	=>	'25' ) ),
				26	=>	new QParameters( array(
					'id'	=>	'26', 
					'name'	=>	'26' ) ),
				27	=>	new QParameters( array(
					'id'	=>	'27', 
					'name'	=>	'27' ) ),
				28	=>	new QParameters( array(
					'id'	=>	'28', 
					'name'	=>	'28' ) ),
				29	=>	new QParameters( array(
					'id'	=>	'29', 
					'name'	=>	'29' ) ),
				30	=>	new QParameters( array(
					'id'	=>	'30', 
					'name'	=>	'30' ) ),
				31	=>	new QParameters( array(
					'id'	=>	'31', 
					'name'	=>	'31' ) ),
				32	=>	new QParameters( array(
					'id'	=>	'32', 
					'name'	=>	'32' ) ),
				33	=>	new QParameters( array(
					'id'	=>	'33', 
					'name'	=>	'33' ) ),
				34	=>	new QParameters( array(
					'id'	=>	'34', 
					'name'	=>	'34' ) ),
				35	=>	new QParameters( array(
					'id'	=>	'35', 
					'name'	=>	'35' ) ),
				36	=>	new QParameters( array(
					'id'	=>	'36', 
					'name'	=>	'36' ) ),
				37	=>	new QParameters( array(
					'id'	=>	'37', 
					'name'	=>	'37' ) ),
				38	=>	new QParameters( array(
					'id'	=>	'38', 
					'name'	=>	'38' ) ),
				39	=>	new QParameters( array(
					'id'	=>	'39', 
					'name'	=>	'39' ) ),
				40	=>	new QParameters( array(
					'id'	=>	'40', 
					'name'	=>	'40' ) ),
				41	=>	new QParameters( array(
					'id'	=>	'41', 
					'name'	=>	'41' ) ),
				42	=>	new QParameters( array(
					'id'	=>	'42', 
					'name'	=>	'42' ) ),
				43	=>	new QParameters( array(
					'id'	=>	'43', 
					'name'	=>	'43' ) ),
				44	=>	new QParameters( array(
					'id'	=>	'44', 
					'name'	=>	'44' ) ),
				45	=>	new QParameters( array(
					'id'	=>	'45', 
					'name'	=>	'45' ) ),
				46	=>	new QParameters( array(
					'id'	=>	'46', 
					'name'	=>	'46' ) ),
				47	=>	new QParameters( array(
					'id'	=>	'47', 
					'name'	=>	'47' ) ),
				48	=>	new QParameters( array(
					'id'	=>	'48', 
					'name'	=>	'48' ) ),
				49	=>	new QParameters( array(
					'id'	=>	'49', 
					'name'	=>	'49' ) ),
				50	=>	new QParameters( array(
					'id'	=>	'50', 
					'name'	=>	'50' ) ),
				51	=>	new QParameters( array(
					'id'	=>	'51', 
					'name'	=>	'51' ) ),
				52	=>	new QParameters( array(
					'id'	=>	'52', 
					'name'	=>	'52' ) ),
				53	=>	new QParameters( array(
					'id'	=>	'53', 
					'name'	=>	'53' ) ),
				54	=>	new QParameters( array(
					'id'	=>	'54', 
					'name'	=>	'54' ) ),
				55	=>	new QParameters( array(
					'id'	=>	'55', 
					'name'	=>	'55' ) ),
				56	=>	new QParameters( array(
					'id'	=>	'56', 
					'name'	=>	'56' ) ),
				57	=>	new QParameters( array(
					'id'	=>	'57', 
					'name'	=>	'57' ) ),
				58	=>	new QParameters( array(
					'id'	=>	'58', 
					'name'	=>	'58' ) ),
				59	=>	new QParameters( array(
					'id'	=>	'59', 
					'name'	=>	'59' ) ),
					
			);
		}
	}
	
?>