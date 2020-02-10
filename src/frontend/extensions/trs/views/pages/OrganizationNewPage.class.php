<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/10/2020
 * Time: 3:33 PM
 */


namespace extensions\trs\views\pages;


use extensions\trs\views\forms\NewOrganizationForm;

class OrganizationNewPage extends BackOfficeDocument
{
    public function __construct()
    {
        parent::__construct('trs_organizations-w', 'organizations');

        $this->setVariable('tabTitle', 'Create Organization');

        $form = new NewOrganizationForm();

        $this->setVariable('content', $form->getTemplate());
    }
}