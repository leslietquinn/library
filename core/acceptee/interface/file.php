<?php

	/**
	 * @package		none
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	interface QAcceptee_Interface {
		
		/**
		 * @note	put this ::push(); on the class that 
		 *			is to use the visitor
		 *
		 */
		 
		public function push( $acceptable );
	}
	
?>