<?php
	
	final class QShop_Taxation {
		private QShop_Taxation_Factory_Interface $factory;

		/**
		 * Class constructor
		 * 
		 * @param	$factory 			object typeof QShop_Taxation_Factory_Interface
		 * 
		 * @access			public
		 * @introduced		2022/01/31
		 * @return			void
		 */

		public function __construct( QShop_Taxation_Factory_Interface$factory ) {
			$this -> factory = $factory;
		}

		/**
		 * Return the appropriate duty based on the ISO 3 country code
		 * 
		 * @param	$country 			string
		 * 
		 * @access			public
		 * @introduced		2022/01/31
		 * @return			string
		 */

		public function factory( string $country ) {

		}

		/**
		 * Return this factory but with restricted access
		 *
		 * @access			public
		 * @introduced		2022/01/31
		 *
		 * @return			object typeof QShop_Factory_Interface
		 */
		 
		public function getFactory() : QShop_Factory_Interface {
			return $this -> factory;
		}
		
	}

?>