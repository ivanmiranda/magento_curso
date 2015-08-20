<?php
class Pengo_Curso_OtroController extends Mage_Core_Controller_Front_Action {
	public function indexAction() {
		#Regresar como respuesta el nombre de la acción que se está solicitando
		$this->getResponse()->setBody( $this->getFullActionName() );
	}
	public function otraAction() {
		#Regresar como respuesta el nombre de la acción que se está solicitando
		$this->getResponse()->setBody( $this->getFullActionName() );
	}
	public function masAction() {
		#Regresar como respuesta el nombre de la acción que se está solicitando
		$this->getResponse()->setBody( $this->getFullActionName() );
	}
}