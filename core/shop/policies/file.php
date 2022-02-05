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
	
	final class QShop_Policies implements QShop_Policies_Interface, QFilter_Interface {
		private $rules = array();
		private $factory = null;
		private $client = null;
		private $policy;
		
		/**
		 * Class constructor, flush rules
		 *
		 * @param	$client			object typeof QShop_Policies_Client
		 * @param	$factory		object typeof QShop_Policies_Rules_Factory_Interface
		 * @param	$policy			string, name of policy
		 *
		 * @access			public
		 * @introduced		2021/11/27
		 *
		 * @return			void
		 */
		 
		public function __construct( QShop_Policies_Client $client, QShop_Policies_Rules_Factory_Interface $factory, string $policy ) {
			$this -> factory = $factory;
			$this -> client = $client;
			$this -> policy = $policy;
			
			$this -> rules = array();
		}
		
		/**
		 * Process one or more rules against a $dao
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @see				QFilter_Interface
		 * @see				QShop_Policies_Controller::run();
		 *
		 * @return			void
		 * @throws			QShop_Policies_Exception
		 */
		 
		public function process() {
			$args = func_get_args();
			$request = array_shift( $args );
			
			foreach( $this -> rules as $rule ) {
				if( !$request instanceof QDataspace_Interface ) {
					throw new QShop_Policies_Exception( 'thrown exception: unexpected interface [core/shop/policies] 66' );
				}
				
				$rule -> process( $this, $request );
			}
		}
		
		/**
		 * Load associated rules to this policy, using the $client
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @return			bool
		 */
		 
		public function loadRules() : bool {
			$this -> rules = $this -> factory -> load( $this -> client, $this -> policy() );
			
			if( is_array( $this -> rules ) && count( $this -> rules ) > 0 ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return the policy, as a MD5 hash
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @return			string
		 */
		 
		public function policy() : string {
			return $this -> policy;
		}
		
	}
	
?>