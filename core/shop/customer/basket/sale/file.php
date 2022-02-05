<?php

	/**
	 * @package		shop
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QShop_Customer_Basket_Sale extends QDataspace implements QShop_Customer_Basket_Sale_Interface {
		protected $factory = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$factory		object typeof QShop_Factory_Interface
		 *
		 * @access			public
		 * @introduced		2021/10/24
		 *
		 * @return			void
		 */
		 
		public function __construct( QShop_Factory_Interface $factory ) { 
			$this -> factory = $factory;
			parent::__construct();
		}
		
		/**
		 * Load (fetch) data from the database for the customer's sale item
		 *
		 * @access			public
		 * @introduced		2021/10/24
		 *
		 * @see				QShops_Sales_Factory::load();
		 * @return			void
		 */
		 
		public function load() {
			$this -> getFactory() -> load();
		}
		
		/**
		 * Facilitate access to the customer
		 *
		 * @access			public
		 * @return			object typeof QShop_Customer_Interface
		 */
		 
		public function getCustomer() {
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
		 * @introduced		2021/10/24
		 *
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
		 * @introduced		2021/10/24
		 *
		 * @return			object typeof QShops_Sales_Factory
		 */
		 
		public function getFactory() {
			return $this -> factory;
		}
		
	}
	
?>