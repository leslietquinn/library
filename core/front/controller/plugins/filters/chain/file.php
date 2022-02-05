<?php

	final class QFront_Controller_Plugins_Filters_Chain implements QFront_Controller_Plugins_Interface {
		private $filters = array();
		
		public function __construct() {}
		
		/**
		 * Add a filter
		 *
		 * @param	$filter		object
		 *
		 * @access							public
		 * @return							void
		 */
		 
		public function addFilter( QFilter_Interface $filter ) {
			$this -> filters[] = $filter;
		}
		
		/**
		 * Iterate through an array of filters
		 *
		 * @access							public
		 * @return							void
		 */
		 
		public function preProcess() {
			$request = QRegistry::get( 'request' );
			
			foreach( $this -> filters as $filter ) {
				$filter -> process( $request );
			}
		}
		
		public function postProcess() {}
	}

	/* example of use

		$fc -> addPlugin( $filter_chain = new QPlugin_Request_Filter() );
		
		// create and validate unique user agent hash
		$filter_chain -> addFilter( new QPlugin_Request_Filter_Session_Hash( '__userhash' ) );
		
		// output robots.txt file if request
		$filter_chain -> addFilter( new QPlugin_Request_Filter_Match_Uri( 
			'/robots\.txt\/?/', 
			dirname( $_SERVER['DOCUMENT_ROOT'] ).'/robots.txt', 
			'Content-Type: text/plain' 
		) );
		
		// output sitemap.xml file if request
		$filter_chain -> addFilter( new QPlugin_Request_Filter_Match_Uri( 
			'/sitemap\.xml\/?/', 
			dirname( $_SERVER['DOCUMENT_ROOT'] ).'/sitemap.xml', 
			'Content-Type: text/xml; charset=utf-8' 
		) );
		
		// output products.xml file if request
		$filter_chain -> addFilter( new QPlugin_Request_Filter_Match_Uri( 
			'/products\.xml\/?/', 
			dirname( $_SERVER['DOCUMENT_ROOT'] ).'/feeds/products.xml', 
			'Content-Type: application/rss+xml; charset=utf-8' 
		) ); 
		
		// output offers.xml file if request
		$filter_chain -> addFilter( new QPlugin_Request_Filter_Match_Uri( 
			'/offers\.xml\/?/', 
			dirname( $_SERVER['DOCUMENT_ROOT'] ).'/feeds/offers.xml', 
			'Content-Type: application/rss+xml; charset=utf-8' 
		) ); 

	*/
	
?>