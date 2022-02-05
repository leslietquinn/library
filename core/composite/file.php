<?php

	/**
	 * @package		composite
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
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
	
	abstract class QComposite implements QComposite_Interface {
		protected $id;
		protected $children = array();
		
		public function __construct() {}
		public function getId() {
			return $this -> id;
		}
		
		public function getChildren() {
			return $this -> children;
		}
		
		public function hasChildren() {
			return count( $this -> children );
		}
		
		/**
		 * Attach one or more child composites as well as defining child <> parent relationship
		 *
		 * @param	$composite		object		typeof QComposite_Interface
		 *
		 * @access				public
		 * @return				void
		 */
		 
		public function attach( QComposite_Interface $composite ) {
			$this -> children[$composite -> getId()] = $composite;
			
			// set parent of $composite
			$composite -> setParent( $this );
		}
	}
	
		/* 17/01/06 *//* added on 25/09/09 for reference from old library */
		/* protected function traverse( QComposite_Interface $composite ) {
			$pathname = array();
			while( !is_null( $composite -> getParent() ) ) {
				$pathname[] = $composite -> getId();
				$composite = $composite -> getParent();
			}
			$pathname[] = $composite -> getId();
			return implode( '/', array_reverse( $pathname ) );
		} */
		
?>