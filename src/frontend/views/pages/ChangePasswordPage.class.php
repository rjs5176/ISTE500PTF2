<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 11:26 AM
 */


namespace views\pages;


use views\forms\ChangePasswordForm;

class ChangePasswordPage extends PortalDocument
{
    private $form;

    public function __construct()
    {
        parent::__construct();

        $this->form = new ChangePasswordForm();

        $this->setVariable("content", $this->form->getTemplate());

        $this->setVariable("tabTitle", "Change Password");
    }

    /**
     * @return array
     * @throws \exceptions\InfoCentralException
     */
    public function validateForm(): array
    {
        return $this->form->validateForm();
    }
}