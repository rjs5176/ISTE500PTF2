<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 3:21 PM
 */


abstract class Config
{
    const OPTIONS = array(
        'appName' => 'TRS',

        'companyName' => '',
        'useCustomStyles' => TRUE,

        'baseURI' => '/is/',

        'cookieName' => 'ML',

        'icURL' => 'https://piratetoyfund.llrnetworks.com/ic/',
        'icSecret' => '83ca0fe3863459b59ab87ef15d6bc8aad5dedfdd26be2d26c59e5b9cd6f4467f73b7387761ea99c20eeadec8e68171d2a916d26134d5457650023b56f55824be',

        // Specify enabled extensions
        'enabledExtensions' => array(
            'trs'
        ),

        // Specify whitelist I.P. networks for public pages
        'ipWhitelist' => array(
            '10.0.0.0/24'
        )
    );
}