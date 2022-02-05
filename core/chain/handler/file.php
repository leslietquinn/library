<?php

	/**
	 * @package		chain handler
	 * @version		beta-05f, 06;09-dev
	 * @author		les quinn 
	 */
	 
	abstract class QChain_Handler implements QChain_Handler_Interface {
		const FORM_HANDLER = '__formhandler__';
		const SESS_HANDLER = '__sesshandler__';
		
		protected $successor = null;
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Handle required action or pass responsibility along to another
		 *
		 * @param 	$dataspace		object		typeof QDataspace_Interface
		 * @param	$actions		array		an array of available actions in chain
		 * @param	$field_name		string		field to use for action in use, hidden form field
		 *
		 * @access					public
		 * @return					mixed			
		 */
		 
		public function handle( QDataspace_Interface $dataspace, array $actions, string $field_name ) {
			$action = array_shift( $actions ); 
			if( $dataspace -> get( $field_name ) == $action ) {
				
				/** 
				 * @note	the current action found is a match to what 
				 *			is the state at this time, so process the required 
				 *			handler
				 */
				 
				return $this -> process();
			} else { 
			
				/**
				 * @note	no match on this handler, let's look at the 
				 *			next one in line
				 */
				 
				return $this -> successor -> handle( $dataspace, $actions, $field_name );
			}
		}
		
		/**
		 * Process required action 
		 *
		 * @abstract
		 *
		 * @access					public
		 * @return					void
		 */
		 
		abstract public function process();
	}
	
	/* example of use *//*
	$chain = new QHandler_Step_One( 
		new QHandler_Step_Two( 
			new QHandler_Step_Three( 
	
				// last handler in chain must 
				// overwrite QChain_Handler::handle( ... );
				new QHandler_Step_Four() ) ) );
			
	$chain -> handle( QRegistry::get( 'request' ), array(
		'step_one', 'step_two', 'step_three', 'step_four' ) );	
	*/
	
?>