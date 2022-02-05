<?php

	/**
	 * @package		access control
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 */
	 
	class QAccess_Control implements QAccess_Control_Interface {
		protected $roles = array();
		
		public function __construct() {
			$this -> roles = array();
		}
		
		/**
		 * Verify that a role has access to controller and action pair
		 *
		 * @param	$role			string	represents a role, ie Administrator
		 * @param	$module			string	represents an controller implementation
		 * @param	$privilege		string	represents an action on supplied controller implementation
		 * @return					boolean	returns true or false
		 */
		 
		public function can( $role, $module, $privilege ) {
			if( array_key_exists( $role, $this -> roles ) ) {
				if( $this -> roles[$role] -> can( $module, $privilege ) ) {
					return true;
				}
			}
			return false;
		}
		
		/**
		 * Adds a role
		 *
		 * @param	$role		string	a role
		 * @return				object	returns a QAccess_Role type
		 */
		 
		public function addRole( $role ) {
			if( !array_key_exists( $role, $this -> roles ) ) {
				$this -> roles[$role] = new QAccess_Role();
			}
			return $this -> roles[$role];
		}
		
		/** 
		 * Fetchs a role
		 *
		 * @param	$role		string	a role
		 * @return				mixed 	boolean | QAccess_Role type 
		 */ 
		 
		public function getRole( $role ) {
			if( array_key_exists( $role, $this -> roles ) ) {
				return $this -> roles[$role];
			}
			return false;
		}
		
		/** 
		 * Add a module to either specific role or all roles
		 *
		 * @param	$module		string	module (controller) in question
		 * @param	$role		mixed	boolean | string
		 *
		 * @return				void	
		 */
		 
		public function addModule( $module, $role = false ) {
			if( $role ) {
				// if role specified, add module (controller) to 
				// role, ie Administrator
				if( array_key_exists( $role, $this -> roles ) ) {
					$this -> roles[$role] -> addModule( $module );
				}
			} else {
				// no role specified so add module to all roles
				foreach( $this -> roles as $role ) {
					$role -> addModule( $module );
				}
			}
		}
	}
	
?>