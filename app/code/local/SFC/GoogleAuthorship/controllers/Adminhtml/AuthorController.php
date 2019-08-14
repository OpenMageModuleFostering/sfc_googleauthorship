<?php
/**
 * SFC - Google Authorship Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@storefrontconsulting.com so we can send you a copy immediately.
 * 
 * @package    SFC_GoogleAuthorship
 * @copyright  (C)Copyright 2013 StoreFront Consulting, Inc (http://www.StoreFrontConsulting.com/)
 * @author     Luke James : ljames@storefrontconsulting.com
 */

class SFC_GoogleAuthorship_Adminhtml_AuthorController extends Mage_Adminhtml_Controller_Action
{
	/**
	 * initialize
	 */
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu("googleauthorship/author")->_addBreadcrumb(Mage::helper("adminhtml")->__("Authors  Manager"),Mage::helper("adminhtml")->__("Author Manager"));
		return $this;
	}

	/**
	 * Author index controller action
	 */
	public function indexAction() 
	{
		$this->_title($this->__("Googleauthorship"));
		$this->_title($this->__("Manager Authors"));

		$this->_initAction();
		$this->renderLayout();
	}

	/**
	 * Author edit action
	 */
	public function editAction()
	{			    
		$this->_title($this->__("Googleauthorship"));
		$this->_title($this->__("Author"));
		$this->_title($this->__("Edit Item"));
		
		$id = $this->getRequest()->getParam("id");
		$model = Mage::getModel("googleauthorship/author")->load($id);
		if ($model->getId()) {
			Mage::register("author_data", $model);
			$this->loadLayout();
			$this->_setActiveMenu("googleauthorship/author");
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Author Manager"), Mage::helper("adminhtml")->__("Author Manager"));
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Author Description"), Mage::helper("adminhtml")->__("Author Description"));
			$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock("googleauthorship/adminhtml_author_edit"))->_addLeft($this->getLayout()->createBlock("googleauthorship/adminhtml_author_edit_tabs"));
			$this->renderLayout();
		} 
		else {
			Mage::getSingleton("adminhtml/session")->addError(Mage::helper("googleauthorship")->__("Author does not exist."));
			$this->_redirect("*/*/");
		}
	}

	/**
	 * Author new action
	 */
	public function newAction()
	{
		$this->_title($this->__("Googleauthorship"));
		$this->_title($this->__("Author"));
		$this->_title($this->__("New Item"));

		$id = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("googleauthorship/author")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("author_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("googleauthorship/author");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Author Manager"), Mage::helper("adminhtml")->__("Author Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Author Description"), Mage::helper("adminhtml")->__("Author Description"));

		$this->_addContent($this->getLayout()->createBlock("googleauthorship/adminhtml_author_edit"))->_addLeft($this->getLayout()->createBlock("googleauthorship/adminhtml_author_edit_tabs"));

		$this->renderLayout();

	}

	/**
	 * Author save action
	 */
	public function saveAction()
	{
		$post_data=$this->getRequest()->getPost();

		if ($post_data) {
			try 
			{				
				$model = Mage::getModel("googleauthorship/author")
				->addData($post_data)
				->setId($this->getRequest()->getParam("id"))
				->save();

				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Authors was successfully saved"));
				Mage::getSingleton("adminhtml/session")->setAuthorData(false);

				if ($this->getRequest()->getParam("back")) {
					$this->_redirect("*/*/edit", array("id" => $model->getId()));
					return;
				}
				$this->_redirect("*/*/");
				return;
			} 
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				Mage::getSingleton("adminhtml/session")->setAuthorData($this->getRequest()->getPost());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
				return;
			}
		}
		$this->_redirect("*/*/");
	}

	/**
	 * Author delete action
	 */
	public function deleteAction()
	{
		if( $this->getRequest()->getParam("id") > 0 ) {
			try {
				$model = Mage::getModel("googleauthorship/author");
				$model->setId($this->getRequest()->getParam("id"))->delete();
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
				$this->_redirect("*/*/");
			} 
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
			}
		}
		$this->_redirect("*/*/");
	}

	/**
	 * Author massRemove action
	 */
	public function massRemoveAction()
	{
		try {
			$ids = $this->getRequest()->getPost('ids', array());
			foreach ($ids as $id) {
				$model = Mage::getModel("googleauthorship/author");
				$model->setId($id)->delete();
			}
			Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
		}
		catch (Exception $e) {
			Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
		}
		$this->_redirect('*/*/');
	}
	
}
