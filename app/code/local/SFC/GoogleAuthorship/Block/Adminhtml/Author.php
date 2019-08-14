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

class SFC_GoogleAuthorship_Block_Adminhtml_Author extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	/**
	 * Construct
	 */
    public function __construct()
    {
        $this->_controller = "adminhtml_author";
        $this->_blockGroup = "googleauthorship";
        $this->_headerText = Mage::helper("googleauthorship")->__("Google Author");
        $this->_addButtonLabel = Mage::helper("googleauthorship")->__("Add New Author");
        parent::__construct();	
    }

}