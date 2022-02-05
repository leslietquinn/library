<?php

	final class QNetworks_Protocols {
		
		static public function isV4( $packed_ip ) {
			return strpos( $packed_ip, ':' ) === false ? 4 : 6;
		}
		
		static public function convertFromV4( $packed_ip ) {
			return ip2long( $ip_address );
		}
		
		static function convertFromV6( $packed_ip ) {
			$pton = @inet_pton( $packed_ip );
  
			if( !$pton ) { 
				return false; 
			}
			
			$number = '';
			foreach( unpack( 'C*', $pton ) as $byte ) {
				$number .= str_pad( decbin( $byte ), 8, '0', STR_PAD_LEFT );
			}
			
			return base_convert( ltrim( $number, '0' ), 2, 10 );
		}

	}

?>