<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 5:54 PM
 */


namespace views\forms\admin;


use utilities\InfoCentralConnection;
use views\forms\Form;

class BulletinForm extends Form
{
    /**
     * BulletinForm constructor.
     * @param array|null $details
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct(?array $details = NULL)
    {
        $this->setTemplateFromHTML('admin/BulletinForm', self::TEMPLATE_FORM);

        $roles = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'roles')->getBody();
        $roleSelect = '';

        foreach($roles as $role)
        {
            $selected = '';
            if($details !== NULL)
            {
                foreach($details['roles'] as $assignedRole)
                {
                    if($role['id'] == $assignedRole['id'])
                        $selected = 'selected';
                }
            }

            $roleSelect .= "<option value='{$role['id']}' $selected>{$role['name']}</option>";
        }

        $this->setVariable('roleSelect', $roleSelect);

        if($details !== NULL)
        {
            if($details['inactive'])
                $this->setVariable('inactiveYes', 'selected');
            if($details['type'] == 'a')
                $this->setVariable('typeAlert', 'selected');

            if($details['endDate'] == '9999-12-31')
                $this->setVariable('endDate', '');

            $this->setVariables($details);
        }
    }
}