<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/10/2020
 * Time: 3:32 PM
 */


namespace extensions\trs\views\forms;


use views\forms\Form;

class NewOrganizationForm extends Form
{
    /**
     * EditOrganizationForm constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('OrganizationForm', self::TEMPLATE_FORM, 'trs');
        $this->setVariable('menu', self::templateFileContents('OrgNewFormMenu', self::TEMPLATE_ELEMENT, 'trs'));
        $this->setVariable('formScript', 'createOrganization()');
    }
}