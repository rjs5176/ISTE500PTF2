<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:39 PM
 */


namespace views\elements;


use utilities\InfoCentralConnection;
use views\View;

class Navigation extends View
{
    /**
     * Navigation constructor.
     * @param string $baseURI
     * @param array $links
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct(string $baseURI, array $links)
    {
        $this->setTemplateFromHTML('Navigation', self::TEMPLATE_ELEMENT);
        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();

        $navigation = '';

        foreach($links as $section)
        {
            if(!in_array($section['permission'], $permissions))
                continue;

            if(isset($section['link']))
                $sectionString = "<li><a class='nav-item' href='{{@baseURI}}{$baseURI}{$section['link']}'><i class='icon'>{$section['icon']}</i>{$section['title']}</a>\n";
            else
                $sectionString = "<li><span class='nav-item'><i class='icon'>{$section['icon']}</i>{$section['title']}</span>\n";

            if(isset($section['pages']))
            {
                $sectionString .= "<ul>\n";

                foreach($section['pages'] as $page)
                {
                    if(!in_array($page['permission'], $permissions))
                        continue;

                    if(isset($page['icon']))
                    {
                        $icon = "<i class='icon'>{$page['icon']}</i>";
                    }
                    else
                        $icon = "";


                    $sectionString .= "<li><a href='{{@baseURI}}{$baseURI}{$page['link']}'>" . $icon . "{$page['title']}</a></li>";
                }

                $sectionString .= "</ul>\n";
            }

            $sectionString .= "</li>";

            $navigation .= $sectionString;
        }

        $this->setVariable("navigation", $navigation);
    }
}