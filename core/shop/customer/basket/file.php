<?php

	/**
	 * @package		shop
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QShop_Customer_Basket extends QDataspace implements QShop_Customer_Basket_Interface {
		protected $coupon_factory = null;
		protected $parameters = array();
		protected $sale_factory = null;
		protected $factory = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$factory		object typeof QShop_Factory_Interface
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct( QShop_Factory_Interface $factory ) {
			$this -> parameters = array();
			$this -> factory = $factory;
			parent::__construct();
		}
		
		/**
		 * Faciliate the aggregation of sub total of each item, based on price * quantity
		 *
		 * @access 			public
		 * @introduced		2021/10/23
		 *
		 * @see				QShops_Factory::save();
		 * @see				QShop_Customer_Basket::aggregate();
		 * @return			void
		 */
		 
		public function aggregate() {
			$this -> getFactory() -> aggregate();
		}
		
		/**
		 * Load (fetch) data from the database for this customer
		 *
		 * @access			public
		 * @introduced		2021/10/22
		 *
		 * @see				QShops_Customers_Factory::load();
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
		 * @see				QShops_Customers_Factory::save();
		 * @return			void
		 */
		 
		public function save() {
			$this -> getFactory() -> save();
		}
		
		/**
		 * Add an item to the basket, by unique code
		 *
		 * @param	$dataspace		object typeof QDataspace_Interface 
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @see				QShops_Customers_Factory::addItem();
		 * @return			void
		 */
		 
		public function addItem( QDataspace_Interface $dataspace ) { 
			$this -> getFactory() -> addItem( $dataspace );
		}
		
		/**
		 * Return a specified basket item, by unique code
		 *
		 * @param	$item			string 12 
		 *
		 * @access			public
		 * @introduced		2020/10/21
		 *
		 * @return			mixed
		 */
		 
		public function getItem( $item ) { 
		
			/**
			 * @note	leave here for now; but move to a facade on the 
			 *			factory if need be
			 *
			 */
			 
			if( array_key_exists( $item, $this -> parameters ) ) {
				return $this -> parameters[$item];
			}
			
			return null;
		}
		
		/**
		 * Remove an item from the basket, by unique code
		 *
		 * @param	$item		string 12 
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @see				QShops_Customers_Factory::removeItem();
		 * @return			boolean
		 */
		 
		public function removeItem( $item ) { 
			$this -> getFactory() -> removeItem( $item );
		}
		
		/**
		 * Facilitate access to the customer
		 *
		 * @access			public
		 * @introduced		2021/10/22
		 *
		 * @see				QShops_Customers_Factory::getCustomer();
		 * @return			object typeof QShop_Customer_Interface
		 */
		 
		public function getCustomer() {
			return $this -> getFactory() -> getCustomer();
		}
		
		/**
		 * Create the customer's coupon
		 *
		 * @access			public
		 * @introduced		2021/10/23
		 *
		 * @see				
		 * @return			object typeof QShop_Customer_Basket_Coupon_Interface
		 */
		 
		public function getCoupon() {
			if( QNull::is( $this -> coupon_factory ) ) {
				$this -> coupon_factory = new QShops_Coupons_Factory();
			}
			
			return $this -> coupon_factory -> getCoupon( $this -> getCustomer() );
		}
		
		/**
		 * Facilitate access to a sale
		 *
		 * @access			public
		 * @introduced		2021/10/23
		 *
		 * @see
		 * @return			object typeof QShop_Sale_Interface
		 */
		 
		public function getSale() {
			if( QNull::is( $this -> sale_factory ) ) {
				$this -> sale_factory = new QShops_Sales_Factory();
			}
			
			return $this -> sale_factory -> getSale( $this -> getCustomer() );
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
		 * @throws			QShop_Customer_Basket_Exception
		 */
		 
		public function operate( QAcceptee_Interface $object ) {
			if( $this -> getCustomer() instanceof QShop_Customer_Interface ) {
				$object -> push( $this -> getCustomer() );
			} else {
				throw new QShop_Customer_Basket_Exception( 'invalid interface, expecting QShop_Customer_Interface' );
			}
		}
		
		/**
		 * Return this factory but with restricted access
		 *
		 * @access			private
		 * @introduced		2021/10/21
		 *
		 * @return			object typeof QShops_Customers_Factory
		 */
		 
		public function getFactory() {
			return $this -> factory;
		}
	}

?>