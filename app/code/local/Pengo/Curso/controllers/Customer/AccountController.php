<?php
require_once 'Mage/Customer/controllers/AccountController.php';
class Pengo_Curso_Customer_AccountController extends Mage_Customer_AccountController{
    
	#Sobre la acción solicitada en el ejercicio
    public function loginAction()
    {
    	#Antes de lanzar la URL definida en la autorización, la cambio por mostrar la categoría 3 (productos apple en mi caso)
        $this->_getSession()->setBeforeAuthUrl(Mage::getModel('catalog/category')->load(3)->getUrl());
        
        #El resto del código queda como estaba originalmente...
        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $this->getResponse()->setHeader('Login-Required', 'true');
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');
        $this->renderLayout();
    }
}