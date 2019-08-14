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
 
class SFC_GoogleAuthorship_Block_Adminhtml_Author_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * Prepare edit form
	 */
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form(array(
		"id" => "edit_form",
		"action" => $this->getUrl("*/*/save", array("id" => $this->getRequest()->getParam("id"))),
		"method" => "post",
		"enctype" =>"multipart/form-data",
		));

		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}
