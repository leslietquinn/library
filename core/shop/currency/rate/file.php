<?php

	final class QShop_Currency_Rate implements QShop_Currency_Rate_Interface {
		private $dataspace = null;
		
		/**
		 * Class constructor
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/30
		 *
		 * @return			void
		 */
		 
		public function __construct( QDataspace_Interface $dataspace ) {
			$this -> dataspace = $dataspace;
		}
		
		/**
		 * Return the exchange rate, based held currency
		 *
		 * @access			public
		 * @introduced		2021/11/30
		 *
		 * @return			string
		 */
		 
		public function getRate() : string {
			return $this -> dataspace -> get( 'exchange_rate' );
		}
	}
	
?>