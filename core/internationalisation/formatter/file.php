<?php
	
	final class QInternationalisation_Formatter {
		private $factory = null;
		
		public function __construct() {}
		
		/**
		 * Set up a factory to facilitate access to the database
		 *
		 * @param	$factory		object typeof QInternationalisation_Formatter_Factory_Interface
		 *
		 * @see				public
		 * @introduced		2021/11/02
		 *
		 * @return			object typeof QInternationalisation_Formatter_Factory_Interface
		 */
		 
		public function setFactory( QInternationalisation_Formatter_Factory_Interface $factory ) {
			$this -> factory = $factory;
		}
		
		/**
		 * Return a factory to faciliate database access
		 *
		 * @access			protected
		 * @introduced		2021/11/02
		 *
		 * @return			object typeof QInternationalisation_Formatter_Factory_Interface
		 * @throws			Exception
		 */
		 
		protected function getFactory() : QInternationalisation_Formatter_Factory_Interface {
			if( QNull::is( $this -> factory ) ) {
				throw new Exception( 'thrown exception: undefined factory, no factory found [core/internationalisation/formatter]' );
			}
			
			return $this -> factory;
		}
		
		/**
		 * Format a currency with currency symbol based on defined parameters found in $request
		 *
		 * @param	$value				float	value to format
		 * @param	$use_country_code	bool	if true use QCommon::LOCALE_FULL_COUNTRY_TOKEN from QInternationalisation_Iso::*
		 *										otherwise use QCommon::LOCALE_CURRENCY_TOKEN from $locale instead 
		 *
		 * @see		QFilter_Formatter_Currency::process();
		 *
		 * @return		mixed
		 */
		 
		public function currency( float $value, bool $use_country_code = false  ) : string { 
			$filename = dirname( __FILE__ ).'/cache/currency-formats.dat'; 
			
			$country_currency = QInternationalisation_Iso::countryCodeCurrencyCode(); 

			$stack = new QStack();
			if( !$stack -> grab( $filename ) ) { 
			
				/**
				 * @todo	refactor out and use the $factory to 
				 *			access the domain layer
				 *
				 */
				 
				$conn = QRegistry::get( 'connection' );
				$rs = $conn -> fetch( "select cou.iso2code, cou.iso3code, cou.iso2locale from countries cou order by cou.iso2code asc" );
				
				$ds = array();
				while( $row = $rs -> getRow() ) {
					if( array_key_exists( $row['iso3code'], $country_currency ) ) {
						$ds[$country_currency[$row['iso3code']]] = array(
							'locale' 		=> $row['iso2locale'],
							'currency' 		=> $row['iso3code'],
							'token' 		=> $row['iso2code'],
						); 
					} 
				}
			
				$stack -> put( $ds, $filename );
			}
			
			$ds = $stack -> grab( $filename );
			$locale = QInternationalisation_Locale::all();
			
			if( $use_country_code ) { 
			
				/**
				 * @note	use the country code, find the currency code for that country code,
				 *			and use that instead
				 *
				 */
				 
				$currency = $country_currency[$locale[QCommon::LOCALE_FULL_COUNTRY_TOKEN]];
			} else {
				$currency = $locale[QCommon::LOCALE_CURRENCY_TOKEN];
			}
			
			$locale = $ds[$currency]['locale'];
			$token = $ds[$currency]['token'];
			
			$formatter = new NumberFormatter( $locale.'_'.$token.'.UTF8', NumberFormatter::CURRENCY );
			
			return $formatter -> format( $value );
		}
		
		public function datestamp() {
			
		}
		
	}
	
?>