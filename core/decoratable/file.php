<?php

	abstract class QDecoratable implements QDecoratable_Interface {
		protected $decorated = null;
		
		/**
		 * Apply the Decorator design pattern on this $object
		 *
		 * @param	$object			object typeof QDecoratable_Interface
		 *
		 * @access			public
		 * @introduced		2021/11/02
		 *
		 * @return			void
		 */
		 
		public function decorate( QDecoratable_Interface $object ) {
			$this -> decorated = $object;
		}
		
		/**
		 * Return a decoratable when requested
		 *
		 * @access			public
		 * @introduced		2021/11/02
		 *
		 * @see				QDecoratable_Interface
		 * @return			mixed
		 */
		 
		public function getDecorated() {
			return $this -> decorated;
		}
	}
	
?>