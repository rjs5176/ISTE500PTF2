<?php
/**
 * User: rjs5176
 * Date: 02/01/2020
 */


namespace extensions\trs;


class ExtConfig
{
    public const MENU = array(
        'toyrequestsystem' => array(
            'title' => 'Toy Request System',
            'permission' => 'trs',
            'icon' => '',
            'link' => 'trs'
        ),
    );

    public const ROUTES = array(
        'trs' => 'extensions\trs\controllers\TRSController',
    );
	
	//public const OPTIONS = array(
		
	);
}