<?php

	/**
	 * @package		access control
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn
	 */
	 
	class QAccess_Role {
		protected $modules = array();
		
		public function __construct() {
			$this -> modules = array();
		}
		
		/**
		 * Verify for this role, an action exists on a given controller
		 *
		 * @param 	$module			string	represents a controller
		 * @param	$privilege		string	represents an action on a controller
		 * @return					boolean	returns true or false
		 */
		 
		public function can( $module, $privilege ) {
			if( array_key_exists( $module, $this -> modules ) ) {
				if( $this -> modules[$module] -> hasPrivilege( $privilege ) ) {
					return true;
				}
			}
			return false;
		}
		
		public function addModule( $module ) {
			if( !array_key_exists( $module, $this -> modules ) ) {
				$this -> modules[$module] = new QAccess_Role_Module();
			}
			return $this;
		}
		
		public function addModules( $modules ) {
			if( is_array( $modules ) && count( $modules ) ) {
				foreach( $modules as $module ) {
					$this -> addModule( $module );
				}
			}
			return $this;
		}
		
		public function defaultPrivilege( $privilege ) {
			if( is_array( $this -> modules ) && count( $this -> modules ) ) {
				foreach( $this -> modules as $module ) {
					$module -> addPrivilege( $privilege );
				}
			}
			return $this;
		}
		
		public function addPrivilege( $module, $privilege ) {
			if( array_key_exists( $module, $this -> modules ) ) {
				$this -> modules[$module] -> addPrivilege( $privilege );
			}
			return $this;
		}
		
		public function addPrivileges( $module, $privileges ) {
			if( array_key_exists( $module, $this -> modules ) ) {
				$this -> modules[$module] -> addPrivileges( $privileges );
			}
			return $this;
		}
	}
	
?>