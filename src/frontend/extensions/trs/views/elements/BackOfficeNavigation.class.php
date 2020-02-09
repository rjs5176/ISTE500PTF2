<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/08/2020
 * Time: 3:42 PM
 */


namespace extensions\trs\views\elements;


use views\elements\Navigation;

class BackOfficeNavigation extends Navigation
{
    public const BASE_URI = 'trsbackoffice/';

    public const LINKS = array(
        'organizations' => array(
            'title' => 'Organizations',
            'permission' => 'trs_organizations-r',
            'icon' => 'work',
            'pages' => array(
                array(
                    'title' => 'Search Organizations',
                    'permission' => 'trs_organizations-r',
                    'icon' => 'search',
                    'link' => 'organizations'
                ),
                array(
                    'title' => 'Create Organization',
                    'permission' => 'trs_organizations-w',
                    'icon' => 'add',
                    'link' => 'organizations/new'
                )
            )
        ),
        'commodities' => array(
            'title' => 'Commodities',
            'permission' => 'trs_commodities-r',
            'icon' => 'shopping_cart',
            'pages' => array(
                array(
                    'title' => 'Search Commodities',
                    'permission' => 'trs_commodities-r',
                    'icon' => 'search',
                    'link' => 'commodities'
                ),
                array(
                    'title' => 'Create Commodity',
                    'permission' => 'trs_commodities-w',
                    'icon' => 'add',
                    'link' => 'commodities/new'
                ),
                array(
                    'title' => 'Commodity Categories',
                    'permission' => 'trs_commodities-a',
                    'icon' => 'assignment',
                    'link' => 'categories'
                ),
                array(
                    'title' => 'Warehouses',
                    'permission' => 'trs_warehouses-r',
                    'icon' => 'local_shipping',
                    'link' => 'warehouses'
                ),

            )
        )
    );

    public function __construct()
    {
        parent::__construct(self::BASE_URI, self::LINKS);
    }
}