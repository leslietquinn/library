<?php

	interface QValidator_Interface {
		public function addCondition( QValidator_Condition $condition );
		public function validate( QDataspace_Interface $dataspace, $logger );
	}
	
?>