<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QValidator_Condition_Or extends QValidator_Condition {
		protected $source = null;
		protected $target = null;
		
		public function __construct( QValidator_Condition $source, QValidator_Condition $target ) {
			$this -> source = $source;
			$this -> target = $target;
		}
		
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			return $this -> target -> isValid( $dataspace, $logger ) || $this -> source -> isValid( $dataspace, $logger );
		}
	}
	
?>