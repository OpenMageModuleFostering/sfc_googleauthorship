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

class SFC_GoogleAuthorship_Model_Author extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
       $this->_init("googleauthorship/author");
    }

}
	 