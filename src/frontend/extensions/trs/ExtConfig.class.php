<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 2/08/2020
 * Time: 2:23 PM
 */


namespace extensions\trs;


class ExtConfig
{
    public const MENU = array(
        'trs_back_office' => array(
            'title' => 'TRS Back Office',
            'permission' => 'trs_backoffice',
            'icon' => 'facilitiesmanagement.svg',
            'link' => 'trsbackoffice'
        ),
        'trs_rep_portal' => array(
            'title' => 'TRS Representative Portal',
            'permission' => 'trs_repportal',
            'icon' => 'servicecenter.svg',
            'link' => 'trsrepportal'
        )
    );

    public const ROUTES = array(
        'trsbackoffice' => 'extensions\trs\controllers\TRSBackOfficeController',
        'trsrepportal' => 'extensions\trs\controllers\TRSRepPortalController',
    );
}