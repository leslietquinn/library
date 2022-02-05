<?php
	
	interface QTraverse_Node_Interface {
		public function setParent( QTraverse_Node_Interface $parent );
		public function getParent();
		public function getName();
	}
	
?>