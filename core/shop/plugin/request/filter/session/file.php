<?php

	final class QShop_Plugin_Request_Filter_Session implements QFilter_Interface {
		private $field_name;
		
		/**
		 * Class constructor
		 *
		 * @param	$field_name			string
		 *
		 * @access			public
		 * @introduced		2021/11/03
		 *
		 * @return			void
		 */
		 
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		/**
		 * If a session hash doesn't exist, create one, for the shop
		 *
		 * @access				public
		 * @introduced			2021/11/03
		 *
		 * @return				void
		 */
		 
		public function process() {
			$args = func_get_args();
			$dataspace = array_shift( $args ); 
			
			$was_set = true;
			if( !( $dataspace -> get( 'session' ) -> has( $this -> field_name ) ) ) { 
				$was_set = false;
				$dataspace -> get( 'session' ) -> set( $this -> field_name, QRandom::numeric( QCommon::PK_BIG ) );
				$dataspace -> set( $this -> field_name, $dataspace -> get( 'session' ) -> get( $this -> field_name ) );
			}
			
			if( $was_set ) {
				$dataspace -> set( $this -> field_name, $dataspace -> get( 'session' ) -> get( $this -> field_name ) );
			}
		}
	}
	
?>