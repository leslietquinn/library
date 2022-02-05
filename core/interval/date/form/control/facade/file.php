<?php
	
	final class QDate_Form_Control_Facade {
		
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
		 
		public function checkbox( string $field_name ) : QForm_Select_Control { 
			return new QDate_Form_Control_Facade_Checkbox( $field_name );
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
		 
		public function day( string $field_name ) : QForm_Select_Control { 
			return new QDate_Form_Control_Facade_Day( $field_name );
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
		 
		public function hour( string $field_name ) : QForm_Select_Control { 
			return new QDate_Form_Control_Facade_Hour( $field_name );
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
		 
		public function minute( string $field_name ) : QForm_Select_Control { 
			return new QDate_Form_Control_Facade_Minute( $field_name );
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
		 
		public function month( string $field_name ) : QForm_Select_Control { 
			return new QDate_Form_Control_Facade_Month( $field_name );
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
		 
		public function second( string $field_name ) : QForm_Select_Control { 
			return new QDate_Form_Control_Facade_Second( $field_name );
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
		 
		public function year( string $field_name ) : QForm_Select_Control { 
			return new QDate_Form_Control_Facade_Year( $field_name );
		}
		
	}
	
?>