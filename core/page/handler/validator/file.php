<?php

	/**
	 * @deprecated
	 */

	/**
	 * @package		page handler
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 * @ignore
	 */
	 
	abstract class QPage_Handler_Validator implements QPage_Handler_Interface {
		protected $conditions = array();
		protected $children = array();
		protected $handler = null;
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
		
		public function forward( QPage_Handler_Interface $handler ) {
			$this -> handler = $handler;
		}
		
		public function addCondition( QValidator_Condition $condition ) {
			$this -> conditions[] = $condition;
		}
		
		protected function validate( QDataspace_Interface $request, $logger ) {
			$validation = true;
			foreach( $this -> conditions as $condition ) { 
				$validation = $condition -> isValid( $request, $logger ) && $validation;
			}
			return $validation;
		}
		
		public function isCachable() {
			return QCache::NO_CACHE;
		}
		
		abstract public function execute( QDataspace_Interface $dataspace );
		abstract protected function initialise();
	}
	
?>