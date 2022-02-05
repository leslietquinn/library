<?php

	interface QMatrix_Column_Interface {
		public function __construct( int $size );
		public function sizeOf() : int;
	}
	
?>