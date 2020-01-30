<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP InfoScape
 *
 * User: lromero
 * Date: 5/04/2019
 * Time: 10:23 PM
 */


namespace controllers\admin;


use controllers\Controller;
use views\pages\admin\RoleCreatePage;
use views\pages\admin\RoleEditPage;
use views\pages\admin\RoleSearchPage;
use views\View;

class RoleController extends Controller
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
                return new RoleSearchPage();
            case 'new':
                return new RoleCreatePage();
            default:
                return new RoleEditPage($param);
        }
    }
}