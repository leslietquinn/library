<?php

	/**
	 * @package		page handler
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 */
	 
	abstract class QPage_Handler_Decorator implements QPage_Handler_Interface {
		protected $page_handler = null;
		
		public function __construct( QPage_Handler_Interface $page_handler ) {
			$this -> page_handler = $page_handler;
		}
		
		public function getId() {
			return $this -> page_handler -> getId();
		}
		
		public function hasChildren() {
			return $this -> page_handler -> hasChildren();
		}
		
		public function getChildren() {
			return $this -> page_handler -> getChildren();
		}
		
		public function attach( QComposite_Interface $composite ) {
			$this -> page_handler -> attach( $composite );
		}
		
		public function isCachable() {
			return $this -> page_handler -> isCachable();
		}
		
		abstract public function execute( QDataspace_Interface $dataspace );
	}
	
?>