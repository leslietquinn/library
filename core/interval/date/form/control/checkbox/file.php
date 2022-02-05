<?php
	
	final class QDate_Form_Control_Checkbox extends QForm_Checkbox_Control {
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function toArray() {
			return array( new QParameters( array( 'id' => $this -> field_name ) ) );
		}
	}
	
?>