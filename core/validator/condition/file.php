<?php

	/**
	 * @package		validator
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 */
	 
	abstract class QValidator_Condition {
		
		/**
		 * Validate a resource against condition(s) applied
		 *
		 * @param	$dataspace		object		typeof QDataspace_Interface
		 * @param	$logger			object
		 *
		 * @access				public
		 * @return				boolean			true | false
		 */
		 
		abstract public function isValid( QDataspace_Interface $dataspace, $logger );
	}
	
?>