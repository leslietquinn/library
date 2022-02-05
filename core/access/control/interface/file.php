<?php

	/**
	 * @package		access control
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	interface QAccess_Control_Interface {
		public function can( $role, $module, $privilege );
	}
	
?>