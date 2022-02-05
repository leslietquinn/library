<?php

	final class QShop_Policies_Rules_Serialiser {
		private $package = array();
		
		/**
		 * Class constructor
		 *
		 * @param	$package		array
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 *
		 * @note	the $package will contain serialised data if the 
		 *			package is to be unpacked, otherwise the array will
		 *			contain indices
		 *
		 * @return			void
		 */
		 
		public function __construct( array $package ) {
			$this -> package = $package;
		}
		
		/**
		 * Pack data, serialise
		 *
		 * @param	$rule		object typeof QShop_Policies_Rule_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 *
		 * @return			void
		 */
		 
		public function pack( QShop_Policies_Rules_Interface $rule ) : void {
			
		}
		
		/**
		 * Unpack data, deserialise
		 *
		 * @param	$rule		object typeof QShop_Policies_Rule_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 *
		 * @return			void
		 */
		 
		public function unpack( QShop_Policies_Rules_Interface $rule ) : void {
			
		}
		
	}
	
?>