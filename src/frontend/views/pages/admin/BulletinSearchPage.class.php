<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 4:32 PM
 */


namespace views\pages\admin;


;

class BulletinSearchPage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings', 'bulletins');
        $this->setVariable('tabTitle', 'Bulletins');
        $this->setVariable('content', self::templateFileContents("admin/BulletinSearchPage", self::TEMPLATE_PAGE));
    }
}