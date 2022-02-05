<?php
	
	interface QShop_Policies_Controller_Interface {
		
		/**
		 * Run one or more policies and their rules again a domain object
		 *
		 * @param	$client			object typeof QShop_Policies_Client
		 * @param	$factory		object typeof QShop_Policies_Rules_Factory_Interface
		 * @param	$request		object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @return			object typeof QShop_Policies_Controller_Interface
		 */
		 
		public function run( QShop_Policies_Client $client, QShop_Policies_Rules_Factory_Interface $factory, QDataspace_Interface $request );
	}
	
?>