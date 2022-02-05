<?php

	/**
	 * @package		shop
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QShop_Customer_Address extends QDataspace implements QShop_Customer_Address_Interface {
		protected $is_shipping = false;
		protected $factory = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$factory			object typeof QShop_Factory_Interface
		 * @param	$is_shipping		boolean
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @return			void
		 */
		 
		public function __construct( QShop_Factory_Interface $factory, $is_shipping ) {
			$this -> is_shipping = $is_shipping;
			$this -> factory = $factory;
		}
		
		/**
		 * Determine if shipping address or not; if not then must be the billing address
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @return			boolean
		 */
		 
		public function isShipping() {
			return $this -> is_shipping;
		}
		
		public function load() { 
			$this -> getFactory() -> load( $this -> isShipping() );
		}
		
		public function save() {
			$this -> getFactory() -> save( $this -> isShipping() );
		}
		
		/**
		 * Add an address to the customer, either shipping or billing
		 *
		 * @param	$address			array
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see				QShops_Customers_Addresses_Factory::add();
		 * @see				QShops_Customers_Addresses::add();
		 * @return			void
		 */
		 
		public function add( array $address ) { 
			$this -> getFactory() -> add( new QParameters( $address ), $this -> isShipping() );
		}
		
		/**
		 * Transfer a customer's account address to the customer's address
		 *
		 * @param	$address			object typeof QShop_Account_Address_Interface
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @see
		 * @return			void
		 */
		 
		public function transfer( QShop_Account_Address_Interface $address ) {
			$this -> getFactory() -> transfer( $address );
		}
		
		/**
		 * Facilitate access to the customer
		 *
		 * @access			public
		 * @return			object typeof QShop_Customer_Interface
		 */
		 
		public function getCustomer() : QShop_Customer_Interface {
			return $this -> getFactory() -> getCustomer();
		}
		
		/**
		 * Perform an operation on this
		 *
		 * @param	$object			object 
		 *
		 * @note	use the Visitor pattern to decouple responsibilities
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @return			void
		 * @throws			Exception
		 */
		 
		public function operate( QAcceptee_Interface $object ) {
			if( $this -> getCustomer() instanceof QShop_Customer_Interface ) {
				$object -> push( $this -> getCustomer() );
			} else {
				throw new Exception( 'invalid interface, expecting QShop_Customer_Interface [core/shop/customer/address]' );
			}
		}
		
		/**
		 * Return this factory but with restricted access
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @return			object typeof QShops_Customers_Addresses_Factory
		 */
		 
		public function getFactory() {
			return $this -> factory;
		}
		
	}
	
?>