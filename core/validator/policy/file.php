<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 */
	 
	final class QValidator_Policy extends QValidator_Condition {
		protected $condition = null;
		
		public function __construct() {}
		
		/**
		 * Add a condition to this policy
		 *
		 * @param	$condition		object		typeof QValidator_Condition
		 *
		 * @access				public
		 * @return				object
		 */
		 
		public function addCondition( QValidator_Condition $condition ) {
			if( !is_null( $this -> condition ) ) {
				$this -> condition = new QValidator_Condition_And( $this -> condition, $condition );
			} else {
				// add initial condition
				$this -> condition = $condition;
			}
			
			// allow for method chaining
			return $this;
		}
		
		/**
		 * Add an optional condition to this policy
		 *
		 * @param	$condition		object		typeof QValidator_Condition
		 *
		 * @access				public
		 * @return				object
		 */
		 
		public function orCondition( QValidator_Condition $condition ) {
			if( !is_null( $this -> condition ) ) {
				$this -> condition = new QValidator_Condition_Or( $this -> condition, $condition );
			} else {
				// add initial condition
				$this -> condition = $condition;
			}
			
			// allow for method chaining
			return $this;
		}
		
		/**
		 * Validate data against conditions held in this policy
		 *
		 * @param	$dataspace		object
		 * @param	$logger			object
		 *
		 * @access			public
		 * @return			boolean
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) {
			return $this -> condition -> isValid( $dataspace, $logger );
		}
	}
	
?>