<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * APPLICATION
 *
 * DESCRIPTION
 *
 * User: lromero
 * Date: 2/04/2020
 * Time: 9:53 AM
 */


namespace extensions\trs\views\pages;


use views\pages\SidebarDocument;

abstract class TRSDocument extends SidebarDocument
{
    public function __construct(?string $permission = NULL, ?string $section = NULL)
    {
        // TODO create TRSNavigation and link under navClass
        parent::__construct($permission, NULL, $section);

        // TODO construct TRS Navigation
        // and assign to 'navigation' variables

        $this->setVariable('appCaption', 'TRS');

        // TODO add custom stylesheets, if necessary
    }
}