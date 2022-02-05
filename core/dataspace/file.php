<?php

	/**
	 * @package		dataspace
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
	
	abstract class QDataspace implements QDataspace_Interface {
		protected $parameters = array();
		protected $filters = array();
		
		public function __construct() {
			$this -> parameters = array();
		}
		
		/**
		 * Allow one or more filters to be added
		 *
		 * @param 	$filter				object 		typeof QFilter_Interface
		 *
		 * @access						public
		 * @return 						void
		 */
		 
		public function addFilter( QFilter_Interface $filter ) {
			$this -> filters[] = $filter;
		}
		
		/**
		 * Process filters added previously
		 *
		 * @access 						public
		 * @return						void
		 */
		 
		public function process() {
			foreach( $this -> filters as $filter ) {
				$filter -> process( $this );
			}
			
			$this -> filters = array();
		}
		
		public function get() {
			$parameters = func_get_args();
			if( is_array( $parameters ) ) {
				if( array_key_exists( $parameter = array_shift( $parameters ), $this -> parameters ) ) {
					return $this -> parameters[$parameter];
				}
			}
			return false;
		}
		
		public function set() {
			$parameters = func_get_args();
			if( is_array( $parameters ) ) {
				$this -> parameters[array_shift( $parameters )] = array_shift( $parameters );
			}
		}
		
		public function has() {
			$parameters = func_get_args();
			if( is_array( $parameters ) ) {
				if( array_key_exists( $parameter = array_shift( $parameters ), $this -> parameters ) && !empty( $this -> parameters[$parameter] ) ) {
					return true;
				}
			}
			return false;
		}
		
		public function remove() {
			$parameters = func_get_args();
			if( is_array( $parameters ) ) {
				unset( $this -> parameters[array_shift( $parameters )] );
			}
		}
		
		public function accept( QAcceptee_Interface $acceptee ) {
			$acceptee -> push( $this );
		}
		
		public function import( QDataspace_Interface $dataspace ) { 
			$this -> parameters = array_merge( $this -> parameters, $dataspace -> export() );
		}
		
		public function export() {
			return $this -> parameters;
		}
	}
	
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
	
?>