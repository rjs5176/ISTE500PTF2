<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/08/2020
 * Time: 3:46 PM
 */


namespace extensions\trs\views\pages;


use extensions\trs\views\elements\BackOfficeNavigation;
use views\pages\SidebarDocument;

abstract class BackOfficeDocument extends SidebarDocument
{
    public function __construct(?string $permission = NULL, ?string $section = NULL)
    {
        parent::__construct($permission, 'extensions\trs\views\elements\BackOfficeNavigation', $section);

        $navigation = new BackOfficeNavigation();
        $this->setVariable('navigation', $navigation->getTemplate());
    }
}