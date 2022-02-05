<?php 

	final class QInternationalisation_Form_Control_Localisation extends QForm_Select_Control {
		public function __construct( string $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function toArray() : array {
			$dataset = QInternationalisation_Iso::languageCodeCountryCodeLanguageName();
			
			$array = array();
			foreach( $dataset as $k => $v ) {
				
				/**
				 * @note	split the token into its two parts, ie en-GB or 
				 *			ru-RU 
				 *
				 */
				 
				$split = explode( '-', $k );
				
				$lang = $split[0];
				$code = $split[1]; 
				$name = QInternationalisation_Iso::countryCodeCountryName( $code );
				
				$array[] = new QParameters( 
					array(
						'code' 			=> 	$lang.'_'.$code,
						'country' 		=> 	$v.' '.$name,
						'language' 		=> 	$lang,
					)
				);
			}
			
			return $array;
		}
	}
	
?>