<?php

	/**
	 * @package		page handler
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @abstract
	 */
	 
	abstract class QPage_Handler implements QPage_Handler_Interface {
		protected $children = array();
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
		
		public function isCachable() {
			return QCache::NO_CACHE;
		}
		
		abstract public function execute( QDataspace_Interface $dataspace );
	}
	
	/*
		$factory = new QPage_Handler_Page_Factory();
			
		// attach independent handler to structure
		$handler = new QPage_Handler_Recurse( $factory -> get() );
			
		$handler -> attach( 
			new QPage_Handler_Cachable( 
				new QPage_Handler_Secure(
					new QAccounts_Observer( array() ), '', 'signout/' ) 
				), 
			'main' 
		);

		return $handler -> get();
	*//*
		include_once( dirname( __FILE__ ).'/show/handlers.php' );
			
		$chain = new QHandler_Default( 
			new QHandler_Alternate() 
		);
			
		$handler = $chain -> handle( QRegistry::get( 'request' ), array() );
			
		// attach independent handler to structure
		$handler = new QPage_Handler_Recurse( $handler );
		
		$handler -> attach( new QPage_Handler_Message_Bar(), 'page' );
		
		return $handler -> get();
	*//*
		$handler = new QPage_Handler_Recurse( new QPage_Handler_Page() );
				
		$handler -> attach( new QPage_Handler_Page_Coupon(), 'page' );
				
		return $handler -> get();
	*//**
	 * example of use with AJAX handler; no factory creation
	 *
	 * $handler = new QPage_Handler_Recurse( new QPage_Handler_Cachable( new QPage_Handler_Page() ) );
	 *		
	 * $handler -> attach( new QPage_Handler_Cachable( new QPage_Handler_Checkbox() ), 'page' );
	 *
	 * return $handler -> get();
	 *
	 */
	 
?>