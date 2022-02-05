<?php

	/**
	 * @package		shop
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QShop_Customer_Basket_Coupon extends QDataspace implements QShop_Customer_Basket_Coupon_Interface {
		protected $factory = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$factory		object typeof QShop_Factory_Interface
		 *
		 * @access			public
		 * @introduced		2021/10/23
		 *
		 * @return			void
		 */
		 
		public function __construct( QShop_Factory_Interface $factory ) { 
			$this -> factory = $factory;
			parent::__construct();
		}
		
		/**
		 * Load (fetch) data from the database for the customer's coupon
		 *
		 * @access			public
		 * @introduced		2021/10/23
		 *
		 * @see				QShops_Coupons_Factory::load();
		 * @return			void
		 */
		 
		public function load() {
			$this -> getFactory() -> load();
		}
		
		/**
		 * Save (commit)  data from the database for this customer
		 *
		 * @access			public
		 * @introduced		2021/10/23
		 *
		 * @see				QShops_Coupons_Factory::save();
		 * @return			void
		 */
		 
		public function save() {
			$this -> getFactory() -> save();
		}
		
		/**
		 * Add a coupon to the customer's basket
		 *
		 * @param	$coupon			string 
		 *
		 * @access				public
		 * @introduced			2021/10/25
		 *
		 * @see					QShops_Coupons_Factory::add();
		 * @return				void
		 */
		 
		public function add( $coupon ) {
			$this -> getFactory() -> add( $coupon );
		}
		
		/**
		 * Remove a coupon to the customer's basket
		 *
		 * @access				public
		 * @introduced			2021/10/25
		 *
		 * @see					QShops_Coupons_Factory::remove();
		 * @return				void
		 */
		 
		public function remove() {
			$this -> getFactory() -> remove();
		}
		
		/**
		 * Adjust the customer's aggregate basket amount based on the coupon
		 *
		 * @access			public
		 * @introduced		2021/10/25
		 *
		 * @see				QShops_Coupons_Factory::discount();
		 * @return			void
		 */
		 
		public function discount() { 
			$this -> getFactory() -> discount();
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
		 * Perform an operation on the database
		 *
		 * @param	$object			object 
		 *
		 * @note	use the Visitor pattern to decouple responsibilities
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function operate( QAcceptee_Interface $object ) {
			if( $this -> getCustomer() instanceof QShop_Customer_Interface ) {
				$object -> push( $this -> getCustomer() );
			} else {
				throw new QShop_Customer_Exception( 'invalid interface, expecting QShop_Customer_Interface' );
			}
		}
		
		/**
		 * Return this factory but with restricted access
		 *
		 * @access			public
		 * @introduced		2021/10/21
		 *
		 * @return			object typeof QShops_Coupons_Factory
		 */
		 
		public function getFactory() {
			return $this -> factory;
		}
		
	}
	
?>