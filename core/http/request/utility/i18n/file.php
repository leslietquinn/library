<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Utility_I18n implements QFilter_Interface {
		public function __construct() {}
		
		/**
		 * Preset, or use language and country, currency settings
		 */
		 
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			$locale = str_replace( '_', '-', $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_TOKEN ) );
			
			if( 
				!( 
					/**
					 * @note	either all or nothing; or if the *::LOCAL_TOKEN is not 
					 *			matching current with the previous then reset
					 */
					 
					( $dataspace -> get( 'lang' ) == $locale )
					&&
					$dataspace -> get( 'session' ) -> has( QCommon::LOCALE_COUNTRY_TOKEN ) 
					&& 
					$dataspace -> get( 'session' ) -> has( QCommon::LOCALE_LANGUAGE_TOKEN ) 
					&& 
					$dataspace -> get( 'session' ) -> has( QCommon::LOCALE_CURRENCY_TOKEN ) 
					&& 
					$dataspace -> get( 'session' ) -> has( QCommon::LOCALE_FULL_COUNTRY_TOKEN ) 
					&& 
					$dataspace -> get( 'session' ) -> has( QCommon::LOCALE_CURRENCY_SYM_TOKEN ) 
					&&
					$dataspace -> get( 'session' ) -> has( QCommon::LOCALE_TOKEN ) 
				)
			) {
				/**
				 * @note	locale and language; internationalisation parameters are not defined, so 
				 *			create them based on the :lang route or use a default
				 */
				
				$array = explode( '-', $dataspace -> get( 'lang' ) ); 
				
				$dataspace -> get( 'session' ) -> set( QCommon::LOCALE_COUNTRY_TOKEN, $array[1] );
				$dataspace -> get( 'session' ) -> set( QCommon::LOCALE_LANGUAGE_TOKEN, $array[0] );
				$dataspace -> get( 'session' ) -> set( QCommon::LOCALE_TOKEN, $array[0].'_'.$array[1] );
				
				$country_name = QInternationalisation_Iso::countryCodeCountryName( $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_COUNTRY_TOKEN ) );
				$full_country = QInternationalisation_Iso::countryCodeCountryCode( $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_COUNTRY_TOKEN ) );
				$currency_tok = QInternationalisation_Iso::countryCodeCurrencyCode( $full_country );
				$currency_sym = QInternationalisation_Iso::countryCodeCurrencySymbol( $full_country );
				
				$dataspace -> get( 'session' ) -> set( QCommon::LOCALE_CURRENCY_TOKEN, $currency_tok );
				$dataspace -> get( 'session' ) -> set( QCommon::LOCALE_FULL_COUNTRY_TOKEN, $full_country );
				$dataspace -> get( 'session' ) -> set( QCommon::LOCALE_CURRENCY_SYM_TOKEN, $currency_sym );
				
				$dataspace -> get( 'session' ) -> set( QCommon::LOCALE_COUNTRY_NAME_TOKEN, $country_name );
			} 

			$dataspace -> set( QCommon::LOCALE_CURRENCY_TOKEN, $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_CURRENCY_TOKEN ) ); // GBP
			$dataspace -> set( QCommon::LOCALE_FULL_COUNTRY_TOKEN, $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_FULL_COUNTRY_TOKEN ) ); // GBR 
			$dataspace -> set( QCommon::LOCALE_CURRENCY_SYM_TOKEN, $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_CURRENCY_SYM_TOKEN ) ); // £
			$dataspace -> set( QCommon::LOCALE_COUNTRY_NAME_TOKEN, $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_COUNTRY_NAME_TOKEN ) ); // United Kingdom
			
			$dataspace -> set( QCommon::LOCALE_COUNTRY_TOKEN, $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_COUNTRY_TOKEN ) ); // GB
			$dataspace -> set( QCommon::LOCALE_LANGUAGE_TOKEN, $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_LANGUAGE_TOKEN ) ); // en
			$dataspace -> set( QCommon::LOCALE_TOKEN, $dataspace -> get( 'session' ) -> get( QCommon::LOCALE_TOKEN ) ); // en_GB
			
		}
	}
	
?>