<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 3:28 PM
 */


namespace views\pages\admin;


class BadLogSearchPage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'users');

        $this->setVariable('tabTitle', 'Failed Login History');

        $this->setVariable('content', self::templateFileContents('admin/BadLogSearchPage', self::TEMPLATE_PAGE));
    }
}