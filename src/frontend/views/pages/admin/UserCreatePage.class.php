<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 12:17 PM
 */


namespace views\pages\admin;


use views\forms\admin\UserForm;
;

class UserCreatePage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'users');

        $form = new UserForm();

        $this->setVariable('tabTitle', 'User (New)');
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
        $this->setVariable('passwordRequired', "class='required'");
    }
}