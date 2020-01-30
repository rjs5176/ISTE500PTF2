<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 12:30 AM
 */


namespace views\pages\admin;


use views\forms\admin\APIKeyForm;
;

class APIKeyCreatePage extends AdminDocument
{
    /**
     * APIKeyCreatePage constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct('api-settings', 'api_keys');

        $this->setVariable('tabTitle', 'API Key (Issue)');

        $form = new APIKeyForm();

        $this->setVariable('content', $form->getTemplate());
        $this->setVariable('formScript', 'return create()');
    }
}