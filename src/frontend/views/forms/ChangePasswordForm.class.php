<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/09/2019
 * Time: 11:39 AM
 */


namespace views\forms;


use utilities\InfoCentralConnection;

class ChangePasswordForm extends Form
{
    protected const FIELDS = array('old', 'new', 'confirm');

    /**
     * PasswordChangeForm constructor.
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        $this->fields = self::FIELDS;
        $this->setTemplateFromHTML("ChangePasswordForm", self::TEMPLATE_FORM);
    }

    /**
     * @return array
     * @throws \exceptions\InfoCentralException
     */
    public function validateForm(): array
    {
        $fields = $this->formAsArray();

        // TODO: call IC changepassword route
        $response = InfoCentralConnection::getResponse(InfoCentralConnection::PUT, "currentUser/changepassword", $fields);

        if($response->getResponseCode() != "204")
            return $response->getBody();

        return array();
    }
}