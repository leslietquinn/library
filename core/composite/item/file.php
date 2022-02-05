<?php

	/**
	 * @package		composite
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 */
	 
	class QComposite_Item extends QComposite {
		protected $parent = null;
		protected $name;
		
		/**
		 * Class constructor
		 *
		 * @param	$item		object		typeof QDataspace_Interface
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function __construct( QDataspace_Interface $item ) {
			$this -> name = $item -> get( 'name' );
			$this -> id = $item -> get( 'id' );
		}
		
		public function getName() {
			return $this -> name;
		}
		
		/**
		 * Set the parent of this $composite
		 *
		 * @param	$parent		object
		 *
		 * @access			public
		 * @return			void
		 */
		 
		public function setParent( QComposite_Interface $parent ) {
			$this -> parent = $parent;
		}
		
		public function getParent() {
			return $this -> parent;
		}
	}
	
?>