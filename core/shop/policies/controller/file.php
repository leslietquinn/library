<?php
	
	/**
	 * @package		shop
	 * @subpackage	shop policies
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	/**
	 * Copyright Notice
	 *
	 * Class and class functions [implementation] is the sole ownership and
	 * copyright owner of Leslie Quinn <les.quinn.2012@gmail.com>
	 *
	 * No part of this script, or associated script found within the framework
	 * may be used in any way, in whole or in part without prior written
	 * permission of Leslie Quinn
	 */
	
	final class QShop_Policies_Controller implements QShop_Policies_Controller_Interface {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Run the policies and their rules against data sets specified
		 *
		 * @param	$client				object typeof QShop_Policies_Client
		 * @param	$factory			object typeof QShop_Policies_Rules_Factory_Interface
		 * @param	$request			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @note	it is possible to run multiple policies independently of each other
		 *
		 * @return			object typeof QShop_Policies_Controller_Interface
		 */
		 
		public function run( QShop_Policies_Client $client, QShop_Policies_Rules_Factory_Interface $factory, QDataspace_Interface $request ) : QShop_Policies_Controller_Interface {
			$policies = $client -> request( $factory );
			
			foreach( $policies as $policy ) { 
				if( $policy -> loadRules() ) {
					
					/**
					 * @note	a policy has one or more rules, based on the QFilter_Interface, each 
					 *			rule has its own data to work with on sets of client data
					 */
					 
					$policy -> process( $request );
				}				
			}
			
			return $this;
		}
	}
	
?>