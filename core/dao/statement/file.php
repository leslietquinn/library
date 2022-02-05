<?php

	/**
	 * @package		dao
	 * @version		beta-07g, 2021-pending
	 * @author		les quinn 
	 * @final
	 */
	 
	final class QDao_Statement {
		public function __construct() {}
		
		/**
		 * Prepare SQL string based on accumalated parameters
		 * 
		 * @param	$conn			object typeof QDb_Connection_Interface
		 * @param	$sql			string
		 * @param	$parameters		array
		 *
		 * @see			QDb_Connection_MySql_Statement::bindString();
		 *
		 * @static
		 * @access			public
		 * @return			string
		 */
		 
		static public function bindParams( QDb_Connection_Interface $conn, string $sql, array $parameters ) : string {
			$parts = explode( '?', $sql ); 
			
			$sql = $parts[0];
			for( $a = 1; $a < count( $parts ); $a++ ) {
				$parameter = mysqli_real_escape_string( $conn -> getConnection(), preg_replace( QExpressions::NON_VISIBLE_CHARS, '', strval( $parameters[$a] ) ) );
			
				$sql .= "'".$parameter."'".$parts[$a];
			} 
			
			return $sql;
		}
	}
	
?>