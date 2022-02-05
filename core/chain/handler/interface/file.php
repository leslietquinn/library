<?php

	interface QChain_Handler_Interface {
	
		/**
		 * Handle a given action from a range of possible actions
		 *
		 * @param	$dataspace			object		typeof QDataspace_Interface
		 * @param	$actions			array		an array of actions
		 * @param	$field_name			string		form field to use, for action comparison
		 *
		 * @return						mixed
		 */
		 
		public function handle( QDataspace_Interface $dataspace, array $actions, string $field_name );
	}
	
?>