<?php

	/**
	 * @package		none
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	interface QAcceptance_Interface {
		
		/**
		 * @note	the $acceptee is the Visitor pattern implementation, 
		 *			use: $acceptee -> push( $this ); where $this must also 
		 *			implement the QAcceptee_Interface
		 *
		 */
		 
		public function accept( QAcceptee_Interface $acceptee );
	}
	
?>