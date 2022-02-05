<?php

	final class QInterval {
		const DAY = 86400;
		const HOUR = 3600;
		const WEEK = 604800;
		const YEAR = 31536000; 
		const MONTH = 2419200;
		const MINUTE = 60;
		
		const SQL_DATE = 'Y-m-d';
		const SQL_TIME = 'H:i:s';
		const SQL_NULL_DATE = '0000-00-00';
		const SQL_NULL_TIME	= '00:00:00';
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Get date for today
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 *
		 * @return			string
		 */
		 
		public function today() : string {
			return QInterval_Date::now();
		}
		
		/**
		 * Get date for yesterday
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 *
		 * @return			string
		 */
		 
		public function yesterday() : string {
			return date( 'Y-m-d', QInterval_Date::seconds() - QInterval::DAY );
		}
		
		/**
		 * Get date for tomorrow
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 *
		 * @return			string
		 */
		 
		public function tomorrow() : string {
			return date( 'Y-m-d', QInterval_Date::seconds() + QInterval::DAY );
		}
		
		/**
		 * Get date for last week, 7 days
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 *
		 * @return			string
		 */
		 
		public function lastWeek() : string {
			return date( 'Y-m-d', QInterval_Date::seconds() - QInterval::WEEK );
		}
		
		/**
		 * Get date for next week, 7 days
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 *
		 * @return			string
		 */
		 
		public function nextWeek() : string {
			return date( 'Y-m-d', QInterval_Date::seconds() + QInterval::WEEK );
		}
		
		/**
		 * Return a countdown, days, hours and in minutes
		 *
		 * @param	$when			string
		 *
		 * @access			public
		 * @introduced		2021/12/02
		 *
		 * @see				QFilter_Date_Timers_Countdown::process();
		 *
		 * @return			object typeof QDataspace_Interface
		 * @throws			QInterval_Exception
		 */
		 
		public function countdown( string $when = '' ) : QDataspace_Interface {
			if( empty( $when ) ) {
				$when = QInterval_Date::now();
			}
			
			if( !QInterval_Date::validate( $when ) ) {
				throw new QInterval_Exception( 'thrown exception: invalid date format [core/interval] 200' );
			}
		
			$now = QInterval_Date::seconds();
			$when = QInterval_Date::seconds( $when );
			
			$difference = $date_from - $now; 
			
			$days = floor( $difference / QInterval::DAY ); 
			$hours = floor( ( $difference % QInterval::DAY ) / QInterval::HOUR ); 
			$minutes = floor( ( $difference % QInterval::HOUR ) / QInterval::MINUTE );
			
			$dataspace -> import( 
				new QParameters( 
					array( 
						'days' 		=>	$days,
						'hours'		=>	$hours,
						'minutes'	=>	$minutes
					) 
				) 
			);
		}
		
		/**
		 * Return the name of a month (Ja, Jan, or January) for the number of a month
		 * 
		 * @param 	$month 			int
		 * @param 	$option 		string 
		 * 
		 * @access				public
		 * @introduced			2022/01/17
		 * @return				string
		 */

		static public function month( int $month, string $option = 'full' ) : string { 
			if( !( in_array( $option, array( 'shortened', 'abbrev', 'full' ) ) or ( $month >= 1 and $month <= 12 ) ) ) {
				throw new QInterval_Exception( 'thrown exception: unknown month or out of range [core/interval] 137' );
			}

			$month--;

			if( $option == 'shortened' ) {
				$range = array( 
					0 	=> 	'Ja'
				  , 1 	=>	'Fe'
				  , 2 	=>	'Ma'
				  , 3 	=>	'Ap'
				  , 4 	=>	'Ma'
				  ,	5 	=>	'Ju'
				  , 6 	=>	'Ju'
				  ,	7 	=>	'Au'
				  , 8 	=>	'Se'
				  , 9 	=>	'Oc'
				  , 10 	=>	'No'
				  , 11 	=>	'De' 
				);

				return $range[$month];
			}

			if( $option == 'abbrev' ) {
				$range = array( 
					0 	=> 	'Jan'
				  , 1 	=>	'Feb'
				  , 2 	=>	'Mar'
				  , 3 	=>	'Apr'
				  , 4 	=>	'May'
				  ,	5 	=>	'Jun'
				  , 6 	=>	'Jul'
				  ,	7 	=>	'Aug'
				  , 8 	=>	'Sep'
				  , 9 	=>	'Oct'
				  , 10 	=>	'Nov'
				  , 11 	=>	'Dec' 
				);

				return $range[$month];
			}

			$range = array( 
				0 	=> 	'January'
			  , 1 	=>	'February'
			  , 2 	=>	'March'
			  , 3 	=>	'April'
			  , 4 	=>	'May'
			  ,	5 	=>	'June'
			  , 6 	=>	'July'
			  ,	7 	=>	'August'
			  , 8 	=>	'September'
			  , 9 	=>	'October'
			  , 10 	=>	'November'
			  , 11 	=>	'December' 
			);

			return $range[$month];
		}

	}
	
?>