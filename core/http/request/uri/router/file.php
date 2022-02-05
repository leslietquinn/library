<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Request_Router implements QFilter_Interface {
		protected $routes = array();
		
		public function __construct() {}
		public function addRoute( QHttp_Request_Route_Interface $route ) {
			$this -> routes[] = $route;
		}
		
		public function process() : void {
			$args = func_get_args();
			$dataspace = array_shift( $args );
			
			$request_uri = $dataspace -> requestUri();
			foreach( $this -> routes as $route ) {
				if( $parameters = $route -> match( $request_uri ) ) {
					foreach( $parameters as $k => $v ) { 
						$dataspace -> set( $k, $v );
					}
				}
			}
		}
	}
	
?>