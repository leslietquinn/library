<?php

	final class QInternationalisation_Locale {
		public function __construct() {}
		
		static public function all() : array {
			return array(
				/* GB     */ QCommon::LOCALE_COUNTRY_TOKEN 			=> QRegistry::get( 'request' ) -> get( QCommon::LOCALE_COUNTRY_TOKEN ),
				/* GBR    */ QCommon::LOCALE_FULL_COUNTRY_TOKEN 	=> QRegistry::get( 'request' ) -> get( QCommon::LOCALE_FULL_COUNTRY_TOKEN ),
				/* en     */ QCommon::LOCALE_LANGUAGE_TOKEN 		=> QRegistry::get( 'request' ) -> get( QCommon::LOCALE_LANGUAGE_TOKEN ),
				/* GBP    */ QCommon::LOCALE_CURRENCY_TOKEN 		=> QRegistry::get( 'request' ) -> get( QCommon::LOCALE_CURRENCY_TOKEN ),
				/* £      */ QCommon::LOCALE_CURRENCY_SYM_TOKEN 	=> QRegistry::get( 'request' ) -> get( QCommon::LOCALE_CURRENCY_SYM_TOKEN ),
				/* en_GB  */ QCommon::LOCALE_TOKEN 					=> QRegistry::get( 'request' ) -> get( QCommon::LOCALE_TOKEN ),
				/*        */ QCommon::LOCALE_COUNTRY_NAME_TOKEN 	=> QRegistry::get( 'request' ) -> get( QCommon::LOCALE_COUNTRY_NAME_TOKEN ),
			);
		}
		
		/**
		 * Return an ISO2 country code, ie GB
		 *
		 * @access			static public
		 *
		 * @return			string [A-Z]{2}
		 */
		 
		static public function countryISO2() : string {
			return QRegistry::get( 'request' ) -> get( QCommon::LOCALE_COUNTRY_TOKEN );
		}
		
		/**
		 * Return an ISO3 country code, ie GBR
		 *
		 * @access			static public
		 *
		 * @return			string [A-Z]{3}
		 */
		 
		static public function countryISO3() : string {
			return QRegistry::get( 'request' ) -> get( QCommon::LOCALE_FULL_COUNTRY_TOKEN );
		}
		
		/**
		 * Return an ISO3 currency code, ie GBP
		 *
		 * @access			static public
		 *
		 * @return			string [A-Z]{3}
		 */
		 
		static public function currencyISO3() : string {
			return QRegistry::get( 'request' ) -> get( QCommon::LOCALE_CURRENCY_TOKEN );
		}
		
		/**
		 * Return unicode for currency symbol, ie £
		 *
		 * @access			static public
		 *
		 * @return			string 
		 */
		 
		static public function symbol() : string {
			return QRegistry::get( 'request' ) -> get( QCommon::LOCALE_CURRENCY_SYM_TOKEN );
		}
		
		/**
		 * Return ISO2 language code, ie en
		 *
		 * @access			static public
		 *
		 * @return			string [a-z]{2}
		 */
		 
		static public function languageISO2() : string {
			return QRegistry::get( 'request' ) -> get( QCommon::LOCALE_LANGUAGE_TOKEN );
		}
		
		/**
		 * Return paired language and country, ie en_GB
		 *
		 * @access			static public
		 *
		 * @return			string 
		 */
		 
		static public function locale() : string {
			return QRegistry::get( 'request' ) -> get( QCommon::LOCALE_TOKEN );
		}
		
		static public function country() : string {
			return QRegistry::get( 'request' ) -> get( QCommon::LOCALE_COUNTRY_NAME_TOKEN );
		}
	}
	
?>