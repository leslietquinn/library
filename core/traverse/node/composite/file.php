<?php

	final class QTraverse_Node_Composite extends QComposite implements QTraverse_Node_Interface {
		protected $parent;
		protected $name;
		
		/**
		 * Class constructor
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/15
		 *
		 * @return			void
		 */
		 
		public function __construct( QDataspace_Interface $dataspace ) {
			parent::__construct();
			
			$this -> parent = $dataspace -> get( 'parent' );
			$this -> name = $dataspace -> get( 'name' );
			$this -> id = $dataspace -> get( 'id' );
		}
		
		/**
		 * Return a name of this node
		 *
		 * @access			public
		 * @introduced		2021/11/15
		 *
		 * @return			string
		 */
		 
		public function getName() : string {
			return $this -> name;
		}
		
		/**
		 * Return a parent ID of this node
		 *
		 * @access			public
		 * @introduced		2021/11/15
		 *
		 * @return			string
		 */
		 
		public function getParent() : string {
			return $this -> parent;
		}
		
		/**
		 * Set, define a parent node
		 *
		 * @param	$parent			object typeof QTraverse_Node_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/15
		 *
		 * @return			void
		 */
		 
		public function setParent( QTraverse_Node_Interface $parent ) {}
		
	}
	
?>