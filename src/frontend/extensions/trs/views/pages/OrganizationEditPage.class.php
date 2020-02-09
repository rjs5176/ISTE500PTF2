<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/09/2020
 * Time: 1:10 PM
 */


namespace extensions\trs\views\pages;


use extensions\trs\views\forms\EditOrganizationForm;

class OrganizationEditPage extends BackOfficeModelPage
{
    public function __construct(?string $orgID)
    {
        parent::__construct('trs/organizations/' . $orgID, 'trs_organizations-r', 'organizations');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', 'Editing Organization ' . htmlentities($details['name']));

        $form = new EditOrganizationForm($details);

        $this->setVariable('content', $form->getTemplate());
    }
}