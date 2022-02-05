<?php

	/**
	 * @package		shop
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
	
	final class QShop implements QShop_Interface {
		private $factory = null;
		
		const CUSTOMER = '__customer__';
		
		const ADDRESS_LINE_1 = '__house__';
		const ADDRESS_LINE_2 = '__street__';
		const ADDRESS_LINE_3 = '__city__';
		const ADDRESS_LINE_4 = '__region__';
		const ADDRESS_LINE_5 = '__postcode__';
		const ADDRESS_COUNTRY = '__country__';
		
		const ADDRESS_SEPARATOR = ',';
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Import a file
		 *
		 * @param	$importer		object typeof QShop_Importer_Datasource_Interface
		 * @param	$package		array
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see				QShop_Importer:__construct();
		 * @return			object typeof QShop_Importer_Interface
		 */
		 
		public function import( QShop_Importer_Datasource_Interface $datasource, array $package ) : QShop_Importer_Interface {
			return $this -> getFactory() -> import( $datasource, $package );
		}
		
		public function export() {}
		
		/**
		 * Add a coupon to the customer's basket
		 *
		 * @param	$coupon			string
		 *
		 * @access			public
		 * @introduced		2021/10/24
		 *
		 * @see				QShop_Customer_Basket_Coupon::add();
		 * @return			object typeof QShop_Interface
		 */
		 
		public function addCoupon( string $coupon ) : QShop_Interface {
			
			/**
			 * @note	just to be sure the coupon is all 
			 *			uppercase letters now; rather than later 
			 *
			 */
			 
			$coupon = strtoupper( $coupon );
			$this -> getCustomer() -> getBasket() -> getCoupon() -> add( $coupon );
			
			return $this;
		}
		
		/**
		 * Remove the customer's coupon
		 *
		 * @access			public
		 * @introduced		2021/10/25
		 *
		 * @see				QShop_Customer_Basket_Coupon::remove();
		 * @return			void
		 */
		 
		public function removeCoupon() {
			$this -> getCustomer() -> getBasket() -> getCoupon() -> remove();
		}
		
		/**
		 * Add a deal to the customer's basket
		 *
		 * @param	$items			array
		 *
		 * @access			public
		 * @introduced		2021/10/22
		 *
		 * @return			object typeof QShop_Interface
		 */
		 
		public function addDeal( array $items ) : QShop_Interface {
			if( is_array( $items ) && count( $items ) == 4 ) {
				foreach( $items as $item ) {
					$this -> addItem( $item );
				}
			}
			
			return $this;
		}
		
		/**
		 * Add an item to the customer's basket
		 *
		 * @param	$item			array
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			object typeof QShop_Interface
		 */
		 
		public function addItem( array $item ) : QShop_Interface { 
			$this -> getCustomer() -> addItem( new QParameters( $item ) ); 
			
			/**
			 * @note	return $this so we can chain multiple calls together
			 *
			 */
			 
			return $this;
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
		 
		public function getItem( string $item ) : QDataspace_Interface {
			return $this -> getCustomer() -> getItem( $item );
		}
		
		/**
		 * Remove an item from the customer's basket, by unique code
		 *
		 * @param	$item			string 12
		 *
		 * @access			public
		 * @introduced		2021/10/31
		 *
		 * @return			object typeof QShop_Interface
		 */
		 
		public function removeItem( string $item ) : QShop_Interface {
			$this -> addItem( 
				array(
					'product'	=>	$item,
					'quantity'	=>	0,
				)
			);
			
			return $this;
		}
		
		/**
		 * Prepare to load (fetch) data from the database
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @see				QShops_Customers_Factory::load();
		 * @see				QShops_Accounts_Factory::load();
		 * @return			void
		 */
		 
		public function load() {
			$this -> getCustomer() -> load();
		}
		
		/**
		 * Prepare to save (commit) data to the database
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @see				QShops_Customers_Factory::save();
		 * @see				QShops_Accounts_Factory::save();
		 * @return			void
		 */
		 
		public function save() {
			$this -> getCustomer() -> save();
		}
		
		/**
		 * Return the customer
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			object typeof QShop_Customer_Interface
		 */
		 
		public function getCustomer() : QShop_Customer_Interface {
			return $this -> getFactory() -> getCustomer();
		}
		
		/**
		 * Return the customer account
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see				QShops_Accounts_Factory::getAccount();
		 * @return			object typeof QShop_Account_Interface
		 */
		 
		public function getAccount() : QShop_Account_Interface {
			$factory = new QShops_Accounts_Factory();
			$account = $factory -> getAccount( $this -> getCustomer() );
			
			$this -> getCustomer() -> setAccount( $account );
			
			return $account;
		}
		
		/**
		 * Return the shipment charge
		 *
		 * @access			public
		 * @introduced		2021/10/25
		 *
		 * @see				QShop_Customer::setShipmentCharge();
		 * @see				QShops_Shipments_Charges_Factory::getShipmentCharge();
		 * @return			object typeof QShops_Shipments_Charges_Factory
		 */
		 
		public function getShipmentCharge() : QShop_Shipment_Charge_Interface {
			$factory = new QShops_Shipments_Charges_Factory();
			$charge = $factory -> getShipmentCharge( $this -> getCustomer() );
			
			/**
			 * @note	before returning the shipment charge, set it up for 
			 *			the customer first
			 *
			 */
			 
			$this -> getCustomer() -> setShipmentCharge( $charge );
			
			return $charge;
		}
		
		/**
		 * Return the customer's address, shipping or billing
		 *
		 * @param	$shipping			bool
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @see				QShop_Customer::getCustomerAddress();
		 * @return			object typeof QShop_Customer_Address_Interface
		 */
		 
		public function getCustomerAddress( bool $shipping ) : QShop_Customer_Address_Interface {
			$factory = new QShops_Customers_Addresses_Factory();
			$address = $factory -> getAddress( $this -> getFactory() -> getCustomer(), $shipping );
			
			/**
			 * @note	set the address for the customer to access from  
			 *			QShops_Customers_Addresses::*
			 *
			 */
			 
			$this -> getFactory() -> getCustomer() -> setCustomerAddress( $address );
			
			return $address;
		}
		
		/**
		 * Return this factory but with restricted access
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			object typeof QShop_Factory_Interface
		 */
		 
		public function getFactory() : QShop_Factory_Interface {
			if( QNull::is( $this -> factory ) ) {
				$this -> factory = new QShops_Factory();
			}
			
			return $this -> factory;
		}
		
		/**
		 * Discount a price by a certain percentage amount with format
		 *
		 * @note	no longer use float in mysql; use decimal instead as float is being 
		 * 			deprecated
		 * 
		 * @param	$price			float 8,2
		 * @param	$discount		integer
		 *
		 * @static
		 * @access			public
		 * @return			string
		 */
		 
		static public function discount( float $price, int $discount_by ) : string { 
			return (string) number_format( QMaths::percentageFrom( $price, $discount_by ), 2, '.', '' );
		}
		
		/**
		 * Number format to two decimal places, alias PHP function
		 *
		 * @todo		need to refactor to account for currency in use, that 
		 *				means to utilise the existing solution for currency formats
		 *				@see QInternationalisation_Formatter
		 *
		 * @param	$float				float 8,2
		 *
		 * @static
		 * @access				public
		 * @introduced			2021/10/23
		 *
		 * @return				string
		 */
		 
		static public function format( $float, $currency = 'GBP' ) : string {
			return (string) number_format( $float, 2, '.', '' );
		}
	}
	
	/**
	 * example of use
	 *
	 *	$shop = new QShop(); 
	 *	$shop -> getShipmentCharge() -> load();
	 *
	 *	$shop -> load();
	 *	$shop -> addCoupon( 'NEWSLETTER' );
	 *	$shop -> addItem(
	 *		array(
	 *			'product' => '', 'quantity' => 1, 'price' => '', 
	 *		)
	 *	) -> addItem( array( ... ) );
	 *
	 *	$shop -> removeItem( '...' );
	 *
	 *	$account = $shop -> getAccount();
	 *	$account -> load();
	 *
	 *	$account -> getAccountAddress( true ) -> load();
	 *	$account -> getAccountAddress( true ) -> save();
	 *	$account -> getAccountAddress( false ) -> load();
	 *	$account -> getAccountAddress( false ) -> save();
	 *
	 *	$account -> save();
	 *	$shop -> save();
	 */
	
?>