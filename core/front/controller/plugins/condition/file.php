<?php

	abstract class QFront_Controller_Plugins_Condition implements QFront_Controller_Plugin_Interface {
		protected $conditions = array();
		
		public function __construct() {}
		
		public function addCondition( QValidator_Condition $condition ) {
			$this -> conditions[] = $condition;
		}
		
		protected function validate( QDataspace_Interface $dataspace, $logger ) {
			$validation = true;
			
			foreach( $this -> conditions as $condition ) {
				$validation = $condition -> isValid( $dataspace, $logger ) && $validation;
			}
			
			return $validation;
		}
	}
	
?>