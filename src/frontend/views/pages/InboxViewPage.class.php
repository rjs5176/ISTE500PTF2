<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 4/08/2019
 * Time: 4:44 PM
 */


namespace views\pages;

use exceptions\EntryNotFoundException;
use utilities\InfoCentralConnection;

class InboxViewPage extends PortalDocument
{
    /**
     * InboxViewPage constructor.
     * @param string|null $notificationId
     * @throws EntryNotFoundException
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct(?string $notificationId)
    {
        parent::__construct();

        $response = InfoCentralConnection::getResponse(InfoCentralConnection::GET, "currentUser/notifications/$notificationId");

        if($response->getResponseCode() != '200')
            throw new EntryNotFoundException(EntryNotFoundException::MESSAGES[EntryNotFoundException::PRIMARY_KEY_NOT_FOUND], EntryNotFoundException::PRIMARY_KEY_NOT_FOUND);

        $this->setVariable("content", self::templateFileContents("InboxNotification", self::TEMPLATE_PAGE));
        $this->setVariable("tabTitle", "View Notification");

        $notification = $response->getBody();

        $this->setVariable('id', $notification['id']);
        $this->setVariable('title', htmlentities($notification['title']));
        $this->setVariable('date', $notification['time']);
        $this->setVariable('message', $notification['data']);
    }
}