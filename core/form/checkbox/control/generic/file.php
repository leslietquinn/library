<?php
	
	final class QForm_Checkbox_Control_Generic extends QForm_Checkbox_Control {
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * @note	use QForm_CheckBox_Control::GENERIC_NAME for the $field_name
		 *
		 */
		 
		public function toArray() {
			return array( new QParameters( array( 'id' => $this -> field_name ) ) );
		}
	}
	
?>