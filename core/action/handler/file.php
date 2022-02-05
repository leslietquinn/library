<?php

	abstract class QAction_Handler implements QAction_Handler_Interface {
		protected $children = array();
		protected $parent = null;
		protected $id;
		
		public function __construct() {}
		
		public function getId() {
			return $this -> id;
		}
		
		public function hasChildren() {
			return count( $this -> children );
		}
		
		public function getChildren() {
			return $this -> children;
		}
		
		public function attach( QComposite_Interface $composite ) {
			$this -> children[$composite -> getId()] = $composite;
		}
		
		abstract public function execute();
		
		/* 17/01/06 */
		/* protected function traverse( IComposite $composite ) {
			$pathname = array();
			while( !is_null( $composite -> getParent() ) ) {
				$pathname[] = $composite -> getId();
				$composite = $composite -> getParent();
			}
			$pathname[] = $composite -> getId();
			return implode( '/', array_reverse( $pathname ) );
		} */
	}
	
?>