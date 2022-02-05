<?php
	
	final class QForm_Control_Facade {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/03
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Select rows for form control
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			object typeof QForm_Select_Control
		 */
		 
		public function activeOrInactive( string $field_name ) : QForm_Select_Control { 
			return new QForm_Control_Facade_Active_Or_Inactive( $field_name );
		}
		
		/**
		 * Select rows for form control
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			object typeof QForm_Select_Control
		 */
		 
		public function yesOrNo( string $field_name ) : QForm_Select_Control { 
			return new QForm_Control_Facade_Yes_Or_No( $field_name );
		}
		
		/**
		 * Select rows for form control
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			object typeof QForm_Select_Control
		 */
		 
		public function openOrClosed( string $field_name ) : QForm_Select_Control { 
			return new QForm_Control_Facade_Open_Or_Closed( $field_name );
		}
		
		/**
		 * Select rows for form control
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			object typeof QForm_Select_Control
		 */
		 
		public function onOrOff( string $field_name ) : QForm_Select_Control { 
			return new QForm_Control_Facade_On_Or_Off( $field_name );
		}
		
		/**
		 * Select rows for form control
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/11/22
		 *
		 * @return			object typeof QForm_Select_Control
		 */
		 
		public function holdOrRelease( string $field_name ) : QForm_Select_Control { 
			return new QForm_Control_Facade_Hold_Or_Release( $field_name );
		}
		
		/**
		 * Select rows for form control
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/12/04
		 *
		 * @return			object typeof QForm_Select_Control
		 */
		 
		public function discount( string $field_name ) : QForm_Select_Control { 
			return new QForm_Control_Facade_Discount( $field_name );
		}
		
	}
	
?>