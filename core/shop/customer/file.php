<?php

	/**
	 * @package		shop
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QShop_Customer extends QDataspace implements QShop_Customer_Interface {
		protected $shipping = null;
		protected $billing = null;
		protected $account = null;
		protected $factory = null;
		protected $charge = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$factory		object typeof QShop_Factory_Interface
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct( QShop_Factory_Interface $factory ) { 
			$this -> factory = $factory;
		}
		
		/**
		 * Pass over the customer account
		 *
		 * @param	$account 		object typeof QShop_Account_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/01
		 *
		 * @see				QShop::getAccount();
		 * @return			void
		 */
		 
		public function setAccount( QShop_Account_Interface $account ) {
			$this -> account = $account;
		}
		
		/**
		 * Create and return the customer's account, one instance only
		 *
		 * @access			public
		 * @introduced		2021/11/01
		 *
		 * @return			object typeof QShop_Account_Interface
		 */
		 
		public function getAccount() : QShop_Account_Interface {
			return $this -> account;
		}
		
		/**
		 * Pass over the shipment charge
		 *
		 * @param	$charge 		object typeof QShop_Shipment_Charge_Interface
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @see				QShop::getShipmentCharge();
		 * @return			void
		 */
		 
		public function setShipmentCharge( QShop_Shipment_Charge_Interface $charge ) {
			$this -> charge = $charge;
		}
		
		/**
		 * Determine if the shipment charge has been created or not
		 *
		 * @access			public
		 * @introduced		2021/10/27
		 *
		 * @see				QShops_Shipments_Charge_Facade::load();
		 * @see				QShops_Customers_Facade::shipping();
		 * @return			bool
		 */
		 
		public function hasShipmentCharge() : bool {
			if( !QNull::is( $this -> charge ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return the shipment charge
		 *
		 * @access			public
		 * @introduced		2021/10/25
		 *
		 * @see				QShops_Shipments_Charge_Facade::load();
		 * @see				QShops_Customers_Facade::shipping();
		 * @return			object typeof QShop_Shipment_Charge_Interface
		 */
		 
		public function getShipmentCharge() : QShop_Shipment_Charge_Interface {
			return $this -> charge;
		}
		
		/**
		 * Pass over the customer's address, either shipping or billing
		 *
		 * @param	$address			object typeof QShop_Customer_Address_Interface 
		 *
		 * @access				public
		 * @introduced			2021/10/26
		 *
		 * @see					QShop_Customer_Address::operate();
		 * @return				void
		 */
		 
		public function setCustomerAddress( QShop_Customer_Address_Interface $address ) { 
		
			/**
			 * @note	set either the shipping address, or the billing 
			 *			address based on the boolean flag in the $address
			 *			its self
			 *
			 */
			
			if( $address -> isShipping() ) {
				$this -> shipping = $address;
			} else {
				$this -> billing = $address;
			}
		}
		
		/**
		 * Return the customer's address, either shipping or billing
		 *
		 * @param	$shipping				boolean
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @see				QShops_Customers_Addresses_Facade_Load::load();
		 * @return			object typeof QShop_Customer_Address_Interface
		 */
		 
		public function getCustomerAddress( bool $shipping ) : QShop_Customer_Address_Interface { 
			if( $shipping ) {
				return $this -> shipping;
			} else {
				return $this -> billing;
			}
		}
		
		/**
		 * Load (fetch) data from the database for this customer
		 *
		 * @access			public
		 * @introduced		2021/10/22
		 *
		 * @see				QShops_Factory::load();
		 * @return			void
		 */
		 
		public function load() {
			$this -> getFactory() -> load();
		}
		
		/**
		 * Save (commit)  data from the database for this customer
		 *
		 * @access			public
		 * @introduced		2021/10/22
		 *
		 * @see				QShops_Factory::save();
		 * @return			void
		 */
		 
		public function save() {
			$this -> getFactory() -> save();
		}
		
		/**
		 * Return the configuration as defined
		 *
		 * @param	$parameter			string
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @return			object typeof QDataspace_Interface
		 */
		 
		public function getConfiguration( $parameter ) : QDataspace_Interface {
			return $this -> getFactory() -> getConfiguration( $parameter );
		}
		
		/**
		 * Log a piece of data
		 *
		 * @param	$log			string
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @see				QShops_Factory::log();
		 * @return			bool
		 */
		 
		public function log( string $log ) : bool {
			if( $this -> getFactory() -> log( $log ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Return access to the current $_SESSION
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			object typeof QHttp_Session_Interface
		 */
		 
		public function getSession() {
			return $this -> getFactory() -> getSession();
		}
		
		/**
		 * Return access to the curreny database resource
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			object typeof QSql_Connection_Interface
		 */
		 
		public function getConnection() {
			return $this -> getFactory() -> getConnection();
		}
		
		/**
		 * Return the ISO 3 Code currency, ie GBP, from the $_SESSION
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			string [A-Z]{3}
		 */
		 
		public function getCurrency() : string {
			return $this -> getFactory() -> getCurrency();
		}
		
		/**
		 * Add an item to the customers basket
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			void
		 */
		 
		public function addItem( QDataspace_Interface $dataspace ) { 
			$this -> getBasket() -> addItem( $dataspace );
		}
		
		/**
		 * Return an item from the customer's basket, by unique code
		 *
		 * @param	$item			string 12
		 *
		 * @access			public
		 * @introduced		2021/10/19
		 *
		 * @return			object typeof QDataspace_Interface
		 */
		 
		public function getItem( string $item ) {
			return $this -> getBasket() -> getItem( $item );
		}
		
		/**
		 * Remove an item from the customer's basket, by unique code
		 *
		 * @note	no longer applicable; use QShop::addItem(); to remove
		 *			a basket item based on 0 quantity, this remains for 
		 *			history
		 *
		 * @param	$item			string 12
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @see				QShop::removeItem();
		 * @return			boolean
		 */
		 
		public function removeItem( string $item ) : bool {
			if( $this -> getBasket() -> removeItem( $item ) ) {
				return true;
			}
			
			return false;
		}
		
		/**
		 * Allow access to the customers basket, and also the coupon and sale
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @see				QShops_Factory
		 * @return			object	typeof QShop_Customer_Basket_Interface
		 */
		 
		public function getBasket() : QShop_Customer_Basket_Interface { 
			
			/**
			 * @note	pass the $customer along to the basket
			 *
			 */
			 
			return $this -> getFactory() -> getBasket( $this );
		}
		
		/**
		 * Perform an operation on this
		 *
		 * @param	$object			object 
		 *
		 * @note	use the Visitor pattern to decouple responsibilities
		 *
		 * @access			public
		 * @return			void
		 * @throws			QShop_Customer_Exception
		 */
		 
		public function operate( QAcceptee_Interface $object ) {
			if( $this instanceof QShop_Customer_Interface ) {
				$object -> push( $this );
			} else {
				throw new Exception( 'invalid interface, expecting QShop_Customer_Interface [core/shop/customer]' );
			}
		}
		
		/**
		 * Return this factory but with restricted access
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			object typeof QShops_Factory
		 */
		 
		public function getFactory() : QShop_Factory_Interface {
			return $this -> factory;
		}
		
	}
	
?>