<?php

	/**
	 * @package		http
	 * @version		beta-03e, 06;07-revised
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QHttp_Session_Sql_Container implements QHttp_Session_Interface {
		public function __construct() {}
		
		public function open( $path ) { 
			return true;
		}
		
		public function close() {
			$this -> gc( get_cfg_var( 'session.gc_maxlifetime' ) );
			
			$this -> getConnection() -> close();
			
			return true;
		}
		
		public function read( $session ) { 
			$stmt = $this -> getConnection() -> createStatement( 'select data from sessions where id = ?' );
			$stmt -> setString( 1, $session );
			$rs = $stmt -> execute();
				
			if( $rs -> rowCount() > 0 ) { 
				$row = $rs -> getRow();
				$row = $row['data'];
					
				return $row; 
			}
			
			return '';
		}
		
		public function write( $session, $data ) { 
			$stmt = $this -> getConnection() -> createStatement( 'replace into sessions values( ?, ?, ? )' );
			$stmt -> setString( 1, $session );
			$stmt -> setString( 2, $data ); 
			$stmt -> setInteger( 3, time() );
			$rs = $stmt -> execute();
			
			/*
			if( $rs -> affectedRows() ) { 
				return $rs -> getRow();
			}
			
			return false;
			*/
			
			return true;
		}
		
		public function destroy( $session ) { 
			$stmt = $this -> getConnection() -> createStatement( 'delete from sessions where id = ?' );
			$stmt -> setString( 1, $session );
			$rs = $stmt -> execute();
			
			/*
			if( $rs -> affectedRows() ) {
				return $rs -> getRow();
			}
			
			return false;
			*/
			
			return true;
		}
		
		public function gc( $maximum ) {
			$lifespan = time() - $maximum;
			$stmt = $this -> getConnection() -> createStatement( 'delete from sessions where access < ?' );
			$stmt -> setInteger( 1, $lifespan );
			$rs = $stmt -> execute();
			
			/*
			if( $rs -> affectedRows() ) {
				return $rs -> getRows();
			}
			
			return false;
			*/
			
			return true;
		}
		
		public function __destruct() {
			@session_write_close();
		}
		
		private function getConnection() {
			return QRegistry::get( 'connection' );
		}
	}
	
?>