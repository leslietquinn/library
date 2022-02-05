<?php
	
	final class QValidator_Condition_Http_Get extends QValidator_Condition {
		public function __construct() {} // not implemented
		
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			return $dataspace -> requestMethod() == (string) 'GET';
		}
	}
	
?>