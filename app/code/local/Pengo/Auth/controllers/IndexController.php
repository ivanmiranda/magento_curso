<?php

/**
 *   PengoStores
 * 
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM8=~==~~~===7MMMMMMMMMMMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMO~~~~~~~~~~~~~~~~~~~MMMMMMMMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMM=~=~~~~~~~~~~~~~~~~~~~~~~~MMMMMMMMMMMM
 *   MMMMMMMMMMMMMMMMM8==~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~MMMMMMMMMM
 *   MMMMMMMMMMMMMM~~~~~~~~~~~~~~~~~~~~~~~~~~~~~=MMMMMM~MMMMMMMMM
 *   MMMMMMMMMMM~~~~~~~~~~~~~~~~~~~~~~~~~===MMMMMMMM=~~~~MMMMMMMM
 *   MMMMMMMMM=~~~~~~~~~~~~~~~~=~+7MMMMMMMMMMM$?M+=~~~~~~=MMMMMMM
 *   MMMMMMM?~~~~~~~~~~=MMMMMMMMMMMMMMMMMM???MD~~~~~~~~~~~=MMMMMM
 *   MMMMMM=~~~~~~~~~=MMMMMMMMMMMMMMMMM???IMM=~~~~~~~~~~~~~MMMMNM
 *   MMMMM=~~~~~~~~~7MMMMMMMMMM,.?MMM??OMMM=~~~~~~~~~~~~~~~+MMMMM
 *   MMMMZ~~~~~~~~~MMMMMMMMMMMMMMMMMMMMMMM~~~~~~~~~~~~~~~~~~MMMMM
 *   MMMM~~~~~~~~~MMMMMMMMMMMMMMMMMMMMMMM~~~~~~~~~~~~~~~~~~~MMMMM
 *   MMMM~~~~~~~=MMMMMMMMMMMMMMMMMMMMMMM~=~~~~~~~~~~~~~~~~~~MMMMM
 *   MMM8~~~~~~~NMMMM++MMMMMMMMMMMMMMMM=~~~~~~~~~~~~~~~~~~~~7MMMM
 *   MMM7~~~~~~~MMM++++=MMMMMMMMMMMMMM=~~~~~~~~~~~~~~~~~~~~~?MMMM
 *   MMMZ~~~~~=MMM?+++==MMMMMMMMMMMMMM~~~~~~~~~~~~~~~~~~~~~~?MMMM
 *   MMMM~~~~~~MM??++====MMMMMMMMMMMMM~~~~~~~~~~~~~~~~~~~~~~$MMMM
 *   MMMM~~~~~MM?+++===~~~MMMMMMMMMMMMM~=~~~~~~~~~~~~~~~~~~~MMMMM
 *   MMMM+~~~~MM?+~.....:~:8MMMMM~...OMM~~~~~~~~~~~~~~~~~~~~MMMMM
 *   DMMMM=~~~M=....... DMN   . ......MMM=~~~~~~~~~~~~~~~~~~MMMMM
 *   MMMMMM~~=MM.....MMMMMMMMN ........MM=~~~~~~~~~~~~~~~~~$MMMMM
 *   MMMMMM7~~MMM...MMMMMMMMMMM~ . . . .MM~~~~~~~~~~~~~~~~=MMMMMM
 *   MMMMMMM7~MMMMMMMMMMMMMMMMMMM. . .   MM=~~~~~~~~~~~~=~MMMMMMM
 *   MMMMMMMMOMMMMMMMMMMMMMMMMMMMM . .   .MM~~~~~~~~~~~~7MMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMMMM=.......,MM~~~~~~~~~=MMMMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMMMMM. .    .,MM=~~~~=MMMMMMMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMMMMM. .   ...MMM=~=MMMMMMMMMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMMMMM..........MMMMMMMMMMMMMMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMMMMM.........IMMMMMMMMMMMMMMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMMMM.......MMMMMMMMMMMMMMMMMMMMMMMM
 *   MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
 * 
 * NOTICE OF LICENSE
 *
 * This source file is subject to the PengoStores License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pengostores.com/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@pengostores.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Edit or add to this file under your own risk.
 * PengoStores will not provide  support to any developed extension
 * which has been modified after its official release.
 *
 * @author Iván Miranda <ivan@pengostores.com>
 * @package  Auth
 * @category Pengo_Security
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * 
 */

class Pengo_Auth_IndexController extends Mage_Core_Controller_Front_Action {
	public function indexAction() {
		if(Mage::getStoreConfig('Pengo_Auth/general/enabled')) {
			$this->loadLayout();
			$this->renderLayout();
		}
	}

	public function qrAction() {
		if(Mage::getStoreConfig('Pengo_Auth/general/enabled')) {
			$this->loadLayout();
			$this->renderLayout();
		}
	}

	public function qrAjaxAction() {
		if(Mage::getStoreConfig('Pengo_Auth/general/enabled')) {
			$_llave = "GEAKO2IJW4PKLBXF";
			$_auth = new Sincco_Google2Step();
			echo json_encode(array("respuesta"=>$_auth->urlQR("magento","pengo@magento.com",$_llave)));
		}
	}

	public function validarAction() {
		$_llave = "GEAKO2IJW4PKLBXF";
		$_tiempo = floor(time() / 30);
		$_auth = new Sincco_Google2Step();
		$_codigo = Mage::app()->getRequest()->getParam('codigoauth');
		echo json_encode(array("respuesta"=>$_auth->validaCodigo($_llave,$_codigo)));
	}
}