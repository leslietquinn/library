<?php

	/**
	 * @package		shop
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QShop_Account_Address extends QDataspace implements QShop_Account_Address_Interface {
		protected $is_shipping = false;
		protected $factory = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$factory		object typeof QShop_Factory_Interface
		 * @param	$is_shipping	bool
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @return			void
		 */
		 
		public function __construct( QShop_Factory_Interface $factory, bool $is_shipping ) {
			$this -> is_shipping = $is_shipping;
			$this -> factory = $factory;
		}
		
		/**
		 * Determine if shipping address or not; if not then must be the billing address
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @return			boolean
		 */
		 
		public function isShipping() {
			return $this -> is_shipping;
		}
		
		/**
		 * Load (fetch) account address from the database, either shipping or billing
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see
		 * @return			void
		 */
		 
		public function load() { 
			$this -> getFactory() -> load( $this -> isShipping() );
		}
		
		/**
		 * Save (commit) account address to database, either shipping or billing
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see	
		 * @return			void
		 */
		 
		public function save() {
			$this -> getFactory() -> save( $this -> isShipping() );
		}
		
		/**
		 * Add an address to the account, prior to a save
		 *
		 * @param	$dataspace			array
		 * 
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see
		 * @return			void
		 */
		 
		public function add( array $dataspace ) {
			$this -> getFactory() -> add( new QParameters( $dataspace ), $this -> isShipping() );
		}
		
		/**
		 * Create (insert) an  address to the account
		 *
		 * @param	$dataspace			array
		 * 
		 * @access			public
		 * @introduced		2021/11/02
		 *
		 * @see
		 * @return			void
		 */
		 
		public function create( array $dataspace ) {
			$this -> getFactory() -> create( new QParameters( $dataspace ), $this -> isShipping() );
		}
		
		/**
		 * Facilitate access to the customer
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
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
		 * @introduced		2021/10/28
		 *
		 * @return			void
		 * @throws			Exception
		 */
		 
		public function operate( QAcceptee_Interface $object ) { 
			if( $this -> getCustomer() instanceof QShop_Customer_Interface ) {
				$object -> push( $this -> getCustomer() );
			} else {
				throw new Exception( 'invalid interface, expecting QShop_Customer_Interface [core/shop/account/address]' );
			}
		}
		
		/**
		 * Return this factory but with restricted access
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @return			object typeof QShop_Factory_Interface
		 */
		 
		public function getFactory() : QShop_Factory_Interface {
			return $this -> factory;
		}
		
	}
	
?>