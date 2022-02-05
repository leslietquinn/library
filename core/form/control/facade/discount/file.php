<?php
	
	final class QForm_Control_Facade_Discount extends QForm_Select_Control implements QAcceptee_Interface {
		protected $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/12/04
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
		 * @introduced		2021/12/04
		 *
		 * @return			array
		 */
		 
		protected function toArray() : array {
			return array(
				0	=>	new QParameters( array(
						'id' 	=>	'5',
						'name'	=>	'5',
					)
				),
					
				1	=>	new QParameters( array(
					'id'	=>	'10',
					'name'	=>	'10',
					)
				),
					
					2	=>	new QParameters( array(
						'id'	=>	'15',
						'name'	=>	'15',
						)
					),
					
					3	=>	new QParameters( array(
						'id'	=>	'20',
						'name'	=>	'20',
						)
					),
					
					4	=>	new QParameters( array(
						'id'	=>	'25',
						'name'	=>	'25',
						)
					),
					
					5	=>	new QParameters( array(
						'id'	=>	'30',
						'name'	=>	'30',
						)
					),
					
					6	=>	new QParameters( array(
						'id'	=>	'33',
						'name'	=>	'33',
						)
					),
					
					7	=>	new QParameters( array(
						'id'	=>	'35',
						'name'	=>	'35',
						)
					),
					
					8	=>	new QParameters( array(
						'id'	=>	'40',
						'name'	=>	'40',
						)
					),
					
					9	=>	new QParameters( array(
						'id'	=>	'45',
						'name'	=>	'45',
						)
					),
					
					10	=>	new QParameters( array(
						'id'	=>	'50',
						'name'	=>	'50',
						)
					),
					
					11	=>	new QParameters( array(
						'id'	=>	'55',
						'name'	=>	'55',
						)
					),
					
					12	=>	new QParameters( array(
						'id'	=>	'60',
						'name'	=>	'60',
						)
					),
					
					13	=>	new QParameters( array(
						'id'	=>	'65',
						'name'	=>	'65',
						)
					),
					
					14	=>	new QParameters( array(
						'id'	=>	'66',
						'name'	=>	'66',
						)
					),
					
					15	=>	new QParameters( array(
						'id'	=>	'70',
						'name'	=>	'70',
						)
					),
					
					16	=>	new QParameters( array(
						'id'	=>	'75',
						'name'	=>	'75',
						)
					),
					
					17	=>	new QParameters( array(
						'id'	=>	'80',
						'name'	=>	'80',
						)
					),
					
					18	=>	new QParameters( array(
						'id'	=>	'85',
						'name'	=>	'85',
						)
					),
					
					19	=>	new QParameters( array(
						'id'	=>	'90',
						'name'	=>	'90',
						)
					),
					
					20	=>	new QParameters( array(
						'id'	=>	'95',
						'name'	=>	'95',
						)
					),
					
					21	=>	new QParameters( array(
						'id'	=>	'100',
						'name'	=>	'100 (Free)',
						)
					)
			);
		}
	}
	
?>