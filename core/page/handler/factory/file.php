<?php

	/**
	 * @package		page handler
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 * @ignore
	 */
	 
	abstract class QPage_Handler_Factory {
		protected $children = array();
		
		public function __construct( $children ) {
			$this -> children = $children;
		}
		
		public function get() {
			$args = func_get_args();
			$parent = array_shift( $args );
			$composite = $this -> create();
			if( $parent instanceof QPage_Handler_Interface ) {
				$parent -> attach( $composite );
			}
			
			foreach( $this -> children as $child ) {
				$classname = $this -> formatName( $child );
				$instance = new $classname(); 
				$instance -> get( $composite );
			}
			
			return $composite;
		}
		
		protected function formatName( string $name ) : string { 
		
			/**
			 * @todo	2021/11/07
			 *
			 *			ensure all words are capitalised; some are not after the 
			 *			string replacement
			 *
			 */
			 
			return 'QPage_Handler_'.ucwords( str_replace( '-', '_', $name ) ).'_Factory';
		}
		
		abstract protected function create();
	}
	
	/* 
	
	final class QPage_Handler_Admin_Factory extends QPage_Handler_Factory {
		public function __construct() {
			parent::__construct( array( 'head', 'userarea', 'content' ) );
		}
		
		protected function create() {
			return new QPage_Handler_Admin();
		}
	}
	
	final class QPage_Handler_Admin extends QPage_Handler {
		public function __construct() {
			$this -> id = 'phptag:page';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_View( $request = QRegistry::get( 'request' ) );
			$page -> render( 'admin/template.tpl' );
		}
	}
	
	// controller
	public function showAction() {
			include_once( dirname( __FILE__ ).'/show/includes.php' );
			
			$factory = new QPage_Handler_Admin_Factory();
			
			// attach independent handler to structure
			$handler = new QPage_Handler_Recurse( $factory -> get() );
			$handler -> attach( new QPage_Handler_Cachable( new QPage_Handler_Tags() ), 'options' );
			
			return $hander -> get();
		}
		
	*/
	
?>