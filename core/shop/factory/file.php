<?php

	final class QShop_Factory /*implements QShop_Factory_Interface*/ {
		public function __construct() {}
		
		public function getSession() {
			return QRegistry::get( 'request' ) -> get( 'session' );
		}
		
		public function getConnection() {
			return QRegistry::get( 'connection' );
		}
		
		public function getCurrency() {
			return QRegistry::get( 'request' ) -> get( 'session' ) -> get( QCommon::LOCALE_CURRENCY_TOKEN );
		}
		
		public function getBasket() {}
		public function getShippingAddress( QShop_Customer_Interface $customer ) {}
		public function getBillingAddress( QShop_Customer_Interface $customer ) {}
	}
	
?>