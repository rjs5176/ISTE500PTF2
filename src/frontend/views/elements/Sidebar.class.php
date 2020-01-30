<?php /** @noinspection PhpUndefinedFieldInspection */

/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/11/2019
 * Time: 5:01 PM
 */


namespace views\elements;


use utilities\InfoCentralConnection;
use views\View;

/**
 * Class Sidebar
 *
 * A sidebar that displays pages the current user has access to in the section they're in
 *
 * @package views\elements
 */
class Sidebar extends View
{
    /**
     * Sidebar constructor.
     * @param string $navClass
     * @param string $sectionTitle
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $navClass, string $sectionTitle)
    {
        $this->setTemplateFromHTML("Sidebar", self::TEMPLATE_ELEMENT);

        /** @noinspection PhpUndefinedFieldInspection */
        if(!class_exists($navClass) OR empty($navClass::LINKS) OR empty($navClass::LINKS[$sectionTitle])) // Check that class exists and section exists inside of it
            return;

        $section = $navClass::LINKS[$sectionTitle];

        $this->setVariable("sectionTitle", $section['title']);
        $this->setVariable('sectionIcon', $section['icon']);

        if(!isset($section['pages']))
            return;

        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();
        $links = "";

        // Check for a base URI for this section
        if(!empty($navClass::BASE_URI))
            $sectionURI = $navClass::BASE_URI;
        else
            $sectionURI = '';

        foreach($section['pages'] as $page)
        {
            if(isset($page['icon']))
            {
                $icon = "<i class='icon'>{$page['icon']}</i>";
            }
            else
                $icon = "";

            if(in_array($page['permission'], $permissions))
                $links .= "<li><a href='{{@baseURI}}" . $sectionURI . $page['link'] . "'>$icon{$page['title']}</a></li>\n";
        }

        $this->setVariable("sectionLinks", $links);
    }
}