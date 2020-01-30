<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:38 PM
 */


namespace views\elements\admin;


use views\elements\Navigation;

class AdminNavigation extends Navigation
{
    public const BASE_URI = 'admin/';

    public const LINKS = array(
        'users' => array(
            'title' => 'Users',
            'permission' => 'settings',
            'icon' => 'account_circle',
            'pages' => array(
                array(
                    'title' => 'Search Users',
                    'link' => 'users',
                    'icon' => 'search',
                    'permission' => 'settings'
                ),
                array(
                    'title' => 'New User',
                    'link' => 'users/new',
                    'icon' => 'add_circle',
                    'permission' => 'settings'
                ),
                array(
                    'title' => 'Login History',
                    'link' => 'userlogs',
                    'icon' => 'history',
                    'permission' => 'settings'
                ),
                array(
                    'title' => 'Failed Login History',
                    'link' => 'badlogs',
                    'icon' => 'error',
                    'permission' => 'settings'
                ),
                array(
                    'title' => 'Audit Permissions',
                    'link' => 'permissions',
                    'icon' => 'vpn_key',
                    'permission' => 'settings'
                )
            )
        ),
        'roles' => array(
            'title' => 'Roles',
            'permission' => 'settings',
            'icon' => 'group',
            'pages' => array(
                array(
                    'title' => 'Search Roles',
                    'permission' => 'settings',
                    'icon' => 'search',
                    'link' => 'roles'
                ),
                array(
                    'title' => 'New Role',
                    'permission' => 'settings',
                    'icon' => 'add_circle',
                    'link' => 'roles/new'
                )
            )
        ),
        'api_keys' => array(
            'title' => 'API Keys',
            'permission' => 'api-settings',
            'icon' => 'vpn_key',
            'pages' => array(
                array(
                    'title' => 'Search API Keys',
                    'permission' => 'api-settings',
                    'icon' => 'search',
                    'link' => 'icadmin'
                ),
                array(
                    'title' => 'Issue API Key',
                    'permission' => 'api-settings',
                    'icon' => 'add_circle',
                    'link' => 'icadmin/new'
                )
            )
        ),
        'notifications' => array(
            'title' => 'Send Notification',
            'permission' => 'settings',
            'icon' => 'email',
            'link' => 'notifications/send'
        ),
        'bulletins' => array(
            'title' => 'Bulletins',
            'permission' => 'settings',
            'icon' => 'event_note',
            'pages' => array(
                array(
                    'title' => 'Search Bulletins',
                    'permission' => 'settings',
                    'icon' => 'search',
                    'link' => 'bulletins',
                ),
                array(
                    'title' => 'New Bulletin',
                    'permission' => 'settings',
                    'icon' => 'add_circle',
                    'link' => 'bulletins/new',
                )
            )
        )
    );

    public function __construct()
    {
        parent::__construct(self::BASE_URI, self::LINKS);
    }
}