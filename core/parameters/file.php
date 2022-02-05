<?php

	/**
	 * @package		none
	 * @subpackage	dataspace
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	class QParameters extends QDataspace implements QAcceptance_Interface {
		public function __construct( array $parameters ) {
			if( is_array( $parameters ) && count( $parameters ) ) {
				foreach( $parameters as $k => $v ) {
					$this -> set( $k, $v );
				}
			}
		}
		
		public function escape( string $parameter, string $encoding = 'UTF-8' ) : string {
			return htmlentities( $this -> get( $parameter ), ENT_QUOTES, $encoding );
		}
	}
	
?>