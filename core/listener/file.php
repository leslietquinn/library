<?php

	abstract class QListener implements QListener_Interface {
		protected $events = array();
		
		/** 
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 *
		 * @return			void
		 */
		 
		public function __construct() {
			$this -> events = array();
		}
		
		/**
		 * Add an event
		 *
		 * @param	$event			object typeof QListener_Events_Interface 
		 *
		 * @acccess			public
		 * @introduced		2021/12/19
		 *
		 * @return 			object typeof QListener_Interface
		 */
		 
		public function add( QListener_Events_Interface $event ) : QListener_Interface {
			$this -> events[get_class( $event )] = $event;
			
			return $this;
		}
		
		/**
		 * Remove an event
		 *
		 * @param	$event			object typeof QListener_Events_Interface 
		 *
		 * @acccess			public
		 * @introduced		2021/12/19
		 *
		 * @return 			bool
		 */
		 
		public function remove( QListener_Events_Interface $event ) : bool {
			$class = get_class( $event );
			
			foreach( $this -> events as $k => $v ) {
				if( $class == $k ) {
					unset( $this -> events[$k] );
					
					return true;
				}
			}
			
			return false;
		}
		
		/**
		 * Trigger each event in turn
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * @introduced		2021/12/19
		 *
		 * @note	something must cause the events to be triggered 
		 *			when an action happens
		 *
		 * @return			void
		 */
		 
		public function trigger( QDataspace_Interface $dataspace ) : void {
			foreach( $this -> events as $event ) {
				$event -> receive( $this, $dataspace );
			}
		}
	}
	
?>