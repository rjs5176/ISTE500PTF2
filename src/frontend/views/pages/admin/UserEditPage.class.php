<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 12:24 PM
 */


namespace views\pages\admin;


use views\forms\admin\UserForm;
;

class UserEditPage extends ModelPage
{
    public function __construct(?string $param)
    {
        parent::__construct("users/$param", 'settings', 'users');

        $details = $this->response->getBody();

        $this->setVariable('tabTitle', "User - {$details['username']} (Edit)");

        $form = new UserForm($details);
        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', "return save('$param')");
    }
}