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
 
class SFC_GoogleAuthorship_Model_Observer
{
	/**
	 * Add input field to edit CMS page
	 *
	 * @param $observer : 
	 */
    public function cmsField($observer)
    {
        //get CMS model with data
        $model = Mage::registry('cms_page');
        //get form instance
        $form = $observer->getForm();
        //create new custom fieldset
        $fieldset = $form->addFieldset('author', array('legend'=>Mage::helper('cms')->__('Google Authorship'),'class'=>'fieldset-wide'));
        //add new field
        $fieldset->addField('google_author_id', 'select', array(
            'name'      => 'google_author_id',
            'label'     => Mage::helper('cms')->__('Select Author'),
            'title'     => Mage::helper('cms')->__('Select Author'),
            'disabled'  => false,
            'values'     => $this->getGoogleAuthors(),
        ));
         
    }
	
	/**
	 * Get list of all google authors
	 *
	 * @return array
	 */
    public function getGoogleAuthors() 
    {
        $collection = Mage::getModel('googleauthorship/author')->getCollection();

        $output = array();
		array_push($output,array('value'=>NULL, 'label'=>'No Author'));
        foreach ($collection as $item)
        { 
            array_push($output,array('value'=>$item->getId(), 'label'=>$item->getName()));	
        }	    
        return $output;
    }
	
	/**
	 * Set google_author_id field null
	 */
	public function filterCMSvalue($observer) 
	{
		$page = $observer->getPage();
		if($page->getData('google_author_id') == '') {
			$page->setData('google_author_id',null);
		}
		return;
	}

}