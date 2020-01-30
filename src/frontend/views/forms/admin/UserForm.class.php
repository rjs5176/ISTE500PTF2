<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 12:10 PM
 */


namespace views\forms\admin;


use utilities\InfoCentralConnection;
use views\forms\Form;

class UserForm extends Form
{
    /**
     * UserForm constructor.
     * @param array|null $details
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('admin/UserForm', self::TEMPLATE_FORM);

        if($details !== NULL)
        {
            $this->setVariables($details);

            if($details['disabled'])
                $this->setVariable('disabledYes', 'selected');
            if($details['authType'] == 'ldap')
                $this->setVariable('authTypeLdap', 'selected');
        }

        $roles = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'roles')->getBody();

        $roleSelect = "";

        foreach($roles as $role)
        {
            $selected = '';

            if($details !== NULL AND is_array($details['roles']))
            {
                foreach($details['roles'] as $currentRole)
                {
                    if($currentRole['id'] == $role['id'])
                        $selected = 'selected';
                }
            }

            $roleSelect .= "<option value='{$role['id']}' $selected>{$role['name']}</option>";
        }

        $this->setVariable('roleSelect', $roleSelect);
    }
}