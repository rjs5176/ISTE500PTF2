<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 5:37 PM
 */


namespace views\pages\admin;


use views\forms\admin\NotificationForm;
;

class SendNotificationPage extends AdminDocument
{
    public function __construct()
    {
        parent::__construct('settings');

        $this->setVariable('tabTitle', 'Send Notification');

        $form = new NotificationForm();
        $this->setVariable('content', $form->getTemplate());
    }
}