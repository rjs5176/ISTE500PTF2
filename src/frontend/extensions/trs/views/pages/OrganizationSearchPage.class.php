<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/09/2020
 * Time: 11:52 AM
 */


namespace extensions\trs\views\pages;


class OrganizationSearchPage extends BackOfficeDocument
{
    public function __construct()
    {
        parent::__construct('trs_organizations-r', 'organizations');

        $this->setVariable('tabTitle', 'Search Organizations');
        $this->setVariable('content', self::templateFileContents('OrganizationSearchPage', self::TEMPLATE_PAGE, 'trs'));
    }
}