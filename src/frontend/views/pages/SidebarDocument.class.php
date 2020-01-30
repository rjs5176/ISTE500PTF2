<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 10:07 AM
 */


namespace views\pages;


use views\elements\Header;
use views\elements\Sidebar;

abstract class SidebarDocument extends AuthenticatedPage
{
    /**
     * SidebarDocument constructor.
     * @param string|null $permission
     * @param string|null $navClass Name of the class holding the navigation sections
     * @param string|null $sectionTitle Index of the list of pages in the navigation class
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $permission = NULL, ?string $navClass = NULL, ?string $sectionTitle = NULL)
    {
        parent::__construct($permission);
        $this->setVariable("content", self::templateFileContents("SidebarDocument", self::TEMPLATE_PAGE));

        // Add header
        $header = new Header();
        $this->setVariable("header", $header->getTemplate());

        // Add footer
        $this->setVariable("footer", self::templateFileContents("Footer", self::TEMPLATE_ELEMENT));

        if($navClass !== NULL AND $sectionTitle !== NULL)
        {
            $sidebar = new Sidebar($navClass, $sectionTitle);
            $this->setVariable("sidebar", $sidebar->getTemplate());
        }

        $this->setVariable('operatorName', $this->user->getUsername());
    }
}