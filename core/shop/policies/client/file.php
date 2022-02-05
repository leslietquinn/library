<?php

	/**
	 * @package		shop
	 * @subpackage	shop policies
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @abstract
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
	
	abstract class QShop_Policies_Client {
		protected $client;
		
		/**
		 * Class constructor
		 *
		 * @param	$client			string
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @return			void
		 */
		 
		public function __construct( string $client ) {
			$this -> client = $client;
		}
		
		/**
		 * A request for policies has been made
		 *
		 * @param	$factory 		object typeof QShop_Policies_Rules_Factory_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @return			array
		 */
		 
		public function request( QShop_Policies_Rules_Factory_Interface $factory ) : array {
			$policies = $this -> queryClient();
			
			$classes = array();
			foreach( $policies as $policy ) {
				
				/**
				 * @note	use a factory to decouple responsibility from $client and 
				 *			the lower domain layers; we might want to use something else 
				 *			for a data source 
				 */
				 
				$classes[] = new QShop_Policies( $this, $factory, $policy );
			}
			
			return $classes;
		}
		
		/**
		 * Query the data source for policies owned by client
		 *
		 * @access			protected
		 * @introduced		2021/12/07
		 *
		 * @return			array
		 * @abstract
		 */
		 
		abstract protected function queryClient();
		
	}
	
?>