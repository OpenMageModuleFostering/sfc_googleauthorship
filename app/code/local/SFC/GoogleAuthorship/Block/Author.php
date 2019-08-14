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
 * @author     Garth Brantley
 */

class SFC_GoogleAuthorship_Block_Author extends Mage_Core_Block_Template
{

    /**
     * Add meta information from author to head block
     *
     * @return SFC_GoogleAuthorship_Block_Author
     */
    protected function _prepareLayout()
    {
    	if(Mage::getStoreConfig('sfc_googleauthorship/general/enabled')) {
	        $headBlock = $this->getLayout()->getBlock('head');
    	    if ($headBlock) {
        	    if (($author = $this->getAuthor())) {
        	    	// Add link rel="author" tag to html <head>
            	    $headBlock->addLinkRel('author', $author->getProfileUrl());
            	}
            }
        }

        return parent::_prepareLayout();
    }
    
    /**
     * Get author information for current page
     *
     * @return SFC_GoogleAuthorship_Model_Author
     */
    public function getAuthor()
    {
    	// Check if we already saved author object
        if (!$this->hasData('author')) {
    		if(Mage::getStoreConfig('sfc_googleauthorship/general/enabled')) {
        		$authorId = Mage::getSingleton('cms/page')->getGoogleAuthorId();
            	if ($authorId) {
            		$author = Mage::getModel('googleauthorship/author')->load($authorId);
	            	$this->setData('author', $author);
	        	}
		        else {
		            $this->setData('author', $null);
	    	    }
	    	}
	        else {
	            $this->setData('author', $null);
    	    }
        }
        
        // Return saved author object
        return $this->getData('author');
    }

}