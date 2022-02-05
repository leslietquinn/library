<?php

	final class QPage_Handler_Shipping extends QPage_Handler_Validator {
		public function __construct() {
			$this -> id = 'shipping';
			$this -> initialise();
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			if( !$this -> validate( $request = QRegistry::get( 'request' ), QRegistry::get( 'logger' ) ) ) {
				
				/**
				 * @note	show either UK or European shipping message, otherwise 
				 *			default to International message
				 *
				 */
				 
				$this -> handler -> execute( $dataspace );
			} else {
				
				/**
				 * @note	default action fall to International shipping
				 *
				 */
				 
				$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
				
				$facade = new QShops_Shipments_Charges_Facade();
				$page -> operate( $facade -> navigation() );
				
				$page -> render( 'shipping.tpl' );
			}
		}
		
		protected function initialise() {
			$this -> forward( new QPage_Handler_Shipping_European() );
			
			$this -> addCondition( QValidator::factory()
				-> addCondition( 
					new QValidator_Condition_And( 
						
						/**
						 * @note	if not European AND not United Kingdom ISO 3 Code then continue 
						 * 			otherwise default to International shipping
						 *
						 */
						 
						new QValidator_Condition_Not( '__null__', new QShops_Shipments_Charges_Validator_Condition_Is_European() ),
						new QValidator_Condition_Not( '__null__', new QShops_Shipments_Charges_Validator_Condition_Is_Uk() )
					)
				)
			);
		}
	}
	
	final class QPage_Handler_Shipping_European extends QPage_Handler_Validator {
		public function __construct() {
			$this -> id = 'shipping';
			$this -> initialise();
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			if( $this -> validate( $request = QRegistry::get( 'request' ), QRegistry::get( 'logger' ) ) ) {
				
				/**
				 * @note	proceed to show the UK shipping message otherwise 
				 *			show European message
				 *
				 */
				 
				$this -> handler -> execute( $dataspace );
			} else {
				$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
				
				$facade = new QShops_Shipments_Charges_Facade();
				$page -> operate( $facade -> navigation() );
				
				$page -> render( 'shipping-european.tpl' );
			}
		}
		
		protected function initialise() {
			$this -> forward( new QPage_Handler_Shipping_Uk() );
			
			$this -> addCondition( QValidator::factory()
				-> addCondition( 
					new QValidator_Condition_And( 
					
						/**
						 * @note	if United Kingdom AND not any European ISO 3 Code then continue 
						 * 			otherwise default
						 *
						 */
						 
						new QShops_Shipments_Charges_Validator_Condition_Is_Uk(),
						new QValidator_Condition_Not( '__null__', new QShops_Shipments_Charges_Validator_Condition_Is_European() )
					)
				)
			);		
		}
	}
	
	final class QPage_Handler_Shipping_Uk extends QPage_Handler {
		public function __construct() {
			$this -> id = 'shipping';
		}
		
		public function execute( QDataspace_Interface $dataspace ) {
			$page = new QPage_Renderer( $request = QRegistry::get( 'request' ) );
			
			$facade = new QShops_Shipments_Charges_Facade();
			$page -> operate( $facade -> navigation() );
				
			$page -> render( 'shipping-uk.tpl' );
		}
	}
	
?>