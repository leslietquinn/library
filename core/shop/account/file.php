<?php

	/**
	 * @package		shop
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QShop_Account extends QDataspace implements QShop_Account_Interface {
		const PASSPHRASE = '__account__';
		
		protected $shipping = null;
		protected $billing = null;
		protected $factory = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$factory		object
		 *
		 * @access			public
		 * @introduced		2021/10/19
		 *
		 * @see				QShops_Accounts_Factory::getAccount();
		 * @return			void
		 */
		 
		public function __construct( QShop_Factory_Interface $factory ) {
			$this -> factory = $factory;
			parent::__construct();
		}
		
		/**
		 * Create a new (insert) account to the database
		 *
		 * @param	$dataspace			array
		 *
		 * @access			public
		 * @introduced		2021/10/29
		 *
		 * @see
		 * @return			void
		 */
		 
		public function create( array $dataspace ) {
			$this -> getFactory() -> create( new QParameters( $dataspace ) );
		}
		
		/**
		 * Use credentials provided to sign into account
		 *
		 * @param	$dataspace			array
		 *
		 * @access			public
		 * @introduced		2021/10/29
		 *
		 * @see
		 * @return			void
		 */
		 
		public function signin( array $dataspace ) {
			$this -> getFactory() -> signin( new QParameters( $dataspace ) );
		}
		
		/**
		 * Load (fetch) account from the database
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see
		 * @return			void
		 */
		 
		public function load() { 
			$this -> getFactory() -> load();
		}
		
		/**
		 * Save (commit) account to the database
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see
		 * @return			void
		 */
		 
		public function save() { 
			$this -> getFactory() -> save();
		}
		
		/**
		 * Add account to the customer
		 *
		 * @param	$dataspace			array
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see				QShops_Accounts_Factory::add();
		 * @return			void
		 */
		 
		public function add( array $dataspace ) { 
			$this -> getFactory() -> add( new QParameters( $dataspace ) );
		}
		
		/**
		 * Toggle the status of an account
		 *
		 * @param	$status			bool
		 *
		 * @access			public
		 * @introduced		2021/10/29
		 *
		 * @see
		 * @return			void
		 */
		 
		public function status( bool $status ) { 
			$this -> getFactory() -> status( $status );
		}
		
		/**
		 * Change password and passphrase of an account
		 *
		 * @param	$dataspace			array
		 *
		 * @access			public
		 * @introduced		2021/10/30
		 *
		 * @see
		 * @return			void
		 */
		 
		public function passphrase( array $dataspace ) { 
			$this -> getFactory() -> passphrase( new QParameters( $dataspace ) );
		}
				
		/** 
		* Facilitate access to the customer
		*
		* @access			public
		* @introduced		2021/10/28
		*
		* @see				QShops_Accounts_Factory::getCustomer();
		* @return			object typeof QShop_Customer_Interface
		*/
		
		public function getCustomer() : QShop_Customer_Interface {
			return $this -> getFactory() -> getCustomer();
		}
		
		/**
		 * Return the customer's account address, shipping or billing
		 *
		 * @param	$shipping			bool
		 *
		 * @access			public
		 * @introduced		2021/10/31
		 *
		 * @see				QShops_Accounts_Addresses_Factory::getAccountAddress();
		 * @return			object typeof QShop_Account_Address_Interface
		 */
		 
		public function getAccountAddress( bool $shipping ) : QShop_Account_Address_Interface {
			$factory = new QShops_Accounts_Addresses_Factory(); 
			
			if( $shipping ) {
				if( QNull::is( $this -> shipping ) ) {
					$this -> shipping = $factory -> getAccountAddress( $this, $shipping );
				}
				
				return $this -> shipping;
			} else {
				if( QNull::is( $this -> billing ) ) {
					$this -> billing = $factory -> getAccountAddress( $this, $shipping );
				}
				
				return $this -> billing;
			}
		}
		
		/**
		 * Perform an operation on this
		 *
		 * @param	$object			object 
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
				throw new Exception( 'invalid interface, expecting QShop_Customer_Interface [core/shop/account]' );
			}
		}
		
		/**
		 * Return this factory 
		 *
		 * @access			public
		 * @introduced		2021/10/28
		 *
		 * @see				QShops_Accounts_Factory
		 * @return			object typeof QShop_Factory_Interface
		 */
		 
		public function getFactory() : QShop_Factory_Interface {
			return $this -> factory;
		}
		
	}
	
?>