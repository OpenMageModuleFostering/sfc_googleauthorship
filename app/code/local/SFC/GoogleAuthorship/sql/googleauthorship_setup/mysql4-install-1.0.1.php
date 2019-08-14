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

$installer = $this;
$installer->startSetup();

//
//Create sfc_googleauthor table
//
$installer->run("

create table if not exists {$installer->getTable('googleauthorship/author')}(
    id int not null auto_increment, 
    name varchar(255),
    profile_url varchar(255), 
    verified_email varchar(255),
    primary key(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

//
//Add column to cms_page table
//
$conn = $installer->getConnection();
$table = $installer->getTable('cms_page');
$conn->addColumn($table, 'google_author_id', 'int(10) NULL');

//
//Add FK constraint to google_author_id column, references sfc_googleauthor (id)
//
$conn->addConstraint(
    'FK_GOOGLE_AUTHORSHIP_ID',
    $installer->getTable('cms_page'), 
    'google_author_id',
    $installer->getTable('googleauthorship/author'), 
    'id',
    'set null', 
    'set null'
);

$installer->endSetup();
	 