<?php

	interface QMatrix_Interface {
		public function addColumn( QMatrix_Column_Interface $column ) : QMatrix_Interface;
		public function addFilter( QFilter_Interface $filter ) : QMatrix_Interface;
		public function addRow( QMatrix_Row_Interface $row ) : QMatrix_Interface;
		public function rows() : int;
	}

?>