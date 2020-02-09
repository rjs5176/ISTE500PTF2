<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/08/2020
 * Time: 3:49 PM
 */


namespace extensions\trs\views\pages;


class BackOfficeHomePage extends BackOfficeDocument
{
    public function __construct()
    {
        parent::__construct('trs_backoffice');
        $this->setVariable('tabTitle', 'Back Office');
        $this->setVariable('content', self::templateFileContents('BackOfficeHomePage', self::TEMPLATE_PAGE, 'trs'));
    }
}