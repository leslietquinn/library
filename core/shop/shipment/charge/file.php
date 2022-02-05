<?php

	/**
	 * @package		shop
	 * @subpackage	dataspace
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QShop_Shipment_Charge extends QDataspace implements QShop_Shipment_Charge_Interface {
		protected $factory = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$factory		object typeof QShops_Shipments_Charges_Factory 
		 *
		 * @access			public
		 * @introduced		2021/10/25
		 *
		 * @return			void
		 */
		 
		public function __construct( QShops_Shipments_Charges_Factory $factory ) {
			$this -> factory = $factory;
		}
		
		/**
		 * Facilitate the fetch (load) of data, for shipment charge
		 *
		 * @access			public
		 * @introduced		2021/10/26
		 *
		 * @see				QShops_Shipments_Charges_Factory
		 * @return			void
		 */
		 
		public function load() {
			$this -> getFactory() -> load();
		}
		
		/**
		 * Facilitate access to the customer
		 *
		 * @access			public
		 * @introduced		2021/10/25
		 *
		 * @see				QShops_Shipments_Charges_Factory
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
		 * @introduced		2021/10/25
		 *
		 * @return			void
		 * @throws			Exception
		 */
		 
		public function operate( QAcceptee_Interface $object ) { 
			if( $this -> getCustomer() instanceof QShop_Customer_Interface ) {
				$object -> push( $this -> getCustomer() );
			} else {
				throw new Exception( 'invalid interface, expecting QShop_Customer_Interface [core/shop/shipment/charge]' );
			}
		}
		
		/**
		 * Return this factory but with restricted access
		 *
		 * @access			public
		 * @introduced		2021/10/25
		 *
		 * @return			object typeof QShops_Shipments_Charges_Factory
		 */
		 
		public function getFactory() : QShops_Shipments_Charges_Factory {
			return $this -> factory;
		}
		
		
	}
	
?>