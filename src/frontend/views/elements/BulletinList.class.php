<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/28/2019
 * Time: 12:58 PM
 */


namespace views\elements;


use utilities\InfoCentralConnection;
use views\content\Bulletin;
use views\View;

class BulletinList extends View
{
    /**
     * BulletinList constructor.
     * @throws \exceptions\ViewException
     * @throws \exceptions\InfoCentralException
     */
    public function __construct()
    {
        $this->setTemplateFromHTML('BulletinList', self::TEMPLATE_ELEMENT);

        $bulletins = InfoCentralConnection::getResponse(InfoCentralConnection::GET, 'currentUser/bulletins')->getBody();
        $bulletinString = "";

        foreach($bulletins as $bulletinData)
        {
            $bulletin = new Bulletin($bulletinData['title'], $bulletinData['message'], $bulletinData['type']);

            $bulletinString .= $bulletin->getTemplate();
        }

        $this->setVariable('content', $bulletinString);
    }
}