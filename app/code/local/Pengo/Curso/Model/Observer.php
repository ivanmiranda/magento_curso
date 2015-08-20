<?php
class Pengo_Curso_Model_Observer {
    public function redireccionar($observer) {
        #Este objeto tiene todos los elementos asociados con la petición
        #var_dump($observer->getControllerAction()->getRequest());
        $_pagina = $observer->getControllerAction()->getRequest()->getRequestString();
        
        #Si la pagina solicitada es 'home' hacer el redireccionamiento
        if($_pagina == "/home") {
            $observer->getControllerAction()->getResponse()->setRedirect(Mage::getBaseUrl(), 301);
        }

        return $this;    
    }
}