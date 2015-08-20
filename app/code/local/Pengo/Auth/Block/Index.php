<?php
class Pengo_Auth_Block_Index extends Mage_Core_Block_Template {
	public function getQR() {
		$_llave = "GEAKO2IJW4PKLBXF";
		$_tiempo = floor(time() / 30);
		$_auth = new Sincco_Google2Step();
		return $_auth->urlQR("magento","pengo@magento.com",$_llave);
	}

}