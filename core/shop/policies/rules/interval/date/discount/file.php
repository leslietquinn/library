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
	
	final class QShop_Policies_Rules_Interval_Date_Discount extends QShop_Policies_Rules {
		
		/**
		 * Class constructor
		 *
		 * @param	$serialiser		object typeof QShop_Policies_Rules_Serialiser
		 * @param	$toggle			bool
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 *
		 * @return			void
		 */
		 
		public function __construct( QShop_Policies_Rules_Serialiser $serialiser, bool $toggle = false ) {
			parent::__construct( $serialiser, $toggle );
		}
		
		
	}
	
?>