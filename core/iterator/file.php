<?php

	abstract class QIterator implements QIterator_Interface {
		protected $dataspace = null;
		protected $position;
		
		/**
		 * Class constructor
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 *
		 * @return 			void
		 */
		 
		public function __construct( QDataspace_Interface $dataspace ) {
			$this -> dataspace = $dataspace;
			
			$this -> rewind();
		}
		
		/**
		 * Return the internal pointer to the start
		 *
		 * @access			public
		 *
		 * @return			void
		 */
		 
		public function rewind() {
			$this -> position = 0;
		}
		
		/**
		 * Determine if there is an array element, does it exist or not
		 *
		 * @access			public
		 *
		 * @return			bool
		 */
		 
		public function valid() : bool {
			return $this -> dataspace -> has( $this -> position );
		}
		
		/**
		 * Move the internal pointer to next position
		 *
		 * @access			public
		 *
		 * @return			void
		 */
		 
		public function next() {
			$this -> position++;
		}
		
		/**
		 * Return the contents of the current internal position
		 *
		 * @access			public
		 *
		 * @return			string
		 */
		 
		public function current() : array {
			return $this -> dataspace -> get( $this -> position );
		}
		
		/**
		 * Return the current internal pointer position
		 *
		 * @access			public
		 *
		 * @return			int
		 */
		 
		public function key() : int {
			return (int) $this -> position;
		}
		
		/**
		 * Set data for the current internal pointer position
		 *
		 * @param	$payload		array
		 *
		 * @access			public
		 * @introduced		2021/11/17
		 *
		 * @return			void
		 */
		 
		public function set( array $payload ) {
			$this -> dataspace -> set( $this -> position, $payload );
		}
		
		/**
		 * Delegate an operation to another responsibility
		 *
		 * @param	$acceptee			object
		 *
		 * @access			public
		 * 
		 * @return			void
		 * @throws 			QIterator_Exception
		 */
		 
		public function accept( QAcceptee_Interface $acceptee ) {
			try {
				$acceptee -> push( $this );
			} catch( QException $e ) {
				throw new QIterator_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Allow data to be imported into the dataspace container
		 *
		 * @param	$dataspace			object typeof QDataspace_Interface
		 *
		 * @access			public
		 * 
		 * @return			void
		 */
		 
		public function import( QDataspace_Interface $dataspace ) {
			$this -> dataspace -> import( $dataspace );
		}
		
		/**
		 * Allow the dataspace container to be exported, emptied
		 *
		 * @access			public
		 *
		 * @return			array
		 */
		 
		public function export() : array {
			return $this -> dataspace -> export();
		}
		
		/**
		 * Access specific data named by parameter for current index
		 *
		 * @param	$parameter		string
		 *
		 * @access		public
		 * @return		mixed
		 */
		 
		public function find( $parameter ) {
			return $this -> dataspace -> get( $this -> position ) -> get( $parameter );
		}
	}
	
	/*
	final class QSample_Iterator extends QIterator {
		public function __construct( $collection ) {
			parent::__construct( $collection );
		}
		
	}
	
	$c = new QSample_Iterator(
		new QParameters( 
			array(
				
				0	=>	new QParameters( array( 'id' => '345543', 'name' => 'Leslie' ) ),
				1	=>	new QParameters( array( 'id' => '345345', 'name' => 'William' ) ),
				2	=>	new QParameters( array( 'id' => '787865', 'name' => 'Mary' ) ),
				3	=>	new QParameters( array( 'id' => '123988', 'name' => 'Katrina' ) ),
			)
		)
	);
	
	for( $c -> rewind(); $c -> valid(); $c -> next() ) {
		echo $c -> find( 'id' ).' -- '.$c -> find( 'name' ).'<br>';
	}
	*//* example of use */
	
?>