<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 2:44 PM
 */


namespace views\elements;


use utilities\InfoCentralConnection;
use views\View;

class PortalMenu extends View
{
    private const MENU = array(
        'configuration' => array(
            'title' => 'Configuration',
            'permission' => 'settings',
            'icon' => 'configuration.svg',
            'link' => 'admin'
        )
    );

    /**
     * PortalMenu constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        // Import extension menus
        $menuItems = array();

        // Import routes from extensions
        foreach(\Config::OPTIONS['enabledExtensions'] as $extension)
        {
            // Check for ExtConfig.class inside extension
            $extConfig = "extensions\\$extension\\ExtConfig";

            // If it doesn't exist, skip the extension
            if(!class_exists($extConfig))
                continue;

            // Merge ROUTES from ExtConfig into $controllers
            $extConfig = new $extConfig();

            $menuItems = array_merge($menuItems, $extConfig::MENU);
        }

        // Include core menu items at the bottom
        $menuItems = array_merge($menuItems, self::MENU);

        $this->setTemplateFromHTML('PortalMenu', self::TEMPLATE_ELEMENT);
        $permissions = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/permissions")->getBody();
        $menu = '';

        foreach($menuItems as $item)
        {
            if(!in_array($item['permission'], $permissions))
                continue;

            $menu .= "<li><a href='{{@baseURI}}{$item['link']}'><img src='{{@baseURI}}media/menu/{$item['icon']}' alt=''><span>{$item['title']}</span></a></li>";
        }

        $this->setVariable('portalMenu', $menu);
    }
}