<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn
	 */
	 
	final class QValidator implements QValidator_Interface {
		private $conditions = array();
		
		public function __construct() {
			$this -> conditions = array();
		}
		
		public function addCondition( QValidator_Condition $condition ) : void {
			$this -> conditions[] = $condition;
		}
		
		public function validate( QDataspace_Interface $request, $logger ) : bool {
			$validation = true;
			foreach( $this -> conditions as $condition ) {
				$validation = $condition -> isValid( $request, $logger ) && $validation;
			}
			return $validation;
		}
		
		/**
		 * Return an instance of QValidator_Policy to facilitate the 
		 * creation of a validation policy (one or more conditions)
		 *
		 * @access				public
		 * @return				object
		 */
		 
		static public function factory() {
			return new QValidator_Policy();
		}
	}
	
?>