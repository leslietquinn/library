<?php

	/**
	 * @package		access control
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	class QAccess_Role_Module {
		protected $privileges = array();
		
		public function __construct() {
			$this -> privileges = array();
		}
		
		public function addPrivilege( $privilege ) {
			if( !in_array( $privilege, $this -> privileges ) ) {
				$this -> privileges[] = $privilege;
			}
		}
		
		/**
		 * Add a series of actions to a given controller
		 *
		 * @param	$privileges		array	represents a series of actions
		 * @return					void	
		 */
		 
		public function addPrivileges( $privileges ) {
			if( is_array( $privileges ) && count( $privileges ) ) {
				$this -> privileges = array_merge( $this -> privileges, $privileges );
			}
		}
		
		/**
		 * Does a action exist on this controller?
		 *
		 * @param	$privilege		string	represents an action
		 * @return					boolean	returns true or false
		 */
		 
		public function hasPrivilege( $privilege ) {
			if( in_array( $privilege, $this -> privileges ) ) {
				return true;
			}
			return false;
		}
	}
	
?>