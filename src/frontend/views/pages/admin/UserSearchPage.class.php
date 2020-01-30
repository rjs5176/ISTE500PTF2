<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 11:53 AM
 */


namespace views\pages\admin;


;

class UserSearchPage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'users');

        $this->setVariable('tabTitle', 'Users');
        $this->setVariable('content', self::templateFileContents('admin/UserSearchPage', self::TEMPLATE_PAGE));
    }
}