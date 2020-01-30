<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/05/2019
 * Time: 12:09 AM
 */


namespace controllers\admin;


use controllers\Controller;
use views\pages\admin\APIKeyCreatePage;
use views\pages\admin\APIKeyEditPage;
use views\pages\admin\APIKeyListPage;
use views\View;

class APIKeyController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): ?View
    {
        $param = $this->request->next();

        switch($param)
        {
            case null:
                return new APIKeyListPage();
            case 'new':
                return new APIKeyCreatePage();
            default:
                return new APIKeyEditPage($param);
        }
    }
}