<?php
	
	/**
	 * @package		shop
	 * @subpackage	shop policies
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	/**
	 * Copyright Notice
	 *
	 * Class and class functions [implementation] is the sole ownership and
	 * copyright owner of Leslie Quinn <les.quinn.2012@gmail.com>
	 *
	 * No part of this script, or associated script found within the framework
	 * may be used in any way, in whole or in part without prior written
	 * permission of Leslie Quinn
	 */
	
	abstract class QShop_Policies_Rules implements QShop_Policies_Rules_Interface, QFilter_Interface {
		
		/**
		 * @note	every rule as a pair of dates; a beginning and an end, and if 
		 *			there is no need for an end date then the $ending date will be older 
		 *			than $begins and if no need for dates at all then both $begins and 
		 *			$ending will be the same
		 */
		 
		protected $begins;
		protected $ending;
		
		/**
		 * Class constructor
		 *
		 * @param	$serialiser		object typeof QShop_Policies_Rules_Deserialiser
		 * @param	$toggle			bool
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 *
		 * @return			void
		 */
		 
		public function __construct( QShop_Policies_Rules_Serialiser $serialiser, bool $toggle ) {
			if( $toggle ) {
				$serialiser -> pack( $this );
			} else {
				$serialiser -> unpack( $this );
			}
		}
		
		/**
		 * Process this $rule
		 *
		 * @access			public
		 * @introduced		2021/12/07
		 *
		 * @return			void
		 */
		 
		public function process() {
			$args = func_get_args();
			$policy = array_shift( $args );
			$request = array_shift( $args );
			
			
		}
		
	}
	
?>