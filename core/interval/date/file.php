<?php

	class QInterval_Date {
		const SEPARATOR = '-';
		const HUMAN_READABLE = 'F jS, Y';
		
		public function __construct() {}
		
		/**
		 * Return current date
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 * @static
		 *
		 * @return			string
		 */
		 
		static public function now() : string {
			return date( 'Y-m-d', time() );
		}
		
		/**
		 * Return a timestamp suitable for database
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 * @static
		 *
		 * @return			string
		 */
		 
		static public function timestamp() : string {
			return date( 'Y-m-d H:i:s', time() );
		}
		
		/**
		 * Return date in another $format
		 *
		 * @param	$format 		string
		 * @param	$date			string
		 *
		 * @access			public
		 * @introduced		2022/01/01
		 * @static
		 *
		 * @return			string
		 */
		 
		static public function reformat( string $format, string $date = '' ) : string {
			if( empty( $date ) ) {
				return time();
			}
			
			return date( $format, strtotime( $date ) );
		}
		
		/**
		 * Return current date as seconds, or another date
		 *
		 * @param	$date			string
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 * @static
		 *
		 * @return			string
		 */
		 
		static public function seconds( string $date = '' ) : string {
			if( empty( $date ) ) {
				return time();
			}
			
			return strtotime( $date );
		}
		
		/**
		 * Validate a date for format
		 *
		 * @param	$date			string
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 * @static
		 *
		 * @return			bool
		 */
		
		static public function validate( string $date, string $separator = self::SEPARATOR ) : bool {
			if( preg_match( '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date ) ) {
				$parts = self::splitDate( $date, $separator );

				return checkdate( $parts[1], $parts[2], $parts[0] );
			}
			
			return false;
		}
		
		/**
		 * Split a date into its parts; separate year, month and day
		 * 
		 * @param	$date 			string
		 * @param	$separator 		string
		 * 
		 * @access				public
		 * @introduced 			2022/01/09
		 * @static
		 * 
		 * @return 				array
		 */

		static public function splitDate( string $date, string $separator = self::SEPARATOR ) : array {
			return explode( $separator, $date );
		}

		/**
		 * Return a date in ISO 8601 format
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 * @static
		 *
		 * @return			string
		 */
		 
		static public function iso8601() : string {
			return date( 'Y-m-d\TH:i:sP', time() );
		}
		 
		/**
		 * Return a date in RFC 850 format
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 * @static
		 *
		 * @return			string
		 */
		 
		static public function rfc850() : string {
			return date( 'l, j\-M\-y H:i:s \U\T\C', time() );
		}
		
		/**
		 * Return days as an array
		 *
		 * @access			public
		 * @introduced		2021/12/14
		 * @static
		 *
		 * @return			array
		 */
		 
		static public function days() : array {
			return array( '01', '02', '03', '04', '05', '06', '07' );
		}
		
		/**
		 * Return days as an array
		 *
		 * @access			public
		 * @introduced		2021/12/14
		 * @static
		 *
		 * @return			array
		 */
		 
		static public function weeks() : array {
			return array( 
				'01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'
			  , '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'
			  , '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36'
			  , '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48'
			  , '49', '50', '51', '52'
			);
		}
		/**
		 * Return days as an array
		 *
		 * @access			public
		 * @introduced		2021/12/14
		 * @static
		 *
		 * @return			array
		 */
		 
		static public function months() : array {
			return array( 
				'01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'
			);
		}
		
	}
	
?>