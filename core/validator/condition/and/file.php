<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QValidator_Condition_And extends QValidator_Condition { 
		protected $source = null;
		protected $target = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$source			object typeof QValidator_Condition
		 * @param	$target			object typeof QValidator_Condition
		 *
		 * @access			public
		 *
		 * @return			void
		 */
		 
		public function __construct( QValidator_Condition $source, QValidator_Condition $target ) {
			$this -> source = $source;
			$this -> target = $target;
		}
		
		/**
		 * Validate that two conditions are true, both together otherwise false
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 * @param	$logger				object typeof QDataspace_Interface
		 *
		 * @access			public
		 * 
		 * @return			bool
		 */
		 
		public function isValid( QDataspace_Interface $dataspace, $logger ) : bool {
			return $this -> target -> isValid( $dataspace, $logger ) && $this -> source -> isValid( $dataspace, $logger );
		}
	}
	
?>