<?php

	final class QShop_Currency_Rate_Default implements QShop_Currency_Rate_Interface {
		
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
		 * Return the exchange rate, based held currency
		 *
		 * @access			public
		 * @introduced		2021/11/30
		 *
		 * @return			string
		 */
		 
		public function getRate() : float {
			return 1.0000;
		}
	}
	
?>