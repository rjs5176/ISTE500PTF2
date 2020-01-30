<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 4:34 PM
 */


namespace controllers\admin;


use controllers\Controller;
use views\pages\admin\BulletinCreatePage;
use views\pages\admin\BulletinEditPage;
use views\pages\admin\BulletinSearchPage;
use views\View;

class BulletinController extends Controller
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
                return new BulletinSearchPage();
            case 'new':
                return new BulletinCreatePage();
            default:
                return new BulletinEditPage($param);
        }
    }
}