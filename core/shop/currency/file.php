<?php

	final class QShop_Currency {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/11/30
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Convert, or exchange the value of $amount between $from and $to
		 *
		 * @param		$from		QShop_Currency_Rate_Interface 3 iso 3 currency code
		 * @param		$to			QShop_Currency_Rate_Interface 3 iso 3 currency code
		 * @param		$amount		string
		 *
		 * @access			public
		 * @introduced		2021/11/30
		 *
		 * @return			string
		 */
		 
		public function between( QShop_Currency_Rate_Interface $from, QShop_Currency_Rate_Interface $to, string $amount ) : string { 
			
			/**
			 * @note	convert $from to base GBP and then using that to convert to $to, the amount
			 *
			 */
			 
			$from_exchange_amount = round( $amount / $from -> getRate() );
			
			return QShop::format( $from_exchange_amount * $to -> getRate(), 2, '.', '' ); 
		}
		
	}
	
?>