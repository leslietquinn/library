<?php
	
	interface QMatrix_Row_Interface {
		public function addColumn( QMatrix_Column_Interface $column ) : void;
		public function getCell( int $column ) : QMatrix_Cell_Interface;
		public function addFilter( QFilter_Interface $filter ) : void;
		public function sizeOf() : int;

	}
	
?>