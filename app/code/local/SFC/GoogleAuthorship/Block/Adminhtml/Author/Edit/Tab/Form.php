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
 
class SFC_GoogleAuthorship_Block_Adminhtml_Author_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * Create form fields
	 *
	 * @return Mage_Adminhtml_Block_Widget_Form::_prepareForm();
	 */
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset("googleauthorship_form", array("legend"=>Mage::helper("googleauthorship")->__("Author information")));	

		//name
		$fieldset->addField("name", "text", array(
		"label" => Mage::helper("googleauthorship")->__("Name"),
		"name" => "name",
		"class" => "required-entry",
		));	

		//profile url
		$fieldset->addField("profile_url", "text", array(
		"label" => Mage::helper("googleauthorship")->__("Profile URL"),
		"name" => "profile_url",
		"class" => "required-entry validate-url",
		));

		//email
		$fieldset->addField("verified_email", "text", array(
		"label" => Mage::helper("googleauthorship")->__("Verified Email"),
		"name" => "verified_email",
		"class" => "required-entry validate-email",
		));			

		if (Mage::getSingleton("adminhtml/session")->getAuthorData())
		{
			$form->setValues(Mage::getSingleton("adminhtml/session")->getAuthorData());
			Mage::getSingleton("adminhtml/session")->setAuthorData(null);
		} 
		elseif(Mage::registry("author_data")) {
			$form->setValues(Mage::registry("author_data")->getData());
		}
		return parent::_prepareForm();
	}
}
