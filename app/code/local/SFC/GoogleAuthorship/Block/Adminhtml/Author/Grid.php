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

class SFC_GoogleAuthorship_Block_Adminhtml_Author_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

	/**
	 * Construct
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setId("authorGrid");
		$this->setDefaultSort("id");
		$this->setDefaultDir("ASC");
		$this->setSaveParametersInSession(true);
	}

	/**
	 * Prepare collection for grid
	 * 
	 * @return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
	 */
	protected function _prepareCollection()
	{
		$collection = Mage::getModel("googleauthorship/author")->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	/**
	 * Prepare grid columns
	 * 
	 * @return Mage_Adminhtml_Block_Widget_Grid::_prepareColumns();
	 */
	protected function _prepareColumns()
	{
		$this->addColumn("id", array(
		"header" => Mage::helper("googleauthorship")->__("ID"),
		"align" =>"right",
		"width" => "50px",
		"type" => "number",
		"index" => "id",
		));

		$this->addColumn("name", array(
		"header" => Mage::helper("googleauthorship")->__("Name"),
		"align" =>"right",
		"index" => "name",
		));

		$this->addColumn("profile_url", array(
		"header" => Mage::helper("googleauthorship")->__("Profile URL"),
		"align" =>"right",
		"index" => "profile_url",
		));

		$this->addColumn("verified_email", array(
		"header" => Mage::helper("googleauthorship")->__("Verified Email"),
		"align" =>"right",
		"index" => "verified_email",
		));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
		$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

		return parent::_prepareColumns();
	}
	
	/**
	 * Get grid row url
	 * 
	 * @return string;
	 */
	public function getRowUrl($row)
	{
		return $this->getUrl("*/*/edit", array("id" => $row->getId()));
	}
	
	/**
	 * Prepare mass grid action
	 * 
	 * @return SFC_GoogleAuthorship_Block_Adminhtml_Author_Grid;
	 */
	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('id');
		$this->getMassactionBlock()->setFormFieldName('ids');
		$this->getMassactionBlock()->setUseSelectAll(true);
		$this->getMassactionBlock()->addItem('remove_authors', array(
		'label'=> Mage::helper('googleauthorship')->__('Remove Authors'),
		'url'  => $this->getUrl('*/adminhtml_author/massRemove'),
		'confirm' => Mage::helper('googleauthorship')->__('Are you sure?')
		));
		return $this;
	}
	
}