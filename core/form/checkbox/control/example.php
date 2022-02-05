<?php

	// example observer from include.php file
	// $page -> addObserver( new QForm_Control_Checkbox_*( '__name__' ) );
	//
	// example HTML fragment for future reference
	// <?php foreach( $this -> get( '__name__' ) as $option ): ?>
	// <input type="checkbox" name="__name__" value="__name__" <?php echo $option -> get( 'checked' ); ?> />
	// <?php endforeach; ?>
	//
	// example form control for checkbox *::toArray() function
	// return array( new QParameters( array( 'id' => '__name__' ) ) );
	//
	// example use of radio group
	//
	
	// <?php foreach( $this -> get( '__name__' ) as $option ): ?>
	// <input type="radio" name="__name__" value="<?php echo $option -> get( 'id' ); ?>" <?php echo $option -> get( 'checked' ); ?> />&nbsp;<?php echo $option -> get( 'name' ); ?>
	// <?php endforeach; ?>
	
	/*
	final class QRadio_Form_Control_Checkbox extends QForm_CheckBox_Control {
		public function __construct( $field_name ) {
			$this -> field_name = $field_name;
		}
		
		public function toArray() {
			return array( 
				0	=>	new QParameters( array(
					'id'	=>	'mr',
					'name'	=>	'Mr' ) ),
				1	=>	new QParameters( array(
					'id'	=>	'ms', 
					'name'	=>	'Ms / Mrs' ) ),
			);
		}
	}
	*/
	
?>