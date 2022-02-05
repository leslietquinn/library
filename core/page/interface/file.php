<?php

	/**
	 * @package		page
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @ignore
	 */
	 
	interface QPage_Interface extends QAcceptance_Interface {
		public function escape( string $parameter, string $encoding = 'UTF-8' );
	}
	
?>