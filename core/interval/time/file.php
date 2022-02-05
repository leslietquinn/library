<?php

	class QInterval_Time {
		public function __construct() {}
		
		/**
		 * Return a date in a database format
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 * @static
		 *
		 * @return			string
		 */
		 
		static public function now() : string {
			return date( 'H:i:s', time() );
		}
		
		/**
		 * Return hours as an array, 24 hour format
		 *
		 * @access			public
		 * @introduced		2021/12/14
		 * @static
		 *
		 * @return			array
		 */
		 
		static public function hours() : array {
			return array( 
				'00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11'
			  , '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'
			);
		}
		
		/**
		 * Return minutes as an array
		 *
		 * @access			public
		 * @introduced		2021/12/14
		 * @static
		 *
		 * @return			array
		 */
		 
		static public function minutes() : array {
			return array( 
				'00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14'
			  , '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29'
			  , '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44'
			  , '45', '46', '47', '48', '49', '50', '51', '52', '53', '54' ,'55' ,'56', '57', '58', '59'
			);
		}
		
		/**
		 * Return seconds as an array
		 *
		 * @access			public
		 * @introduced		2021/12/14
		 * @static
		 *
		 * @return			array
		 */
		 
		static public function seconds() : array {
			return self::minutes();
		}
		
	}
	
?>