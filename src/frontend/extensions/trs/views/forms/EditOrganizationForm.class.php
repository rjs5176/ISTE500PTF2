<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/09/2020
 * Time: 1:03 PM
 */


namespace extensions\trs\views\forms;


use views\forms\Form;

class EditOrganizationForm extends Form
{
    /**
     * EditOrganizationForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('OrganizationForm', self::TEMPLATE_FORM, 'trs');
        $this->setVariable('menu', self::templateFileContents('OrgEditFormMenu', self::TEMPLATE_ELEMENT, 'trs'));
        $this->setVariable('formScript', 'editOrganization(\'{{@id}}\')');

        // TODO: representativeManagement

        // History link
        $this->setVariable('historyLink', "<a class=\"history-link\" href=\"{{@baseURI}}history/trsorganization/{{@id}}\"><i class=\"icon\" title=\"View History\">history</i></a>");

        if($details !== NULL)
        {
            $this->setVariables($details);

            // Type selects
            if($details['type'] === 'donor')
                $this->setVariable('typeDonor', ' selected');
            if($details['approved'] == '0')
                $this->setVariable('approvedNo', ' selected');
        }
    }
}