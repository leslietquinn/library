<?php
	
	abstract class QShop_Policies_Rules_Factory implements QShop_Policies_Rules_Factory_Interface {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Load rules based on $client and $policy given
		 *
		 * @param	$client				object
		 * @param	$policy				string
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 * @abstract
		 *
		 * @see				QShop_Policies::loadRules();
		 *
		 * @return			array
		 */
		 
		abstract public function load( QShop_Policies_Client $client, string $policy );
	}
	
?>